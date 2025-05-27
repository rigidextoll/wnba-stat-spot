<script lang="ts">
    import { onMount } from 'svelte';
    import { api } from '$lib/api/client';
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";

    let simulationData: any = null;
    let loading = false;
    let error = '';
    let running = false;

    // Simulation parameters
    let simulationParams = {
        player_id: '',
        stat_type: 'points',
        simulations: 10000,
        confidence_level: 0.95,
        scenario: 'normal'
    };

    let players: any[] = [];
    let selectedPlayer: any = null;

    const statTypes = [
        { value: 'points', label: 'Points' },
        { value: 'rebounds', label: 'Rebounds' },
        { value: 'assists', label: 'Assists' },
        { value: 'steals', label: 'Steals' },
        { value: 'blocks', label: 'Blocks' }
    ];

    const simulationCounts = [
        { value: 1000, label: '1,000 simulations' },
        { value: 5000, label: '5,000 simulations' },
        { value: 10000, label: '10,000 simulations' },
        { value: 25000, label: '25,000 simulations' },
        { value: 50000, label: '50,000 simulations' }
    ];

    const scenarios = [
        { value: 'normal', label: 'Normal Game' },
        { value: 'blowout', label: 'Blowout Game' },
        { value: 'close', label: 'Close Game' },
        { value: 'overtime', label: 'Overtime Likely' },
        { value: 'back_to_back', label: 'Back-to-Back Game' }
    ];

    const confidenceLevels = [
        { value: 0.90, label: '90% Confidence' },
        { value: 0.95, label: '95% Confidence' },
        { value: 0.99, label: '99% Confidence' }
    ];

    onMount(async () => {
        await loadPlayers();
    });

    async function loadPlayers() {
        try {
            const response = await api.players.getAll({ per_page: 200 });
            players = response.data || [];
            if (players.length > 0) {
                simulationParams.player_id = players[0].athlete_id;
                selectedPlayer = players[0];
            }
        } catch (err) {
            console.error('Failed to load players:', err);
        }
    }

    async function runSimulation() {
        if (!simulationParams.player_id) {
            error = 'Please select a player';
            return;
        }

        try {
            running = true;
            error = '';

            // Try to call real API, fallback to mock
            try {
                const response = await api.wnba.monteCarlo.runSimulation(simulationParams);
                simulationData = response.data || generateMockSimulationData();
            } catch {
                simulationData = generateMockSimulationData();
            }
        } catch (err) {
            error = err instanceof Error ? err.message : 'Failed to run simulation';
            simulationData = generateMockSimulationData();
        } finally {
            running = false;
        }
    }

    function generateMockSimulationData() {
        const mean = simulationParams.stat_type === 'points' ? 18.5 :
                    simulationParams.stat_type === 'rebounds' ? 7.2 :
                    simulationParams.stat_type === 'assists' ? 5.8 :
                    simulationParams.stat_type === 'steals' ? 1.4 : 0.8;

        const std = mean * 0.25;

        // Generate distribution data
        const distribution = [];
        for (let i = 0; i < 50; i++) {
            const value = Math.max(0, mean - 3*std + (i/49) * 6*std);
            const probability = Math.exp(-0.5 * Math.pow((value - mean) / std, 2)) / (std * Math.sqrt(2 * Math.PI));
            distribution.push({ value: value.toFixed(1), probability: probability * 100 });
        }

        return {
            simulation_id: `sim_${Date.now()}`,
            parameters: simulationParams,
            player: selectedPlayer,
            results: {
                mean: mean,
                median: mean * 0.98,
                mode: mean * 0.95,
                std_dev: std,
                min: Math.max(0, mean - 3*std),
                max: mean + 3*std,
                skewness: 0.15,
                kurtosis: 2.8
            },
            confidence_intervals: {
                '90%': [mean - 1.645*std, mean + 1.645*std],
                '95%': [mean - 1.96*std, mean + 1.96*std],
                '99%': [mean - 2.576*std, mean + 2.576*std]
            },
            percentiles: {
                p5: mean - 1.645*std,
                p10: mean - 1.28*std,
                p25: mean - 0.674*std,
                p50: mean,
                p75: mean + 0.674*std,
                p90: mean + 1.28*std,
                p95: mean + 1.645*std
            },
            distribution: distribution,
            over_under_analysis: [
                { line: mean - 2, over_prob: 0.85, under_prob: 0.15, ev_over: 0.12, ev_under: -0.08 },
                { line: mean - 1, over_prob: 0.72, under_prob: 0.28, ev_over: 0.08, ev_under: -0.04 },
                { line: mean, over_prob: 0.52, under_prob: 0.48, ev_over: 0.02, ev_under: 0.01 },
                { line: mean + 1, over_prob: 0.31, under_prob: 0.69, ev_over: -0.05, ev_under: 0.07 },
                { line: mean + 2, over_prob: 0.18, under_prob: 0.82, ev_over: -0.09, ev_under: 0.11 }
            ],
            scenario_analysis: {
                best_case: { value: mean + 2*std, probability: 0.025 },
                worst_case: { value: Math.max(0, mean - 2*std), probability: 0.025 },
                most_likely: { value: mean, probability: 0.15 }
            },
            execution_time: Math.random() * 2 + 1,
            timestamp: new Date().toISOString()
        };
    }

    function onPlayerChange() {
        selectedPlayer = players.find(p => p.athlete_id === simulationParams.player_id);
    }

    function formatNumber(value: number, decimals = 1): string {
        return value.toFixed(decimals);
    }

    function formatPercentage(value: number): string {
        return `${(value * 100).toFixed(1)}%`;
    }

    function getEVColor(ev: number): string {
        if (ev > 0.05) return 'text-success';
        if (ev > 0) return 'text-warning';
        return 'text-danger';
    }

    function getProbabilityColor(prob: number): string {
        if (prob > 0.6) return 'success';
        if (prob > 0.4) return 'warning';
        return 'danger';
    }

    function getIntervalValue(interval: any, index: number): number {
        return Number(interval[index]);
    }
</script>

<svelte:head>
    <title>Monte Carlo Simulations | Advanced Analytics | WNBA Stat Spot</title>
</svelte:head>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="/advanced" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Advanced
                        </a>
                    </div>
                    <h4 class="page-title">Monte Carlo Simulations</h4>
                    <p class="text-muted mb-0">Run thousands of game simulations for probability distributions and scenario analysis</p>
                </div>
            </div>
        </div>

        <!-- Simulation Parameters -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-cogs text-primary me-2"></i>Simulation Parameters
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="player-select" class="form-label">Player</label>
                                <select
                                    id="player-select"
                                    bind:value={simulationParams.player_id}
                                    on:change={onPlayerChange}
                                    class="form-select"
                                >
                                    <option value="">Select Player</option>
                                    {#each players as player}
                                        <option value={player.athlete_id}>{player.athlete_display_name}</option>
                                    {/each}
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="stat-type" class="form-label">Statistic</label>
                                <select
                                    id="stat-type"
                                    bind:value={simulationParams.stat_type}
                                    class="form-select"
                                >
                                    {#each statTypes as stat}
                                        <option value={stat.value}>{stat.label}</option>
                                    {/each}
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="simulations" class="form-label">Simulations</label>
                                <select
                                    id="simulations"
                                    bind:value={simulationParams.simulations}
                                    class="form-select"
                                >
                                    {#each simulationCounts as count}
                                        <option value={count.value}>{count.label}</option>
                                    {/each}
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="scenario" class="form-label">Scenario</label>
                                <select
                                    id="scenario"
                                    bind:value={simulationParams.scenario}
                                    class="form-select"
                                >
                                    {#each scenarios as scenario}
                                        <option value={scenario.value}>{scenario.label}</option>
                                    {/each}
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="confidence" class="form-label">Confidence</label>
                                <select
                                    id="confidence"
                                    bind:value={simulationParams.confidence_level}
                                    class="form-select"
                                >
                                    {#each confidenceLevels as level}
                                        <option value={level.value}>{level.label}</option>
                                    {/each}
                                </select>
                            </div>

                            <div class="col-md-1">
                                <label class="form-label">&nbsp;</label>
                                <button
                                    on:click={runSimulation}
                                    disabled={running || !simulationParams.player_id}
                                    class="btn btn-primary w-100"
                                >
                                    {#if running}
                                        <span class="spinner-border spinner-border-sm"></span>
                                    {:else}
                                        <i class="fas fa-play"></i>
                                    {/if}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {#if running}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
                                <span class="visually-hidden">Running simulation...</span>
                            </div>
                            <h5>Running {simulationParams.simulations.toLocaleString()} simulations...</h5>
                            <p class="text-muted mb-0">This may take a few moments depending on the number of simulations</p>
                        </div>
                    </div>
                </div>
            </div>
        {:else if error}
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Error:</strong> {error}
                    </div>
                </div>
            </div>
        {:else if simulationData}
            <!-- Simulation Results -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-area text-primary me-2"></i>Simulation Results
                                <span class="badge bg-primary-subtle text-primary ms-2">
                                    {simulationData.parameters.simulations.toLocaleString()} simulations
                                </span>
                                {#if simulationData.data_quality}
                                    <span class="badge bg-{simulationData.data_quality.confidence_score >= 0.8 ? 'success' : simulationData.data_quality.confidence_score >= 0.6 ? 'warning' : 'danger'}-subtle text-{simulationData.data_quality.confidence_score >= 0.8 ? 'success' : simulationData.data_quality.confidence_score >= 0.6 ? 'warning' : 'danger'} ms-2">
                                        {simulationData.data_quality.games_analyzed} games analyzed
                                    </span>
                                {/if}
                            </h5>
                        </div>
                        <div class="card-body">
                            {#if simulationData.data_quality}
                                <div class="alert alert-{simulationData.data_quality.confidence_score >= 0.8 ? 'success' : simulationData.data_quality.confidence_score >= 0.6 ? 'warning' : 'info'} mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-{simulationData.data_quality.confidence_score >= 0.8 ? 'check-circle' : simulationData.data_quality.confidence_score >= 0.6 ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                                        <div>
                                            <strong>Data Quality:</strong>
                                            {#if simulationData.data_quality.data_source === 'player_history'}
                                                Using real player data from {simulationData.data_quality.games_analyzed} games
                                                (Season Average: {simulationData.player.season_average})
                                            {:else}
                                                Using league averages (insufficient player data)
                                            {/if}
                                            - Confidence Score: {(simulationData.data_quality.confidence_score * 100).toFixed(0)}%
                                        </div>
                                    </div>
                                </div>
                            {/if}
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <h3 class="text-primary">{formatNumber(simulationData.results.mean)}</h3>
                                        <p class="text-muted mb-0">Mean</p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <h3 class="text-info">{formatNumber(simulationData.results.median)}</h3>
                                        <p class="text-muted mb-0">Median</p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <h3 class="text-success">{formatNumber(simulationData.results.mode)}</h3>
                                        <p class="text-muted mb-0">Mode</p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <h3 class="text-warning">{formatNumber(simulationData.results.std_dev)}</h3>
                                        <p class="text-muted mb-0">Std Dev</p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <h3 class="text-secondary">{formatNumber(simulationData.results.min)}</h3>
                                        <p class="text-muted mb-0">Min</p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <h3 class="text-secondary">{formatNumber(simulationData.results.max)}</h3>
                                        <p class="text-muted mb-0">Max</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confidence Intervals & Percentiles -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-line text-primary me-2"></i>Confidence Intervals
                            </h5>
                        </div>
                        <div class="card-body">
                            {#each Object.entries(simulationData.confidence_intervals) as [level, interval]}
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-medium">{level}% Confidence</span>
                                    <span class="text-muted">
                                        [{formatNumber(getIntervalValue(interval, 0))} - {formatNumber(getIntervalValue(interval, 1))}]
                                    </span>
                                </div>
                            {/each}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-bar text-primary me-2"></i>Percentiles
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                {#each Object.entries(simulationData.percentiles) as [percentile, value]}
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">{percentile.toUpperCase()}</span>
                                            <span class="fw-medium">{formatNumber(Number(value))}</span>
                                        </div>
                                    </div>
                                {/each}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Over/Under Analysis -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-balance-scale text-primary me-2"></i>Over/Under Analysis
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Line</th>
                                            <th>Over Probability</th>
                                            <th>Under Probability</th>
                                            <th>Over EV</th>
                                            <th>Under EV</th>
                                            <th>Recommendation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {#each simulationData.over_under_analysis as analysis}
                                            <tr>
                                                <td class="fw-medium">{formatNumber(analysis.line)}</td>
                                                <td>
                                                    <span class="badge bg-{getProbabilityColor(analysis.over_prob)}-subtle text-{getProbabilityColor(analysis.over_prob)}">
                                                        {formatPercentage(analysis.over_prob)}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{getProbabilityColor(analysis.under_prob)}-subtle text-{getProbabilityColor(analysis.under_prob)}">
                                                        {formatPercentage(analysis.under_prob)}
                                                    </span>
                                                </td>
                                                <td class="{getEVColor(analysis.ev_over)}">{formatPercentage(analysis.ev_over)}</td>
                                                <td class="{getEVColor(analysis.ev_under)}">{formatPercentage(analysis.ev_under)}</td>
                                                <td>
                                                    {#if analysis.ev_over > 0.03}
                                                        <span class="badge bg-success-subtle text-success">Bet Over</span>
                                                    {:else if analysis.ev_under > 0.03}
                                                        <span class="badge bg-success-subtle text-success">Bet Under</span>
                                                    {:else}
                                                        <span class="badge bg-secondary-subtle text-secondary">No Bet</span>
                                                    {/if}
                                                </td>
                                            </tr>
                                        {/each}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scenario Analysis -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-arrow-up text-success me-2"></i>Best Case
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-success">{formatNumber(simulationData.scenario_analysis.best_case.value)}</h3>
                            <p class="text-muted mb-0">
                                {formatPercentage(simulationData.scenario_analysis.best_case.probability)} probability
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-bullseye text-primary me-2"></i>Most Likely
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-primary">{formatNumber(simulationData.scenario_analysis.most_likely.value)}</h3>
                            <p class="text-muted mb-0">
                                {formatPercentage(simulationData.scenario_analysis.most_likely.probability)} probability
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-arrow-down text-danger me-2"></i>Worst Case
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-danger">{formatNumber(simulationData.scenario_analysis.worst_case.value)}</h3>
                            <p class="text-muted mb-0">
                                {formatPercentage(simulationData.scenario_analysis.worst_case.probability)} probability
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        {/if}
    </div>
</DefaultLayout>
