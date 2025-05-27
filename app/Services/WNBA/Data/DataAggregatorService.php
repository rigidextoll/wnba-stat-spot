<?php

namespace App\Services\WNBA\Data;

use App\Models\WnbaPlayer;
use App\Models\WnbaPlayerGame;
use App\Models\WnbaGame;
use App\Models\WnbaGameTeam;
use App\Models\WnbaTeam;
use App\Models\WnbaPlay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DataAggregatorService
{
    private const CACHE_TTL = 3600; // 1 hour
    private const BATCH_SIZE = 1000;

    /**
     * Aggregate player performance data for analytics
     */
    public function aggregatePlayerData(int $playerId, ?int $season = null, ?int $lastNGames = null): array
    {
        $cacheKey = "player_data_{$playerId}_{$season}_{$lastNGames}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function() use ($playerId, $season, $lastNGames) {
            try {
                $query = WnbaPlayerGame::with(['game', 'team', 'player'])
                    ->where('player_id', $playerId);

                if ($season) {
                    $query->whereHas('game', function($q) use ($season) {
                        $q->where('season', $season);
                    });
                }

                $query->whereHas('game', function($q) {
                    $q->orderBy('game_date', 'desc');
                });

                if ($lastNGames) {
                    $query->limit($lastNGames);
                }

                $games = $query->get();

                if ($games->isEmpty()) {
                    return $this->getEmptyPlayerData();
                }

                return [
                    'player_info' => $this->extractPlayerInfo($games->first()),
                    'season_stats' => $this->calculateSeasonStats($games),
                    'game_log' => $this->formatGameLog($games),
                    'performance_trends' => $this->calculatePerformanceTrends($games),
                    'situational_stats' => $this->calculateSituationalStats($games),
                    'advanced_metrics' => $this->calculateAdvancedPlayerMetrics($games),
                    'consistency_metrics' => $this->calculateConsistencyMetrics($games),
                    'data_quality' => $this->assessDataQuality($games)
                ];

            } catch (\Exception $e) {
                Log::error('Player data aggregation failed', [
                    'player_id' => $playerId,
                    'error' => $e->getMessage()
                ]);
                return $this->getEmptyPlayerData();
            }
        });
    }

    /**
     * Aggregate team performance data
     */
    public function aggregateTeamData(int $teamId, ?int $season = null, ?int $lastNGames = null): array
    {
        $cacheKey = "team_data_{$teamId}_{$season}_{$lastNGames}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function() use ($teamId, $season, $lastNGames) {
            try {
                $query = WnbaGameTeam::with(['game', 'team', 'opponentTeam'])
                    ->where('team_id', $teamId);

                if ($season) {
                    $query->whereHas('game', function($q) use ($season) {
                        $q->where('season', $season);
                    });
                }

                $query->whereHas('game', function($q) {
                    $q->orderBy('game_date', 'desc');
                });

                if ($lastNGames) {
                    $query->limit($lastNGames);
                }

                $games = $query->get();

                if ($games->isEmpty()) {
                    return $this->getEmptyTeamData();
                }

                return [
                    'team_info' => $this->extractTeamInfo($games->first()),
                    'season_stats' => $this->calculateTeamSeasonStats($games),
                    'game_log' => $this->formatTeamGameLog($games),
                    'offensive_metrics' => $this->calculateOffensiveMetrics($games),
                    'defensive_metrics' => $this->calculateDefensiveMetrics($games),
                    'pace_metrics' => $this->calculatePaceMetrics($games),
                    'situational_performance' => $this->calculateTeamSituationalStats($games),
                    'strength_of_schedule' => $this->calculateStrengthOfSchedule($games),
                    'recent_form' => $this->calculateRecentForm($games)
                ];

            } catch (\Exception $e) {
                Log::error('Team data aggregation failed', [
                    'team_id' => $teamId,
                    'error' => $e->getMessage()
                ]);
                return $this->getEmptyTeamData();
            }
        });
    }

    /**
     * Aggregate game-level data for analysis
     */
    public function aggregateGameData(int $gameId): array
    {
        $cacheKey = "game_data_{$gameId}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function() use ($gameId) {
            try {
                $game = WnbaGame::with(['gameTeams.team', 'playerGames.player', 'plays'])
                    ->find($gameId);

                if (!$game) {
                    return $this->getEmptyGameData();
                }

                return [
                    'game_info' => $this->extractGameInfo($game),
                    'team_stats' => $this->extractTeamGameStats($game),
                    'player_stats' => $this->extractPlayerGameStats($game),
                    'play_by_play' => $this->processPlayByPlay($game),
                    'game_flow' => $this->analyzeGameFlow($game),
                    'key_moments' => $this->identifyKeyMoments($game),
                    'pace_analysis' => $this->analyzeGamePace($game),
                    'efficiency_metrics' => $this->calculateGameEfficiency($game),
                    'competitive_balance' => $this->analyzeCompetitiveBalance($game)
                ];

            } catch (\Exception $e) {
                Log::error('Game data aggregation failed', [
                    'game_id' => $gameId,
                    'error' => $e->getMessage()
                ]);
                return $this->getEmptyGameData();
            }
        });
    }

    /**
     * Aggregate matchup data between two teams
     */
    public function aggregateMatchupData(int $team1Id, int $team2Id, ?int $season = null): array
    {
        $cacheKey = "matchup_data_{$team1Id}_{$team2Id}_{$season}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function() use ($team1Id, $team2Id, $season) {
            try {
                // Get head-to-head games
                $query = WnbaGame::whereHas('gameTeams', function($q) use ($team1Id) {
                    $q->where('team_id', $team1Id);
                })->whereHas('gameTeams', function($q) use ($team2Id) {
                    $q->where('team_id', $team2Id);
                });

                if ($season) {
                    $query->where('season', $season);
                }

                $games = $query->with(['gameTeams.team', 'playerGames.player'])
                    ->orderBy('game_date', 'desc')
                    ->get();

                return [
                    'matchup_history' => $this->analyzeMatchupHistory($games, $team1Id, $team2Id),
                    'head_to_head_stats' => $this->calculateHeadToHeadStats($games, $team1Id, $team2Id),
                    'recent_meetings' => $this->formatRecentMeetings($games, $team1Id, $team2Id),
                    'style_comparison' => $this->compareTeamStyles($team1Id, $team2Id, $season),
                    'key_player_matchups' => $this->identifyKeyPlayerMatchups($team1Id, $team2Id, $season),
                    'trends' => $this->analyzeMatchupTrends($games, $team1Id, $team2Id),
                    'prediction_factors' => $this->extractPredictionFactors($team1Id, $team2Id, $season)
                ];

            } catch (\Exception $e) {
                Log::error('Matchup data aggregation failed', [
                    'team1_id' => $team1Id,
                    'team2_id' => $team2Id,
                    'error' => $e->getMessage()
                ]);
                return $this->getEmptyMatchupData();
            }
        });
    }

    /**
     * Aggregate league-wide statistics
     */
    public function aggregateLeagueData(int $season): array
    {
        $cacheKey = "league_data_{$season}";

        return Cache::remember($cacheKey, self::CACHE_TTL * 2, function() use ($season) {
            try {
                return [
                    'league_averages' => $this->calculateLeagueAverages($season),
                    'team_rankings' => $this->calculateTeamRankings($season),
                    'player_leaders' => $this->calculatePlayerLeaders($season),
                    'pace_trends' => $this->analyzePaceTrends($season),
                    'scoring_trends' => $this->analyzeScoringTrends($season),
                    'efficiency_trends' => $this->analyzeEfficiencyTrends($season),
                    'defensive_trends' => $this->analyzeDefensiveTrends($season),
                    'league_context' => $this->getLeagueContext($season)
                ];

            } catch (\Exception $e) {
                Log::error('League data aggregation failed', [
                    'season' => $season,
                    'error' => $e->getMessage()
                ]);
                return $this->getEmptyLeagueData();
            }
        });
    }

    /**
     * Aggregate data for prop betting analysis
     */
    public function aggregatePropData(int $playerId, string $statType, ?int $season = null): array
    {
        $cacheKey = "prop_data_{$playerId}_{$statType}_{$season}";

        return Cache::remember($cacheKey, self::CACHE_TTL, function() use ($playerId, $statType, $season) {
            try {
                $query = WnbaPlayerGame::where('player_id', $playerId);

                if ($season) {
                    $query->whereHas('game', function($q) use ($season) {
                        $q->where('season', $season);
                    });
                }

                $games = $query->with(['game.gameTeams', 'team'])
                    ->whereHas('game', function($q) {
                        $q->orderBy('game_date', 'desc');
                    })
                    ->get();

                if ($games->isEmpty()) {
                    return $this->getEmptyPropData();
                }

                $statValues = $games->pluck($statType)->filter()->toArray();

                return [
                    'stat_distribution' => $this->analyzeStatDistribution($statValues),
                    'historical_performance' => $this->analyzeHistoricalPerformance($games, $statType),
                    'situational_analysis' => $this->analyzeSituationalPerformance($games, $statType),
                    'opponent_impact' => $this->analyzeOpponentImpact($games, $statType),
                    'trend_analysis' => $this->analyzeTrends($statValues),
                    'consistency_metrics' => $this->calculateConsistency($statValues),
                    'outlier_analysis' => $this->analyzeOutliers($statValues),
                    'prediction_inputs' => $this->preparePredictionInputs($games, $statType)
                ];

            } catch (\Exception $e) {
                Log::error('Prop data aggregation failed', [
                    'player_id' => $playerId,
                    'stat_type' => $statType,
                    'error' => $e->getMessage()
                ]);
                return $this->getEmptyPropData();
            }
        });
    }

    // Private helper methods

    private function extractPlayerInfo($playerGame): array
    {
        return [
            'player_id' => $playerGame->player->id,
            'athlete_id' => $playerGame->player->athlete_id,
            'name' => $playerGame->player->athlete_display_name,
            'position' => $playerGame->player->athlete_position_abbreviation,
            'team_id' => $playerGame->team_id,
            'team_name' => $playerGame->team->team_display_name ?? 'Unknown'
        ];
    }

    private function calculateSeasonStats($games): array
    {
        return [
            'games_played' => $games->count(),
            'averages' => [
                'points' => round($games->avg('points'), 1),
                'rebounds' => round($games->avg('rebounds'), 1),
                'assists' => round($games->avg('assists'), 1),
                'steals' => round($games->avg('steals'), 1),
                'blocks' => round($games->avg('blocks'), 1),
                'turnovers' => round($games->avg('turnovers'), 1),
                'minutes' => round($games->avg('minutes'), 1),
                'field_goals_made' => round($games->avg('field_goals_made'), 1),
                'field_goals_attempted' => round($games->avg('field_goals_attempted'), 1),
                'three_point_made' => round($games->avg('three_point_field_goals_made'), 1),
                'three_point_attempted' => round($games->avg('three_point_field_goals_attempted'), 1),
                'free_throws_made' => round($games->avg('free_throws_made'), 1),
                'free_throws_attempted' => round($games->avg('free_throws_attempted'), 1)
            ],
            'totals' => [
                'points' => $games->sum('points'),
                'rebounds' => $games->sum('rebounds'),
                'assists' => $games->sum('assists'),
                'steals' => $games->sum('steals'),
                'blocks' => $games->sum('blocks'),
                'turnovers' => $games->sum('turnovers'),
                'minutes' => $games->sum('minutes')
            ],
            'percentages' => [
                'field_goal_pct' => $this->calculatePercentage($games->sum('field_goals_made'), $games->sum('field_goals_attempted')),
                'three_point_pct' => $this->calculatePercentage($games->sum('three_point_field_goals_made'), $games->sum('three_point_field_goals_attempted')),
                'free_throw_pct' => $this->calculatePercentage($games->sum('free_throws_made'), $games->sum('free_throws_attempted'))
            ]
        ];
    }

    private function formatGameLog($games): array
    {
        return $games->map(function($game) {
            return [
                'game_id' => $game->game_id,
                'date' => $game->game->game_date->format('Y-m-d'),
                'opponent' => $this->getOpponentName($game),
                'home_away' => $this->getHomeAway($game),
                'minutes' => $game->minutes,
                'points' => $game->points,
                'rebounds' => $game->rebounds,
                'assists' => $game->assists,
                'steals' => $game->steals,
                'blocks' => $game->blocks,
                'turnovers' => $game->turnovers,
                'fg_made_attempted' => $game->field_goals_made . '/' . $game->field_goals_attempted,
                'three_pt_made_attempted' => $game->three_point_field_goals_made . '/' . $game->three_point_field_goals_attempted,
                'ft_made_attempted' => $game->free_throws_made . '/' . $game->free_throws_attempted,
                'plus_minus' => $game->plus_minus,
                'starter' => $game->starter
            ];
        })->toArray();
    }

    private function calculatePerformanceTrends($games): array
    {
        $gameArray = $games->sortBy('game.game_date')->values();

        return [
            'points_trend' => $this->calculateTrend($gameArray->pluck('points')->toArray()),
            'rebounds_trend' => $this->calculateTrend($gameArray->pluck('rebounds')->toArray()),
            'assists_trend' => $this->calculateTrend($gameArray->pluck('assists')->toArray()),
            'minutes_trend' => $this->calculateTrend($gameArray->pluck('minutes')->toArray()),
            'efficiency_trend' => $this->calculateEfficiencyTrend($gameArray)
        ];
    }

    private function calculateSituationalStats($games): array
    {
        $homeGames = $games->filter(function($game) {
            return $this->getHomeAway($game) === 'home';
        });

        $awayGames = $games->filter(function($game) {
            return $this->getHomeAway($game) === 'away';
        });

        return [
            'home' => $this->calculateAverageStats($homeGames),
            'away' => $this->calculateAverageStats($awayGames),
            'vs_strong_defense' => $this->calculateVsStrongDefense($games),
            'vs_weak_defense' => $this->calculateVsWeakDefense($games),
            'back_to_back' => $this->calculateBackToBackStats($games),
            'rest_days' => $this->calculateRestDayStats($games)
        ];
    }

    private function calculateAdvancedPlayerMetrics($games): array
    {
        return [
            'usage_rate' => $this->calculateUsageRate($games),
            'true_shooting_pct' => $this->calculateTrueShootingPct($games),
            'effective_fg_pct' => $this->calculateEffectiveFGPct($games),
            'assist_turnover_ratio' => $this->calculateAssistTurnoverRatio($games),
            'per_36_stats' => $this->calculatePer36Stats($games),
            'player_efficiency_rating' => $this->calculatePER($games)
        ];
    }

    private function calculateConsistencyMetrics($games): array
    {
        $points = $games->pluck('points')->toArray();
        $rebounds = $games->pluck('rebounds')->toArray();
        $assists = $games->pluck('assists')->toArray();

        return [
            'points_consistency' => $this->calculateConsistency($points),
            'rebounds_consistency' => $this->calculateConsistency($rebounds),
            'assists_consistency' => $this->calculateConsistency($assists),
            'overall_consistency' => $this->calculateOverallConsistency($games)
        ];
    }

    private function assessDataQuality($games): array
    {
        $totalGames = $games->count();
        $gamesWithMinutes = $games->where('minutes', '>', 0)->count();
        $recentGames = $games->where('game.game_date', '>=', Carbon::now()->subDays(30))->count();

        return [
            'sample_size' => $totalGames,
            'data_completeness' => $totalGames > 0 ? $gamesWithMinutes / $totalGames : 0,
            'recency_score' => $totalGames > 0 ? $recentGames / min(10, $totalGames) : 0,
            'quality_score' => $this->calculateQualityScore($totalGames, $gamesWithMinutes, $recentGames)
        ];
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

        $denominator = $n * $sumX2 - $sumX * $sumX;
        return $denominator != 0 ? ($n * $sumXY - $sumX * $sumY) / $denominator : 0;
    }

    private function calculateConsistency(array $values): float
    {
        if (empty($values)) return 0;

        $mean = array_sum($values) / count($values);
        $variance = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $values)) / count($values);

        $coefficientOfVariation = $mean > 0 ? sqrt($variance) / $mean : 0;
        return round((1 - min(1, $coefficientOfVariation)) * 100, 1);
    }

    private function calculatePercentage(int $made, int $attempted): float
    {
        return $attempted > 0 ? round(($made / $attempted) * 100, 1) : 0;
    }

    private function calculateAverageStats($games): array
    {
        if ($games->isEmpty()) {
            return [];
        }

        return [
            'games' => $games->count(),
            'points' => round($games->avg('points'), 1),
            'rebounds' => round($games->avg('rebounds'), 1),
            'assists' => round($games->avg('assists'), 1),
            'minutes' => round($games->avg('minutes'), 1)
        ];
    }

    private function getOpponentName($game): string
    {
        // Get the game team data for this player's team using external game_id
        $gameTeam = WnbaGameTeam::whereHas('game', function($query) use ($game) {
                $query->where('game_id', $game->game->game_id);
            })
            ->where('team_id', $game->team_id)
            ->with('opponentTeam')
            ->first();

        if ($gameTeam && $gameTeam->opponentTeam) {
            return $gameTeam->opponentTeam->team_abbreviation ?? $gameTeam->opponentTeam->team_display_name ?? 'Unknown';
        }

        return 'Unknown';
    }

    private function getHomeAway($game): string
    {
        // Get the game team data for this player's team to determine home/away status using external game_id
        $gameTeam = WnbaGameTeam::whereHas('game', function($query) use ($game) {
                $query->where('game_id', $game->game->game_id);
            })
            ->where('team_id', $game->team_id)
            ->first();

        if ($gameTeam) {
            return $gameTeam->home_away ?? 'home';
        }

        return 'home';
    }

    // Placeholder methods for complex calculations
    private function calculateEfficiencyTrend($games): float { return 0; }
    private function calculateVsStrongDefense($games): array { return []; }
    private function calculateVsWeakDefense($games): array { return []; }
    private function calculateBackToBackStats($games): array { return []; }
    private function calculateRestDayStats($games): array { return []; }
    private function calculateUsageRate($games): float
    {
        if ($games->isEmpty()) {
            return 0;
        }

        $totalPlayerFGA = $games->sum('field_goals_attempted');
        $totalPlayerFTA = $games->sum('free_throws_attempted');
        $totalPlayerTOV = $games->sum('turnovers');
        $totalPlayerMinutes = $games->sum('minutes');

        if ($totalPlayerMinutes == 0) {
            return 0;
        }

        // For simplified calculation without full team data, we'll estimate
        // Typical team values per game: ~80 FGA, ~20 FTA, ~15 TOV, ~240 team minutes
        $gamesCount = $games->count();
        $estimatedTeamFGA = $gamesCount * 80;
        $estimatedTeamFTA = $gamesCount * 20;
        $estimatedTeamTOV = $gamesCount * 15;
        $estimatedTeamMinutes = $gamesCount * 240;

        // Usage Rate = 100 * ((FGA + 0.44 * FTA + TOV) * (Team Minutes / 5)) / (Minutes * (Team FGA + 0.44 * Team FTA + Team TOV))
        $playerPossessions = $totalPlayerFGA + (0.44 * $totalPlayerFTA) + $totalPlayerTOV;
        $teamPossessions = $estimatedTeamFGA + (0.44 * $estimatedTeamFTA) + $estimatedTeamTOV;

        $usageRate = 100 * (($playerPossessions * ($estimatedTeamMinutes / 5)) / ($totalPlayerMinutes * $teamPossessions));

        return round($usageRate, 1);
    }
    private function calculateTrueShootingPct($games): float { return 0; }
    private function calculateEffectiveFGPct($games): float { return 0; }
    private function calculateAssistTurnoverRatio($games): float { return 0; }
    private function calculatePer36Stats($games): array { return []; }
    private function calculatePER($games): float { return 0; }
    private function calculateOverallConsistency($games): float { return 0; }
    private function calculateQualityScore($total, $withMinutes, $recent): float { return 0.8; }

    // Team-related methods
    private function extractTeamInfo($gameTeam): array { return []; }
    private function calculateTeamSeasonStats($games): array { return []; }
    private function formatTeamGameLog($games): array { return []; }
    private function calculateOffensiveMetrics($games): array { return []; }
    private function calculateDefensiveMetrics($games): array { return []; }
    private function calculatePaceMetrics($games): array { return []; }
    private function calculateTeamSituationalStats($games): array { return []; }
    private function calculateStrengthOfSchedule($games): array { return []; }
    private function calculateRecentForm($games): array { return []; }

    // Game-related methods
    private function extractGameInfo($game): array { return []; }
    private function extractTeamGameStats($game): array { return []; }
    private function extractPlayerGameStats($game): array { return []; }
    private function processPlayByPlay($game): array { return []; }
    private function analyzeGameFlow($game): array { return []; }
    private function identifyKeyMoments($game): array { return []; }
    private function analyzeGamePace($game): array { return []; }
    private function calculateGameEfficiency($game): array { return []; }
    private function analyzeCompetitiveBalance($game): array { return []; }

    // Matchup-related methods
    private function analyzeMatchupHistory($games, $team1Id, $team2Id): array { return []; }
    private function calculateHeadToHeadStats($games, $team1Id, $team2Id): array { return []; }
    private function formatRecentMeetings($games, $team1Id, $team2Id): array { return []; }
    private function compareTeamStyles($team1Id, $team2Id, $season): array { return []; }
    private function identifyKeyPlayerMatchups($team1Id, $team2Id, $season): array { return []; }
    private function analyzeMatchupTrends($games, $team1Id, $team2Id): array { return []; }
    private function extractPredictionFactors($team1Id, $team2Id, $season): array { return []; }

    // League-related methods
    private function calculateLeagueAverages($season): array { return []; }
    private function calculateTeamRankings($season): array { return []; }
    private function calculatePlayerLeaders($season): array { return []; }
    private function analyzePaceTrends($season): array { return []; }
    private function analyzeScoringTrends($season): array { return []; }
    private function analyzeEfficiencyTrends($season): array { return []; }
    private function analyzeDefensiveTrends($season): array { return []; }
    private function getLeagueContext($season): array { return []; }

    // Prop-related methods
    private function analyzeStatDistribution($values): array { return []; }
    private function analyzeHistoricalPerformance($games, $statType): array { return []; }
    private function analyzeSituationalPerformance($games, $statType): array { return []; }
    private function analyzeOpponentImpact($games, $statType): array { return []; }
    private function analyzeTrends($values): array { return []; }
    private function analyzeOutliers($values): array { return []; }
    private function preparePredictionInputs($games, $statType): array { return []; }

    // Empty data methods
    private function getEmptyPlayerData(): array
    {
        return [
            'player_info' => [],
            'season_stats' => [],
            'game_log' => [],
            'performance_trends' => [],
            'situational_stats' => [],
            'advanced_metrics' => [],
            'consistency_metrics' => [],
            'data_quality' => ['quality_score' => 0]
        ];
    }

    private function getEmptyTeamData(): array { return []; }
    private function getEmptyGameData(): array { return []; }
    private function getEmptyMatchupData(): array { return []; }
    private function getEmptyLeagueData(): array { return []; }
    private function getEmptyPropData(): array { return []; }
}
