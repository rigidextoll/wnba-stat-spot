<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheHelper
{
    /**
     * Default cache TTL in seconds (1 hour)
     */
    protected int $defaultCacheTtl = 3600;

    /**
     * Cache key prefix for this service/controller
     */
    protected string $cachePrefix = 'wnba';

    /**
     * Get data from cache or execute callback and cache result
     */
    protected function getCached(string $key, callable $callback, ?int $ttl = null): mixed
    {
        $cacheKey = $this->buildCacheKey($key);
        $cacheTtl = $ttl ?? $this->defaultCacheTtl;

        return Cache::remember($cacheKey, $cacheTtl, $callback);
    }

    /**
     * Store data in cache
     */
    protected function putCache(string $key, mixed $data, ?int $ttl = null): bool
    {
        $cacheKey = $this->buildCacheKey($key);
        $cacheTtl = $ttl ?? $this->defaultCacheTtl;

        return Cache::put($cacheKey, $data, $cacheTtl);
    }

    /**
     * Remove item from cache
     */
    protected function forgetCache(string $key): bool
    {
        $cacheKey = $this->buildCacheKey($key);
        return Cache::forget($cacheKey);
    }

    /**
     * Remove multiple cache keys by pattern
     */
    protected function forgetCachePattern(string $pattern): void
    {
        $fullPattern = $this->buildCacheKey($pattern);
        
        // For Redis-based cache stores
        if (Cache::getStore() instanceof \Illuminate\Cache\RedisStore) {
            $keys = Cache::getStore()->getRedis()->keys($fullPattern);
            if (!empty($keys)) {
                Cache::getStore()->getRedis()->del($keys);
            }
        } else {
            // For other cache stores, we'd need to track keys manually
            // or use cache tags if supported
        }
    }

    /**
     * Build standardized cache key
     */
    protected function buildCacheKey(string $key): string
    {
        $prefix = $this->cachePrefix;
        $className = strtolower(class_basename($this));
        
        return "{$prefix}:{$className}:{$key}";
    }

    /**
     * Get cache key for player data
     */
    protected function getPlayerCacheKey(int $playerId, string $suffix = ''): string
    {
        $key = "player_{$playerId}";
        return $suffix ? "{$key}_{$suffix}" : $key;
    }

    /**
     * Get cache key for team data
     */
    protected function getTeamCacheKey(int $teamId, string $suffix = ''): string
    {
        $key = "team_{$teamId}";
        return $suffix ? "{$key}_{$suffix}" : $key;
    }

    /**
     * Get cache key for game data
     */
    protected function getGameCacheKey(int $gameId, string $suffix = ''): string
    {
        $key = "game_{$gameId}";
        return $suffix ? "{$key}_{$suffix}" : $key;
    }

    /**
     * Get cache key for season data
     */
    protected function getSeasonCacheKey(string $season, string $suffix = ''): string
    {
        $key = "season_{$season}";
        return $suffix ? "{$key}_{$suffix}" : $key;
    }

    /**
     * Clear all player-related cache
     */
    protected function clearPlayerCache(int $playerId): void
    {
        $this->forgetCachePattern($this->getPlayerCacheKey($playerId, '*'));
    }

    /**
     * Clear all team-related cache
     */
    protected function clearTeamCache(int $teamId): void
    {
        $this->forgetCachePattern($this->getTeamCacheKey($teamId, '*'));
    }

    /**
     * Clear all game-related cache
     */
    protected function clearGameCache(int $gameId): void
    {
        $this->forgetCachePattern($this->getGameCacheKey($gameId, '*'));
    }

    /**
     * Get cached data with fallback
     */
    protected function getCachedWithFallback(string $key, callable $primaryCallback, callable $fallbackCallback, ?int $ttl = null): mixed
    {
        try {
            return $this->getCached($key, $primaryCallback, $ttl);
        } catch (\Exception $e) {
            // Log the error but don't fail - use fallback
            \Log::warning("Cache operation failed for key: {$key}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return $fallbackCallback();
        }
    }

    /**
     * Warm up cache with data
     */
    protected function warmUpCache(array $keyCallbackPairs, ?int $ttl = null): array
    {
        $results = [];
        
        foreach ($keyCallbackPairs as $key => $callback) {
            try {
                $results[$key] = $this->getCached($key, $callback, $ttl);
            } catch (\Exception $e) {
                \Log::error("Failed to warm up cache for key: {$key}", [
                    'error' => $e->getMessage()
                ]);
                $results[$key] = null;
            }
        }
        
        return $results;
    }

    /**
     * Check if cache key exists
     */
    protected function cacheExists(string $key): bool
    {
        $cacheKey = $this->buildCacheKey($key);
        return Cache::has($cacheKey);
    }

    /**
     * Get remaining TTL for cache key
     */
    protected function getCacheTtl(string $key): ?int
    {
        $cacheKey = $this->buildCacheKey($key);
        
        // This is Redis-specific - adapt for other cache stores as needed
        if (Cache::getStore() instanceof \Illuminate\Cache\RedisStore) {
            return Cache::getStore()->getRedis()->ttl($cacheKey);
        }
        
        return null;
    }
}