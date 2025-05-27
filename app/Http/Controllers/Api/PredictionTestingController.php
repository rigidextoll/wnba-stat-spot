<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WnbaPlayer;
use App\Models\WnbaPlayerGame;
use App\Models\PredictionTestResult;
use App\Jobs\RunHistoricalPredictionTests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PredictionTestingController extends Controller
{
    /**
     * Run prediction accuracy test for a specific player
     */
    public function testPlayerAccuracy(Request $request): JsonResponse
    {
        // Log the raw request data first
        Log::info('Raw prediction testing request received:', [
            'all_input' => $request->all(),
            'content_type' => $request->header('Content-Type'),
            'method' => $request->method(),
            'url' => $request->url()
        ]);

        try {
            $request->validate([
                'player_id' => 'required|string',
                'stat_type' => 'required|string|in:points,rebounds,assists,steals,blocks',
                'test_games' => 'integer|min:1|max:20',
                'betting_lines' => 'array|max:10'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed for prediction testing:', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'error' => 'Validation failed',
                'details' => $e->errors(),
                'received_data' => $request->all()
            ], 400);
        }

        $playerId = $request->input('player_id');
        $statType = $request->input('stat_type');
        $testGames = $request->input('test_games', 5);
        $bettingLines = $request->input('betting_lines', []);

        Log::info('Prediction testing request', [
            'player_id' => $playerId,
            'stat_type' => $statType,
            'test_games' => $testGames,
            'betting_lines' => $bettingLines
        ]);

        try {
            // Get player info
            $player = WnbaPlayer::where('athlete_id', $playerId)->first();
            if (!$player) {
                Log::warning('Player not found: ' . $playerId);
                return response()->json(['success' => false, 'error' => 'Player not found'], 404);
            }

            Log::info('Found player: ' . $player->athlete_display_name . ' (ID: ' . $player->id . ')');

            // Get recent games for testing
            $recentGames = WnbaPlayerGame::where('player_id', $player->id)
                ->where('did_not_play', false)
                ->with('game')
                ->orderBy('id', 'desc')
                ->limit($testGames)
                ->get();

            Log::info('Found ' . $recentGames->count() . ' recent games for player');

            if ($recentGames->count() < $testGames) {
                Log::warning('Not enough games found', [
                    'player_id' => $playerId,
                    'player_name' => $player->athlete_display_name,
                    'games_found' => $recentGames->count(),
                    'games_requested' => $testGames,
                    'total_games' => WnbaPlayerGame::where('player_id', $player->id)->count(),
                    'non_dnp_games' => WnbaPlayerGame::where('player_id', $player->id)->where('did_not_play', false)->count()
                ]);

                return response()->json([
                    'success' => false,
                    'error' => "Not enough games found. Player has {$recentGames->count()} games, requested {$testGames}",
                    'debug' => [
                        'total_games' => WnbaPlayerGame::where('player_id', $player->id)->count(),
                        'non_dnp_games' => WnbaPlayerGame::where('player_id', $player->id)->where('did_not_play', false)->count(),
                        'games_found' => $recentGames->count(),
                        'games_requested' => $testGames
                    ]
                ], 400);
            }

            // Calculate season average for the stat
            $allGames = WnbaPlayerGame::where('player_id', $player->id)
                ->where('did_not_play', false)
                ->get();

            Log::info('Total games for season average calculation: ' . $allGames->count());

            $seasonAverage = $allGames->avg($statType) ?? 0;

            Log::info('Season average calculated', [
                'stat_type' => $statType,
                'season_average' => $seasonAverage,
                'total_games_used' => $allGames->count()
            ]);

            // If no betting lines provided, generate them around the season average
            if (empty($bettingLines)) {
                // Generate realistic betting lines around season average
                // Sportsbooks typically use half-points (.5) to avoid pushes
                $baseAverage = round($seasonAverage);

                // All lines will be X.5 format (half-points)
                // For stats that are typically lower (assists, steals, blocks)
                if (in_array($statType, ['assists', 'steals', 'blocks']) && $baseAverage <= 10) {
                    $bettingLines = [
                        max(0.5, $baseAverage - 2.5),
                        max(0.5, $baseAverage - 1.5),
                        max(0.5, $baseAverage - 0.5),
                        $baseAverage + 0.5,
                        $baseAverage + 1.5,
                        $baseAverage + 2.5
                    ];
                }
                // For higher stats (points, rebounds)
                else {
                    $bettingLines = [
                        max(0.5, $baseAverage - 2.5),
                        max(0.5, $baseAverage - 1.5),
                        max(0.5, $baseAverage - 0.5),
                        $baseAverage + 0.5,
                        $baseAverage + 1.5,
                        $baseAverage + 2.5
                    ];
                }

                // Ensure all lines are half-points (.5)
                $bettingLines = array_map(function($line) {
                    // Force all lines to be X.5 format
                    return floor($line) + 0.5;
                }, $bettingLines);

                // Remove duplicates and ensure minimum values
                $bettingLines = array_unique($bettingLines);
                $bettingLines = array_filter($bettingLines, function($line) {
                    return $line >= 0.5; // No negative or zero lines
                });

                // Ensure we have exactly 6 lines, add more if needed
                if (count($bettingLines) < 6) {
                    $maxLine = max($bettingLines);
                    while (count($bettingLines) < 6) {
                        $maxLine += 1.0; // Add 1.0 to maintain .5 format
                        $bettingLines[] = $maxLine;
                    }
                }

                // Sort and take first 6
                sort($bettingLines);
                $bettingLines = array_slice($bettingLines, 0, 6);
            }

            // Run predictions for each line and compare with actual results
            $testResults = [];
            $overallStats = [
                'total_predictions' => 0,
                'correct_predictions' => 0,
                'accuracy_percentage' => 0,
                'by_line' => []
            ];

            foreach ($bettingLines as $line) {
                $lineResults = $this->testLineAccuracy($player, $statType, $line, $recentGames, $seasonAverage);
                $testResults[] = $lineResults;

                $overallStats['total_predictions'] += $lineResults['total_predictions'];
                $overallStats['correct_predictions'] += $lineResults['correct_predictions'];
                $overallStats['by_line'][] = [
                    'line' => $line,
                    'accuracy' => $lineResults['accuracy_percentage']
                ];
            }

            $overallStats['accuracy_percentage'] = $overallStats['total_predictions'] > 0
                ? round(($overallStats['correct_predictions'] / $overallStats['total_predictions']) * 100, 1)
                : 0;

            return response()->json([
                'success' => true,
                'data' => [
                    'player' => [
                        'athlete_id' => $player->athlete_id,
                        'name' => $player->athlete_display_name,
                        'position' => $player->athlete_position_abbreviation
                    ],
                    'test_parameters' => [
                        'stat_type' => $statType,
                        'test_games' => $testGames,
                        'betting_lines' => $bettingLines,
                        'season_average' => round($seasonAverage, 1)
                    ],
                    'actual_results' => $recentGames->map(function($game, $index) use ($statType) {
                        // Try to get the actual game date from the related game, fallback to created_at
                        $gameDate = $game->game && $game->game->game_date
                            ? $game->game->game_date
                            : $game->created_at->format('Y-m-d');

                        return [
                            'game_number' => $index + 1,
                            'date' => $gameDate,
                            'actual_value' => $game->{$statType}
                        ];
                    })->values(),
                    'line_tests' => $testResults,
                    'overall_performance' => $overallStats,
                    'insights' => $this->generateInsights($overallStats, $seasonAverage, $recentGames, $statType),
                    'tested_at' => now()->toISOString()
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Prediction testing error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to run prediction test'], 500);
        }
    }

    /**
     * Test accuracy for a specific betting line
     */
    private function testLineAccuracy($player, $statType, $line, $recentGames, $seasonAverage)
    {
        // Generate prediction for this line (simplified version)
        $predictedValue = $seasonAverage;
        $confidence = 0.75; // Base confidence

        // Calculate probabilities based on normal distribution around season average
        $stdDev = $this->calculateStandardDeviation($player->id, $statType);
        $zScore = ($line - $predictedValue) / max($stdDev, 1);

        // Convert z-score to probability
        $probabilityUnder = $this->normalCDF($zScore);
        $probabilityOver = 1 - $probabilityUnder;

        // Determine recommendation
        $recommendation = 'avoid';
        if ($probabilityOver > 0.6) {
            $recommendation = 'over';
        } elseif ($probabilityUnder > 0.6) {
            $recommendation = 'under';
        }

        // Test against actual results
        $predictions = [];
        $correctPredictions = 0;
        $totalPredictions = 0;

        foreach ($recentGames as $index => $game) {
            $actualValue = $game->{$statType};
            $actualResult = $actualValue > $line ? 'over' : 'under';

            // Determine what our model would have predicted
            $predictedResult = $probabilityOver > $probabilityUnder ? 'over' : 'under';
            $isCorrect = $actualResult === $predictedResult;

            $predictions[] = [
                'game_number' => $index + 1,
                'actual_value' => $actualValue,
                'actual_result' => $actualResult,
                'predicted_result' => $predictedResult,
                'correct' => $isCorrect,
                'line' => $line
            ];

            if ($isCorrect) $correctPredictions++;
            $totalPredictions++;
        }

        return [
            'line' => $line,
            'predicted_value' => round($predictedValue, 1),
            'confidence' => round($confidence, 3),
            'probability_over' => round($probabilityOver, 3),
            'probability_under' => round($probabilityUnder, 3),
            'recommendation' => $recommendation,
            'predictions' => $predictions,
            'correct_predictions' => $correctPredictions,
            'total_predictions' => $totalPredictions,
            'accuracy_percentage' => $totalPredictions > 0 ? round(($correctPredictions / $totalPredictions) * 100, 1) : 0
        ];
    }

    /**
     * Calculate standard deviation for a player's stat
     */
    private function calculateStandardDeviation($playerId, $statType)
    {
        $games = WnbaPlayerGame::where('player_id', $playerId)
            ->where('did_not_play', false)
            ->pluck($statType)
            ->toArray();

        if (count($games) < 2) return 3.0; // Default std dev

        $mean = array_sum($games) / count($games);
        $variance = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $games)) / count($games);

        return sqrt($variance);
    }

    /**
     * Normal cumulative distribution function approximation
     */
    private function normalCDF($x)
    {
        return 0.5 * (1 + $this->erf($x / sqrt(2)));
    }

    /**
     * Error function approximation
     */
    private function erf($x)
    {
        $a1 =  0.254829592;
        $a2 = -0.284496736;
        $a3 =  1.421413741;
        $a4 = -1.453152027;
        $a5 =  1.061405429;
        $p  =  0.3275911;

        $sign = $x < 0 ? -1 : 1;
        $x = abs($x);

        $t = 1.0 / (1.0 + $p * $x);
        $y = 1.0 - ((((($a5 * $t + $a4) * $t) + $a3) * $t + $a2) * $t + $a1) * $t * exp(-$x * $x);

        return $sign * $y;
    }

    /**
     * Generate insights from test results
     */
    private function generateInsights($overallStats, $seasonAverage, $recentGames, $statType)
    {
        $insights = [];

        // Overall accuracy insight
        if ($overallStats['accuracy_percentage'] >= 80) {
            $insights[] = "🎯 Excellent accuracy ({$overallStats['accuracy_percentage']}%) - Model is highly reliable";
        } elseif ($overallStats['accuracy_percentage'] >= 70) {
            $insights[] = "✅ Good accuracy ({$overallStats['accuracy_percentage']}%) - Model shows strong predictive power";
        } elseif ($overallStats['accuracy_percentage'] >= 60) {
            $insights[] = "⚠️ Moderate accuracy ({$overallStats['accuracy_percentage']}%) - Model needs improvement";
        } else {
            $insights[] = "❌ Low accuracy ({$overallStats['accuracy_percentage']}%) - Model requires significant adjustments";
        }

        // Volatility analysis
        $values = $recentGames->pluck($statType)->toArray();
        $stdDev = $this->calculateStandardDeviation($recentGames->first()->player_id, $statType);

        if ($stdDev > $seasonAverage * 0.4) {
            $insights[] = "📊 High volatility detected - Player performance varies significantly";
        } elseif ($stdDev < $seasonAverage * 0.2) {
            $insights[] = "📈 Low volatility - Player shows consistent performance";
        }

        // Line-specific insights
        $bestLine = collect($overallStats['by_line'])->sortByDesc('accuracy')->first();
        $worstLine = collect($overallStats['by_line'])->sortBy('accuracy')->first();

        if ($bestLine && $worstLine) {
            $insights[] = "🎲 Best accuracy at line {$bestLine['line']} ({$bestLine['accuracy']}%)";
            $insights[] = "⚡ Lowest accuracy at line {$worstLine['line']} ({$worstLine['accuracy']}%)";
        }

        return $insights;
    }

    /**
     * Get historical test results
     */
    public function getHistoricalTests(Request $request): JsonResponse
    {
        // This would typically come from a database table storing test results
        // For now, return a placeholder structure
        return response()->json([
            'success' => true,
            'data' => [
                'total_tests_run' => 0,
                'average_accuracy' => 0,
                'recent_tests' => [],
                'accuracy_trends' => []
            ]
        ]);
    }

    /**
     * Run bulk testing across multiple players
     */
    public function runBulkTesting(Request $request): JsonResponse
    {
        $request->validate([
            'player_ids' => 'required|array|min:1|max:10',
            'stat_type' => 'required|string|in:points,rebounds,assists,steals,blocks',
            'test_games' => 'integer|min:1|max:10'
        ]);

        $playerIds = $request->input('player_ids');
        $statType = $request->input('stat_type');
        $testGames = $request->input('test_games', 5);

        $results = [];
        $overallStats = [
            'total_predictions' => 0,
            'correct_predictions' => 0,
            'players_tested' => 0
        ];

        foreach ($playerIds as $playerId) {
            try {
                $testRequest = new Request([
                    'player_id' => $playerId,
                    'stat_type' => $statType,
                    'test_games' => $testGames
                ]);

                $response = $this->testPlayerAccuracy($testRequest);
                $responseData = json_decode($response->getContent(), true);

                if ($responseData['success']) {
                    $playerData = $responseData['data'];
                    $results[] = [
                        'player' => $playerData['player'],
                        'accuracy' => $playerData['overall_performance']['accuracy_percentage'],
                        'total_predictions' => $playerData['overall_performance']['total_predictions'],
                        'correct_predictions' => $playerData['overall_performance']['correct_predictions']
                    ];

                    $overallStats['total_predictions'] += $playerData['overall_performance']['total_predictions'];
                    $overallStats['correct_predictions'] += $playerData['overall_performance']['correct_predictions'];
                    $overallStats['players_tested']++;
                }
            } catch (\Exception $e) {
                Log::error("Bulk testing error for player {$playerId}: " . $e->getMessage());
            }
        }

        $overallStats['average_accuracy'] = $overallStats['total_predictions'] > 0
            ? round(($overallStats['correct_predictions'] / $overallStats['total_predictions']) * 100, 1)
            : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'results' => $results,
                'overall_stats' => $overallStats,
                'tested_at' => now()->toISOString()
            ]
        ]);
    }

    /**
     * Start historical prediction testing job
     */
    public function startHistoricalTesting(Request $request): JsonResponse
    {
        $request->validate([
            'stat_types' => 'array|min:1',
            'stat_types.*' => 'string|in:points,rebounds,assists,steals,blocks',
            'min_games' => 'integer|min:3|max:20',
            'test_games' => 'integer|min:1|max:10',
            'player_limit' => 'integer|min:1|max:100|nullable'
        ]);

        $statTypes = $request->input('stat_types', ['points', 'rebounds', 'assists', 'steals', 'blocks']);
        $minGames = $request->input('min_games', 5);
        $testGames = $request->input('test_games', 3);
        $playerLimit = $request->input('player_limit');

        try {
            // Dispatch the background job
            $job = new RunHistoricalPredictionTests($statTypes, $minGames, $testGames, $playerLimit);
            dispatch($job);

            Log::info('Historical prediction testing job dispatched', [
                'stat_types' => $statTypes,
                'min_games' => $minGames,
                'test_games' => $testGames,
                'player_limit' => $playerLimit
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Historical testing job started successfully',
                'data' => [
                    'job_dispatched' => true,
                    'estimated_duration' => $this->estimateJobDuration($statTypes, $minGames, $playerLimit),
                    'parameters' => [
                        'stat_types' => $statTypes,
                        'min_games' => $minGames,
                        'test_games' => $testGames,
                        'player_limit' => $playerLimit
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to start historical testing job: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to start historical testing job'
            ], 500);
        }
    }

    /**
     * Get historical test results with analytics
     */
    public function getHistoricalResults(Request $request): JsonResponse
    {
        $request->validate([
            'stat_type' => 'string|in:points,rebounds,assists,steals,blocks|nullable',
            'player_id' => 'string|nullable',
            'min_accuracy' => 'numeric|min:0|max:100|nullable',
            'limit' => 'integer|min:1|max:100',
            'sort_by' => 'string|in:accuracy_percentage,tested_at,player_name,stat_type',
            'sort_order' => 'string|in:asc,desc'
        ]);

        $statType = $request->input('stat_type');
        $playerId = $request->input('player_id');
        $minAccuracy = $request->input('min_accuracy');
        $limit = $request->input('limit', 50);
        $sortBy = $request->input('sort_by', 'accuracy_percentage');
        $sortOrder = $request->input('sort_order', 'desc');

        try {
            // Build query
            $query = PredictionTestResult::query();

            if ($statType) {
                $query->byStat($statType);
            }

            if ($playerId) {
                $query->byPlayer($playerId);
            }

            if ($minAccuracy) {
                $query->where('accuracy_percentage', '>=', $minAccuracy);
            }

            // Get results
            $results = $query->orderBy($sortBy, $sortOrder)
                ->limit($limit)
                ->get();

            // Get analytics
            $analytics = [
                'top_performers' => PredictionTestResult::getTopPerformers(10),
                'stat_performance' => PredictionTestResult::getStatTypePerformance(),
                'player_rankings' => PredictionTestResult::getPlayerRankings($statType),
                'accuracy_trends' => PredictionTestResult::getAccuracyTrends(30),
                'summary_stats' => $this->getHistoricalSummaryStats()
            ];

            return response()->json([
                'success' => true,
                'data' => [
                    'results' => $results,
                    'analytics' => $analytics,
                    'filters_applied' => [
                        'stat_type' => $statType,
                        'player_id' => $playerId,
                        'min_accuracy' => $minAccuracy,
                        'limit' => $limit,
                        'sort_by' => $sortBy,
                        'sort_order' => $sortOrder
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to get historical results: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to retrieve historical results'
            ], 500);
        }
    }

    /**
     * Get testing job status
     */
    public function getTestingStatus(): JsonResponse
    {
        try {
            // Get recent test batches
            $recentBatches = PredictionTestResult::selectRaw('
                test_batch_id,
                test_type,
                COUNT(*) as total_tests,
                AVG(accuracy_percentage) as avg_accuracy,
                MIN(tested_at) as started_at,
                MAX(tested_at) as completed_at
            ')
            ->where('tested_at', '>=', now()->subDays(7))
            ->groupBy(['test_batch_id', 'test_type'])
            ->orderBy('started_at', 'desc')
            ->limit(10)
            ->get();

            // Get overall statistics
            $overallStats = [
                'total_tests_run' => PredictionTestResult::count(),
                'average_accuracy' => PredictionTestResult::avg('accuracy_percentage'),
                'best_accuracy' => PredictionTestResult::max('accuracy_percentage'),
                'worst_accuracy' => PredictionTestResult::min('accuracy_percentage'),
                'total_players_tested' => PredictionTestResult::distinct('player_id')->count(),
                'last_test_run' => PredictionTestResult::max('tested_at')
            ];

            return response()->json([
                'success' => true,
                'data' => [
                    'recent_batches' => $recentBatches,
                    'overall_stats' => $overallStats,
                    'status' => 'ready' // Could be enhanced to check actual job queue status
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to get testing status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to get testing status'
            ], 500);
        }
    }

    /**
     * Get leaderboard of best predictions
     */
    public function getLeaderboard(Request $request): JsonResponse
    {
        $request->validate([
            'stat_type' => 'string|in:points,rebounds,assists,steals,blocks|nullable',
            'limit' => 'integer|min:1|max:50'
        ]);

        $statType = $request->input('stat_type');
        $limit = $request->input('limit', 20);

        try {
            $query = PredictionTestResult::selectRaw('
                player_id,
                player_name,
                player_position,
                stat_type,
                AVG(accuracy_percentage) as avg_accuracy,
                MAX(accuracy_percentage) as best_accuracy,
                COUNT(*) as test_count,
                AVG(sample_size) as avg_sample_size,
                AVG(confidence_score) as avg_confidence
            ')
            ->groupBy(['player_id', 'player_name', 'player_position', 'stat_type'])
            ->having('test_count', '>=', 1)
            ->orderByDesc('avg_accuracy');

            if ($statType) {
                $query->where('stat_type', $statType);
            }

            $leaderboard = $query->limit($limit)->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'leaderboard' => $leaderboard,
                    'filters' => [
                        'stat_type' => $statType,
                        'limit' => $limit
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to get leaderboard: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to get leaderboard'
            ], 500);
        }
    }

    /**
     * Helper methods
     */
    private function estimateJobDuration(array $statTypes, int $minGames, ?int $playerLimit): string
    {
        // Rough estimation based on player count and stat types
        $estimatedPlayers = $playerLimit ?? WnbaPlayer::whereHas('playerGames', function ($query) use ($minGames) {
            $query->where('did_not_play', false);
        }, '>=', $minGames)->count();

        $totalTests = $estimatedPlayers * count($statTypes);
        $estimatedMinutes = ceil($totalTests / 60); // Roughly 1 test per second

        if ($estimatedMinutes < 5) {
            return "2-5 minutes";
        } elseif ($estimatedMinutes < 15) {
            return "5-15 minutes";
        } elseif ($estimatedMinutes < 30) {
            return "15-30 minutes";
        } else {
            return "30+ minutes";
        }
    }

    private function getHistoricalSummaryStats(): array
    {
        return [
            'total_tests' => PredictionTestResult::count(),
            'unique_players' => PredictionTestResult::distinct('player_id')->count(),
            'avg_accuracy_by_stat' => PredictionTestResult::selectRaw('
                stat_type,
                AVG(accuracy_percentage) as avg_accuracy,
                COUNT(*) as test_count
            ')
            ->groupBy('stat_type')
            ->get()
            ->keyBy('stat_type'),
            'accuracy_distribution' => [
                'excellent' => PredictionTestResult::where('accuracy_percentage', '>=', 85)->count(),
                'good' => PredictionTestResult::whereBetween('accuracy_percentage', [75, 84.99])->count(),
                'fair' => PredictionTestResult::whereBetween('accuracy_percentage', [65, 74.99])->count(),
                'poor' => PredictionTestResult::where('accuracy_percentage', '<', 65)->count()
            ]
        ];
    }
}
