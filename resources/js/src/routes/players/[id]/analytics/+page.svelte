<script lang="ts">
    import { onMount } from 'svelte';
    import { page } from '$app/stores';
    import { api } from '$lib/api/client';
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import type { Player, PlayerAnalytics } from '$lib/api/client';

    let player: Player | null = null;
    let analytics: PlayerAnalytics | null = null;
    let loading = true;
    let error = '';

    $: playerId = $page.params.id;

    onMount(async () => {
        if (!playerId) return;

        try {
            const [playerResponse, analyticsResponse] = await Promise.all([
                api.players.getById(playerId),
                api.wnba.analytics.getPlayer(playerId)
            ]);

            player = playerResponse.data;
            analytics = analyticsResponse.data;
        } catch (err) {
            error = err instanceof Error ? err.message : 'Failed to load player analytics';
        } finally {
            loading = false;
        }
    });

    function formatNumber(value: number): string {
        return value.toFixed(1);
    }
</script>

<svelte:head>
    <title>{player?.athlete_display_name || 'Player'} Analytics | WNBA Stat Spot</title>
</svelte:head>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="/players/{playerId}" class="btn btn-outline-primary">
                            ← Back to Player
                        </a>
                    </div>
                    <h4 class="page-title">Player Analytics</h4>
                </div>
            </div>
        </div>

        {#if loading}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 mb-0">Loading player analytics...</p>
                        </div>
                    </div>
                </div>
            </div>
        {:else if error}
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <strong>Error:</strong> {error}
                    </div>
                </div>
            </div>
        {:else if player && analytics}
            <!-- Player Info Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center">
                                        {#if player.athlete_headshot_href}
                                            <img src={player.athlete_headshot_href} alt={player.athlete_display_name} class="rounded-circle" style="width: 64px; height: 64px; object-fit: cover;" />
                                        {:else}
                                            <i class="fas fa-user text-primary fs-24"></i>
                                        {/if}
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="mb-1">{player.athlete_display_name}</h3>
                                    <p class="text-muted mb-2">Advanced Analytics</p>
                                    <div class="row g-3">
                                        <div class="col-auto">
                                            <span class="badge bg-primary">#{player.athlete_jersey || 'N/A'}</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-secondary">{player.athlete_position_name || 'Position N/A'}</span>
                                        </div>
                                        {#if analytics.analytics.recent_form}
                                            <div class="col-auto">
                                                <span class="badge bg-info">{analytics.analytics.recent_form.games_analyzed} Games Analyzed</span>
                                            </div>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Form Averages -->
            {#if analytics.analytics.recent_form}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Form ({analytics.analytics.recent_form.games_analyzed} games)</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    {#each Object.entries(analytics.analytics.recent_form.averages) as [stat, value]}
                                        <div class="col-md-2 col-6">
                                            <div class="text-center p-3 bg-light rounded">
                                                <h4 class="mb-1 text-primary">{formatNumber(value)}</h4>
                                                <small class="text-muted">{stat.replace('_', ' ').toUpperCase()}</small>
                                            </div>
                                        </div>
                                    {/each}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}

            <!-- Per 36 Stats -->
            {#if analytics.analytics.per_36_stats}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Per 36 Minutes Statistics</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    {#each Object.entries(analytics.analytics.per_36_stats) as [stat, value]}
                                        {#if (stat === 'per_36_stats' || stat === 'efficiency_metrics') && value !== null && typeof value === 'object'}
                                            {#each Object.entries(value) as [stat, val]}
                                                <div class="col-md-2 col-6">
                                                    <div class="text-center p-3 bg-light rounded">
                                                        <h4 class="mb-1 text-success">{typeof val === 'number' ? formatNumber(val) : val}</h4>
                                                        <small class="text-muted">{stat.replace('_', ' ').toUpperCase()}</small>
                                                    </div>
                                                </div>
                                            {/each}
                                        {:else}
                                            <div class="col-md-2 col-6">
                                                <div class="text-center p-3 bg-light rounded">
                                                    <h4 class="mb-1 text-success">{typeof value === 'number' ? formatNumber(value) : value}</h4>
                                                    <small class="text-muted">{stat.replace('_', ' ').toUpperCase()}</small>
                                                </div>
                                            </div>
                                        {/if}
                                    {/each}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}

            <!-- Advanced Metrics -->
            {#if analytics.analytics.advanced_metrics}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Advanced Metrics</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Metric</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {#each Object.entries(analytics.analytics.advanced_metrics) as [stat, value]}
                                                <tr>
                                                    <td class="fw-medium">{stat.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}</td>
                                                    <td><strong>{typeof value === 'number' ? formatNumber(value) : value}</strong></td>
                                                </tr>
                                            {/each}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}

            <!-- Shooting Efficiency -->
            {#if analytics.analytics.shooting_efficiency}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Shooting Efficiency</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    {#each Object.entries(analytics.analytics.shooting_efficiency) as [stat, value]}
                                        <div class="col-md-3 col-6">
                                            <div class="text-center p-3 bg-light rounded">
                                                <h4 class="mb-1 text-warning">{typeof value === 'number' ? formatNumber(value) : value}</h4>
                                                <small class="text-muted">{stat.replace('_', ' ').toUpperCase()}</small>
                                            </div>
                                        </div>
                                    {/each}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}

            <!-- Home vs Away Performance -->
            {#if analytics.analytics.home_away_performance}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Home vs Away Performance</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    {#each Object.entries(analytics.analytics.home_away_performance) as [category, stats]}
                                        <div class="col-md-6">
                                            <div class="border rounded p-3">
                                                <h6 class="mb-3 text-primary">{category.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}</h6>
                                                {#if typeof stats === 'object' && stats !== null}
                                                    <div class="table-responsive">
                                                        <table class="table table-sm">
                                                            <tbody>
                                                                {#each Object.entries(stats) as [stat, value]}
                                                                    <tr>
                                                                        <td class="border-0">{stat.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}</td>
                                                                        <td class="border-0 text-end"><strong>{typeof value === 'number' ? formatNumber(value) : value}</strong></td>
                                                                    </tr>
                                                                {/each}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                {/if}
                                            </div>
                                        </div>
                                    {/each}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}

            <!-- Recent Games Log -->
            {#if analytics.analytics.recent_form?.game_log}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Games Log</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Opponent</th>
                                                <th>MIN</th>
                                                <th>PTS</th>
                                                <th>REB</th>
                                                <th>AST</th>
                                                <th>STL</th>
                                                <th>BLK</th>
                                                <th>TO</th>
                                                <th>FG</th>
                                                <th>3PT</th>
                                                <th>FT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {#each analytics.analytics.recent_form.game_log as game}
                                                <tr>
                                                    <td><small>{new Date(game.date).toLocaleDateString()}</small></td>
                                                    <td><small>{game.opponent}</small></td>
                                                    <td><small>{game.minutes}</small></td>
                                                    <td><strong>{game.points}</strong></td>
                                                    <td>{game.rebounds}</td>
                                                    <td>{game.assists}</td>
                                                    <td>{game.steals}</td>
                                                    <td>{game.blocks}</td>
                                                    <td>{game.turnovers}</td>
                                                    <td><small>{game.fg_made_attempted}</small></td>
                                                    <td><small>{game.three_pt_made_attempted}</small></td>
                                                    <td><small>{game.ft_made_attempted}</small></td>
                                                </tr>
                                            {/each}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}
        {:else}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <div class="avatar-lg bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                <i class="fas fa-user-slash text-muted fs-24"></i>
                            </div>
                            <h5 class="mb-2">Player Not Found</h5>
                            <p class="text-muted mb-0">The requested player analytics could not be loaded.</p>
                        </div>
                    </div>
                </div>
            </div>
        {/if}
    </div>
</DefaultLayout>
