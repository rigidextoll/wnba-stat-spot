<?php

namespace App\Services\WNBA\Math;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class MonteCarloSimulator
{
    private const DEFAULT_SIMULATIONS = 10000;
    private const MAX_SIMULATIONS = 100000;
    private const CACHE_TTL = 3600; // 1 hour

    /**
     * Run Monte Carlo simulation for player stat prediction
     */
    public function simulatePlayerStat(
        float $mean,
        float $standardDeviation,
        string $distributionType = 'normal',
        int $simulations = self::DEFAULT_SIMULATIONS,
        array $constraints = []
    ): array {
        try {
            $simulations = min($simulations, self::MAX_SIMULATIONS);
            $results = [];

            for ($i = 0; $i < $simulations; $i++) {
                $value = $this->generateRandomValue($mean, $standardDeviation, $distributionType);

                // Apply constraints
                if (!empty($constraints)) {
                    $value = $this->applyConstraints($value, $constraints);
                }

                $results[] = $value;
            }

            return [
                'simulation_results' => $results,
                'statistics' => $this->calculateSimulationStatistics($results),
                'distribution_analysis' => $this->analyzeDistribution($results),
                'confidence_intervals' => $this->calculateConfidenceIntervals($results),
                'percentiles' => $this->calculatePercentiles($results),
                'simulation_metadata' => [
                    'simulations_run' => $simulations,
                    'distribution_type' => $distributionType,
                    'input_mean' => $mean,
                    'input_std_dev' => $standardDeviation,
                    'constraints_applied' => !empty($constraints),
                ]
            ];
        } catch (\Exception $e) {
            Log::error('Error in Monte Carlo simulation', [
                'mean' => $mean,
                'std_dev' => $standardDeviation,
                'distribution' => $distributionType,
                'error' => $e->getMessage()
            ]);
            return $this->getEmptySimulationResult();
        }
    }

    /**
     * Simulate game outcome scenarios
     */
    public function simulateGameOutcomes(
        array $homeTeamStats,
        array $awayTeamStats,
        int $simulations = self::DEFAULT_SIMULATIONS
    ): array {
        $cacheKey = "game_simulation_" . md5(serialize([$homeTeamStats, $awayTeamStats, $simulations]));

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($homeTeamStats, $awayTeamStats, $simulations) {
            try {
                $outcomes = [];
                $homeWins = 0;
                $awayWins = 0;
                $totalScores = [];
                $margins = [];

                for ($i = 0; $i < $simulations; $i++) {
                    $homeScore = $this->simulateTeamScore($homeTeamStats);
                    $awayScore = $this->simulateTeamScore($awayTeamStats);

                    $outcome = [
                        'home_score' => $homeScore,
                        'away_score' => $awayScore,
                        'total_score' => $homeScore + $awayScore,
                        'margin' => $homeScore - $awayScore,
                        'home_wins' => $homeScore > $awayScore
                    ];

                    $outcomes[] = $outcome;
                    $totalScores[] = $outcome['total_score'];
                    $margins[] = $outcome['margin'];

                    if ($homeScore > $awayScore) {
                        $homeWins++;
                    } else {
                        $awayWins++;
                    }
                }

                return [
                    'win_probabilities' => [
                        'home_team' => round(($homeWins / $simulations) * 100, 2),
                        'away_team' => round(($awayWins / $simulations) * 100, 2),
                    ],
                    'score_projections' => [
                        'home_team' => $this->calculateProjectionStats($outcomes, 'home_score'),
                        'away_team' => $this->calculateProjectionStats($outcomes, 'away_score'),
                        'total_points' => $this->calculateProjectionStats($totalScores),
                        'point_margin' => $this->calculateProjectionStats($margins),
                    ],
                    'betting_insights' => $this->generateBettingInsights($outcomes, $totalScores, $margins),
                    'scenario_analysis' => $this->analyzeScenarios($outcomes),
                    'simulation_metadata' => [
                        'simulations_run' => $simulations,
                        'home_team_stats' => $homeTeamStats,
                        'away_team_stats' => $awayTeamStats,
                    ]
                ];
            } catch (\Exception $e) {
                Log::error('Error simulating game outcomes', [
                    'error' => $e->getMessage()
                ]);
                return [];
            }
        });
    }

    /**
     * Simulate player prop betting scenarios
     */
    public function simulatePropBetting(
        float $prediction,
        float $uncertainty,
        float $bookmakerLine,
        array $odds = ['over' => -110, 'under' => -110],
        int $simulations = self::DEFAULT_SIMULATIONS
    ): array {
        try {
            $overWins = 0;
            $underWins = 0;
            $pushes = 0;
            $results = [];

            for ($i = 0; $i < $simulations; $i++) {
                $actualValue = $this->generateRandomValue($prediction, $uncertainty, 'normal');

                if ($actualValue > $bookmakerLine) {
                    $overWins++;
                    $result = 'over';
                } elseif ($actualValue < $bookmakerLine) {
                    $underWins++;
                    $result = 'under';
                } else {
                    $pushes++;
                    $result = 'push';
                }

                $results[] = [
                    'actual_value' => $actualValue,
                    'result' => $result,
                    'over_profit' => $result === 'over' ? $this->calculateProfit($odds['over']) :
                                   ($result === 'under' ? -1 : 0),
                    'under_profit' => $result === 'under' ? $this->calculateProfit($odds['under']) :
                                     ($result === 'over' ? -1 : 0),
                ];
            }

            return [
                'probability_analysis' => [
                    'over_probability' => round(($overWins / $simulations) * 100, 2),
                    'under_probability' => round(($underWins / $simulations) * 100, 2),
                    'push_probability' => round(($pushes / $simulations) * 100, 2),
                ],
                'expected_value' => [
                    'over_bet' => $this->calculateExpectedValue($results, 'over_profit'),
                    'under_bet' => $this->calculateExpectedValue($results, 'under_profit'),
                ],
                'betting_recommendation' => $this->generateBettingRecommendation($results, $odds),
                'risk_analysis' => $this->analyzeBettingRisk($results),
                'value_assessment' => $this->assessBettingValue($overWins, $underWins, $simulations, $odds),
                'simulation_details' => [
                    'prediction' => $prediction,
                    'uncertainty' => $uncertainty,
                    'bookmaker_line' => $bookmakerLine,
                    'odds' => $odds,
                    'simulations_run' => $simulations,
                ]
            ];
        } catch (\Exception $e) {
            Log::error('Error simulating prop betting', [
                'prediction' => $prediction,
                'line' => $bookmakerLine,
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * Simulate portfolio of player props
     */
    public function simulatePortfolio(
        array $props,
        int $simulations = self::DEFAULT_SIMULATIONS,
        float $bankroll = 1000.0
    ): array {
        try {
            $portfolioResults = [];
            $finalBankrolls = [];

            for ($i = 0; $i < $simulations; $i++) {
                $currentBankroll = $bankroll;
                $bets = [];

                foreach ($props as $prop) {
                    $betSize = $prop['bet_size'] ?? ($bankroll * 0.02); // 2% default
                    $actualValue = $this->generateRandomValue(
                        $prop['prediction'],
                        $prop['uncertainty'],
                        $prop['distribution'] ?? 'normal'
                    );

                    $result = $this->evaluatePropBet($actualValue, $prop);
                    $profit = $result['profit'];

                    $currentBankroll += $profit;
                    $bets[] = [
                        'prop_id' => $prop['id'] ?? $i,
                        'actual_value' => $actualValue,
                        'result' => $result['outcome'],
                        'profit' => $profit,
                        'bet_size' => $betSize,
                    ];
                }

                $portfolioResults[] = [
                    'simulation' => $i + 1,
                    'starting_bankroll' => $bankroll,
                    'ending_bankroll' => $currentBankroll,
                    'total_profit' => $currentBankroll - $bankroll,
                    'roi' => (($currentBankroll - $bankroll) / $bankroll) * 100,
                    'bets' => $bets,
                ];

                $finalBankrolls[] = $currentBankroll;
            }

            return [
                'portfolio_performance' => $this->analyzePortfolioPerformance($portfolioResults, $bankroll),
                'risk_metrics' => $this->calculatePortfolioRisk($finalBankrolls, $bankroll),
                'profit_distribution' => $this->analyzeDistribution(array_column($portfolioResults, 'total_profit')),
                'individual_prop_analysis' => $this->analyzeIndividualProps($portfolioResults),
                'bankroll_simulation' => $this->analyzeBankrollProgression($portfolioResults),
                'recommendations' => $this->generatePortfolioRecommendations($portfolioResults),
            ];
        } catch (\Exception $e) {
            Log::error('Error simulating portfolio', [
                'props_count' => count($props),
                'bankroll' => $bankroll,
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * Simulate season-long player performance
     */
    public function simulateSeasonPerformance(
        int $playerId,
        array $baseStats,
        int $gamesRemaining,
        array $seasonFactors = [],
        int $simulations = self::DEFAULT_SIMULATIONS
    ): array {
        $cacheKey = "season_simulation_{$playerId}_{$gamesRemaining}_" . md5(serialize($baseStats));

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($playerId, $baseStats, $gamesRemaining, $seasonFactors, $simulations) {
            try {
                $seasonResults = [];

                for ($i = 0; $i < $simulations; $i++) {
                    $gameResults = [];
                    $seasonTotals = array_fill_keys(array_keys($baseStats), 0);

                    for ($game = 1; $game <= $gamesRemaining; $game++) {
                        $gameStats = [];

                        foreach ($baseStats as $stat => $statData) {
                            // Apply fatigue and improvement factors
                            $adjustedMean = $this->applySeasonFactors(
                                $statData['mean'],
                                $game,
                                $gamesRemaining,
                                $seasonFactors
                            );

                            $value = $this->generateRandomValue(
                                $adjustedMean,
                                $statData['std_dev'],
                                $statData['distribution'] ?? 'normal'
                            );

                            $gameStats[$stat] = max(0, $value); // Ensure non-negative
                            $seasonTotals[$stat] += $gameStats[$stat];
                        }

                        $gameResults[] = $gameStats;
                    }

                    $seasonResults[] = [
                        'simulation' => $i + 1,
                        'game_results' => $gameResults,
                        'season_totals' => $seasonTotals,
                        'season_averages' => array_map(function($total) use ($gamesRemaining) {
                            return $total / $gamesRemaining;
                        }, $seasonTotals),
                    ];
                }

                return [
                    'season_projections' => $this->calculateSeasonProjections($seasonResults),
                    'milestone_probabilities' => $this->calculateMilestoneProbabilities($seasonResults, $baseStats),
                    'award_probabilities' => $this->calculateAwardProbabilities($seasonResults),
                    'performance_trends' => $this->analyzePerformanceTrends($seasonResults),
                    'consistency_metrics' => $this->calculateConsistencyMetrics($seasonResults),
                    'simulation_metadata' => [
                        'player_id' => $playerId,
                        'games_remaining' => $gamesRemaining,
                        'simulations_run' => $simulations,
                        'base_stats' => $baseStats,
                    ]
                ];
            } catch (\Exception $e) {
                Log::error('Error simulating season performance', [
                    'player_id' => $playerId,
                    'games_remaining' => $gamesRemaining,
                    'error' => $e->getMessage()
                ]);
                return [];
            }
        });
    }

    // Private helper methods

    private function generateRandomValue(float $mean, float $stdDev, string $distribution): float
    {
        switch ($distribution) {
            case 'normal':
                return $this->generateNormalRandom($mean, $stdDev);
            case 'poisson':
                return $this->generatePoissonRandom($mean);
            case 'gamma':
                return $this->generateGammaRandom($mean, $stdDev);
            case 'beta':
                return $this->generateBetaRandom($mean, $stdDev);
            case 'lognormal':
                return $this->generateLogNormalRandom($mean, $stdDev);
            default:
                return $this->generateNormalRandom($mean, $stdDev);
        }
    }

    private function generateNormalRandom(float $mean, float $stdDev): float
    {
        // Box-Muller transformation
        static $hasSpare = false;
        static $spare;

        if ($hasSpare) {
            $hasSpare = false;
            return $spare * $stdDev + $mean;
        }

        $hasSpare = true;
        $u = mt_rand() / mt_getrandmax();
        $v = mt_rand() / mt_getrandmax();

        $mag = $stdDev * sqrt(-2.0 * log($u));
        $spare = $mag * cos(2.0 * M_PI * $v);

        return $mag * sin(2.0 * M_PI * $v) + $mean;
    }

    private function generatePoissonRandom(float $lambda): float
    {
        if ($lambda < 30) {
            // Direct method for small lambda
            $L = exp(-$lambda);
            $k = 0;
            $p = 1.0;

            do {
                $k++;
                $p *= mt_rand() / mt_getrandmax();
            } while ($p > $L);

            return $k - 1;
        } else {
            // Normal approximation for large lambda
            return max(0, $this->generateNormalRandom($lambda, sqrt($lambda)));
        }
    }

    private function generateGammaRandom(float $mean, float $stdDev): float
    {
        $variance = $stdDev * $stdDev;
        $scale = $variance / $mean;
        $shape = $mean / $scale;

        // Marsaglia and Tsang's method
        if ($shape >= 1) {
            $d = $shape - 1.0/3.0;
            $c = 1.0 / sqrt(9.0 * $d);

            while (true) {
                $x = $this->generateNormalRandom(0, 1);
                $v = 1.0 + $c * $x;

                if ($v <= 0) continue;

                $v = $v * $v * $v;
                $u = mt_rand() / mt_getrandmax();

                if ($u < 1.0 - 0.0331 * $x * $x * $x * $x) {
                    return $d * $v * $scale;
                }

                if (log($u) < 0.5 * $x * $x + $d * (1.0 - $v + log($v))) {
                    return $d * $v * $scale;
                }
            }
        } else {
            // For shape < 1, use rejection method
            return $this->generateGammaRandom($mean + 1, $stdDev) * pow(mt_rand() / mt_getrandmax(), 1.0 / $shape);
        }
    }

    private function generateBetaRandom(float $mean, float $stdDev): float
    {
        $variance = $stdDev * $stdDev;
        $alpha = $mean * (($mean * (1 - $mean) / $variance) - 1);
        $beta = (1 - $mean) * (($mean * (1 - $mean) / $variance) - 1);

        // Use gamma distribution to generate beta
        $x = $this->generateGammaRandom($alpha, sqrt($alpha));
        $y = $this->generateGammaRandom($beta, sqrt($beta));

        return $x / ($x + $y);
    }

    private function generateLogNormalRandom(float $mean, float $stdDev): float
    {
        $variance = $stdDev * $stdDev;
        $mu = log($mean * $mean / sqrt($variance + $mean * $mean));
        $sigma = sqrt(log($variance / ($mean * $mean) + 1));

        return exp($this->generateNormalRandom($mu, $sigma));
    }

    private function applyConstraints(float $value, array $constraints): float
    {
        if (isset($constraints['min'])) {
            $value = max($value, $constraints['min']);
        }

        if (isset($constraints['max'])) {
            $value = min($value, $constraints['max']);
        }

        if (isset($constraints['integer']) && $constraints['integer']) {
            $value = round($value);
        }

        return $value;
    }

    private function calculateSimulationStatistics(array $results): array
    {
        if (empty($results)) {
            return [];
        }

        sort($results);
        $count = count($results);
        $sum = array_sum($results);
        $mean = $sum / $count;

        $variance = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $results)) / $count;

        return [
            'mean' => round($mean, 3),
            'median' => $count % 2 === 0
                ? ($results[$count/2 - 1] + $results[$count/2]) / 2
                : $results[floor($count/2)],
            'mode' => $this->calculateMode($results),
            'std_dev' => round(sqrt($variance), 3),
            'variance' => round($variance, 3),
            'min' => min($results),
            'max' => max($results),
            'range' => max($results) - min($results),
            'skewness' => $this->calculateSkewness($results, $mean, sqrt($variance)),
            'kurtosis' => $this->calculateKurtosis($results, $mean, sqrt($variance)),
        ];
    }

    private function analyzeDistribution(array $results): array
    {
        if (empty($results)) {
            return [];
        }

        $histogram = $this->createHistogram($results);

        return [
            'histogram' => $histogram,
            'distribution_shape' => $this->identifyDistributionShape($results),
            'outliers' => $this->identifyOutliers($results),
            'normality_test' => $this->testNormality($results),
        ];
    }

    private function calculateConfidenceIntervals(array $results, array $levels = [0.90, 0.95, 0.99]): array
    {
        sort($results);
        $count = count($results);
        $intervals = [];

        foreach ($levels as $level) {
            $alpha = 1 - $level;
            $lowerIndex = floor(($alpha / 2) * $count);
            $upperIndex = floor((1 - $alpha / 2) * $count) - 1;

            $intervals[($level * 100) . '%'] = [
                'lower' => $results[$lowerIndex],
                'upper' => $results[$upperIndex],
                'width' => $results[$upperIndex] - $results[$lowerIndex],
            ];
        }

        return $intervals;
    }

    private function calculatePercentiles(array $results): array
    {
        sort($results);
        $count = count($results);

        $percentiles = [1, 5, 10, 25, 50, 75, 90, 95, 99];
        $result = [];

        foreach ($percentiles as $p) {
            $index = floor(($p / 100) * $count);
            $result["p{$p}"] = $results[min($index, $count - 1)];
        }

        return $result;
    }

    private function simulateTeamScore(array $teamStats): float
    {
        return $this->generateRandomValue(
            $teamStats['avg_score'] ?? 80,
            $teamStats['score_std_dev'] ?? 8,
            'normal'
        );
    }

    private function calculateProjectionStats(array $data, ?string $key = null): array
    {
        $values = $key ? array_column($data, $key) : $data;

        if (empty($values)) {
            return [];
        }

        return [
            'mean' => round(array_sum($values) / count($values), 2),
            'median' => $this->calculateMedian($values),
            'std_dev' => round($this->calculateStandardDeviation($values), 2),
            'min' => min($values),
            'max' => max($values),
            'percentiles' => $this->calculatePercentiles($values),
        ];
    }

    private function calculateMedian(array $values): float
    {
        sort($values);
        $count = count($values);

        return $count % 2 === 0
            ? ($values[$count/2 - 1] + $values[$count/2]) / 2
            : $values[floor($count/2)];
    }

    private function calculateStandardDeviation(array $values): float
    {
        $mean = array_sum($values) / count($values);
        $variance = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $values)) / count($values);

        return sqrt($variance);
    }

    private function calculateProfit(int $odds): float
    {
        if ($odds > 0) {
            return $odds / 100; // American odds positive
        } else {
            return 100 / abs($odds); // American odds negative
        }
    }

    private function calculateExpectedValue(array $results, string $profitKey): float
    {
        $profits = array_column($results, $profitKey);
        return round(array_sum($profits) / count($profits), 4);
    }

    private function getEmptySimulationResult(): array
    {
        return [
            'simulation_results' => [],
            'statistics' => [],
            'distribution_analysis' => [],
            'confidence_intervals' => [],
            'percentiles' => [],
            'simulation_metadata' => [],
        ];
    }

    // Additional helper methods (placeholders for complex calculations)
    private function calculateMode(array $values): float { return 0; }
    private function calculateSkewness(array $values, float $mean, float $stdDev): float { return 0; }
    private function calculateKurtosis(array $values, float $mean, float $stdDev): float { return 0; }
    private function createHistogram(array $values): array { return []; }
    private function identifyDistributionShape(array $values): string { return 'normal'; }
    private function identifyOutliers(array $values): array { return []; }
    private function testNormality(array $values): array { return []; }
    private function generateBettingInsights(array $outcomes, array $totals, array $margins): array { return []; }
    private function analyzeScenarios(array $outcomes): array { return []; }
    private function generateBettingRecommendation(array $results, array $odds): array { return []; }
    private function analyzeBettingRisk(array $results): array { return []; }
    private function assessBettingValue(int $overWins, int $underWins, int $simulations, array $odds): array { return []; }
    private function evaluatePropBet(float $actualValue, array $prop): array { return ['outcome' => 'win', 'profit' => 1.0]; }
    private function analyzePortfolioPerformance(array $results, float $bankroll): array { return []; }
    private function calculatePortfolioRisk(array $bankrolls, float $initialBankroll): array { return []; }
    private function analyzeIndividualProps(array $results): array { return []; }
    private function analyzeBankrollProgression(array $results): array { return []; }
    private function generatePortfolioRecommendations(array $results): array { return []; }
    private function applySeasonFactors(float $baseMean, int $gameNumber, int $totalGames, array $factors): float { return $baseMean; }
    private function calculateSeasonProjections(array $results): array { return []; }
    private function calculateMilestoneProbabilities(array $results, array $baseStats): array { return []; }
    private function calculateAwardProbabilities(array $results): array { return []; }
    private function analyzePerformanceTrends(array $results): array { return []; }
    private function calculateConsistencyMetrics(array $results): array { return []; }
}
