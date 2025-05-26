<script lang="ts">
    import { onMount } from 'svelte';
    import { api } from '$lib/api/client';
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";

    interface Player {
        id: number;
        athlete_id: string;
        athlete_display_name: string;
        athlete_short_name: string;
        athlete_jersey: string | null;
        athlete_headshot_href: string | null;
        athlete_position_name: string | null;
        athlete_position_abbreviation: string | null;
        created_at: string;
        updated_at: string;
    }

    let players: Player[] = [];
    let loading = true;
    let error: string | null = null;
    let searchTerm = '';

    $: filteredPlayers = players.filter(player =>
        player.athlete_display_name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        (player.athlete_position_name && player.athlete_position_name.toLowerCase().includes(searchTerm.toLowerCase()))
    );

    onMount(async () => {
        try {
            const response = await api.players.getAll();
            players = response.data;
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
                        <a href="/" class="btn btn-outline-primary">
                            ← Back to Dashboard
                        </a>
                    </div>
                    <h4 class="page-title">WNBA Players</h4>
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
                                placeholder="Search players by name or position..."
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
                            <p class="mt-2 mb-0">Loading players...</p>
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
                {#each filteredPlayers as player}
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-sm bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                        {#if player.athlete_headshot_href}
                                            <img src={player.athlete_headshot_href} alt={player.athlete_display_name} class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;" />
                                        {:else}
                                            <i class="fas fa-user text-success fs-18"></i>
                                        {/if}
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-1">{player.athlete_display_name}</h6>
                                        <p class="text-muted mb-0 small">{player.athlete_short_name}</p>
                                    </div>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <div class="text-center p-2 bg-light rounded">
                                            <small class="text-muted d-block">Position</small>
                                            <span class="fw-semibold">{player.athlete_position_abbreviation || 'N/A'}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center p-2 bg-light rounded">
                                            <small class="text-muted d-block">Jersey</small>
                                            <span class="fw-semibold">#{player.athlete_jersey || 'N/A'}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="/players/{player.athlete_id}" class="btn btn-success btn-sm me-2">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                {/each}
            </div>

            {#if filteredPlayers.length === 0 && searchTerm}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="avatar-lg bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                    <i class="fas fa-search text-muted fs-24"></i>
                                </div>
                                <h5 class="mb-2">No Players Found</h5>
                                <p class="text-muted mb-0">No players match your search criteria.</p>
                            </div>
                        </div>
                    </div>
                </div>
            {:else if players.length === 0}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="avatar-lg bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                    <i class="fas fa-users text-muted fs-24"></i>
                                </div>
                                <h5 class="mb-2">No Players Found</h5>
                                <p class="text-muted mb-0">There are currently no players in the database.</p>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}
        {/if}
    </div>
</DefaultLayout>
