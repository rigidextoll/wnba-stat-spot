<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Test command to verify scheduler is working
Artisan::command('test:scheduler', function () {
    $this->info('✅ Scheduler test command executed at: ' . now());
    Log::info('Scheduler test command executed', ['timestamp' => now()]);
})->purpose('Test that the scheduler is working');

// Define scheduled tasks
Schedule::command('test:scheduler')
    ->everyMinute()
    ->description('Test scheduler every minute')
    ->withoutOverlapping();

// Import WNBA data daily at 2 AM
Schedule::command('app:import-wnba-data --force')
    ->dailyAt('02:00')
    ->description('Import WNBA data daily')
    ->withoutOverlapping()
    ->onOneServer();

// Run queue health check every 30 minutes
Schedule::command('queue:health-check')
    ->everyThirtyMinutes()
    ->description('Check queue health')
    ->withoutOverlapping();

// Clean up failed jobs older than 48 hours
Schedule::command('queue:prune-failed --hours=48')
    ->daily()
    ->description('Clean up old failed jobs');
