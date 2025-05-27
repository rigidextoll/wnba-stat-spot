<script lang="ts">
    import { onMount } from 'svelte';
    import { api } from '$lib/api/client';
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";

    let connectionResults: any[] = [];
    let testing = false;
    let healthResult: any = null;

    async function testConnections() {
        testing = true;
        try {
            connectionResults = await api.test.connection();
        } catch (error) {
            console.error('Connection test failed:', error);
        } finally {
            testing = false;
        }
    }

    async function testHealth() {
        try {
            healthResult = await api.health.check();
        } catch (error) {
            healthResult = { error: error instanceof Error ? error.message : 'Unknown error' };
        }
    }

    onMount(() => {
        testConnections();
    });
</script>

<svelte:head>
    <title>API Debug | WNBA Stat Spot</title>
</svelte:head>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">API Connection Debug</h4>
                    <p class="text-muted mb-0">Test API connections to diagnose Docker networking issues</p>
                </div>
            </div>
        </div>

        <!-- Connection Test Results -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-network-wired text-primary me-2"></i>Connection Tests
                            </h5>
                            <button
                                on:click={testConnections}
                                class="btn btn-primary btn-sm"
                                disabled={testing}
                            >
                                {#if testing}
                                    <span class="spinner-border spinner-border-sm me-2"></span>
                                    Testing...
                                {:else}
                                    <i class="fas fa-sync me-2"></i>
                                    Retest
                                {/if}
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {#if testing}
                            <div class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Testing connections...</span>
                                </div>
                                <p class="mt-2 mb-0">Testing all connection options...</p>
                            </div>
                        {:else if connectionResults.length > 0}
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Connection Type</th>
                                            <th>URL</th>
                                            <th>Status</th>
                                            <th>Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {#each connectionResults as result}
                                            <tr>
                                                <td>
                                                    <span class="fw-medium">{result.name}</span>
                                                </td>
                                                <td>
                                                    <code class="text-muted">{result.url}/health</code>
                                                </td>
                                                <td>
                                                    {#if result.ok}
                                                        <span class="badge bg-success-subtle text-success">
                                                            <i class="fas fa-check me-1"></i>
                                                            {result.status}
                                                        </span>
                                                    {:else}
                                                        <span class="badge bg-danger-subtle text-danger">
                                                            <i class="fas fa-times me-1"></i>
                                                            {result.status || 'Failed'}
                                                        </span>
                                                    {/if}
                                                </td>
                                                <td>
                                                    {#if result.data}
                                                        <span class="text-success">
                                                            <i class="fas fa-check-circle me-1"></i>
                                                            {result.data.message || 'OK'}
                                                        </span>
                                                    {:else if result.error}
                                                        <span class="text-danger small">
                                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                                            {result.error}
                                                        </span>
                                                    {:else}
                                                        <span class="text-muted">No response</span>
                                                    {/if}
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

        <!-- Health Check Test -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-heartbeat text-primary me-2"></i>Health Check Test
                            </h5>
                            <button
                                on:click={testHealth}
                                class="btn btn-success btn-sm"
                            >
                                <i class="fas fa-play me-2"></i>
                                Test Health Endpoint
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {#if healthResult}
                            {#if healthResult.error}
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Health Check Failed:</strong> {healthResult.error}
                                </div>
                            {:else}
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <strong>Health Check Passed:</strong> {healthResult.message}
                                    <br>
                                    <small class="text-muted">Status: {healthResult.status} | Time: {healthResult.timestamp}</small>
                                </div>
                            {/if}
                        {:else}
                            <p class="text-muted mb-0">Click "Test Health Endpoint" to check API connectivity</p>
                        {/if}
                    </div>
                </div>
            </div>
        </div>

        <!-- Docker Troubleshooting Guide -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fab fa-docker text-primary me-2"></i>Docker Troubleshooting Guide
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Common Issues:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-circle text-danger me-2" style="font-size: 8px;"></i>
                                        <strong>ERR_INTERNET_DISCONNECTED:</strong> Container networking issue
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-circle text-warning me-2" style="font-size: 8px;"></i>
                                        <strong>Connection refused:</strong> Backend container not running
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-circle text-info me-2" style="font-size: 8px;"></i>
                                        <strong>404 Not Found:</strong> Wrong port or service name
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Solutions to Try:</h6>
                                <ol class="list-unstyled">
                                    <li class="mb-2">
                                        <span class="badge bg-primary-subtle text-primary me-2">1</span>
                                        Check if Laravel container is running: <code>docker ps</code>
                                    </li>
                                    <li class="mb-2">
                                        <span class="badge bg-primary-subtle text-primary me-2">2</span>
                                        Restart containers: <code>docker-compose restart</code>
                                    </li>
                                    <li class="mb-2">
                                        <span class="badge bg-primary-subtle text-primary me-2">3</span>
                                        Check container logs: <code>docker-compose logs laravel.test</code>
                                    </li>
                                    <li class="mb-2">
                                        <span class="badge bg-primary-subtle text-primary me-2">4</span>
                                        Test from host: <code>curl http://localhost:80/api/health</code>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</DefaultLayout>
