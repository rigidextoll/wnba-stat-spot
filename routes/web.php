<?php

use App\Http\Controllers\Main;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\StatsController;

Route::get('/', [Main::class, 'main'])->name('main');

//// API ROUTES ////
Route::get('/api/teams', [TeamController::class, 'index']);
Route::get('/api/players', [PlayerController::class, 'index']);
Route::get('/api/players/{id}', [PlayerController::class, 'show']);
Route::get('/api/games', [GameController::class, 'index']);
Route::get('/api/stats', [StatsController::class, 'index']);
