<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import { onMount } from 'svelte';

    let stats = {
        totalPredictions: 15420,
        accuracyRate: 73.2,
        expectedValue: 8.7,
        dataQuality: 94.1
    };

    const advancedFeatures = [
        {
            title: "Model Validation",
            description: "Deep analysis of prediction model performance, accuracy metrics, and calibration",
            icon: "fas fa-chart-line",
            color: "primary",
            href: "/advanced/model-validation",
            metrics: ["Accuracy: 73.2%", "Calibration: 0.89", "Brier Score: 0.21"]
        },
        {
            title: "Prop Bet Scanner",
            description: "Scan all players for profitable prop betting opportunities with AI predictions",
            icon: "fas fa-radar",
            color: "success",
            href: "/advanced/prop-scanner",
            metrics: ["500+ Players", "5 Stat Types", "Real-time EV"]
        },
        {
            title: "Player Analytics",
            description: "Advanced player performance analysis with situational breakdowns and trends",
            icon: "fas fa-user-chart",
            color: "info",
            href: "/reports/players",
            metrics: ["Usage Rate", "True Shooting %", "PER Analysis"]
        },
        {
            title: "Team Analytics",
            description: "Complex team performance metrics, pace analysis, and matchup predictions",
            icon: "fas fa-users-cog",
            color: "warning",
            href: "/reports/teams",
            metrics: ["Pace Factor", "Net Rating", "SOS Analysis"]
        },
        {
            title: "Betting Analytics",
            description: "Expected value calculations, ROI tracking, and bankroll management",
            icon: "fas fa-coins",
            color: "secondary",
            href: "/advanced/betting-analytics",
            metrics: ["ROI: +8.7%", "Kelly %: 2.3%", "Sharpe: 1.42"]
        },
        {
            title: "Data Quality",
            description: "Data completeness analysis, reliability metrics, and source validation",
            icon: "fas fa-database",
            color: "primary",
            href: "/advanced/data-quality",
            metrics: ["Completeness: 94.1%", "Freshness: 98.7%", "Accuracy: 99.2%"]
        },
        {
            title: "Monte Carlo Simulations",
            description: "Run thousands of game simulations for probability distributions",
            icon: "fas fa-dice",
            color: "danger",
            href: "/advanced/monte-carlo",
            metrics: ["10K Simulations", "95% Confidence", "Variance Analysis"]
        }
    ];
</script>

<svelte:head>
    <title>Advanced Analytics | WNBA Stat Spot</title>
</svelte:head>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Advanced Analytics</h4>
                    <p class="text-muted mb-0">Sophisticated WNBA analytics tools for professional-grade insights and predictions</p>
                </div>
            </div>
        </div>

        <!-- Overview Stats -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-brain text-primary fs-18"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Total Predictions</h5>
                                <h3 class="text-primary mb-0">{stats.totalPredictions.toLocaleString()}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-bullseye text-success fs-18"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Accuracy Rate</h5>
                                <h3 class="text-success mb-0">{stats.accuracyRate}%</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-chart-bar text-warning fs-18"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Expected Value</h5>
                                <h3 class="text-warning mb-0">+{stats.expectedValue}%</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-shield-check text-info fs-18"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Data Quality</h5>
                                <h3 class="text-info mb-0">{stats.dataQuality}%</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Tools -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-tools text-primary me-2"></i>Quick Access Tools
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <a href="/advanced/model-validation" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-microscope me-2"></i>
                                    Model Diagnostics
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="/advanced/prop-scanner" class="btn btn-outline-success w-100">
                                    <i class="fas fa-radar me-2"></i>
                                    Prop Scanner
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="/advanced/betting-analytics" class="btn btn-outline-warning w-100">
                                    <i class="fas fa-calculator me-2"></i>
                                    EV Calculator
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="/advanced/monte-carlo" class="btn btn-outline-info w-100">
                                    <i class="fas fa-random me-2"></i>
                                    Run Simulation
                                </a>
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <a href="/advanced/data-quality" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-search me-2"></i>
                                    Data Quality Audit
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="/reports/analytics" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-chart-line me-2"></i>
                                    Analytics Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advanced Features Grid -->
        <div class="row">
            {#each advancedFeatures as feature}
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <div class="avatar-md bg-{feature.color} bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="{feature.icon} text-{feature.color} fs-20"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">{feature.title}</h5>
                                    <p class="text-muted mb-0">{feature.description}</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                {#each feature.metrics as metric}
                                    <span class="badge bg-{feature.color}-subtle text-{feature.color} me-2 mb-1">
                                        {metric}
                                    </span>
                                {/each}
                            </div>

                            <div class="d-grid">
                                <a href={feature.href} class="btn btn-{feature.color}">
                                    <i class="fas fa-arrow-right me-2"></i>
                                    Explore {feature.title}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            {/each}
        </div>

        <!-- New cards -->
        <div class="row mt-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-sm bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-chart-area text-warning fs-18"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1">Monte Carlo Simulations</h5>
                                <p class="text-muted mb-0">Statistical modeling</p>
                            </div>
                        </div>
                        <p class="text-muted mb-3">Run thousands of game simulations to understand probability distributions and scenario analysis for player performance.</p>
                        <div class="d-flex gap-2">
                            <a href="/advanced/monte-carlo" class="btn btn-warning btn-sm">
                                <i class="fas fa-play me-1"></i>Run Simulation
                            </a>
                            <a href="/methodology/monte-carlo" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-book me-1"></i>Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-sm bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-check-circle text-success fs-18"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-1">Prediction Testing</h5>
                                <p class="text-muted mb-0">Accuracy validation</p>
                            </div>
                        </div>
                        <p class="text-muted mb-3">Test prediction accuracy against actual game results to build confidence and track historical performance metrics.</p>
                        <div class="d-flex gap-2">
                            <a href="/advanced/prediction-testing" class="btn btn-success btn-sm">
                                <i class="fas fa-vial me-1"></i>Run Tests
                            </a>
                            <a href="/methodology" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-info-circle me-1"></i>Methodology
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</DefaultLayout>

<style>
    .avatar-md {
        width: 3rem;
        height: 3rem;
    }

    .fs-20 {
        font-size: 1.25rem;
    }
</style>
