<?php

namespace App\Services\WNBA\Data;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class CacheManagerService
{
    // Cache TTL constants (in seconds)
    private const PLAYER_STATS_TTL = 1800;      // 30 minutes
    private const TEAM_STATS_TTL = 1800;        // 30 minutes
    private const GAME_DATA_TTL = 3600;         // 1 hour
    private const PREDICTIONS_TTL = 900;        // 15 minutes
    private const LEAGUE_DATA_TTL = 7200;       // 2 hours
    private const HISTORICAL_DATA_TTL = 86400;  // 24 hours

    // Cache key prefixes
    private const PLAYER_PREFIX = 'wnba:player:';
    private const TEAM_PREFIX = 'wnba:team:';
    private const GAME_PREFIX = 'wnba:game:';
    private const PREDICTION_PREFIX = 'wnba:prediction:';
    private const LEAGUE_PREFIX = 'wnba:league:';
    private const ANALYTICS_PREFIX = 'wnba:analytics:';

    /**
     * Get cached data with fallback to generator function
     */
    public function remember(string $key, int $ttl, callable $callback): mixed
    {
        try {
            return Cache::remember($key, $ttl, $callback);
        } catch (\Exception $e) {
            Log::error('Cache remember failed', [
                'key' => $key,
                'error' => $e->getMessage()
            ]);

            // Fallback to direct execution if cache fails
            return $callback();
        }
    }

    /**
     * Cache player statistics with appropriate TTL
     */
    public function cachePlayerStats(int $playerId, array $data, ?int $season = null): bool
    {
        $key = $this->getPlayerStatsKey($playerId, $season);
        return $this->setWithTags($key, $data, self::PLAYER_STATS_TTL, ['player', "player:{$playerId}"]);
    }

    /**
     * Get cached player statistics
     */
    public function getPlayerStats(int $playerId, ?int $season = null): ?array
    {
        $key = $this->getPlayerStatsKey($playerId, $season);
        return Cache::get($key);
    }

    /**
     * Cache team statistics
     */
    public function cacheTeamStats(int $teamId, array $data, ?int $season = null): bool
    {
        $key = $this->getTeamStatsKey($teamId, $season);
        return $this->setWithTags($key, $data, self::TEAM_STATS_TTL, ['team', "team:{$teamId}"]);
    }

    /**
     * Get cached team statistics
     */
    public function getTeamStats(int $teamId, ?int $season = null): ?array
    {
        $key = $this->getTeamStatsKey($teamId, $season);
        return Cache::get($key);
    }

    /**
     * Cache game data
     */
    public function cacheGameData(int $gameId, array $data): bool
    {
        $key = $this->getGameDataKey($gameId);
        return $this->setWithTags($key, $data, self::GAME_DATA_TTL, ['game', "game:{$gameId}"]);
    }

    /**
     * Get cached game data
     */
    public function getGameData(int $gameId): ?array
    {
        $key = $this->getGameDataKey($gameId);
        return Cache::get($key);
    }

    /**
     * Cache prediction data
     */
    public function cachePrediction(string $predictionId, array $data): bool
    {
        $key = $this->getPredictionKey($predictionId);
        return $this->setWithTags($key, $data, self::PREDICTIONS_TTL, ['prediction']);
    }

    /**
     * Get cached prediction
     */
    public function getPrediction(string $predictionId): ?array
    {
        $key = $this->getPredictionKey($predictionId);
        return Cache::get($key);
    }

    /**
     * Cache league-wide data
     */
    public function cacheLeagueData(int $season, string $dataType, array $data): bool
    {
        $key = $this->getLeagueDataKey($season, $dataType);
        return $this->setWithTags($key, $data, self::LEAGUE_DATA_TTL, ['league', "season:{$season}"]);
    }

    /**
     * Get cached league data
     */
    public function getLeagueData(int $season, string $dataType): ?array
    {
        $key = $this->getLeagueDataKey($season, $dataType);
        return Cache::get($key);
    }

    /**
     * Invalidate player-related cache
     */
    public function invalidatePlayer(int $playerId): bool
    {
        try {
            // Clear specific player caches
            $this->clearByPattern(self::PLAYER_PREFIX . $playerId . ':*');

            // Clear prediction caches that might involve this player
            $this->clearByPattern(self::PREDICTION_PREFIX . '*:player:' . $playerId . ':*');

            // Clear analytics caches
            $this->clearByPattern(self::ANALYTICS_PREFIX . 'player:' . $playerId . ':*');

            Log::info('Player cache invalidated', ['player_id' => $playerId]);
            return true;
        } catch (\Exception $e) {
            Log::error('Player cache invalidation failed', [
                'player_id' => $playerId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Invalidate team-related cache
     */
    public function invalidateTeam(int $teamId): bool
    {
        try {
            // Clear team caches
            $this->clearByPattern(self::TEAM_PREFIX . $teamId . ':*');

            // Clear game caches involving this team
            $this->clearByPattern(self::GAME_PREFIX . '*:team:' . $teamId . ':*');

            // Clear analytics caches
            $this->clearByPattern(self::ANALYTICS_PREFIX . 'team:' . $teamId . ':*');

            Log::info('Team cache invalidated', ['team_id' => $teamId]);
            return true;
        } catch (\Exception $e) {
            Log::error('Team cache invalidation failed', [
                'team_id' => $teamId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Invalidate game-related cache
     */
    public function invalidateGame(int $gameId): bool
    {
        try {
            // Clear game-specific caches
            $this->clearByPattern(self::GAME_PREFIX . $gameId . ':*');

            // Clear prediction caches for this game
            $this->clearByPattern(self::PREDICTION_PREFIX . '*:game:' . $gameId . ':*');

            Log::info('Game cache invalidated', ['game_id' => $gameId]);
            return true;
        } catch (\Exception $e) {
            Log::error('Game cache invalidation failed', [
                'game_id' => $gameId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Warm up cache for upcoming games
     */
    public function warmUpcomingGames(array $gameIds): array
    {
        $results = [];

        foreach ($gameIds as $gameId) {
            try {
                // Pre-load game data
                $this->warmGameData($gameId);

                // Pre-load team data for teams in the game
                $this->warmGameTeamData($gameId);

                // Pre-load player data for key players
                $this->warmGamePlayerData($gameId);

                $results[$gameId] = 'success';
            } catch (\Exception $e) {
                Log::error('Cache warming failed for game', [
                    'game_id' => $gameId,
                    'error' => $e->getMessage()
                ]);
                $results[$gameId] = 'failed';
            }
        }

        return $results;
    }

    /**
     * Warm player statistics cache
     */
    public function warmPlayerStats(array $playerIds, ?int $season = null): array
    {
        $results = [];

        foreach ($playerIds as $playerId) {
            try {
                // This would trigger the data aggregation service
                // For now, we'll just mark the cache as warmed
                $key = $this->getPlayerStatsKey($playerId, $season);
                $this->markAsWarmed($key);

                $results[$playerId] = 'warmed';
            } catch (\Exception $e) {
                Log::error('Player stats cache warming failed', [
                    'player_id' => $playerId,
                    'error' => $e->getMessage()
                ]);
                $results[$playerId] = 'failed';
            }
        }

        return $results;
    }

    /**
     * Get cache statistics
     */
    public function getCacheStats(): array
    {
        try {
            $stats = [
                'total_keys' => $this->getTotalKeys(),
                'memory_usage' => $this->getMemoryUsage(),
                'hit_rate' => $this->getHitRate(),
                'key_distribution' => $this->getKeyDistribution(),
                'expiration_analysis' => $this->getExpirationAnalysis()
            ];

            return $stats;
        } catch (\Exception $e) {
            Log::error('Cache stats retrieval failed', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Clean expired cache entries
     */
    public function cleanExpiredEntries(): int
    {
        try {
            $cleaned = 0;

            // Get all WNBA cache keys
            $keys = $this->getWnbaKeys();

            foreach ($keys as $key) {
                if ($this->isExpired($key)) {
                    Cache::forget($key);
                    $cleaned++;
                }
            }

            Log::info('Cache cleanup completed', ['cleaned_entries' => $cleaned]);
            return $cleaned;
        } catch (\Exception $e) {
            Log::error('Cache cleanup failed', ['error' => $e->getMessage()]);
            return 0;
        }
    }

    /**
     * Optimize cache performance
     */
    public function optimizeCache(): array
    {
        $results = [
            'cleaned_expired' => $this->cleanExpiredEntries(),
            'compressed_data' => $this->compressLargeEntries(),
            'rebalanced_ttl' => $this->rebalanceTTL(),
            'memory_freed' => $this->freeUnusedMemory()
        ];

        Log::info('Cache optimization completed', $results);
        return $results;
    }

    /**
     * Backup critical cache data
     */
    public function backupCriticalData(): bool
    {
        try {
            $criticalKeys = $this->getCriticalKeys();
            $backup = [];

            foreach ($criticalKeys as $key) {
                $data = Cache::get($key);
                if ($data !== null) {
                    $backup[$key] = [
                        'data' => $data,
                        'timestamp' => now()->toISOString(),
                        'ttl' => $this->getTTL($key)
                    ];
                }
            }

            // Store backup (could be to file, database, or separate cache)
            $backupKey = 'wnba:backup:' . now()->format('Y-m-d-H-i-s');
            Cache::put($backupKey, $backup, 86400); // 24 hours

            Log::info('Cache backup completed', [
                'backup_key' => $backupKey,
                'entries_backed_up' => count($backup)
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Cache backup failed', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Restore cache from backup
     */
    public function restoreFromBackup(string $backupKey): bool
    {
        try {
            $backup = Cache::get($backupKey);

            if (!$backup) {
                Log::warning('Backup not found', ['backup_key' => $backupKey]);
                return false;
            }

            $restored = 0;
            foreach ($backup as $key => $entry) {
                Cache::put($key, $entry['data'], $entry['ttl']);
                $restored++;
            }

            Log::info('Cache restored from backup', [
                'backup_key' => $backupKey,
                'entries_restored' => $restored
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Cache restore failed', [
                'backup_key' => $backupKey,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    // Private helper methods

    private function getPlayerStatsKey(int $playerId, ?int $season = null): string
    {
        return self::PLAYER_PREFIX . $playerId . ':stats' . ($season ? ":season:{$season}" : '');
    }

    private function getTeamStatsKey(int $teamId, ?int $season = null): string
    {
        return self::TEAM_PREFIX . $teamId . ':stats' . ($season ? ":season:{$season}" : '');
    }

    private function getGameDataKey(int $gameId): string
    {
        return self::GAME_PREFIX . $gameId . ':data';
    }

    private function getPredictionKey(string $predictionId): string
    {
        return self::PREDICTION_PREFIX . $predictionId;
    }

    private function getLeagueDataKey(int $season, string $dataType): string
    {
        return self::LEAGUE_PREFIX . "season:{$season}:type:{$dataType}";
    }

    private function setWithTags(string $key, mixed $data, int $ttl, array $tags = []): bool
    {
        try {
            // Set the main cache entry
            $result = Cache::put($key, $data, $ttl);

            // Set tags for easier invalidation (if using Redis)
            if (!empty($tags) && $this->supportsTagging()) {
                foreach ($tags as $tag) {
                    $this->addToTag($tag, $key);
                }
            }

            return $result;
        } catch (\Exception $e) {
            Log::error('Cache set with tags failed', [
                'key' => $key,
                'tags' => $tags,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    private function clearByPattern(string $pattern): int
    {
        try {
            $keys = $this->getKeysByPattern($pattern);
            $cleared = 0;

            foreach ($keys as $key) {
                if (Cache::forget($key)) {
                    $cleared++;
                }
            }

            return $cleared;
        } catch (\Exception $e) {
            Log::error('Clear by pattern failed', [
                'pattern' => $pattern,
                'error' => $e->getMessage()
            ]);
            return 0;
        }
    }

    private function getKeysByPattern(string $pattern): array
    {
        try {
            if ($this->isRedisCache()) {
                return Redis::keys($pattern);
            }

            // Fallback for other cache drivers
            return $this->getAllWnbaKeys();
        } catch (\Exception $e) {
            Log::error('Get keys by pattern failed', [
                'pattern' => $pattern,
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    private function markAsWarmed(string $key): void
    {
        $warmKey = "warmed:{$key}";
        Cache::put($warmKey, true, 300); // 5 minutes
    }

    private function warmGameData(int $gameId): void
    {
        // This would trigger the data aggregation service
        // Placeholder for actual implementation
    }

    private function warmGameTeamData(int $gameId): void
    {
        // This would load team data for teams in the game
        // Placeholder for actual implementation
    }

    private function warmGamePlayerData(int $gameId): void
    {
        // This would load key player data for the game
        // Placeholder for actual implementation
    }

    private function getTotalKeys(): int
    {
        try {
            if ($this->isRedisCache()) {
                return count(Redis::keys('wnba:*'));
            }
            return 0; // Placeholder for other drivers
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getMemoryUsage(): array
    {
        try {
            if ($this->isRedisCache()) {
                $info = Redis::info('memory');
                return [
                    'used_memory' => $info['used_memory'] ?? 0,
                    'used_memory_human' => $info['used_memory_human'] ?? '0B',
                    'used_memory_peak' => $info['used_memory_peak'] ?? 0
                ];
            }
            return [];
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getHitRate(): float
    {
        try {
            if ($this->isRedisCache()) {
                $info = Redis::info('stats');
                $hits = $info['keyspace_hits'] ?? 0;
                $misses = $info['keyspace_misses'] ?? 0;
                $total = $hits + $misses;

                return $total > 0 ? round(($hits / $total) * 100, 2) : 0;
            }
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getKeyDistribution(): array
    {
        $distribution = [
            'player' => 0,
            'team' => 0,
            'game' => 0,
            'prediction' => 0,
            'league' => 0,
            'analytics' => 0
        ];

        try {
            $keys = $this->getAllWnbaKeys();

            foreach ($keys as $key) {
                if (str_starts_with($key, self::PLAYER_PREFIX)) {
                    $distribution['player']++;
                } elseif (str_starts_with($key, self::TEAM_PREFIX)) {
                    $distribution['team']++;
                } elseif (str_starts_with($key, self::GAME_PREFIX)) {
                    $distribution['game']++;
                } elseif (str_starts_with($key, self::PREDICTION_PREFIX)) {
                    $distribution['prediction']++;
                } elseif (str_starts_with($key, self::LEAGUE_PREFIX)) {
                    $distribution['league']++;
                } elseif (str_starts_with($key, self::ANALYTICS_PREFIX)) {
                    $distribution['analytics']++;
                }
            }
        } catch (\Exception $e) {
            Log::error('Key distribution analysis failed', ['error' => $e->getMessage()]);
        }

        return $distribution;
    }

    private function getExpirationAnalysis(): array
    {
        $analysis = [
            'expiring_soon' => 0,    // < 5 minutes
            'expiring_medium' => 0,  // 5-30 minutes
            'expiring_later' => 0,   // > 30 minutes
            'no_expiration' => 0
        ];

        try {
            $keys = $this->getAllWnbaKeys();

            foreach ($keys as $key) {
                $ttl = $this->getTTL($key);

                if ($ttl === -1) {
                    $analysis['no_expiration']++;
                } elseif ($ttl < 300) {
                    $analysis['expiring_soon']++;
                } elseif ($ttl < 1800) {
                    $analysis['expiring_medium']++;
                } else {
                    $analysis['expiring_later']++;
                }
            }
        } catch (\Exception $e) {
            Log::error('Expiration analysis failed', ['error' => $e->getMessage()]);
        }

        return $analysis;
    }

    private function isExpired(string $key): bool
    {
        try {
            return !Cache::has($key);
        } catch (\Exception $e) {
            return true;
        }
    }

    private function compressLargeEntries(): int
    {
        // Placeholder for compression logic
        return 0;
    }

    private function rebalanceTTL(): int
    {
        // Placeholder for TTL rebalancing logic
        return 0;
    }

    private function freeUnusedMemory(): int
    {
        // Placeholder for memory optimization logic
        return 0;
    }

    private function getCriticalKeys(): array
    {
        // Return keys for critical data that should be backed up
        return $this->getKeysByPattern('wnba:league:*');
    }

    private function getTTL(string $key): int
    {
        try {
            if ($this->isRedisCache()) {
                return Redis::ttl($key);
            }
            return -1; // Unknown for other drivers
        } catch (\Exception $e) {
            return -1;
        }
    }

    private function getAllWnbaKeys(): array
    {
        try {
            if ($this->isRedisCache()) {
                return Redis::keys('wnba:*');
            }
            return []; // Placeholder for other drivers
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getWnbaKeys(): array
    {
        return $this->getAllWnbaKeys();
    }

    private function isRedisCache(): bool
    {
        return config('cache.default') === 'redis';
    }

    private function supportsTagging(): bool
    {
        return $this->isRedisCache();
    }

    private function addToTag(string $tag, string $key): void
    {
        try {
            if ($this->isRedisCache()) {
                Redis::sadd("tag:{$tag}", $key);
            }
        } catch (\Exception $e) {
            Log::error('Add to tag failed', [
                'tag' => $tag,
                'key' => $key,
                'error' => $e->getMessage()
            ]);
        }
    }
}
