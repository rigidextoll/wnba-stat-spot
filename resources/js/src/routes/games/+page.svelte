<script lang="ts">
    import { onMount } from 'svelte';
    import { api } from '$lib/api/client';
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";

    interface Game {
        id: number;
        game_id: string;
        season: string;
        season_type: string;
        game_date: string;
        game_date_time: string;
        venue_name: string | null;
        venue_city: string | null;
        venue_state: string | null;
        status_name: string | null;
        created_at: string;
        updated_at: string;
    }

    let games: Game[] = [];
    let loading = true;
    let error: string | null = null;
    let searchTerm = '';

    $: filteredGames = games.filter(game =>
        (game.venue_name && game.venue_name.toLowerCase().includes(searchTerm.toLowerCase())) ||
        (game.venue_city && game.venue_city.toLowerCase().includes(searchTerm.toLowerCase())) ||
        game.season.toLowerCase().includes(searchTerm.toLowerCase())
    );

    onMount(async () => {
        try {
            const response = await api.games.getAll();
            games = response.data;
        } catch (e) {
            error = e instanceof Error ? e.message : 'An error occurred';
        } finally {
            loading = false;
        }
    });

    function formatDate(dateString: string): string {
        return new Date(dateString).toLocaleDateString('en-US', {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }

    function formatTime(dateTimeString: string): string {
        return new Date(dateTimeString).toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });
    }
</script>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="/" class="btn btn-outline-primary">
                            ← Back to Dashboard
                        </a>
                    </div>
                    <h4 class="page-title">WNBA Games</h4>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search games by venue, city, or season..."
                                bind:value={searchTerm}
                            />
                        </div>
                    </div>
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
                            <p class="mt-2 mb-0">Loading games...</p>
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
        {:else}
            <div class="row">
                {#each filteredGames as game}
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-sm bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="fas fa-basketball text-warning fs-18"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-1">Game #{game.game_id}</h6>
                                        <p class="text-muted mb-0 small">{game.season} {game.season_type}</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <div class="text-center p-2 bg-light rounded">
                                                <small class="text-muted d-block">Date & Time</small>
                                                <span class="fw-semibold">{formatDate(game.game_date)}</span>
                                                <br>
                                                <small class="text-muted">{formatTime(game.game_date_time)}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {#if game.venue_name}
                                    <div class="mb-3">
                                        <div class="row g-2">
                                            <div class="col-12">
                                                <div class="text-center p-2 bg-light rounded">
                                                    <small class="text-muted d-block">Venue</small>
                                                    <span class="fw-semibold">{game.venue_name}</span>
                                                    {#if game.venue_city && game.venue_state}
                                                        <br>
                                                        <small class="text-muted">{game.venue_city}, {game.venue_state}</small>
                                                    {/if}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {/if}

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <div class="text-center p-2 bg-light rounded">
                                            <small class="text-muted d-block">Season</small>
                                            <span class="fw-semibold">{game.season}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center p-2 bg-light rounded">
                                            <small class="text-muted d-block">Status</small>
                                            <span class="fw-semibold">{game.status_name || 'TBD'}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-warning btn-sm me-2">
                                        View Details
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm">
                                        Box Score
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                {/each}
            </div>

            {#if filteredGames.length === 0 && searchTerm}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="avatar-lg bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                    <i class="fas fa-search text-muted fs-24"></i>
                                </div>
                                <h5 class="mb-2">No Games Found</h5>
                                <p class="text-muted mb-0">No games match your search criteria.</p>
                            </div>
                        </div>
                    </div>
                </div>
            {:else if games.length === 0}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="avatar-lg bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                    <i class="fas fa-basketball text-muted fs-24"></i>
                                </div>
                                <h5 class="mb-2">No Games Found</h5>
                                <p class="text-muted mb-0">There are currently no games in the database.</p>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}
        {/if}
    </div>
</DefaultLayout>
