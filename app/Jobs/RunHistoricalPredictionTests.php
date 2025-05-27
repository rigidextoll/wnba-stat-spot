<?php

namespace App\Jobs;

use App\Models\WnbaPlayer;
use App\Models\WnbaPlayerGame;
use App\Models\PredictionTestResult;
use App\Http\Controllers\Api\PredictionTestingController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RunHistoricalPredictionTests implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3600; // 1 hour timeout
    public $tries = 3;

    protected $testBatchId;
    protected $statTypes;
    protected $minGames;
    protected $testGames;
    protected $playerLimit;

    /**
     * Create a new job instance.
     */
    public function __construct(
        array $statTypes = ['points', 'rebounds', 'assists', 'steals', 'blocks'],
        int $minGames = 5,
        int $testGames = 3,
        int $playerLimit = null
    ) {
        $this->testBatchId = 'historical_' . now()->format('Y_m_d_H_i_s') . '_' . Str::random(8);
        $this->statTypes = $statTypes;
        $this->minGames = $minGames;
        $this->testGames = $testGames;
        $this->playerLimit = $playerLimit;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Starting historical prediction tests', [
            'batch_id' => $this->testBatchId,
            'stat_types' => $this->statTypes,
            'min_games' => $this->minGames,
            'test_games' => $this->testGames,
            'player_limit' => $this->playerLimit
        ]);

        try {
            // Get players with sufficient game data
            $players = $this->getEligiblePlayers();

            Log::info("Found {$players->count()} eligible players for testing");

            $totalTests = $players->count() * count($this->statTypes);
            $completedTests = 0;
            $successfulTests = 0;

            foreach ($players as $player) {
                foreach ($this->statTypes as $statType) {
                    try {
                        $result = $this->runPlayerStatTest($player, $statType);

                        if ($result) {
                            $this->saveTestResult($player, $statType, $result);
                            $successfulTests++;
                        }

                        $completedTests++;

                        // Log progress every 10 tests
                        if ($completedTests % 10 === 0) {
                            Log::info("Progress: {$completedTests}/{$totalTests} tests completed ({$successfulTests} successful)");
                        }

                        // Small delay to prevent overwhelming the system
                        usleep(100000); // 0.1 second

                    } catch (\Exception $e) {
                        Log::error("Failed to test {$player->athlete_display_name} for {$statType}", [
                            'player_id' => $player->athlete_id,
                            'stat_type' => $statType,
                            'error' => $e->getMessage()
                        ]);
                        $completedTests++;
                    }
                }
            }

            Log::info('Historical prediction tests completed', [
                'batch_id' => $this->testBatchId,
                'total_tests' => $totalTests,
                'completed_tests' => $completedTests,
                'successful_tests' => $successfulTests,
                'success_rate' => $totalTests > 0 ? round(($successfulTests / $totalTests) * 100, 2) : 0
            ]);

        } catch (\Exception $e) {
            Log::error('Historical prediction tests failed', [
                'batch_id' => $this->testBatchId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Get players with sufficient game data for testing
     */
    protected function getEligiblePlayers()
    {
        $query = WnbaPlayer::whereHas('playerGames', function ($query) {
            $query->where('did_not_play', false);
        }, '>=', $this->minGames);

        if ($this->playerLimit) {
            $query->limit($this->playerLimit);
        }

        return $query->with(['playerGames' => function ($query) {
            $query->where('did_not_play', false)
                  ->orderBy('id', 'desc');
        }])->get();
    }

    /**
     * Run prediction test for a specific player and stat
     */
    protected function runPlayerStatTest($player, $statType)
    {
        // Check if player has enough games for this stat
        $availableGames = WnbaPlayerGame::where('player_id', $player->id)
            ->where('did_not_play', false)
            ->whereNotNull($statType)
            ->count();

        if ($availableGames < $this->testGames) {
            Log::debug("Skipping {$player->athlete_display_name} - {$statType}: only {$availableGames} games available");
            return null;
        }

        // Get recent games for testing
        $recentGames = WnbaPlayerGame::where('player_id', $player->id)
            ->where('did_not_play', false)
            ->whereNotNull($statType)
            ->orderBy('id', 'desc')
            ->limit($this->testGames)
            ->get();

        // Calculate season average
        $allGames = WnbaPlayerGame::where('player_id', $player->id)
            ->where('did_not_play', false)
            ->whereNotNull($statType)
            ->get();

        $seasonAverage = $allGames->avg($statType) ?? 0;

        if ($seasonAverage <= 0) {
            return null;
        }

        // Generate realistic betting lines around season average
        // Sportsbooks typically use half-points (.5) to avoid pushes
        $baseAverage = round($seasonAverage);

        // Generate 6 realistic betting lines around the season average
        // All lines will be X.5 format (half-points)
        $bettingLines = [];

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

        // Run the test using the existing controller logic
        $controller = new PredictionTestingController();
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

        return [
            'test_parameters' => [
                'stat_type' => $statType,
                'test_games' => $this->testGames,
                'betting_lines' => $bettingLines,
                'season_average' => round($seasonAverage, 1)
            ],
            'actual_results' => $recentGames->map(function($game, $index) use ($statType) {
                return [
                    'game_number' => $index + 1,
                    'date' => $game->created_at->format('Y-m-d'),
                    'actual_value' => $game->{$statType}
                ];
            })->values(),
            'line_tests' => $testResults,
            'overall_performance' => $overallStats,
            'sample_size' => $allGames->count(),
            'insights' => $this->generateInsights($overallStats, $seasonAverage, $recentGames, $statType)
        ];
    }

    /**
     * Test accuracy for a specific betting line (simplified version)
     */
    protected function testLineAccuracy($player, $statType, $line, $recentGames, $seasonAverage)
    {
        $predictedValue = $seasonAverage;
        $confidence = 0.75;

        // Calculate standard deviation
        $values = $recentGames->pluck($statType)->toArray();
        $stdDev = $this->calculateStandardDeviation($values);

        // Calculate probabilities
        $zScore = ($line - $predictedValue) / max($stdDev, 1);
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
     * Save test result to database
     */
    protected function saveTestResult($player, $statType, $result)
    {
        $lineAccuracies = collect($result['line_tests'])->pluck('accuracy_percentage');

        PredictionTestResult::create([
            'test_batch_id' => $this->testBatchId,
            'test_type' => 'historical',
            'player_id' => $player->athlete_id,
            'player_name' => $player->athlete_display_name,
            'player_position' => $player->athlete_position_abbreviation,
            'stat_type' => $statType,
            'test_games' => $this->testGames,
            'betting_lines' => $result['test_parameters']['betting_lines'],
            'season_average' => $result['test_parameters']['season_average'],
            'total_predictions' => $result['overall_performance']['total_predictions'],
            'correct_predictions' => $result['overall_performance']['correct_predictions'],
            'accuracy_percentage' => $result['overall_performance']['accuracy_percentage'],
            'confidence_score' => 0.75,
            'line_results' => $result['line_tests'],
            'actual_game_results' => $result['actual_results'],
            'insights' => $result['insights'],
            'best_line_accuracy' => $lineAccuracies->max(),
            'worst_line_accuracy' => $lineAccuracies->min(),
            'average_line_accuracy' => $lineAccuracies->avg(),
            'volatility_score' => $this->calculateVolatility($result['actual_results']->toArray()),
            'sample_size' => $result['sample_size'],
            'data_quality_score' => $this->calculateDataQuality($result['sample_size'], $result['overall_performance']['accuracy_percentage']),
            'tested_at' => now(),
            'test_version' => '1.0'
        ]);
    }

    // Helper methods
    protected function calculateStandardDeviation(array $values): float
    {
        if (count($values) < 2) return 3.0;

        $mean = array_sum($values) / count($values);
        $variance = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $values)) / count($values);

        return sqrt($variance);
    }

    protected function normalCDF($x): float
    {
        return 0.5 * (1 + $this->erf($x / sqrt(2)));
    }

    protected function erf($x): float
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

    protected function calculateVolatility(array $gameResults): float
    {
        $values = collect($gameResults)->pluck('actual_value')->toArray();
        return $this->calculateStandardDeviation($values);
    }

    protected function calculateDataQuality(int $sampleSize, float $accuracy): float
    {
        $sizeScore = min($sampleSize / 20, 1.0); // Max score at 20+ games
        $accuracyScore = $accuracy / 100;
        return round(($sizeScore + $accuracyScore) / 2, 3);
    }

    protected function generateInsights($overallStats, $seasonAverage, $recentGames, $statType): array
    {
        $insights = [];

        if ($overallStats['accuracy_percentage'] >= 80) {
            $insights[] = "🎯 Excellent accuracy ({$overallStats['accuracy_percentage']}%) - Model is highly reliable";
        } elseif ($overallStats['accuracy_percentage'] >= 70) {
            $insights[] = "✅ Good accuracy ({$overallStats['accuracy_percentage']}%) - Model shows strong predictive power";
        } elseif ($overallStats['accuracy_percentage'] >= 60) {
            $insights[] = "⚠️ Moderate accuracy ({$overallStats['accuracy_percentage']}%) - Model needs improvement";
        } else {
            $insights[] = "❌ Low accuracy ({$overallStats['accuracy_percentage']}%) - Model requires significant adjustments";
        }

        $bestLine = collect($overallStats['by_line'])->sortByDesc('accuracy')->first();
        $worstLine = collect($overallStats['by_line'])->sortBy('accuracy')->first();

        if ($bestLine && $worstLine) {
            $insights[] = "🎲 Best accuracy at line {$bestLine['line']} ({$bestLine['accuracy']}%)";
            $insights[] = "⚡ Lowest accuracy at line {$worstLine['line']} ({$worstLine['accuracy']}%)";
        }

        return $insights;
    }
}
