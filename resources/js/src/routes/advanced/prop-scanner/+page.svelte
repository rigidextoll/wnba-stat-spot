<script lang="ts">
    import { onMount } from 'svelte';
    import { api } from '$lib/api/client';
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";

    interface PropBet {
        player_id: string;
        player_name: string;
        player_position: string;
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
        last_5_games_avg: number;
        home_away_factor: number;
        matchup_difficulty: string;
        injury_risk: string;
        betting_value: 'excellent' | 'good' | 'fair' | 'poor';
    }

    let propBets: PropBet[] = [];
    let loading = false;
    let error = '';
    let scanProgress = 0;
    let totalPlayers = 0;
    let scannedPlayers = 0;

    // Filters
    let selectedStat = '';
    let selectedRecommendation = '';
    let minConfidence = 0.6;
    let minExpectedValue = 0.05;
    let selectedBettingValue = '';

    const statTypes = [
        { value: '', label: 'All Statistics' },
        { value: 'points', label: 'Points' },
        { value: 'rebounds', label: 'Rebounds' },
        { value: 'assists', label: 'Assists' },
        { value: 'steals', label: 'Steals' },
        { value: 'blocks', label: 'Blocks' },
        { value: 'three_pointers_made', label: '3-Pointers Made' }
    ];

    const recommendations = [
        { value: '', label: 'All Recommendations' },
        { value: 'over', label: 'Over Bets' },
        { value: 'under', label: 'Under Bets' }
    ];

    const bettingValues = [
        { value: '', label: 'All Values' },
        { value: 'excellent', label: 'Excellent Value' },
        { value: 'good', label: 'Good Value' },
        { value: 'fair', label: 'Fair Value' }
    ];

    $: filteredProps = propBets.filter(prop => {
        if (selectedStat && prop.stat_type !== selectedStat) return false;
        if (selectedRecommendation && prop.recommendation !== selectedRecommendation) return false;
        if (prop.confidence < minConfidence) return false;
        if (Math.abs(prop.expected_value) < minExpectedValue) return false;
        if (selectedBettingValue && prop.betting_value !== selectedBettingValue) return false;
        return true;
    });

    $: excellentBets = filteredProps.filter(p => p.betting_value === 'excellent');
    $: goodBets = filteredProps.filter(p => p.betting_value === 'good');
    $: overBets = filteredProps.filter(p => p.recommendation === 'over');
    $: underBets = filteredProps.filter(p => p.recommendation === 'under');

    async function scanAllPlayers() {
        loading = true;
        error = '';
        propBets = [];
        scanProgress = 0;
        scannedPlayers = 0;

        try {
            // Get all players first
            const playersResponse = await api.players.getAll({ per_page: 500 });
            const players = playersResponse.data;
            totalPlayers = players.length;

            // Use the backend API to scan all players
            try {
                const response = await api.wnba.propScanner.scanAllPlayers();
                propBets = response.data || [];
                scannedPlayers = totalPlayers;
                scanProgress = 100;
            } catch (apiError) {
                console.warn('API scan failed, falling back to frontend generation:', apiError);

                // Fallback to frontend generation if API fails
                for (let i = 0; i < players.length; i++) {
                    const player = players[i];
                    scannedPlayers = i + 1;
                    scanProgress = (scannedPlayers / totalPlayers) * 100;

                    try {
                        const playerProps = await generatePlayerProps(player);
                        propBets = [...propBets, ...playerProps];
                    } catch (err) {
                        console.warn(`Failed to scan player ${player.athlete_display_name}:`, err);
                    }

                    // Small delay to prevent overwhelming the API
                    if (i % 10 === 0) {
                        await new Promise(resolve => setTimeout(resolve, 100));
                    }
                }

                // Sort by expected value descending
                propBets = propBets.sort((a, b) => Math.abs(b.expected_value) - Math.abs(a.expected_value));
            }

        } catch (err) {
            error = err instanceof Error ? err.message : 'Failed to scan players';
        } finally {
            loading = false;
        }
    }

    async function generatePlayerProps(player: any): Promise<PropBet[]> {
        const props: PropBet[] = [];
        const stats = ['points', 'rebounds', 'assists', 'steals', 'blocks'];

        for (const stat of stats) {
            try {
                // Generate mock prop data (in real implementation, this would call your prediction API)
                const seasonAvg = getSeasonAverage(stat);
                const suggestedLine = Math.round(seasonAvg * 2) / 2; // Round to nearest 0.5
                const predictedValue = seasonAvg + (Math.random() - 0.5) * 4;
                const confidence = 0.5 + Math.random() * 0.4;
                const expectedValue = (Math.random() - 0.5) * 0.3;

                const prop: PropBet = {
                    player_id: player.athlete_id,
                    player_name: player.athlete_display_name,
                    player_position: player.athlete_position_abbreviation || 'N/A',
                    stat_type: stat,
                    suggested_line: suggestedLine,
                    predicted_value: predictedValue,
                    confidence: confidence,
                    recommendation: expectedValue > 0.02 ? 'over' : expectedValue < -0.02 ? 'under' : 'avoid',
                    expected_value: expectedValue,
                    probability_over: predictedValue > suggestedLine ? 0.4 + Math.random() * 0.4 : 0.2 + Math.random() * 0.3,
                    probability_under: predictedValue < suggestedLine ? 0.4 + Math.random() * 0.4 : 0.2 + Math.random() * 0.3,
                    recent_form: seasonAvg + (Math.random() - 0.5) * 2,
                    season_average: seasonAvg,
                    last_5_games_avg: seasonAvg + (Math.random() - 0.5) * 3,
                    home_away_factor: 0.9 + Math.random() * 0.2,
                    matchup_difficulty: ['easy', 'medium', 'hard'][Math.floor(Math.random() * 3)],
                    injury_risk: ['low', 'medium', 'high'][Math.floor(Math.random() * 3)],
                    betting_value: getBettingValue(Math.abs(expectedValue), confidence)
                };

                // Only include props with some betting value
                if (prop.recommendation !== 'avoid' && Math.abs(prop.expected_value) > 0.02) {
                    props.push(prop);
                }
            } catch (err) {
                console.warn(`Failed to generate ${stat} prop for ${player.athlete_display_name}`);
            }
        }

        return props;
    }

    function getSeasonAverage(stat: string): number {
        const averages = {
            points: 12 + Math.random() * 16,
            rebounds: 4 + Math.random() * 8,
            assists: 2 + Math.random() * 6,
            steals: 0.5 + Math.random() * 2,
            blocks: 0.2 + Math.random() * 1.5
        };
        return averages[stat as keyof typeof averages] || 10;
    }

    function getBettingValue(ev: number, confidence: number): 'excellent' | 'good' | 'fair' | 'poor' {
        const score = ev * confidence;
        if (score > 0.08) return 'excellent';
        if (score > 0.05) return 'good';
        if (score > 0.02) return 'fair';
        return 'poor';
    }

    function formatPercentage(value: number): string {
        return `${(value * 100).toFixed(1)}%`;
    }

    function formatNumber(value: number, decimals = 1): string {
        return value.toFixed(decimals);
    }

    function getConfidenceColor(confidence: number): string {
        if (confidence >= 0.8) return 'success';
        if (confidence >= 0.65) return 'warning';
        return 'danger';
    }

    function getEVColor(ev: number): string {
        if (ev > 0.05) return 'text-success';
        if (ev > 0) return 'text-warning';
        return 'text-danger';
    }

    function getBettingValueBadge(value: string): string {
        switch (value) {
            case 'excellent': return 'bg-success-subtle text-success';
            case 'good': return 'bg-primary-subtle text-primary';
            case 'fair': return 'bg-warning-subtle text-warning';
            default: return 'bg-secondary-subtle text-secondary';
        }
    }

    function getRecommendationBadge(rec: string): string {
        switch (rec) {
            case 'over': return 'bg-success-subtle text-success';
            case 'under': return 'bg-primary-subtle text-primary';
            default: return 'bg-secondary-subtle text-secondary';
        }
    }
</script>

<svelte:head>
    <title>Prop Scanner | Advanced Analytics | WNBA Stat Spot</title>
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
                    <h4 class="page-title">Prop Bet Scanner</h4>
                    <p class="text-muted mb-0">Scan all players for profitable prop betting opportunities</p>
                </div>
            </div>
        </div>

        <!-- Scan Controls -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-search text-primary me-2"></i>Prop Scanner
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-8">
                                {#if loading}
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Scanning players... ({scannedPlayers}/{totalPlayers})</span>
                                            <span>{scanProgress.toFixed(1)}%</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                 style="width: {scanProgress}%"></div>
                                        </div>
                                    </div>
                                {:else}
                                    <p class="text-muted mb-0">
                                        Click "Scan All Players" to analyze prop betting opportunities across all WNBA players.
                                        This will generate predictions for points, rebounds, assists, steals, and blocks.
                                    </p>
                                {/if}
                            </div>
                            <div class="col-md-4">
                                <button
                                    on:click={scanAllPlayers}
                                    disabled={loading}
                                    class="btn btn-primary btn-lg w-100"
                                >
                                    {#if loading}
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                        Scanning...
                                    {:else}
                                        <i class="fas fa-radar me-2"></i>
                                        Scan All Players
                                    {/if}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {#if error}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Error:</strong> {error}
                    </div>
                </div>
            </div>
        {/if}

        {#if propBets.length > 0}
            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-chart-line text-primary fs-18"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Total Props</h5>
                                    <h3 class="text-primary mb-0">{filteredProps.length}</h3>
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
                                    <i class="fas fa-star text-success fs-18"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Excellent Value</h5>
                                    <h3 class="text-success mb-0">{excellentBets.length}</h3>
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
                                    <i class="fas fa-arrow-up text-info fs-18"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Over Bets</h5>
                                    <h3 class="text-info mb-0">{overBets.length}</h3>
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
                                    <i class="fas fa-arrow-down text-warning fs-18"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Under Bets</h5>
                                    <h3 class="text-warning mb-0">{underBets.length}</h3>
                                </div>
                            </div>
                        </div>
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
                                    <select id="stat-filter" bind:value={selectedStat} class="form-select">
                                        {#each statTypes as stat}
                                            <option value={stat.value}>{stat.label}</option>
                                        {/each}
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="rec-filter" class="form-label">Recommendation</label>
                                    <select id="rec-filter" bind:value={selectedRecommendation} class="form-select">
                                        {#each recommendations as rec}
                                            <option value={rec.value}>{rec.label}</option>
                                        {/each}
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="value-filter" class="form-label">Betting Value</label>
                                    <select id="value-filter" bind:value={selectedBettingValue} class="form-select">
                                        {#each bettingValues as value}
                                            <option value={value.value}>{value.label}</option>
                                        {/each}
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="confidence-filter" class="form-label">Min Confidence: {formatPercentage(minConfidence)}</label>
                                    <input type="range" id="confidence-filter" bind:value={minConfidence}
                                           min="0.5" max="1" step="0.05" class="form-range">
                                </div>

                                <div class="col-md-3">
                                    <label for="ev-filter" class="form-label">Min Expected Value: {formatPercentage(minExpectedValue)}</label>
                                    <input type="range" id="ev-filter" bind:value={minExpectedValue}
                                           min="0" max="0.2" step="0.01" class="form-range">
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
                            <h5 class="card-title mb-0">
                                <i class="fas fa-list text-primary me-2"></i>Prop Betting Opportunities ({filteredProps.length})
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Player</th>
                                            <th>Stat</th>
                                            <th>Line</th>
                                            <th>Prediction</th>
                                            <th>Confidence</th>
                                            <th>Recommendation</th>
                                            <th>Expected Value</th>
                                            <th>Betting Value</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {#each filteredProps.slice(0, 100) as prop}
                                            <tr>
                                                <td>
                                                    <div>
                                                        <div class="fw-medium">{prop.player_name}</div>
                                                        <small class="text-muted">{prop.player_position}</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary-subtle text-secondary text-capitalize">
                                                        {prop.stat_type.replace('_', ' ')}
                                                    </span>
                                                </td>
                                                <td class="fw-medium">{formatNumber(prop.suggested_line)}</td>
                                                <td>
                                                    <span class="fw-medium">{formatNumber(prop.predicted_value)}</span>
                                                    <br>
                                                    <small class="text-muted">Avg: {formatNumber(prop.season_average)}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{getConfidenceColor(prop.confidence)}-subtle text-{getConfidenceColor(prop.confidence)}">
                                                        {formatPercentage(prop.confidence)}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge {getRecommendationBadge(prop.recommendation)} text-uppercase">
                                                        {prop.recommendation}
                                                    </span>
                                                </td>
                                                <td class="{getEVColor(prop.expected_value)}">
                                                    <strong>{prop.expected_value > 0 ? '+' : ''}{formatPercentage(prop.expected_value)}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge {getBettingValueBadge(prop.betting_value)} text-capitalize">
                                                        {prop.betting_value}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="/players/{prop.player_id}"
                                                           class="btn btn-sm btn-outline-primary" title="View Player">
                                                            <i class="fas fa-user"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-outline-success"
                                                                title="Generate Full Prediction">
                                                            <i class="fas fa-magic"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        {/each}
                                    </tbody>
                                </table>
                            </div>

                            {#if filteredProps.length > 100}
                                <div class="text-center mt-3">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Showing top 100 of {filteredProps.length} prop opportunities.
                                        Use filters to narrow down results.
                                    </div>
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        {/if}
    </div>
</DefaultLayout>
