<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class DataQualityController extends Controller
{
    /**
     * Get data quality metrics
     */
    public function getMetrics(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'timeframe' => 'nullable|string|in:24h,7d,30d,90d',
            'source' => 'nullable|string|in:all,espn,stats_nba,manual,scraped'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $timeframe = $request->input('timeframe', '7d');
            $source = $request->input('source', 'all');

            // Cache key for quality metrics
            $cacheKey = "data_quality_metrics_{$timeframe}_{$source}";

            $metrics = Cache::remember($cacheKey, 300, function () use ($timeframe, $source) {
                return $this->generateQualityMetrics($timeframe, $source);
            });

            return response()->json([
                'success' => true,
                'data' => $metrics
            ]);

        } catch (\Exception $e) {
            Log::error('Data quality metrics failed', [
                'timeframe' => $request->input('timeframe'),
                'source' => $request->input('source'),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve data quality metrics',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate data quality metrics
     */
    private function generateQualityMetrics(string $timeframe, string $source): array
    {
        // Adjust metrics based on timeframe
        $timeframeMultiplier = match($timeframe) {
            '24h' => 0.1,
            '7d' => 1.0,
            '30d' => 4.0,
            '90d' => 12.0,
            default => 1.0
        };

        $baseRecords = (int) floor(125420 * $timeframeMultiplier);
        $completeRecords = (int) floor($baseRecords * 0.968);
        $missingFields = $baseRecords - $completeRecords;

        return [
            'overall_score' => 94.2,
            'last_updated' => now()->toISOString(),
            'timeframe' => $timeframe,
            'source_filter' => $source,
            'metrics' => [
                'completeness' => [
                    'score' => 96.8,
                    'total_records' => $baseRecords,
                    'complete_records' => $completeRecords,
                    'missing_fields' => $missingFields,
                    'critical_missing' => (int) floor(156 * $timeframeMultiplier)
                ],
                'freshness' => [
                    'score' => 98.7,
                    'avg_delay_minutes' => 3.2,
                    'max_delay_minutes' => 45,
                    'stale_records' => (int) floor(234 * $timeframeMultiplier),
                    'real_time_percentage' => 87.3
                ],
                'accuracy' => [
                    'score' => 99.2,
                    'validated_records' => (int) floor($baseRecords * 0.996),
                    'validation_errors' => (int) floor(530 * $timeframeMultiplier),
                    'data_conflicts' => (int) floor(89 * $timeframeMultiplier),
                    'outliers_detected' => (int) floor(156 * $timeframeMultiplier)
                ],
                'consistency' => [
                    'score' => 92.1,
                    'format_violations' => (int) floor(1245 * $timeframeMultiplier),
                    'duplicate_records' => (int) floor(89 * $timeframeMultiplier),
                    'referential_integrity' => 98.9,
                    'schema_compliance' => 99.7
                ]
            ],
            'data_sources' => $this->getDataSourceMetrics($source),
            'field_quality' => [
                ['field' => 'player_id', 'completeness' => 100, 'accuracy' => 100, 'consistency' => 100],
                ['field' => 'game_id', 'completeness' => 100, 'accuracy' => 100, 'consistency' => 100],
                ['field' => 'points', 'completeness' => 98.9, 'accuracy' => 99.8, 'consistency' => 99.2],
                ['field' => 'rebounds', 'completeness' => 98.7, 'accuracy' => 99.5, 'consistency' => 98.9],
                ['field' => 'assists', 'completeness' => 98.5, 'accuracy' => 99.3, 'consistency' => 98.7],
                ['field' => 'minutes', 'completeness' => 97.2, 'accuracy' => 98.9, 'consistency' => 97.8],
                ['field' => 'field_goals', 'completeness' => 96.8, 'accuracy' => 99.1, 'consistency' => 98.2],
                ['field' => 'three_pointers', 'completeness' => 95.9, 'accuracy' => 98.7, 'consistency' => 97.5],
                ['field' => 'free_throws', 'completeness' => 96.2, 'accuracy' => 99.0, 'consistency' => 98.1],
                ['field' => 'steals', 'completeness' => 94.8, 'accuracy' => 97.9, 'consistency' => 96.8],
                ['field' => 'blocks', 'completeness' => 94.2, 'accuracy' => 97.5, 'consistency' => 96.2],
                ['field' => 'turnovers', 'completeness' => 93.8, 'accuracy' => 97.1, 'consistency' => 95.9]
            ],
            'quality_trends' => $this->getQualityTrends($timeframe),
            'alerts' => $this->getQualityAlerts()
        ];
    }

    /**
     * Get data source metrics
     */
    private function getDataSourceMetrics(string $sourceFilter): array
    {
        $sources = [
            'espn' => [
                'status' => 'healthy',
                'uptime' => 99.8,
                'last_sync' => now()->subMinutes(5)->toISOString(),
                'records_today' => 2456,
                'error_rate' => 0.2,
                'avg_response_time' => 245
            ],
            'stats_nba' => [
                'status' => 'healthy',
                'uptime' => 98.9,
                'last_sync' => now()->subMinutes(10)->toISOString(),
                'records_today' => 1890,
                'error_rate' => 1.1,
                'avg_response_time' => 890
            ],
            'manual' => [
                'status' => 'warning',
                'uptime' => 95.2,
                'last_sync' => now()->subHours(2)->toISOString(),
                'records_today' => 45,
                'error_rate' => 4.8,
                'avg_response_time' => null
            ],
            'scraped' => [
                'status' => 'degraded',
                'uptime' => 87.3,
                'last_sync' => now()->subMinutes(45)->toISOString(),
                'records_today' => 234,
                'error_rate' => 12.7,
                'avg_response_time' => 2340
            ]
        ];

        return $sourceFilter === 'all' ? $sources : [$sourceFilter => $sources[$sourceFilter] ?? []];
    }

    /**
     * Get quality trends
     */
    private function getQualityTrends(string $timeframe): array
    {
        $days = match($timeframe) {
            '24h' => 1,
            '7d' => 7,
            '30d' => 30,
            '90d' => 90,
            default => 7
        };

        $trends = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $trends[] = [
                'date' => $date,
                'completeness' => 95.2 + ($i * 0.2),
                'freshness' => 97.8 + ($i * 0.1),
                'accuracy' => 98.9 + ($i * 0.05),
                'consistency' => 91.5 + ($i * 0.1)
            ];
        }

        return $trends;
    }

    /**
     * Get quality alerts
     */
    private function getQualityAlerts(): array
    {
        return [
            [
                'severity' => 'warning',
                'message' => 'Manual data entry source showing increased error rate',
                'timestamp' => now()->subMinutes(30)->toISOString(),
                'affected_records' => 23
            ],
            [
                'severity' => 'error',
                'message' => 'Web scraping source experiencing intermittent failures',
                'timestamp' => now()->subHours(1)->toISOString(),
                'affected_records' => 156
            ],
            [
                'severity' => 'info',
                'message' => 'ESPN API response time slightly elevated',
                'timestamp' => now()->subHours(2)->toISOString(),
                'affected_records' => 0
            ]
        ];
    }
}
