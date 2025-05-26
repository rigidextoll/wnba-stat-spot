<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WnbaGame;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    public function index(): JsonResponse
    {
        $games = WnbaGame::with(['gameTeams.team', 'gameTeams.opponentTeam'])
            ->orderBy('game_date', 'desc')
            ->get();

        return response()->json([
            'data' => $games,
            'message' => 'Games retrieved successfully'
        ]);
    }
}
