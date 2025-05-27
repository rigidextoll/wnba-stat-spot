<?php

namespace App\Services\WNBA\Predictions;

use App\Models\WnbaPlayerGame;
use App\Models\WnbaGame;
use App\Models\WnbaGameTeam;
use App\Models\WnbaPlayer;
use App\Models\WnbaTeam;
use App\Services\WNBA\Analytics\PlayerAnalyticsService;
use App\Services\WNBA\Math\BayesianCalculator;
use App\Services\WNBA\Math\MonteCarloSimulator;
use App\Services\WNBA\Math\PoissonCalculator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PropsPredictionService
{
    private PlayerAnalyticsService $playerAnalytics;
    private StatisticalEngineService $statisticalEngine;
    private BayesianCalculator $bayesianCalculator;
    private MonteCarloSimulator $monteCarloSimulator;
    private PoissonCalculator $poissonCalculator;

    public function __construct(
        PlayerAnalyticsService $playerAnalytics,
        StatisticalEngineService $statisticalEngine,
        BayesianCalculator $bayesianCalculator,
        MonteCarloSimulator $monteCarloSimulator,
        PoissonCalculator $poissonCalculator
    ) {
        $this->playerAnalytics = $playerAnalytics;
        $this->statisticalEngine = $statisticalEngine;
        $this->bayesianCalculator = $bayesianCalculator;
        $this->monteCarloSimulator = $monteCarloSimulator;
        $this->poissonCalculator = $poissonCalculator;
    }

    /**
     * Main prediction method - returns full prediction object
     */
    public function predictProp(int $playerId, int $gameId, string $propType, float $lineValue): array
    {
        $cacheKey = "prop_prediction_{$playerId}_{$gameId}_{$propType}_{$lineValue}";

        return Cache::remember($cacheKey, 1800, function() use ($playerId, $gameId, $propType, $lineValue) {
            // Get player and game context
            $player = WnbaPlayer::find($playerId);
            $game = WnbaGame::find($gameId);

            if (!$player || !$game) {
                throw new \InvalidArgumentException('Invalid player or game ID');
            }

            // Get game context
            $gameContext = $this->getGameContext($gameId, $playerId);

            // Get player profile
            $playerProfile = $this->getPlayerProfile($playerId, $propType);

            // Calculate prediction based on prop type
            $prediction = $this->calculatePropPrediction($playerId, $gameId, $propType, $lineValue, $gameContext, $playerProfile);

            // Calculate confidence
            $confidence = $this->calculateConfidence($prediction['data_quality']);

            // Calculate expected value
            $expectedValue = $this->calculateExpectedValue(
                $prediction['over_probability'],
                $gameContext['odds'] ?? ['over' => -110, 'under' => -110]
            );

            return [
                'prediction_id' => uniqid('wnba_prop_'),
                'player' => [
                    'id' => $player->id,
                    'athlete_id' => $player->athlete_id,
                    'name' => $player->athlete_display_name,
                    'position' => $player->athlete_position_abbreviation,
                    'team_id' => $gameContext['player_team_id']
                ],
                'game_context' => $gameContext,
                'prop_details' => [
                    'type' => $propType,
                    'line_value' => $lineValue,
                    'category' => $this->getPropCategory($propType)
                ],
                'prediction' => [
                    'predicted_value' => $prediction['predicted_value'],
                    'over_probability' => $prediction['over_probability'],
                    'under_probability' => 1 - $prediction['over_probability'],
                    'confidence_score' => $confidence,
                    'expected_value' => $expectedValue,
                    'recommendation' => $this->getRecommendation($prediction['over_probability'], $expectedValue, $confidence)
                ],
                'contributing_factors' => $prediction['factors'],
                'statistical_basis' => $prediction['statistical_basis'],
                'model_info' => [
                    'version' => '1.0',
                    'model_type' => $prediction['model_type'],
                    'data_points_used' => $prediction['data_points'],
                    'last_updated' => now()->toISOString()
                ]
            ];
        });
    }

    /**
     * Generate predictions for all available props for a player/game
     */
    public function predictAllProps(int $playerId, int $gameId): array
    {
        $availableProps = [
            'points' => [15.5, 18.5, 21.5],
            'rebounds' => [6.5, 8.5, 10.5],
            'assists' => [3.5, 5.5, 7.5],
            'three_point_field_goals_made' => [1.5, 2.5, 3.5],
            'steals' => [0.5, 1.5, 2.5],
            'blocks' => [0.5, 1.5, 2.5],
            'turnovers' => [2.5, 3.5, 4.5],
            'minutes' => [25.5, 30.5, 35.5]
        ];

        $predictions = [];
        foreach ($availableProps as $propType => $lines) {
            foreach ($lines as $line) {
                try {
                    $predictions[$propType][] = $this->predictProp($playerId, $gameId, $propType, $line);
                } catch (\Exception $e) {
                    // Log error and continue
                    Log::warning("Failed to predict {$propType} {$line} for player {$playerId}: " . $e->getMessage());
                }
            }
        }

        return $predictions;
    }

    /**
     * Bulk prediction for multiple players in a game
     */
    public function predictGameProps(int $gameId): array
    {
        $game = WnbaGame::with('playerGames.player')->find($gameId);

        if (!$game) {
            throw new \InvalidArgumentException('Invalid game ID');
        }

        $predictions = [];
        foreach ($game->playerGames as $playerGame) {
            if ($playerGame->minutes > 10) { // Only predict for players with significant minutes
                $predictions[$playerGame->player->athlete_display_name] = $this->predictAllProps(
                    $playerGame->player_id,
                    $gameId
                );
            }
        }

        return $predictions;
    }

    /**
     * Predict specific stat categories
     */
    public function predictPoints(int $playerId, int $gameId): array
    {
        $gameContext = $this->getGameContext($gameId, $playerId);
        $playerProfile = $this->getPlayerProfile($playerId, 'points');

        // Get recent scoring data
        $recentGames = WnbaPlayerGame::where('player_id', $playerId)
            ->whereHas('game', function($query) {
                $query->orderBy('game_date', 'desc');
            })
            ->limit(15)
            ->get();

        if ($recentGames->isEmpty()) {
            return $this->getEmptyPrediction('points');
        }

        // Calculate base expectation
        $seasonAvg = $recentGames->avg('points');
        $recentForm = $recentGames->take(5)->avg('points');

        // Apply contextual adjustments
        $adjustedExpectation = $this->applyContextualAdjustments($seasonAvg, $gameContext, [
            'recent_form_weight' => 0.3,
            'opponent_defense_weight' => 0.25,
            'pace_weight' => 0.2,
            'rest_weight' => 0.15,
            'home_court_weight' => 0.1
        ]);

        // Use Poisson distribution for points prediction
        $lambda = max(0.1, $adjustedExpectation);

        return [
            'predicted_value' => round($lambda, 1),
            'distribution_type' => 'poisson',
            'lambda' => $lambda,
            'confidence_interval_68' => [
                round($lambda - sqrt($lambda), 1),
                round($lambda + sqrt($lambda), 1)
            ],
            'confidence_interval_95' => [
                round($lambda - (1.96 * sqrt($lambda)), 1),
                round($lambda + (1.96 * sqrt($lambda)), 1)
            ],
            'factors' => [
                'season_average' => round($seasonAvg, 1),
                'recent_form' => round($recentForm, 1),
                'opponent_defense_rating' => $gameContext['opponent_defense_rating'],
                'pace_factor' => $gameContext['pace_factor'],
                'rest_advantage' => $gameContext['rest_days'],
                'minutes_projection' => $gameContext['projected_minutes']
            ]
        ];
    }

    public function predictRebounds(int $playerId, int $gameId): array
    {
        $gameContext = $this->getGameContext($gameId, $playerId);

        // Get rebounding data
        $recentGames = WnbaPlayerGame::where('player_id', $playerId)
            ->whereHas('game', function($query) {
                $query->orderBy('game_date', 'desc');
            })
            ->limit(15)
            ->get();

        if ($recentGames->isEmpty()) {
            return $this->getEmptyPrediction('rebounds');
        }

        $seasonAvg = $recentGames->avg('rebounds');
        $offensiveAvg = $recentGames->avg('offensive_rebounds');
        $defensiveAvg = $recentGames->avg('defensive_rebounds');

        // Adjust for pace and opponent rebounding
        $paceAdjustment = $gameContext['pace_factor'];
        $opponentReboundingRate = $this->getOpponentReboundingRate($gameContext['opponent_team_id']);

        $adjustedRebounds = $seasonAvg * $paceAdjustment * (1 + $opponentReboundingRate);

        return [
            'predicted_value' => round($adjustedRebounds, 1),
            'predicted_offensive' => round($offensiveAvg * $paceAdjustment, 1),
            'predicted_defensive' => round($defensiveAvg * $paceAdjustment, 1),
            'pace_factor' => $paceAdjustment,
            'opponent_rebounding_rate' => $opponentReboundingRate,
            'distribution_type' => 'poisson',
            'lambda' => max(0.1, $adjustedRebounds)
        ];
    }

    public function predictAssists(int $playerId, int $gameId): array
    {
        $gameContext = $this->getGameContext($gameId, $playerId);

        $recentGames = WnbaPlayerGame::where('player_id', $playerId)
            ->whereHas('game', function($query) {
                $query->orderBy('game_date', 'desc');
            })
            ->limit(15)
            ->get();

        if ($recentGames->isEmpty()) {
            return $this->getEmptyPrediction('assists');
        }

        $seasonAvg = $recentGames->avg('assists');
        $assistTurnoverRatio = $recentGames->avg('assists') / max(1, $recentGames->avg('turnovers'));

        // Adjust for pace and team style
        $paceAdjustment = $gameContext['pace_factor'];
        $teamAssistRate = $this->getTeamAssistRate($gameContext['player_team_id']);

        $adjustedAssists = $seasonAvg * $paceAdjustment * (1 + ($teamAssistRate - 0.5));

        return [
            'predicted_value' => round($adjustedAssists, 1),
            'assist_turnover_ratio' => round($assistTurnoverRatio, 2),
            'team_assist_rate' => $teamAssistRate,
            'pace_factor' => $paceAdjustment,
            'distribution_type' => 'poisson',
            'lambda' => max(0.1, $adjustedAssists)
        ];
    }

    public function predictThreePointers(int $playerId, int $gameId): array
    {
        $gameContext = $this->getGameContext($gameId, $playerId);

        $recentGames = WnbaPlayerGame::where('player_id', $playerId)
            ->where('three_point_field_goals_attempted', '>', 0)
            ->whereHas('game', function($query) {
                $query->orderBy('game_date', 'desc');
            })
            ->limit(15)
            ->get();

        if ($recentGames->isEmpty()) {
            return $this->getEmptyPrediction('three_point_field_goals_made');
        }

        $avgAttempts = $recentGames->avg('three_point_field_goals_attempted');
        $avgMakes = $recentGames->avg('three_point_field_goals_made');
        $shootingPct = $avgMakes / max(1, $avgAttempts);

        // Adjust for opponent three-point defense
        $opponentThreePointDefense = $this->getOpponentThreePointDefense($gameContext['opponent_team_id']);
        $adjustedPct = $shootingPct * (1 - $opponentThreePointDefense);

        $expectedMakes = $avgAttempts * $adjustedPct;

        return [
            'predicted_value' => round($expectedMakes, 1),
            'expected_attempts' => round($avgAttempts, 1),
            'shooting_percentage' => round($shootingPct * 100, 1),
            'adjusted_percentage' => round($adjustedPct * 100, 1),
            'opponent_defense_factor' => $opponentThreePointDefense,
            'distribution_type' => 'binomial',
            'n' => round($avgAttempts),
            'p' => $adjustedPct
        ];
    }

    public function predictStealsBlocks(int $playerId, int $gameId): array
    {
        $gameContext = $this->getGameContext($gameId, $playerId);

        $recentGames = WnbaPlayerGame::where('player_id', $playerId)
            ->whereHas('game', function($query) {
                $query->orderBy('game_date', 'desc');
            })
            ->limit(15)
            ->get();

        if ($recentGames->isEmpty()) {
            return [
                'steals' => $this->getEmptyPrediction('steals'),
                'blocks' => $this->getEmptyPrediction('blocks')
            ];
        }

        $stealsAvg = $recentGames->avg('steals');
        $blocksAvg = $recentGames->avg('blocks');

        // Adjust for pace and opponent style
        $paceAdjustment = $gameContext['pace_factor'];
        $opponentTurnoverRate = $this->getOpponentTurnoverRate($gameContext['opponent_team_id']);

        $adjustedSteals = $stealsAvg * $paceAdjustment * (1 + $opponentTurnoverRate);
        $adjustedBlocks = $blocksAvg * $paceAdjustment;

        return [
            'steals' => [
                'predicted_value' => round($adjustedSteals, 1),
                'pace_factor' => $paceAdjustment,
                'opponent_turnover_rate' => $opponentTurnoverRate,
                'distribution_type' => 'poisson',
                'lambda' => max(0.1, $adjustedSteals)
            ],
            'blocks' => [
                'predicted_value' => round($adjustedBlocks, 1),
                'pace_factor' => $paceAdjustment,
                'distribution_type' => 'poisson',
                'lambda' => max(0.1, $adjustedBlocks)
            ]
        ];
    }

    public function predictMinutes(int $playerId, int $gameId): array
    {
        $gameContext = $this->getGameContext($gameId, $playerId);

        $recentGames = WnbaPlayerGame::where('player_id', $playerId)
            ->whereHas('game', function($query) {
                $query->orderBy('game_date', 'desc');
            })
            ->limit(10)
            ->get();

        if ($recentGames->isEmpty()) {
            return $this->getEmptyPrediction('minutes');
        }

        $seasonAvg = $recentGames->avg('minutes');
        $recentForm = $recentGames->take(3)->avg('minutes');

        // Adjust for game context
        $adjustments = [
            'rest_factor' => $this->getRestAdjustment($gameContext['rest_days']),
            'injury_factor' => $this->getInjuryAdjustment($playerId),
            'game_importance' => $this->getGameImportance($gameId),
            'foul_trouble_risk' => $this->getFoulTroubleRisk($playerId)
        ];

        $adjustedMinutes = $seasonAvg;
        foreach ($adjustments as $factor) {
            $adjustedMinutes *= $factor;
        }

        // Minutes are normally distributed
        $stdDev = $this->calculateStandardDeviation($recentGames->pluck('minutes')->toArray());

        return [
            'predicted_value' => round($adjustedMinutes, 1),
            'season_average' => round($seasonAvg, 1),
            'recent_form' => round($recentForm, 1),
            'adjustments' => $adjustments,
            'distribution_type' => 'normal',
            'mean' => $adjustedMinutes,
            'std_dev' => $stdDev,
            'confidence_interval_68' => [
                round($adjustedMinutes - $stdDev, 1),
                round($adjustedMinutes + $stdDev, 1)
            ]
        ];
    }

    /**
     * Calculate prediction confidence based on data quality
     */
    public function calculateConfidence(array $dataQuality): float
    {
        $factors = [
            'sample_size' => min(1.0, $dataQuality['games_count'] / 15), // Full confidence at 15+ games
            'recency' => min(1.0, $dataQuality['days_since_last_game'] <= 7 ? 1.0 : 0.8),
            'consistency' => $dataQuality['consistency_score'] / 100,
            'injury_status' => $dataQuality['injury_free'] ? 1.0 : 0.7,
            'minutes_stability' => min(1.0, $dataQuality['minutes_variance'] <= 5 ? 1.0 : 0.8)
        ];

        $weights = [
            'sample_size' => 0.3,
            'recency' => 0.2,
            'consistency' => 0.2,
            'injury_status' => 0.15,
            'minutes_stability' => 0.15
        ];

        $confidence = 0;
        foreach ($factors as $factor => $value) {
            $confidence += $value * $weights[$factor];
        }

        return round($confidence, 3);
    }

    /**
     * Calculate expected value for betting recommendation
     */
    public function calculateExpectedValue(float $probability, array $odds, float $stake = 100): array
    {
        $overOdds = $odds['over'] ?? -110;
        $underOdds = $odds['under'] ?? -110;

        // Convert American odds to decimal
        $overDecimal = $overOdds > 0 ? ($overOdds / 100) + 1 : (100 / abs($overOdds)) + 1;
        $underDecimal = $underOdds > 0 ? ($underOdds / 100) + 1 : (100 / abs($underOdds)) + 1;

        // Calculate expected values
        $overEV = ($probability * ($overDecimal - 1) * $stake) - ((1 - $probability) * $stake);
        $underEV = ((1 - $probability) * ($underDecimal - 1) * $stake) - ($probability * $stake);

        return [
            'over_bet' => round($overEV, 2),
            'under_bet' => round($underEV, 2),
            'best_bet' => $overEV > $underEV ? 'over' : 'under',
            'edge' => round(max($overEV, $underEV), 2)
        ];
    }

    // Private helper methods

    private function getGameContext(int $gameId, int $playerId): array
    {
        $game = WnbaGame::with('gameTeams.team')->find($gameId);
        $playerGame = WnbaPlayerGame::where('game_id', $gameId)
            ->where('player_id', $playerId)
            ->first();

        if (!$game || !$playerGame) {
            throw new \InvalidArgumentException('Game or player game not found');
        }

        $playerTeam = $playerGame->team_id;
        $opponentTeam = $game->gameTeams->where('team_id', '!=', $playerTeam)->first();

        return [
            'game_id' => $gameId,
            'game_date' => $game->game_date,
            'season_type' => $game->season_type,
            'player_team_id' => $playerTeam,
            'opponent_team_id' => $opponentTeam->team_id ?? null,
            'home_away' => $this->getHomeAway($game, $playerTeam),
            'rest_days' => $this->calculateRestDays($playerId, $game->game_date),
            'pace_factor' => $this->calculatePaceFactor($playerTeam, $opponentTeam->team_id ?? null),
            'opponent_defense_rating' => $this->getTeamDefensiveRating($opponentTeam->team_id ?? null),
            'projected_minutes' => $this->projectMinutes($playerId, $gameId)
        ];
    }

    private function getPlayerProfile(int $playerId, string $statType): array
    {
        $seasonGames = WnbaPlayerGame::where('player_id', $playerId)
            ->whereHas('game', function($query) {
                $query->where('season', 2025);
            })
            ->get();

        if ($seasonGames->isEmpty()) {
            return $this->getEmptyPlayerProfile();
        }

        $statValues = $seasonGames->pluck($statType)->toArray();

        return [
            'season_average' => round($seasonGames->avg($statType), 2),
            'games_played' => $seasonGames->count(),
            'variance' => $this->calculateVariance($statValues),
            'std_dev' => $this->calculateStandardDeviation($statValues),
            'consistency_score' => $this->calculateConsistencyScore($statValues),
            'trend' => $this->calculateTrend($statValues),
            'percentiles' => $this->calculatePercentiles($statValues)
        ];
    }

    private function calculatePropPrediction(int $playerId, int $gameId, string $propType, float $lineValue, array $gameContext, array $playerProfile): array
    {
        switch ($propType) {
            case 'points':
                $prediction = $this->predictPoints($playerId, $gameId);
                break;
            case 'rebounds':
                $prediction = $this->predictRebounds($playerId, $gameId);
                break;
            case 'assists':
                $prediction = $this->predictAssists($playerId, $gameId);
                break;
            case 'three_point_field_goals_made':
                $prediction = $this->predictThreePointers($playerId, $gameId);
                break;
            case 'steals':
                $stealsBlocks = $this->predictStealsBlocks($playerId, $gameId);
                $prediction = $stealsBlocks['steals'];
                break;
            case 'blocks':
                $stealsBlocks = $this->predictStealsBlocks($playerId, $gameId);
                $prediction = $stealsBlocks['blocks'];
                break;
            case 'minutes':
                $prediction = $this->predictMinutes($playerId, $gameId);
                break;
            default:
                throw new \InvalidArgumentException("Unsupported prop type: {$propType}");
        }

        // Calculate over probability based on distribution type
        $overProbability = $this->calculateOverProbability($prediction, $lineValue);

        return [
            'predicted_value' => $prediction['predicted_value'],
            'over_probability' => $overProbability,
            'model_type' => $prediction['distribution_type'],
            'factors' => $prediction,
            'statistical_basis' => $playerProfile,
            'data_points' => $playerProfile['games_played'],
            'data_quality' => $this->assessDataQuality($playerProfile, $gameContext)
        ];
    }

    private function calculateOverProbability(array $prediction, float $lineValue): float
    {
        $distributionType = $prediction['distribution_type'];
        $predictedValue = $prediction['predicted_value'];

        switch ($distributionType) {
            case 'poisson':
                return $this->poissonCalculator->calculateOverProbability($prediction['lambda'], $lineValue);

            case 'binomial':
                $n = $prediction['n'];
                $p = $prediction['p'];
                return $this->calculateBinomialOverProbability($n, $p, $lineValue);

            case 'normal':
                $mean = $prediction['mean'];
                $stdDev = $prediction['std_dev'];
                return $this->calculateNormalOverProbability($mean, $stdDev, $lineValue);

            default:
                // Fallback to simple comparison
                return $predictedValue > $lineValue ? 0.6 : 0.4;
        }
    }

    private function calculateBinomialOverProbability(int $n, float $p, float $lineValue): float
    {
        $probability = 0;
        for ($k = floor($lineValue) + 1; $k <= $n; $k++) {
            $probability += $this->binomialProbability($n, $k, $p);
        }
        return $probability;
    }

    private function binomialProbability(int $n, int $k, float $p): float
    {
        if ($k > $n || $k < 0) return 0;

        $combination = $this->combination($n, $k);
        return $combination * pow($p, $k) * pow(1 - $p, $n - $k);
    }

    private function combination(int $n, int $k): int
    {
        if ($k > $n - $k) $k = $n - $k;

        $result = 1;
        for ($i = 0; $i < $k; $i++) {
            $result = $result * ($n - $i) / ($i + 1);
        }

        return round($result);
    }

    private function calculateNormalOverProbability(float $mean, float $stdDev, float $lineValue): float
    {
        if ($stdDev <= 0) return $mean > $lineValue ? 1.0 : 0.0;

        $zScore = ($lineValue - $mean) / $stdDev;
        return 1 - $this->normalCDF($zScore);
    }

    private function normalCDF(float $x): float
    {
        return 0.5 * (1 + $this->erf($x / sqrt(2)));
    }

    private function erf(float $x): float
    {
        // Abramowitz and Stegun approximation
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

    private function applyContextualAdjustments(float $baseValue, array $gameContext, array $weights): float
    {
        $adjustments = [
            'pace' => $gameContext['pace_factor'] ?? 1.0,
            'defense' => 1 - (($gameContext['opponent_defense_rating'] - 100) / 100 * 0.1),
            'rest' => $this->getRestAdjustment($gameContext['rest_days']),
            'home_court' => $this->getHomeCourtAdjustment($gameContext['home_away'])
        ];

        $adjustedValue = $baseValue;
        foreach ($adjustments as $type => $factor) {
            $weight = $weights[$type . '_weight'] ?? 0;
            $adjustedValue *= (1 + ($factor - 1) * $weight);
        }

        return $adjustedValue;
    }

    private function getRestAdjustment(int $restDays): float
    {
        if ($restDays === 0) return 0.95; // Back-to-back
        if ($restDays === 1) return 0.98; // One day rest
        if ($restDays >= 3) return 1.02; // Well rested
        return 1.0; // Normal rest
    }

    private function getHomeCourtAdjustment(string $homeAway): float
    {
        return $homeAway === 'home' ? 1.03 : 0.97;
    }

    private function calculateVariance(array $values): float
    {
        if (empty($values)) return 0;

        $mean = array_sum($values) / count($values);
        $squaredDiffs = array_map(function($value) use ($mean) {
            return pow($value - $mean, 2);
        }, $values);

        return array_sum($squaredDiffs) / count($values);
    }

    private function calculateStandardDeviation(array $values): float
    {
        return sqrt($this->calculateVariance($values));
    }

    private function calculateConsistencyScore(array $values): float
    {
        if (empty($values)) return 0;

        $mean = array_sum($values) / count($values);
        $coefficientOfVariation = $mean > 0 ? $this->calculateStandardDeviation($values) / $mean : 0;

        return round((1 - min(1, $coefficientOfVariation)) * 100, 1);
    }

    private function calculateTrend(array $values): float
    {
        $n = count($values);
        if ($n < 2) return 0;

        $x = range(1, $n);
        $sumX = array_sum($x);
        $sumY = array_sum($values);
        $sumXY = 0;
        $sumX2 = 0;

        for ($i = 0; $i < $n; $i++) {
            $sumXY += $x[$i] * $values[$i];
            $sumX2 += $x[$i] * $x[$i];
        }

        $slope = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
        return round($slope, 3);
    }

    private function calculatePercentiles(array $values): array
    {
        if (empty($values)) return [];

        sort($values);
        $count = count($values);

        return [
            '10th' => $values[intval($count * 0.1)],
            '25th' => $values[intval($count * 0.25)],
            '50th' => $values[intval($count * 0.5)],
            '75th' => $values[intval($count * 0.75)],
            '90th' => $values[intval($count * 0.9)]
        ];
    }

    private function getEmptyPrediction(string $statType): array
    {
        return [
            'predicted_value' => 0,
            'distribution_type' => 'unknown',
            'confidence' => 0,
            'error' => "Insufficient data for {$statType} prediction"
        ];
    }

    private function getEmptyPlayerProfile(): array
    {
        return [
            'season_average' => 0,
            'games_played' => 0,
            'variance' => 0,
            'std_dev' => 0,
            'consistency_score' => 0,
            'trend' => 0,
            'percentiles' => []
        ];
    }

    private function getPropCategory(string $propType): string
    {
        $categories = [
            'points' => 'scoring',
            'rebounds' => 'rebounding',
            'assists' => 'playmaking',
            'three_point_field_goals_made' => 'shooting',
            'steals' => 'defense',
            'blocks' => 'defense',
            'turnovers' => 'ball_handling',
            'minutes' => 'playing_time'
        ];

        return $categories[$propType] ?? 'other';
    }

    private function getRecommendation(float $overProbability, array $expectedValue, float $confidence): array
    {
        $bestBet = $expectedValue['best_bet'];
        $edge = $expectedValue['edge'];

        if ($confidence < 0.6) {
            return ['action' => 'pass', 'reason' => 'Low confidence in prediction'];
        }

        if ($edge < 2) {
            return ['action' => 'pass', 'reason' => 'Insufficient edge'];
        }

        $strength = $edge > 5 ? 'strong' : 'moderate';

        return [
            'action' => 'bet',
            'side' => $bestBet,
            'strength' => $strength,
            'edge' => $edge,
            'confidence' => $confidence
        ];
    }

    private function assessDataQuality(array $playerProfile, array $gameContext): array
    {
        return [
            'games_count' => $playerProfile['games_played'],
            'days_since_last_game' => $this->getDaysSinceLastGame($gameContext['game_date']),
            'consistency_score' => $playerProfile['consistency_score'],
            'injury_free' => true, // Would need injury data
            'minutes_variance' => $playerProfile['std_dev']
        ];
    }

    // Placeholder methods that would need full implementation
    private function getHomeAway($game, $teamId): string { return 'home'; }
    private function calculateRestDays($playerId, $gameDate): int { return 2; }
    private function calculatePaceFactor($team1, $team2): float { return 1.0; }
    private function getTeamDefensiveRating($teamId): float { return 100.0; }
    private function projectMinutes($playerId, $gameId): float { return 30.0; }
    private function getOpponentReboundingRate($teamId): float { return 0.0; }
    private function getTeamAssistRate($teamId): float { return 0.5; }
    private function getOpponentThreePointDefense($teamId): float { return 0.0; }
    private function getOpponentTurnoverRate($teamId): float { return 0.0; }
    private function getInjuryAdjustment($playerId): float { return 1.0; }
    private function getGameImportance($gameId): float { return 1.0; }
    private function getFoulTroubleRisk($playerId): float { return 1.0; }
    private function getDaysSinceLastGame($gameDate): int { return 2; }

    /**
     * Get betting recommendation for a specific prop
     */
    public function getBettingRecommendation(
        int $playerId,
        string $statType,
        float $line,
        float $oddsOver,
        float $oddsUnder,
        ?int $gameId = null,
        ?int $season = null
    ): array {
        try {
            // Use a mock game ID if none provided
            $gameId = $gameId ?? 1;

            // Get prediction for the stat
            $prediction = match($statType) {
                'points' => $this->predictPoints($playerId, $gameId),
                'rebounds' => $this->predictRebounds($playerId, $gameId),
                'assists' => $this->predictAssists($playerId, $gameId),
                'steals' => $this->predictStealsBlocks($playerId, $gameId)['steals'] ?? [],
                'blocks' => $this->predictStealsBlocks($playerId, $gameId)['blocks'] ?? [],
                'three_pointers' => $this->predictThreePointers($playerId, $gameId),
                'minutes' => $this->predictMinutes($playerId, $gameId),
                default => $this->getEmptyPrediction($statType)
            };

            $predictedValue = $prediction['predicted_value'] ?? $line;
            $confidence = $prediction['confidence'] ?? 0.75;

            // Calculate probabilities
            $overProbability = $predictedValue > $line ?
                0.5 + (($predictedValue - $line) / $predictedValue) * 0.3 :
                0.5 - (($line - $predictedValue) / $line) * 0.3;
            $overProbability = max(0.1, min(0.9, $overProbability));
            $underProbability = 1 - $overProbability;

            // Convert American odds to decimal
            $decimalOddsOver = $oddsOver > 0 ? ($oddsOver / 100) + 1 : (100 / abs($oddsOver)) + 1;
            $decimalOddsUnder = $oddsUnder > 0 ? ($oddsUnder / 100) + 1 : (100 / abs($oddsUnder)) + 1;

            // Calculate expected values
            $evOver = ($overProbability * ($decimalOddsOver - 1)) - ((1 - $overProbability) * 1);
            $evUnder = ($underProbability * ($decimalOddsUnder - 1)) - ((1 - $underProbability) * 1);

            // Determine recommendation
            $recommendation = 'avoid';
            $reasoning = 'No significant edge detected';

            if ($confidence > 0.7) {
                if ($evOver > 0.05) {
                    $recommendation = 'over';
                    $reasoning = "Strong edge on over: {$predictedValue} predicted vs {$line} line";
                } elseif ($evUnder > 0.05) {
                    $recommendation = 'under';
                    $reasoning = "Strong edge on under: {$predictedValue} predicted vs {$line} line";
                }
            }

            return [
                'player_id' => $playerId,
                'stat_type' => $statType,
                'line' => $line,
                'predicted_value' => round($predictedValue, 2),
                'confidence' => round($confidence, 3),
                'over_probability' => round($overProbability, 3),
                'under_probability' => round($underProbability, 3),
                'expected_value_over' => round($evOver, 3),
                'expected_value_under' => round($evUnder, 3),
                'recommendation' => $recommendation,
                'reasoning' => $reasoning,
                'odds' => [
                    'over' => $oddsOver,
                    'under' => $oddsUnder
                ],
                'generated_at' => now()->toISOString()
            ];

        } catch (\Exception $e) {
            // Return fallback recommendation
            return [
                'player_id' => $playerId,
                'stat_type' => $statType,
                'line' => $line,
                'predicted_value' => $line,
                'confidence' => 0.5,
                'over_probability' => 0.5,
                'under_probability' => 0.5,
                'expected_value_over' => 0,
                'expected_value_under' => 0,
                'recommendation' => 'avoid',
                'reasoning' => 'Insufficient data for reliable prediction',
                'odds' => [
                    'over' => $oddsOver,
                    'under' => $oddsUnder
                ],
                'error' => $e->getMessage(),
                'generated_at' => now()->toISOString()
            ];
        }
    }
}
