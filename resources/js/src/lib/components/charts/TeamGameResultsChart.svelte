<script lang="ts">
    import BaseChart from './BaseChart.svelte';
    import type { ChartData, ChartOptions } from 'chart.js';

    export let data: {
        date: string;
        points_scored: number;
        points_allowed: number;
        result: 'W' | 'L';
        home_away: 'home' | 'away';
    }[] = [];
    export let loading: boolean = false;
    export let error: string | null = null;
    export let height: string = '400px';

    let baseChart: BaseChart;

    // Transform data for Chart.js
    $: chartData = {
        labels: data.map(d => d.date),
        datasets: [
            {
                label: 'Points Scored',
                data: data.map(d => d.points_scored),
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: false,
                borderWidth: 2,
                pointBackgroundColor: data.map(d => d.result === 'W' ? '#10b981' : '#ef4444'),
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
            },
            {
                label: 'Points Allowed',
                data: data.map(d => d.points_allowed),
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                tension: 0.4,
                fill: false,
                borderWidth: 2,
                pointBackgroundColor: '#ef4444',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
            }
        ]
    } as ChartData<'line'>;

    // Chart options specific to team game results
    const chartOptions: ChartOptions<'line'> = {
        scales: {
            x: {
                grid: {
                    display: false,
                },
                ticks: {
                    maxTicksLimit: 10,
                },
            },
            y: {
                beginAtZero: false,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)',
                },
                ticks: {
                    stepSize: 10,
                },
                title: {
                    display: true,
                    text: 'Points',
                },
            },
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
            tooltip: {
                mode: 'index',
                intersect: false,
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleColor: '#ffffff',
                bodyColor: '#ffffff',
                callbacks: {
                    afterBody: function(context) {
                        const index = context[0].dataIndex;
                        const gameData = data[index];
                        return [
                            `Result: ${gameData.result}`,
                            `Location: ${gameData.home_away === 'home' ? 'Home' : 'Away'}`,
                            `Point Diff: ${gameData.points_scored - gameData.points_allowed > 0 ? '+' : ''}${gameData.points_scored - gameData.points_allowed}`
                        ];
                    }
                }
            },
        },
        interaction: {
            mode: 'nearest',
            axis: 'x',
            intersect: false,
        },
        elements: {
            point: {
                hoverBackgroundColor: function(context) {
                    const index = context.dataIndex;
                    const gameData = data[index];
                    return gameData?.result === 'W' ? '#10b981' : '#ef4444';
                },
            },
        },
    };

    // Export functions to parent components
    export function refreshChart() {
        if (baseChart) {
            baseChart.refreshChart();
        }
    }

    export function exportChart(format: 'png' | 'jpeg' = 'png') {
        if (baseChart) {
            return baseChart.exportChart(format);
        }
        return null;
    }
</script>

<BaseChart
    bind:this={baseChart}
    title="Team Game Results"
    chartType="line"
    data={chartData}
    options={chartOptions}
    {height}
    {loading}
    {error}
/>