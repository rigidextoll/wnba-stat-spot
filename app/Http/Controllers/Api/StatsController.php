<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WnbaPlayerGame;
use Illuminate\Http\JsonResponse;

class StatsController extends Controller
{
    public function index(): JsonResponse
    {
        $stats = WnbaPlayerGame::with(['player', 'team', 'game'])
            ->orderBy('points', 'desc')
            ->limit(500)
            ->get();

        return response()->json([
            'data' => $stats,
            'message' => 'Stats retrieved successfully'
        ]);
    }
}
