<script lang="ts">
    import { onMount } from 'svelte';
    import { api } from '$lib/api/client';
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";

    interface TodaysProp {
        player_id: string;
        player_name: string;
        team_abbreviation: string;
        opponent: string;
        game_time: string;
        stat_type: string;
        suggested_line: number;
        predicted_value: number;
        confidence: number;
        recommendation: 'over' | 'under' | 'avoid';
        expected_value: number;
        probability_over: number;
        probability_under: number;
        recent_form: number;
        season_average: number;
        matchup_difficulty: string;
        betting_value: string;
        reasoning: string;
    }

    let props: TodaysProp[] = [];
    let loading = true;
    let error = '';
    let filters = {
        stat_type: '',
        min_confidence: 0,
        min_expected_value: 0,
        recommendation: '',
        sort_by: 'expected_value',
        sort_order: 'desc'
    };

    const statTypes = [
        { value: '', label: 'All Stats' },
        { value: 'points', label: 'Points' },
        { value: 'rebounds', label: 'Rebounds' },
        { value: 'assists', label: 'Assists' },
        { value: 'steals', label: 'Steals' },
        { value: 'blocks', label: 'Blocks' }
    ];

    const recommendations = [
        { value: '', label: 'All Recommendations' },
        { value: 'over', label: 'Over' },
        { value: 'under', label: 'Under' },
        { value: 'avoid', label: 'Avoid' }
    ];

    const sortOptions = [
        { value: 'expected_value', label: 'Expected Value' },
        { value: 'confidence', label: 'Confidence' },
        { value: 'predicted_value', label: 'Predicted Value' },
        { value: 'player_name', label: 'Player Name' },
        { value: 'game_time', label: 'Game Time' }
    ];

    $: filteredProps = props.filter(prop => {
        if (filters.stat_type && prop.stat_type !== filters.stat_type) return false;

        // Handle confidence filtering for both decimal (0.65) and percentage (65) formats
        const normalizedConfidence = prop.confidence <= 1 ? prop.confidence * 100 : prop.confidence;
        if (normalizedConfidence < filters.min_confidence) return false;

        if (prop.expected_value < filters.min_expected_value) return false;
        if (filters.recommendation && prop.recommendation !== filters.recommendation) return false;
        return true;
    }).sort((a, b) => {
        const aVal = a[filters.sort_by as keyof TodaysProp];
        const bVal = b[filters.sort_by as keyof TodaysProp];

        if (filters.sort_order === 'desc') {
            return bVal > aVal ? 1 : -1;
        } else {
            return aVal > bVal ? 1 : -1;
        }
    });

    async function loadTodaysProps() {
        try {
            loading = true;
            error = '';

            const response = await api.wnba.predictions.getTodaysBestProps();

            if (response.success) {
                props = response.data || [];
            } else {
                error = 'Failed to load today\'s props';
            }
        } catch (err) {
            error = err instanceof Error ? err.message : 'Failed to load today\'s props';
            console.error('Error loading today\'s props:', err);
        } finally {
            loading = false;
        }
    }

    function formatPercentage(value: number): string {
        // Handle both decimal (0.65) and percentage (65) formats
        if (value <= 1) {
            // Decimal format - multiply by 100
            return `${(value * 100).toFixed(1)}%`;
        } else {
            // Already in percentage format - just format
            return `${value.toFixed(1)}%`;
        }
    }

    function formatNumber(value: number): string {
        return value.toFixed(1);
    }

    function getConfidenceColor(confidence: number): string {
        // Normalize confidence to 0-1 range for comparison
        const normalizedConfidence = confidence <= 1 ? confidence : confidence / 100;

        if (normalizedConfidence >= 0.8) return 'success';
        if (normalizedConfidence >= 0.6) return 'warning';
        return 'danger';
    }

    function getRecommendationColor(recommendation: string): string {
        switch (recommendation) {
            case 'over': return 'success';
            case 'under': return 'primary';
            case 'avoid': return 'danger';
            default: return 'secondary';
        }
    }

    function getBettingValueColor(value: string): string {
        switch (value) {
            case 'excellent': return 'success';
            case 'good': return 'info';
            case 'fair': return 'warning';
            case 'poor': return 'danger';
            default: return 'secondary';
        }
    }

    function getMatchupDifficultyColor(difficulty: string): string {
        switch (difficulty.toLowerCase()) {
            case 'favorable': return 'success';
            case 'neutral': return 'warning';
            case 'difficult': return 'danger';
            default: return 'secondary';
        }
    }

    function clearFilters() {
        filters = {
            stat_type: '',
            min_confidence: 0,
            min_expected_value: 0,
            recommendation: '',
            sort_by: 'expected_value',
            sort_order: 'desc'
        };
    }

    onMount(() => {
        loadTodaysProps();
    });
</script>

<svelte:head>
    <title>Today's Best Props - WNBA Stat Spot</title>
</svelte:head>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <button
                            on:click={loadTodaysProps}
                            class="btn btn-outline-primary me-2"
                            disabled={loading}
                        >
                            {#if loading}
                                <span class="spinner-border spinner-border-sm me-1"></span>
                            {:else}
                                <i class="fas fa-sync me-1"></i>
                            {/if}
                            Refresh
                        </button>
                        <a href="/reports/predictions" class="btn btn-success">
                            <i class="fas fa-crystal-ball me-1"></i>Prediction Engine
                        </a>
                    </div>
                    <h4 class="page-title">Today's Best Props</h4>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-filter text-primary me-2"></i>Filters
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label for="stat-filter" class="form-label">Statistic</label>
                                <select id="stat-filter" class="form-select" bind:value={filters.stat_type}>
                                    {#each statTypes as stat}
                                        <option value={stat.value}>{stat.label}</option>
                                    {/each}
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="confidence-filter" class="form-label">Min Confidence (%)</label>
                                <input
                                    id="confidence-filter"
                                    type="number"
                                    class="form-control"
                                    bind:value={filters.min_confidence}
                                    min="0"
                                    max="100"
                                    placeholder="0"
                                />
                            </div>
                            <div class="col-md-2">
                                <label for="ev-filter" class="form-label">Min Expected Value</label>
                                <input
                                    id="ev-filter"
                                    type="number"
                                    class="form-control"
                                    bind:value={filters.min_expected_value}
                                    min="0"
                                    step="0.1"
                                    placeholder="0"
                                />
                            </div>
                            <div class="col-md-2">
                                <label for="recommendation-filter" class="form-label">Recommendation</label>
                                <select id="recommendation-filter" class="form-select" bind:value={filters.recommendation}>
                                    {#each recommendations as rec}
                                        <option value={rec.value}>{rec.label}</option>
                                    {/each}
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="sort-filter" class="form-label">Sort By</label>
                                <select id="sort-filter" class="form-select" bind:value={filters.sort_by}>
                                    {#each sortOptions as sort}
                                        <option value={sort.value}>{sort.label}</option>
                                    {/each}
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="order-filter" class="form-label">Order</label>
                                <select id="order-filter" class="form-select" bind:value={filters.sort_order}>
                                    <option value="desc">Descending</option>
                                    <option value="asc">Ascending</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button
                                    on:click={clearFilters}
                                    class="btn btn-outline-secondary btn-sm"
                                >
                                    <i class="fas fa-times me-1"></i>Clear Filters
                                </button>
                                <span class="text-muted ms-3">
                                    Showing {filteredProps.length} of {props.length} props
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Props Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-line text-success me-2"></i>
                                Today's Best Props ({filteredProps.length})
                            </h5>
                            <div class="text-muted">
                                <small>Last updated: {new Date().toLocaleString()}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {#if loading}
                            <div class="text-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 mb-0">Loading today's best props...</p>
                            </div>
                        {:else if error}
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Error:</strong> {error}
                                <button
                                    on:click={loadTodaysProps}
                                    class="btn btn-sm btn-outline-danger ms-2"
                                >
                                    Try Again
                                </button>
                            </div>
                        {:else if filteredProps.length === 0}
                            <div class="text-center py-5">
                                <div class="avatar-lg bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                    <i class="fas fa-search text-muted fs-24"></i>
                                </div>
                                <h5 class="mb-2">No Props Found</h5>
                                <p class="text-muted mb-3">
                                    {props.length === 0
                                        ? 'No WNBA games are scheduled for today, or all scheduled games have been completed. Today\'s props are only generated for games happening today that haven\'t finished yet.'
                                        : 'No props match your current filters. Try adjusting the filters above.'
                                    }
                                </p>
                                {#if props.length > 0}
                                    <button
                                        on:click={clearFilters}
                                        class="btn btn-primary"
                                    >
                                        <i class="fas fa-times me-2"></i>Clear Filters
                                    </button>
                                {/if}
                            </div>
                        {:else}
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Player</th>
                                            <th>Game</th>
                                            <th>Stat</th>
                                            <th>Line</th>
                                            <th>Predicted</th>
                                            <th>Confidence</th>
                                            <th>Recommendation</th>
                                            <th>Expected Value</th>
                                            <th>Over/Under Prob</th>
                                            <th>Form</th>
                                            <th>Matchup</th>
                                            <th>Value</th>
                                            <th>Reasoning</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {#each filteredProps as prop}
                                            <tr>
                                                <td>
                                                    <div>
                                                        <div class="fw-semibold">{prop.player_name}</div>
                                                        <small class="text-muted">{prop.team_abbreviation}</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <div class="fw-medium">{prop.opponent}</div>
                                                        <small class="text-muted">{prop.game_time}</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info-subtle text-info text-capitalize">
                                                        {prop.stat_type}
                                                    </span>
                                                </td>
                                                <td class="fw-medium">{formatNumber(prop.suggested_line)}</td>
                                                <td class="fw-bold text-primary">{formatNumber(prop.predicted_value)}</td>
                                                <td>
                                                    <span class="badge bg-{getConfidenceColor(prop.confidence)}-subtle text-{getConfidenceColor(prop.confidence)}">
                                                        {formatPercentage(prop.confidence)}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{getRecommendationColor(prop.recommendation)}-subtle text-{getRecommendationColor(prop.recommendation)} text-uppercase">
                                                        {prop.recommendation}
                                                    </span>
                                                </td>
                                                <td class="fw-medium {prop.expected_value > 0 ? 'text-success' : 'text-danger'}">
                                                    {prop.expected_value > 0 ? '+' : ''}{formatNumber(prop.expected_value)}%
                                                </td>
                                                <td>
                                                    <div class="small">
                                                        <div>Over: {formatPercentage(prop.probability_over)}</div>
                                                        <div>Under: {formatPercentage(prop.probability_under)}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="small">
                                                        <div>Recent: {formatNumber(prop.recent_form)}</div>
                                                        <div>Season: {formatNumber(prop.season_average)}</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{getMatchupDifficultyColor(prop.matchup_difficulty)}-subtle text-{getMatchupDifficultyColor(prop.matchup_difficulty)} text-capitalize">
                                                        {prop.matchup_difficulty}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{getBettingValueColor(prop.betting_value)}-subtle text-{getBettingValueColor(prop.betting_value)} text-capitalize">
                                                        {prop.betting_value}
                                                    </span>
                                                </td>
                                                <td>
                                                    <small class="text-muted" title={prop.reasoning}>
                                                        {prop.reasoning.length > 50
                                                            ? prop.reasoning.substring(0, 50) + '...'
                                                            : prop.reasoning
                                                        }
                                                    </small>
                                                </td>
                                            </tr>
                                        {/each}
                                    </tbody>
                                </table>
                            </div>
                        {/if}
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Stats -->
        {#if filteredProps.length > 0}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-bar text-info me-2"></i>Summary Statistics
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h4 class="text-primary">{filteredProps.length}</h4>
                                        <p class="text-muted mb-0">Total Props</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h4 class="text-success">
                                            {formatPercentage(filteredProps.reduce((sum, p) => sum + p.confidence, 0) / filteredProps.length)}
                                        </h4>
                                        <p class="text-muted mb-0">Avg Confidence</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h4 class="text-info">
                                            {filteredProps.filter(p => p.expected_value > 0).length}
                                        </h4>
                                        <p class="text-muted mb-0">Positive EV Props</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center">
                                        <h4 class="text-warning">
                                            {formatNumber(Math.max(...filteredProps.map(p => p.expected_value)))}%
                                        </h4>
                                        <p class="text-muted mb-0">Best Expected Value</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {/if}
    </div>
</DefaultLayout>
