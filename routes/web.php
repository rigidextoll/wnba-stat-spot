<?php

use App\Http\Controllers\Main;
use Illuminate\Support\Facades\Route;

// Simple ping endpoint for port detection
Route::get('/ping', function () {
    return 'pong';
});

// Simple status endpoint (no database required)
Route::get('/status', function () {
    return response()->json([
        'status' => 'running',
        'app' => 'WNBA Stat Spot',
        'timestamp' => now()->toISOString()
    ]);
});

// Health check endpoint for deployment verification
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
        'app' => 'WNBA Stat Spot',
        'version' => '1.0.0'
    ]);
});

// Main SPA route - serves the Svelte app
Route::get('/', [Main::class, 'main'])->name('main');

// Catch-all route for SPA routing (Svelte Router) - MUST BE LAST
// Exclude API routes from catch-all to prevent interference
Route::get('/{any}', [Main::class, 'main'])
    ->where('any', '^(?!api).*')
    ->name('spa');
