<?php

use App\Http\Controllers\Main;
use Illuminate\Support\Facades\Route;

// Main SPA route - serves the Svelte app
Route::get('/', [Main::class, 'main'])->name('main');

// Catch-all route for SPA routing (Svelte Router) - MUST BE LAST
Route::get('/{any}', [Main::class, 'main'])->where('any', '.*')->name('spa');
