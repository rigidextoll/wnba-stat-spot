<script lang="ts">
    import { onMount } from 'svelte';
    import { page } from '$app/stores';
    import DefaultLayout from '$lib/layouts/DefaultLayout.svelte';
    import PlayerComparison from '$lib/components/PlayerComparison.svelte';

    let playerIds: number[] = [];

    onMount(() => {
        // Parse player IDs from URL query parameters
        const urlParams = new URLSearchParams(window.location.search);
        const playersParam = urlParams.get('players');
        
        if (playersParam) {
            playerIds = playersParam.split(',')
                .map(id => parseInt(id.trim()))
                .filter(id => !isNaN(id));
        }
    });
</script>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/players">Players</a></li>
                            <li class="breadcrumb-item active">Compare</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Player Comparison</h4>
                </div>
            </div>
        </div>

        <PlayerComparison {playerIds} maxPlayers={3} />
    </div>
</DefaultLayout>