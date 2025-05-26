<script lang="ts">
    import { onMount } from 'svelte';
    import { api } from '$lib/api/client';
    import AdminLayout from '$lib/layouts/AdminLayout.svelte';

    interface Team {
        name: string;
        // Add other team properties as needed
    }

    let teams: Team[] = [];
    let loading = true;
    let error: string | null = null;

    onMount(async () => {
        try {
            const response = await api.teams.getAll();
            teams = response.data;
        } catch (e) {
            error = e instanceof Error ? e.message : 'An error occurred';
        } finally {
            loading = false;
        }
    });
</script>

<AdminLayout>
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">WNBA Teams</h1>
            <p class="mt-2 text-gray-600">View all WNBA teams and their statistics</p>
        </div>

        {#if loading}
            <div class="flex items-center justify-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-orange-600"></div>
                <span class="ml-3 text-gray-600">Loading teams...</span>
            </div>
        {:else if error}
            <div class="bg-red-50 border border-red-200 rounded-md p-4">
                <div class="flex">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Error loading teams</h3>
                        <p class="mt-1 text-sm text-red-700">{error}</p>
                    </div>
                </div>
            </div>
        {:else}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {#each teams as team}
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-semibold text-gray-900">{team.name}</h3>
                                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span>Location:</span>
                                    <span class="font-medium">{team.city}, {team.state}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Conference:</span>
                                    <span class="font-medium capitalize">{team.conference}</span>
                                </div>
                                {#if team.abbreviation}
                                    <div class="flex justify-between">
                                        <span>Abbreviation:</span>
                                        <span class="font-medium">{team.abbreviation}</span>
                                    </div>
                                {/if}
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <button class="w-full bg-orange-600 text-white py-2 px-4 rounded-md hover:bg-orange-700 transition-colors duration-200 text-sm font-medium">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                {/each}
            </div>

            {#if teams.length === 0}
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No teams found</h3>
                    <p class="mt-1 text-sm text-gray-500">No WNBA teams are currently available.</p>
                </div>
            {/if}
        {/if}
    </div>
</AdminLayout>
