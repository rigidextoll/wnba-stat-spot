<script lang="ts">
    import { onMount } from 'svelte';
    import { page } from '$app/stores';
    import { api } from '$lib/api/client';
    import type { Player, Team, TeamPlayersResponse } from '$lib/api/client';
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";

    let players: Player[] = [];
    let team: Team | null = null;
    let loading = true;
    let error: string | null = null;
    let searchTerm = '';
    let selectedPosition = '';
    let sortBy = 'athlete_display_name';
    let sortOrder: 'asc' | 'desc' = 'asc';

    // Get team ID from URL params
    $: teamId = $page.params.id;

    const positions = ['G', 'F', 'C', 'PG', 'SG', 'SF', 'PF'];

    $: filteredPlayers = players.filter(player => {
        const matchesSearch = !searchTerm ||
            player.athlete_display_name.toLowerCase().includes(searchTerm.toLowerCase()) ||
            (player.athlete_jersey && player.athlete_jersey.includes(searchTerm));

        const matchesPosition = !selectedPosition ||
            player.athlete_position_abbreviation === selectedPosition;

        return matchesSearch && matchesPosition;
    });

    $: sortedPlayers = [...filteredPlayers].sort((a, b) => {
        let aValue: any, bValue: any;

        switch (sortBy) {
            case 'athlete_display_name':
                aValue = a.athlete_display_name;
                bValue = b.athlete_display_name;
                break;
            case 'athlete_jersey':
                aValue = parseInt(a.athlete_jersey || '999');
                bValue = parseInt(b.athlete_jersey || '999');
                break;
            case 'athlete_position_abbreviation':
                aValue = a.athlete_position_abbreviation || 'ZZ';
                bValue = b.athlete_position_abbreviation || 'ZZ';
                break;
            default:
                aValue = a.athlete_display_name;
                bValue = b.athlete_display_name;
        }

        if (typeof aValue === 'string' && typeof bValue === 'string') {
            return sortOrder === 'asc'
                ? aValue.localeCompare(bValue)
                : bValue.localeCompare(aValue);
        } else {
            return sortOrder === 'asc'
                ? aValue - bValue
                : bValue - aValue;
        }
    });

    onMount(async () => {
        await loadTeamAndPlayers();
    });

    async function loadTeamAndPlayers() {
        try {
            loading = true;
            error = null;

            // Load team info and players using the dedicated endpoint
            const teamPlayersResponse = await api.teams.getPlayers(teamId);
            players = teamPlayersResponse.data;
            team = teamPlayersResponse.meta.team;

            if (!team) {
                error = 'Team not found';
                return;
            }

        } catch (e) {
            error = e instanceof Error ? e.message : 'An error occurred';
        } finally {
            loading = false;
        }
    }

    function handleSort(column: string) {
        if (sortBy === column) {
            sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            sortBy = column;
            sortOrder = 'asc';
        }
    }

    function getSortIcon(column: string) {
        if (sortBy !== column) return 'fas fa-sort text-muted';
        return sortOrder === 'asc' ? 'fas fa-sort-up text-primary' : 'fas fa-sort-down text-primary';
    }

    function hideImage(e: Event) {
        const img = e.target as HTMLImageElement;
        img.style.display = 'none';
    }
</script>

<svelte:head>
    <title>{team?.team_display_name || 'Team'} Players | WNBA Stat Spot</title>
</svelte:head>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="/teams" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Teams
                        </a>
                    </div>
                    <h4 class="page-title">
                        {#if team}
                            <div class="d-flex align-items-center">
                                {#if team.team_logo}
                                    <img src={team.team_logo} alt={team.team_abbreviation} class="avatar-sm rounded me-3" on:error={hideImage} />
                                {/if}
                                {team.team_display_name} Players
                            </div>
                        {:else}
                            Team Players
                        {/if}
                    </h4>
                    <p class="text-muted mb-0">Complete roster and player information</p>
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
                            <p class="mt-2 mb-0">Loading team players...</p>
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
        {:else}
            <!-- Team Summary Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="fas fa-users text-primary fs-18"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Total Players</h5>
                                    <h3 class="text-primary mb-0">{players.length}</h3>
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
                                    <i class="fas fa-filter text-success fs-18"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Filtered</h5>
                                    <h3 class="text-success mb-0">{filteredPlayers.length}</h3>
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
                                    <i class="fas fa-basketball-ball text-info fs-18"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Positions</h5>
                                    <h3 class="text-info mb-0">{new Set(players.map(p => p.athlete_position_abbreviation).filter(Boolean)).size}</h3>
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
                                    <i class="fas fa-trophy text-warning fs-18"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">Team</h5>
                                    <h3 class="text-warning mb-0">{team?.team_abbreviation || 'N/A'}</h3>
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
                                <i class="fas fa-filter text-primary me-2"></i>Filters & Search
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="search-input" class="form-label">Search Players</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input
                                            id="search-input"
                                            type="text"
                                            class="form-control"
                                            placeholder="Search by name or jersey number..."
                                            bind:value={searchTerm}
                                        />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="position-select" class="form-label">Position</label>
                                    <select
                                        id="position-select"
                                        bind:value={selectedPosition}
                                        class="form-select"
                                    >
                                        <option value="">All Positions</option>
                                        {#each positions as position}
                                            <option value={position}>{position}</option>
                                        {/each}
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Sort By</label>
                                    <select bind:value={sortBy} class="form-select">
                                        <option value="athlete_display_name">Name</option>
                                        <option value="athlete_jersey">Jersey Number</option>
                                        <option value="athlete_position_abbreviation">Position</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Players Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users text-primary me-2"></i>
                                {team?.team_display_name || 'Team'} Roster ({sortedPlayers.length} players)
                            </h5>
                        </div>
                        <div class="card-body">
                            {#if sortedPlayers.length > 0}
                                <div class="table-responsive">
                                    <table class="table table-hover table-nowrap mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>
                                                    <button
                                                        class="btn btn-link p-0 text-decoration-none fw-semibold"
                                                        on:click={() => handleSort('athlete_display_name')}
                                                    >
                                                        Player <i class="{getSortIcon('athlete_display_name')} ms-1"></i>
                                                    </button>
                                                </th>
                                                <th>
                                                    <button
                                                        class="btn btn-link p-0 text-decoration-none fw-semibold"
                                                        on:click={() => handleSort('athlete_jersey')}
                                                    >
                                                        Jersey <i class="{getSortIcon('athlete_jersey')} ms-1"></i>
                                                    </button>
                                                </th>
                                                <th>
                                                    <button
                                                        class="btn btn-link p-0 text-decoration-none fw-semibold"
                                                        on:click={() => handleSort('athlete_position_abbreviation')}
                                                    >
                                                        Position <i class="{getSortIcon('athlete_position_abbreviation')} ms-1"></i>
                                                    </button>
                                                </th>
                                                <th>Height</th>
                                                <th>Weight</th>
                                                <th>Experience</th>
                                                <th>College</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {#each sortedPlayers as player}
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            {#if player.athlete_headshot_href}
                                                                <img
                                                                    src={player.athlete_headshot_href}
                                                                    alt={player.athlete_display_name}
                                                                    class="avatar-sm rounded-circle me-3"
                                                                    on:error={hideImage}
                                                                />
                                                            {:else}
                                                                <div class="avatar-sm bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                                                    <i class="fas fa-user text-secondary"></i>
                                                                </div>
                                                            {/if}
                                                            <div>
                                                                <h6 class="mb-0 fw-medium">{player.athlete_display_name}</h6>
                                                                <small class="text-muted">{player.athlete_short_name || 'N/A'}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary-subtle text-primary fw-medium">
                                                            #{player.athlete_jersey || 'N/A'}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info-subtle text-info">
                                                            {player.athlete_position_abbreviation || 'N/A'}
                                                        </span>
                                                        {#if player.athlete_position_name}
                                                            <br><small class="text-muted">{player.athlete_position_name}</small>
                                                        {/if}
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">{player.athlete_height || 'N/A'}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">{player.athlete_weight ? `${player.athlete_weight} lbs` : 'N/A'}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">{player.athlete_experience || 'N/A'}</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">{player.athlete_college || 'N/A'}</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a
                                                                href="/players/{player.athlete_id}"
                                                                class="btn btn-sm btn-outline-primary"
                                                                title="View Player Details"
                                                            >
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a
                                                                href="/players/{player.athlete_id}/data"
                                                                class="btn btn-sm btn-outline-info"
                                                                title="View Player Data"
                                                            >
                                                                <i class="fas fa-database"></i>
                                                            </a>
                                                            <button
                                                                on:click={() => window.open(`/advanced/prop-scanner?player=${player.athlete_id}`, '_blank')}
                                                                class="btn btn-sm btn-outline-success"
                                                                title="Generate Predictions"
                                                            >
                                                                <i class="fas fa-crystal-ball"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            {/each}
                                        </tbody>
                                    </table>
                                </div>
                            {:else}
                                <div class="text-center py-5">
                                    <i class="fas fa-search text-muted fs-48 mb-3"></i>
                                    <h5 class="text-muted">No players found</h5>
                                    <p class="text-muted mb-0">
                                        {#if searchTerm || selectedPosition}
                                            Try adjusting your search criteria or filters
                                        {:else}
                                            No players are currently assigned to this team
                                        {/if}
                                    </p>
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        {/if}
    </div>
</DefaultLayout>

<style>
    .btn-link:hover {
        text-decoration: none !important;
    }

    .table th button {
        color: inherit;
    }

    .table th button:hover {
        color: var(--bs-primary);
    }
</style>
