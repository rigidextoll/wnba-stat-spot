<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WNBA\Analytics\PlayerAnalyticsService;
use App\Services\WNBA\Analytics\TeamAnalyticsService;
use App\Services\WNBA\Analytics\GameAnalyticsService;
use App\Services\WNBA\Predictions\PropsPredictionService;
use App\Services\WNBA\Predictions\StatisticalEngineService;
use App\Services\WNBA\Predictions\ModelValidationService;
use App\Services\WNBA\Math\BayesianCalculator;
use App\Services\WNBA\Math\PoissonCalculator;
use App\Services\WNBA\Math\MonteCarloSimulator;
use App\Services\WNBA\Math\RegressionAnalyzer;
use App\Services\WNBA\Data\DataAggregatorService;
use App\Services\WNBA\Data\CacheManagerService;

class WnbaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register Math services as singletons
        $this->app->singleton(BayesianCalculator::class);
        $this->app->singleton(PoissonCalculator::class);
        $this->app->singleton(MonteCarloSimulator::class);
        $this->app->singleton(RegressionAnalyzer::class);

        // Register Data services as singletons
        $this->app->singleton(DataAggregatorService::class);
        $this->app->singleton(CacheManagerService::class);

        // Register Analytics services
        $this->app->bind(PlayerAnalyticsService::class, function ($app) {
            return new PlayerAnalyticsService(
                $app->make(DataAggregatorService::class),
                $app->make(CacheManagerService::class),
                $app->make(StatisticalEngineService::class)
            );
        });

        $this->app->bind(TeamAnalyticsService::class, function ($app) {
            return new TeamAnalyticsService(
                $app->make(DataAggregatorService::class),
                $app->make(CacheManagerService::class),
                $app->make(StatisticalEngineService::class)
            );
        });

        $this->app->bind(GameAnalyticsService::class, function ($app) {
            return new GameAnalyticsService(
                $app->make(DataAggregatorService::class),
                $app->make(PlayerAnalyticsService::class),
                $app->make(TeamAnalyticsService::class),
                $app->make(CacheManagerService::class)
            );
        });

        // Register Statistical Engine service
        $this->app->bind(StatisticalEngineService::class, function ($app) {
            return new StatisticalEngineService(
                $app->make(BayesianCalculator::class),
                $app->make(PoissonCalculator::class),
                $app->make(MonteCarloSimulator::class),
                $app->make(RegressionAnalyzer::class)
            );
        });

        // Register Prediction services
        $this->app->bind(PropsPredictionService::class, function ($app) {
            return new PropsPredictionService(
                $app->make(PlayerAnalyticsService::class),
                $app->make(StatisticalEngineService::class),
                $app->make(BayesianCalculator::class),
                $app->make(MonteCarloSimulator::class),
                $app->make(PoissonCalculator::class)
            );
        });

        $this->app->bind(ModelValidationService::class, function ($app) {
            return new ModelValidationService(
                $app->make(PropsPredictionService::class),
                $app->make(StatisticalEngineService::class),
                $app->make(DataAggregatorService::class)
            );
        });

        // Register aliases for easier access
        $this->app->alias(PropsPredictionService::class, 'wnba.predictions');
        $this->app->alias(PlayerAnalyticsService::class, 'wnba.player.analytics');
        $this->app->alias(TeamAnalyticsService::class, 'wnba.team.analytics');
        $this->app->alias(GameAnalyticsService::class, 'wnba.game.analytics');
        $this->app->alias(ModelValidationService::class, 'wnba.validation');
        $this->app->alias(CacheManagerService::class, 'wnba.cache');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register console commands if needed
        if ($this->app->runningInConsole()) {
            $this->commands([
                // Add any WNBA-related console commands here
            ]);
        }

        // Publish configuration files if needed
        $this->publishes([
            __DIR__.'/../../config/wnba.php' => config_path('wnba.php'),
        ], 'wnba-config');
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
            BayesianCalculator::class,
            PoissonCalculator::class,
            MonteCarloSimulator::class,
            RegressionAnalyzer::class,
            DataAggregatorService::class,
            CacheManagerService::class,
            PlayerAnalyticsService::class,
            TeamAnalyticsService::class,
            GameAnalyticsService::class,
            StatisticalEngineService::class,
            PropsPredictionService::class,
            ModelValidationService::class,
            'wnba.predictions',
            'wnba.player.analytics',
            'wnba.team.analytics',
            'wnba.game.analytics',
            'wnba.validation',
            'wnba.cache',
        ];
    }
}
