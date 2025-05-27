<script lang="ts">
    import { onMount } from 'svelte';
    import { api } from '$lib/api/client';
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";

    let qualityData: any = null;
    let loading = true;
    let error = '';
    let selectedTimeframe = '7d';
    let selectedDataSource = 'all';

    const timeframes = [
        { value: '24h', label: 'Last 24 Hours' },
        { value: '7d', label: 'Last 7 Days' },
        { value: '30d', label: 'Last 30 Days' },
        { value: '90d', label: 'Last 90 Days' }
    ];

    const dataSources = [
        { value: 'all', label: 'All Sources' },
        { value: 'espn', label: 'ESPN API' },
        { value: 'stats_nba', label: 'Stats.NBA.com' },
        { value: 'manual', label: 'Manual Entry' },
        { value: 'scraped', label: 'Web Scraping' }
    ];

    onMount(async () => {
        await loadQualityData();
    });

    async function loadQualityData() {
        try {
            loading = true;
            error = '';

            const params: any = {
                timeframe: selectedTimeframe,
                source: selectedDataSource
            };

            // Try to load real data, fallback to mock
            try {
                const response = await api.wnba.dataQuality.getMetrics(params);
                qualityData = response.data || generateMockQualityData();
            } catch {
                qualityData = generateMockQualityData();
            }
        } catch (err) {
            error = err instanceof Error ? err.message : 'Failed to load data quality metrics';
            qualityData = generateMockQualityData();
        } finally {
            loading = false;
        }
    }

    function generateMockQualityData() {
        return {
            overall_score: 94.2,
            last_updated: new Date().toISOString(),
            metrics: {
                completeness: {
                    score: 96.8,
                    total_records: 125420,
                    complete_records: 121456,
                    missing_fields: 3964,
                    critical_missing: 156
                },
                freshness: {
                    score: 98.7,
                    avg_delay_minutes: 3.2,
                    max_delay_minutes: 45,
                    stale_records: 234,
                    real_time_percentage: 87.3
                },
                accuracy: {
                    score: 99.2,
                    validated_records: 124890,
                    validation_errors: 530,
                    data_conflicts: 89,
                    outliers_detected: 156
                },
                consistency: {
                    score: 92.1,
                    format_violations: 1245,
                    duplicate_records: 89,
                    referential_integrity: 98.9,
                    schema_compliance: 99.7
                }
            },
            data_sources: {
                espn: {
                    status: 'healthy',
                    uptime: 99.8,
                    last_sync: '2025-01-26T16:25:00Z',
                    records_today: 2456,
                    error_rate: 0.2,
                    avg_response_time: 245
                },
                stats_nba: {
                    status: 'healthy',
                    uptime: 98.9,
                    last_sync: '2025-01-26T16:20:00Z',
                    records_today: 1890,
                    error_rate: 1.1,
                    avg_response_time: 890
                },
                manual: {
                    status: 'warning',
                    uptime: 95.2,
                    last_sync: '2025-01-26T14:30:00Z',
                    records_today: 45,
                    error_rate: 4.8,
                    avg_response_time: null
                },
                scraped: {
                    status: 'degraded',
                    uptime: 87.3,
                    last_sync: '2025-01-26T15:45:00Z',
                    records_today: 234,
                    error_rate: 12.7,
                    avg_response_time: 2340
                }
            },
            field_quality: [
                { field: 'player_id', completeness: 100, accuracy: 100, consistency: 100 },
                { field: 'game_id', completeness: 100, accuracy: 100, consistency: 100 },
                { field: 'points', completeness: 98.9, accuracy: 99.8, consistency: 99.2 },
                { field: 'rebounds', completeness: 98.7, accuracy: 99.5, consistency: 98.9 },
                { field: 'assists', completeness: 98.5, accuracy: 99.3, consistency: 98.7 },
                { field: 'minutes', completeness: 97.2, accuracy: 98.9, consistency: 97.8 },
                { field: 'field_goals', completeness: 96.8, accuracy: 99.1, consistency: 98.2 },
                { field: 'three_pointers', completeness: 95.9, accuracy: 98.7, consistency: 97.5 },
                { field: 'free_throws', completeness: 96.2, accuracy: 99.0, consistency: 98.1 },
                { field: 'steals', completeness: 94.8, accuracy: 97.9, consistency: 96.8 },
                { field: 'blocks', completeness: 94.2, accuracy: 97.5, consistency: 96.2 },
                { field: 'turnovers', completeness: 93.8, accuracy: 97.1, consistency: 95.9 }
            ],
            quality_trends: [
                { date: '2025-01-20', completeness: 95.2, freshness: 97.8, accuracy: 98.9, consistency: 91.5 },
                { date: '2025-01-21', completeness: 95.8, freshness: 98.1, accuracy: 99.0, consistency: 91.8 },
                { date: '2025-01-22', completeness: 96.1, freshness: 98.3, accuracy: 99.1, consistency: 92.0 },
                { date: '2025-01-23', completeness: 96.4, freshness: 98.5, accuracy: 99.2, consistency: 92.1 },
                { date: '2025-01-24', completeness: 96.6, freshness: 98.6, accuracy: 99.2, consistency: 92.1 },
                { date: '2025-01-25', completeness: 96.7, freshness: 98.7, accuracy: 99.2, consistency: 92.1 },
                { date: '2025-01-26', completeness: 96.8, freshness: 98.7, accuracy: 99.2, consistency: 92.1 }
            ],
            alerts: [
                {
                    severity: 'warning',
                    message: 'Manual data entry source showing increased error rate',
                    timestamp: '2025-01-26T15:30:00Z',
                    affected_records: 23
                },
                {
                    severity: 'error',
                    message: 'Web scraping source experiencing intermittent failures',
                    timestamp: '2025-01-26T14:15:00Z',
                    affected_records: 156
                },
                {
                    severity: 'info',
                    message: 'ESPN API response time slightly elevated',
                    timestamp: '2025-01-26T13:45:00Z',
                    affected_records: 0
                }
            ]
        };
    }

    async function applyFilters() {
        await loadQualityData();
    }

    function formatPercentage(value: number): string {
        return `${value.toFixed(1)}%`;
    }

    function formatNumber(value: number): string {
        return value.toLocaleString();
    }

    function getQualityColor(score: number): string {
        if (score >= 95) return 'text-success';
        if (score >= 85) return 'text-warning';
        return 'text-danger';
    }

    function getQualityBadge(score: number): string {
        if (score >= 95) return 'bg-success-subtle text-success';
        if (score >= 85) return 'bg-warning-subtle text-warning';
        return 'bg-danger-subtle text-danger';
    }

    function getStatusColor(status: string): string {
        switch (status.toLowerCase()) {
            case 'healthy': return 'success';
            case 'warning': return 'warning';
            case 'degraded': return 'danger';
            case 'error': return 'danger';
            default: return 'secondary';
        }
    }

    function getSeverityColor(severity: string): string {
        switch (severity.toLowerCase()) {
            case 'info': return 'info';
            case 'warning': return 'warning';
            case 'error': return 'danger';
            case 'critical': return 'danger';
            default: return 'secondary';
        }
    }

    function formatTimestamp(timestamp: string): string {
        return new Date(timestamp).toLocaleString();
    }

    function getUptimeColor(uptime: number): string {
        if (uptime >= 99) return 'text-success';
        if (uptime >= 95) return 'text-warning';
        return 'text-danger';
    }
</script>

<svelte:head>
    <title>Data Quality | Advanced Analytics | WNBA Stat Spot</title>
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
                    <h4 class="page-title">Data Quality Analysis</h4>
                    <p class="text-muted mb-0">Data completeness, freshness, accuracy metrics, and source validation</p>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-filter text-primary me-2"></i>Analysis Filters
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="timeframe" class="form-label">Timeframe</label>
                                <select
                                    id="timeframe"
                                    bind:value={selectedTimeframe}
                                    class="form-select"
                                >
                                    {#each timeframes as timeframe}
                                        <option value={timeframe.value}>{timeframe.label}</option>
                                    {/each}
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="data-source" class="form-label">Data Source</label>
                                <select
                                    id="data-source"
                                    bind:value={selectedDataSource}
                                    class="form-select"
                                >
                                    {#each dataSources as source}
                                        <option value={source.value}>{source.label}</option>
                                    {/each}
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <button
                                    on:click={applyFilters}
                                    disabled={loading}
                                    class="btn btn-primary w-100"
                                >
                                    {#if loading}
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                    {:else}
                                        <i class="fas fa-search me-2"></i>
                                    {/if}
                                    Analyze
                                </button>
                            </div>
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
                            <p class="mt-2 mb-0">Analyzing data quality...</p>
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
        {:else if qualityData}
            <!-- Overall Quality Score -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-shield-check text-primary me-2"></i>Overall Data Quality Score
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-md-3">
                                    <h1 class="{getQualityColor(qualityData.overall_score)}" style="font-size: 4rem;">
                                        {formatPercentage(qualityData.overall_score)}
                                    </h1>
                                    <p class="text-muted mb-0">Overall Score</p>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h3 class="{getQualityColor(qualityData.metrics.completeness.score)}">{formatPercentage(qualityData.metrics.completeness.score)}</h3>
                                            <p class="text-muted mb-0">Completeness</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h3 class="{getQualityColor(qualityData.metrics.freshness.score)}">{formatPercentage(qualityData.metrics.freshness.score)}</h3>
                                            <p class="text-muted mb-0">Freshness</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h3 class="{getQualityColor(qualityData.metrics.accuracy.score)}">{formatPercentage(qualityData.metrics.accuracy.score)}</h3>
                                            <p class="text-muted mb-0">Accuracy</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h3 class="{getQualityColor(qualityData.metrics.consistency.score)}">{formatPercentage(qualityData.metrics.consistency.score)}</h3>
                                            <p class="text-muted mb-0">Consistency</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Metrics -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-pie text-primary me-2"></i>Completeness Metrics
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="text-center">
                                        <h4 class="text-primary">{formatNumber(qualityData.metrics.completeness.total_records)}</h4>
                                        <p class="text-muted mb-0">Total Records</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <h4 class="text-success">{formatNumber(qualityData.metrics.completeness.complete_records)}</h4>
                                        <p class="text-muted mb-0">Complete Records</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <h4 class="text-warning">{formatNumber(qualityData.metrics.completeness.missing_fields)}</h4>
                                        <p class="text-muted mb-0">Missing Fields</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <h4 class="text-danger">{formatNumber(qualityData.metrics.completeness.critical_missing)}</h4>
                                        <p class="text-muted mb-0">Critical Missing</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-clock text-primary me-2"></i>Freshness Metrics
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="text-center">
                                        <h4 class="text-info">{qualityData.metrics.freshness.avg_delay_minutes.toFixed(1)}m</h4>
                                        <p class="text-muted mb-0">Avg Delay</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <h4 class="text-warning">{qualityData.metrics.freshness.max_delay_minutes}m</h4>
                                        <p class="text-muted mb-0">Max Delay</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <h4 class="text-danger">{formatNumber(qualityData.metrics.freshness.stale_records)}</h4>
                                        <p class="text-muted mb-0">Stale Records</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <h4 class="text-success">{formatPercentage(qualityData.metrics.freshness.real_time_percentage)}</h4>
                                        <p class="text-muted mb-0">Real-time</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Sources Status -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-server text-primary me-2"></i>Data Sources Status
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Source</th>
                                            <th>Status</th>
                                            <th>Uptime</th>
                                            <th>Last Sync</th>
                                            <th>Records Today</th>
                                            <th>Error Rate</th>
                                            <th>Response Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {#each Object.entries(qualityData.data_sources) as [source, data]}
                                            <tr>
                                                <td class="fw-medium text-capitalize">{source.replace('_', ' ')}</td>
                                                <td>
                                                    <span class="badge bg-{getStatusColor(data.status)}-subtle text-{getStatusColor(data.status)}">
                                                        {data.status}
                                                    </span>
                                                </td>
                                                <td class="{getUptimeColor(data.uptime)}">{formatPercentage(data.uptime)}</td>
                                                <td class="text-muted small">{formatTimestamp(data.last_sync)}</td>
                                                <td>{formatNumber(data.records_today)}</td>
                                                <td class="{data.error_rate > 5 ? 'text-danger' : data.error_rate > 2 ? 'text-warning' : 'text-success'}">
                                                    {formatPercentage(data.error_rate)}
                                                </td>
                                                <td class="text-muted">
                                                    {data.avg_response_time ? `${data.avg_response_time}ms` : 'N/A'}
                                                </td>
                                            </tr>
                                        {/each}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Field Quality Analysis -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-list text-primary me-2"></i>Field Quality Analysis
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Field</th>
                                            <th>Completeness</th>
                                            <th>Accuracy</th>
                                            <th>Consistency</th>
                                            <th>Overall</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {#each qualityData.field_quality as field}
                                            <tr>
                                                <td class="fw-medium">{field.field.replace('_', ' ')}</td>
                                                <td>
                                                    <span class="badge {getQualityBadge(field.completeness)}">
                                                        {formatPercentage(field.completeness)}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge {getQualityBadge(field.accuracy)}">
                                                        {formatPercentage(field.accuracy)}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge {getQualityBadge(field.consistency)}">
                                                        {formatPercentage(field.consistency)}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge {getQualityBadge((field.completeness + field.accuracy + field.consistency) / 3)}">
                                                        {formatPercentage((field.completeness + field.accuracy + field.consistency) / 3)}
                                                    </span>
                                                </td>
                                            </tr>
                                        {/each}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-exclamation-triangle text-primary me-2"></i>Recent Alerts
                            </h5>
                        </div>
                        <div class="card-body">
                            {#if qualityData.alerts.length === 0}
                                <div class="text-center py-3">
                                    <i class="fas fa-check-circle text-success fs-48 mb-3"></i>
                                    <h5 class="text-success">No Active Alerts</h5>
                                    <p class="text-muted mb-0">All data quality metrics are within acceptable ranges</p>
                                </div>
                            {:else}
                                {#each qualityData.alerts as alert}
                                    <div class="alert alert-{getSeverityColor(alert.severity)} d-flex align-items-center" role="alert">
                                        <i class="fas fa-{alert.severity === 'error' ? 'times-circle' : alert.severity === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-3"></i>
                                        <div class="flex-grow-1">
                                            <strong>{alert.severity.toUpperCase()}:</strong> {alert.message}
                                            <br>
                                            <small class="text-muted">
                                                {formatTimestamp(alert.timestamp)} • {alert.affected_records} records affected
                                            </small>
                                        </div>
                                    </div>
                                {/each}
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        {/if}
    </div>
</DefaultLayout>
