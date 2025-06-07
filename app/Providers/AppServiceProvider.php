<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Odds\OddsApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OddsApiService::class, function ($app) {
            return new OddsApiService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
