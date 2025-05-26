<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WnbaTeam;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    public function index(): JsonResponse
    {
        $teams = WnbaTeam::all();
        return response()->json([
            'data' => $teams,
            'message' => 'Teams retrieved successfully'
        ]);
    }
}
