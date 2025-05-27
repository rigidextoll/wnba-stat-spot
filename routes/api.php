<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\Api\DataAggregatorController;
use App\Http\Controllers\Api\PropScannerController;
use App\Http\Controllers\WnbaPredictionsController;
use App\Http\Controllers\Api\BettingAnalyticsController;
use App\Http\Controllers\Api\DataQualityController;
use App\Http\Controllers\Api\PredictionTestingController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Simple test endpoint (no database required)
Route::get('/test', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is working',
        'timestamp' => now()->toISOString(),
        'php_version' => PHP_VERSION,
        'laravel_version' => app()->version()
    ]);
});

// Health check endpoint for container debugging
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
        'message' => 'API is working'
    ]);
});

// Database setup status endpoint
Route::get('/status', function () {
    try {
        $status = [
            'api' => 'ok',
            'database_connected' => false,
            'migrations_table' => false,
            'wnba_tables' => [
                'wnba_players' => false,
                'wnba_teams' => false,
                'wnba_games' => false,
                'wnba_player_games' => false,
            ],
            'queue_tables' => [
                'jobs' => false,
                'failed_jobs' => false,
                'job_batches' => false,
            ],
            'setup_complete' => false,
            'message' => 'Checking database status...'
        ];

        // Test database connection
        try {
            DB::connection()->getPdo();
            $status['database_connected'] = true;
        } catch (\Exception $e) {
            $status['message'] = 'Database connection failed: ' . $e->getMessage();
            return response()->json($status, 503);
        }

        // Check if migrations table exists
        try {
            DB::table('migrations')->count();
            $status['migrations_table'] = true;
        } catch (\Exception $e) {
            $status['message'] = 'Migrations table not found. Database setup in progress...';
            return response()->json($status, 503);
        }

        // Check WNBA tables
        foreach ($status['wnba_tables'] as $table => $exists) {
            try {
                $status['wnba_tables'][$table] = Schema::hasTable($table);
            } catch (\Exception $e) {
                // Table check failed
            }
        }

        // Check queue tables
        foreach ($status['queue_tables'] as $table => $exists) {
            try {
                $status['queue_tables'][$table] = Schema::hasTable($table);
            } catch (\Exception $e) {
                // Table check failed
            }
        }

        // Determine if setup is complete
        $wnbaTablesReady = array_sum($status['wnba_tables']) >= 2; // At least players and teams
        $queueTablesReady = array_sum($status['queue_tables']) >= 2; // At least jobs and failed_jobs

        $status['setup_complete'] = $status['database_connected'] &&
                                   $status['migrations_table'] &&
                                   $wnbaTablesReady &&
                                   $queueTablesReady;

        if ($status['setup_complete']) {
            $status['message'] = 'Database setup complete. All systems ready.';
        } else {
            $status['message'] = 'Database setup in progress. Please wait...';
        }

        return response()->json($status, $status['setup_complete'] ? 200 : 503);

    } catch (\Exception $e) {
        return response()->json([
            'api' => 'ok',
            'database_connected' => false,
            'setup_complete' => false,
            'message' => 'Status check failed: ' . $e->getMessage(),
            'error' => $e->getMessage()
        ], 503);
    }
});

// Basic data endpoints
Route::get('/teams', [TeamController::class, 'index']);
Route::get('/teams/{teamId}', [TeamController::class, 'show']);
Route::get('/teams/{teamId}/players', [TeamController::class, 'players']);
Route::get('/teams/summary', [TeamController::class, 'summary']);
Route::post('/teams/clear-cache', [TeamController::class, 'clearCache']);

Route::get('/players', [PlayerController::class, 'index']);
Route::get('/players/summary', [PlayerController::class, 'summary']);
Route::post('/players/clear-cache', [PlayerController::class, 'clearCache']);
Route::get('/players/{id}', [PlayerController::class, 'show']);

Route::get('/games', [GameController::class, 'index']);
Route::get('/stats', [StatsController::class, 'index']);

// WNBA Analytics and Predictions API Routes
Route::prefix('wnba')->group(function () {
    // Test endpoint
    Route::get('/test/player/{playerId}', [WnbaPredictionsController::class, 'testAnalytics']);

    // Player predictions and analytics
    Route::get('/analytics/player/{playerId}', [WnbaPredictionsController::class, 'getPlayerAnalytics']);
    Route::post('/predictions/props', [WnbaPredictionsController::class, 'getPlayerPropPredictions']);
    Route::post('/predictions/betting', [WnbaPredictionsController::class, 'getBettingRecommendations']);
    Route::get('/predictions/prop-bets', [WnbaPredictionsController::class, 'getPropBets']);
    Route::post('/predictions/generate', [WnbaPredictionsController::class, 'generatePrediction']);

    // Team analytics
    Route::get('/analytics/team/{teamId}', [WnbaPredictionsController::class, 'getTeamAnalytics']);

    // Game analytics
    Route::get('/analytics/game/{gameId}', [WnbaPredictionsController::class, 'getGameAnalytics']);

    // Model validation and performance
    Route::get('/validation', [WnbaPredictionsController::class, 'getModelValidation']);

    // Cache management
    Route::get('/cache/stats', [WnbaPredictionsController::class, 'getCacheStats']);
    Route::post('/cache/clear', [WnbaPredictionsController::class, 'clearCache']);
    Route::post('/cache/warm', [WnbaPredictionsController::class, 'warmCache']);

    // Prop Scanner endpoints
    Route::prefix('prop-scanner')->group(function () {
        Route::get('/scan-all', [PropScannerController::class, 'scanAllPlayers']);
        Route::get('/scan-player/{playerId}', [PropScannerController::class, 'scanPlayer']);
    });

    // Data Aggregator endpoints
    Route::prefix('data')->group(function () {
        // Player data aggregation
        Route::get('/players/{playerId}', [DataAggregatorController::class, 'getPlayerData']);
        Route::get('/players/{playerId}/props', [DataAggregatorController::class, 'getPropData']);

        // Team data aggregation
        Route::get('/teams/{teamId}', [DataAggregatorController::class, 'getTeamData']);

        // Game data aggregation
        Route::get('/games/{gameId}', [DataAggregatorController::class, 'getGameData']);

        // Matchup data aggregation
        Route::get('/matchups/{team1Id}/{team2Id}', [DataAggregatorController::class, 'getMatchupData']);

        // League data aggregation
        Route::get('/league/{season}', [DataAggregatorController::class, 'getLeagueData']);
    });

    // Prop Scanner
    Route::get('/prop-scanner/scan', [PropScannerController::class, 'scanAllPlayers']);
    Route::get('/prop-scanner/player/{playerId}', [PropScannerController::class, 'scanPlayer']);

    // Betting Analytics
    Route::get('/betting/analytics', [BettingAnalyticsController::class, 'getAnalytics']);

    // Data Quality
    Route::get('/data-quality/metrics', [DataQualityController::class, 'getMetrics']);

    // Monte Carlo Simulations
    Route::post('/monte-carlo/run', [WnbaPredictionsController::class, 'runMonteCarloSimulation']);

    // Prediction Testing & Validation
    Route::prefix('testing')->group(function () {
        Route::post('/player-accuracy', [PredictionTestingController::class, 'testPlayerAccuracy']);
        Route::post('/bulk-testing', [PredictionTestingController::class, 'runBulkTesting']);
        Route::get('/historical', [PredictionTestingController::class, 'getHistoricalTests']);

        // Historical Testing Routes
        Route::post('/historical/start', [PredictionTestingController::class, 'startHistoricalTesting']);
        Route::get('/historical/results', [PredictionTestingController::class, 'getHistoricalResults']);
        Route::get('/historical/status', [PredictionTestingController::class, 'getTestingStatus']);
        Route::get('/historical/leaderboard', [PredictionTestingController::class, 'getLeaderboard']);
    });
});
