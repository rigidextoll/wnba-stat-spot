<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\WNBA\Data\DataAggregatorService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DataAggregatorController extends Controller
{
    public function __construct(
        private DataAggregatorService $dataAggregator
    ) {}

    /**
     * Get aggregated player data
     */
    public function getPlayerData(Request $request, int $playerId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'season' => 'nullable|integer',
            'last_n_games' => 'nullable|integer|min:1|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Convert athlete_id to internal player_id if needed
            $player = \App\Models\WnbaPlayer::where('athlete_id', $playerId)->first();

            if (!$player) {
                return response()->json([
                    'success' => false,
                    'message' => 'Player not found'
                ], 404);
            }

            $internalPlayerId = $player->id;
            $season = $request->input('season');
            $lastNGames = $request->input('last_n_games');

            $data = $this->dataAggregator->aggregatePlayerData($internalPlayerId, $season, $lastNGames);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            Log::error('Player data aggregation failed', [
                'player_id' => $playerId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to aggregate player data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get aggregated team data
     */
    public function getTeamData(Request $request, int $teamId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'season' => 'nullable|integer',
            'last_n_games' => 'nullable|integer|min:1|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $season = $request->input('season');
            $lastNGames = $request->input('last_n_games');

            $data = $this->dataAggregator->aggregateTeamData($teamId, $season, $lastNGames);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            Log::error('Team data aggregation failed', [
                'team_id' => $teamId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to aggregate team data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get aggregated game data
     */
    public function getGameData(Request $request, int $gameId): JsonResponse
    {
        try {
            $data = $this->dataAggregator->aggregateGameData($gameId);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            Log::error('Game data aggregation failed', [
                'game_id' => $gameId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to aggregate game data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get aggregated matchup data
     */
    public function getMatchupData(Request $request, int $team1Id, int $team2Id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'season' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $season = $request->input('season');

            $data = $this->dataAggregator->aggregateMatchupData($team1Id, $team2Id, $season);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            Log::error('Matchup data aggregation failed', [
                'team1_id' => $team1Id,
                'team2_id' => $team2Id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to aggregate matchup data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get aggregated league data
     */
    public function getLeagueData(Request $request, int $season): JsonResponse
    {
        try {
            $data = $this->dataAggregator->aggregateLeagueData($season);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            Log::error('League data aggregation failed', [
                'season' => $season,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to aggregate league data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get aggregated prop data for betting analysis
     */
    public function getPropData(Request $request, int $playerId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'stat_type' => 'required|string|in:points,rebounds,assists,steals,blocks,turnovers,minutes,field_goals_made,field_goals_attempted,three_point_field_goals_made,three_point_field_goals_attempted,free_throws_made,free_throws_attempted',
            'season' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Convert athlete_id to internal player_id if needed
            $player = \App\Models\WnbaPlayer::where('athlete_id', $playerId)->first();

            if (!$player) {
                return response()->json([
                    'success' => false,
                    'message' => 'Player not found'
                ], 404);
            }

            $internalPlayerId = $player->id;
            $statType = $request->input('stat_type');
            $season = $request->input('season');

            $data = $this->dataAggregator->aggregatePropData($internalPlayerId, $statType, $season);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            Log::error('Prop data aggregation failed', [
                'player_id' => $playerId,
                'stat_type' => $request->input('stat_type'),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to aggregate prop data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
