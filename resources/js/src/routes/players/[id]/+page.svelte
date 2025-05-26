<script lang="ts">
    import { onMount } from 'svelte';
    import { page } from '$app/stores';
    import { api } from '$lib/api/client';
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";

    interface PlayerGame {
        id: number;
        game_id: number;
        minutes: string | null;
        field_goals_made: number;
        field_goals_attempted: number;
        three_point_field_goals_made: number;
        three_point_field_goals_attempted: number;
        free_throws_made: number;
        free_throws_attempted: number;
        rebounds: number;
        assists: number;
        steals: number;
        blocks: number;
        turnovers: number;
        fouls: number;
        points: number;
        starter: boolean;
        did_not_play: boolean;
        team?: {
            team_display_name: string;
            team_abbreviation: string;
            team_logo: string;
        };
        game?: {
            game_date: string;
            season: string;
        };
    }

    interface Player {
        id: number;
        athlete_id: string;
        athlete_display_name: string;
        athlete_short_name: string;
        athlete_jersey: string | null;
        athlete_headshot_href: string | null;
        athlete_position_name: string | null;
        athlete_position_abbreviation: string | null;
        player_games?: PlayerGame[];
    }

    let player: Player | null = null;
    let loading = true;
    let error: string | null = null;
    let playerId: string;

    $: playerId = $page.params.id;

    // Calculate averages
    $: gameStats = player?.player_games?.filter(game => !game.did_not_play) || [];
    $: averages = gameStats.length > 0 ? {
        points: (gameStats.reduce((sum, game) => sum + game.points, 0) / gameStats.length).toFixed(1),
        rebounds: (gameStats.reduce((sum, game) => sum + game.rebounds, 0) / gameStats.length).toFixed(1),
        assists: (gameStats.reduce((sum, game) => sum + game.assists, 0) / gameStats.length).toFixed(1),
        steals: (gameStats.reduce((sum, game) => sum + game.steals, 0) / gameStats.length).toFixed(1),
        blocks: (gameStats.reduce((sum, game) => sum + game.blocks, 0) / gameStats.length).toFixed(1),
        fg_percentage: gameStats.reduce((sum, game) => sum + game.field_goals_attempted, 0) > 0
            ? ((gameStats.reduce((sum, game) => sum + game.field_goals_made, 0) / gameStats.reduce((sum, game) => sum + game.field_goals_attempted, 0)) * 100).toFixed(1)
            : '0.0'
    } : null;

    onMount(async () => {
        try {
            const response = await api.players.getById(playerId);
            player = response.data;
        } catch (e) {
            error = e instanceof Error ? e.message : 'An error occurred';
        } finally {
            loading = false;
        }
    });
</script>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="/players" class="btn btn-outline-primary">
                            ← Back to Players
                        </a>
                    </div>
                    <h4 class="page-title">Player Details</h4>
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
                            <p class="mt-2 mb-0">Loading player details...</p>
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
        {:else if player}
            <!-- Player Info Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center">
                                        {#if player.athlete_headshot_href}
                                            <img src={player.athlete_headshot_href} alt={player.athlete_display_name} class="rounded-circle" style="width: 64px; height: 64px; object-fit: cover;" />
                                        {:else}
                                            <i class="fas fa-user text-success fs-24"></i>
                                        {/if}
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="mb-1">{player.athlete_display_name}</h3>
                                    <p class="text-muted mb-2">{player.athlete_short_name}</p>
                                    <div class="row g-3">
                                        <div class="col-auto">
                                            <span class="badge bg-primary">#{player.athlete_jersey || 'N/A'}</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-secondary">{player.athlete_position_name || 'Position N/A'}</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-info">{gameStats.length} Games Played</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Season Averages -->
            {#if averages}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Season Averages</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-2 col-6">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h4 class="mb-1 text-primary">{averages.points}</h4>
                                            <small class="text-muted">PPG</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h4 class="mb-1 text-success">{averages.rebounds}</h4>
                                            <small class="text-muted">RPG</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h4 class="mb-1 text-info">{averages.assists}</h4>
                                            <small class="text-muted">APG</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h4 class="mb-1 text-warning">{averages.steals}</h4>
                                            <small class="text-muted">SPG</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h4 class="mb-1 text-danger">{averages.blocks}</h4>
                                            <small class="text-muted">BPG</small>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6">
                                        <div class="text-center p-3 bg-light rounded">
                                            <h4 class="mb-1 text-secondary">{averages.fg_percentage}%</h4>
                                            <small class="text-muted">FG%</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}

            <!-- Game Log -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Game Log</h5>
                        </div>
                        <div class="card-body">
                            {#if gameStats.length > 0}
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Team</th>
                                                <th>MIN</th>
                                                <th>PTS</th>
                                                <th>REB</th>
                                                <th>AST</th>
                                                <th>STL</th>
                                                <th>BLK</th>
                                                <th>FG</th>
                                                <th>3PT</th>
                                                <th>FT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {#each gameStats.slice(0, 20) as game}
                                                <tr>
                                                    <td>
                                                        <small>{new Date(game.game?.game_date || '').toLocaleDateString()}</small>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            {#if game.team?.team_logo}
                                                                <img src={game.team.team_logo} alt={game.team.team_abbreviation} style="width: 20px; height: 20px; object-fit: contain;" class="me-2" />
                                                            {/if}
                                                            <small>{game.team?.team_abbreviation || 'N/A'}</small>
                                                        </div>
                                                    </td>
                                                    <td><small>{game.minutes || '0:00'}</small></td>
                                                    <td><strong>{game.points}</strong></td>
                                                    <td>{game.rebounds}</td>
                                                    <td>{game.assists}</td>
                                                    <td>{game.steals}</td>
                                                    <td>{game.blocks}</td>
                                                    <td><small>{game.field_goals_made}/{game.field_goals_attempted}</small></td>
                                                    <td><small>{game.three_point_field_goals_made}/{game.three_point_field_goals_attempted}</small></td>
                                                    <td><small>{game.free_throws_made}/{game.free_throws_attempted}</small></td>
                                                </tr>
                                            {/each}
                                        </tbody>
                                    </table>
                                </div>
                            {:else}
                                <div class="text-center py-4">
                                    <div class="avatar-lg bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <i class="fas fa-chart-bar text-muted fs-24"></i>
                                    </div>
                                    <h5 class="mb-2">No Game Stats</h5>
                                    <p class="text-muted mb-0">This player has no recorded game statistics.</p>
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        {/if}
    </div>
</DefaultLayout>
