<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WnbaPlayer;
use Illuminate\Http\JsonResponse;

class PlayerController extends Controller
{
    public function index(): JsonResponse
    {
        $players = WnbaPlayer::all();
        return response()->json([
            'data' => $players,
            'message' => 'Players retrieved successfully'
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $player = WnbaPlayer::with(['playerGames.team', 'playerGames.game'])
            ->where('athlete_id', $id)
            ->first();

        if (!$player) {
            return response()->json([
                'message' => 'Player not found'
            ], 404);
        }

        return response()->json([
            'data' => $player,
            'message' => 'Player retrieved successfully'
        ]);
    }
}
