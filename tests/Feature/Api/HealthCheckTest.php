<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HealthCheckTest extends TestCase
{
    use RefreshDatabase;

    public function test_basic_health_endpoint_returns_success(): void
    {
        $response = $this->get('/health');
        
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'status',
                    'timestamp',
                    'version',
                    'environment'
                ])
                ->assertJson([
                    'status' => 'ok'
                ]);
    }

    public function test_detailed_health_check_returns_comprehensive_status(): void
    {
        $response = $this->get('/health/detailed');
        
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'status',
                    'checks' => [
                        'database',
                        'redis',
                        'queue',
                        'storage'
                    ],
                    'timestamp'
                ]);
    }

    public function test_database_health_check(): void
    {
        // Ensure database is working
        DB::connection()->getPdo();
        
        $response = $this->get('/health/detailed');
        
        $response->assertStatus(200)
                ->assertJsonPath('checks.database.status', 'ok');
    }

    public function test_cache_health_check(): void
    {
        // Test cache functionality
        Cache::put('health-test', 'working', 10);
        
        $response = $this->get('/health/detailed');
        
        $response->assertStatus(200)
                ->assertJsonPath('checks.redis.status', 'ok');
        
        // Clean up
        Cache::forget('health-test');
    }

    public function test_health_check_includes_performance_metrics(): void
    {
        $startTime = microtime(true);
        
        $response = $this->get('/health/detailed');
        
        $endTime = microtime(true);
        $responseTime = ($endTime - $startTime) * 1000; // Convert to milliseconds
        
        $response->assertStatus(200);
        
        // Health check should respond quickly (under 1 second)
        $this->assertLessThan(1000, $responseTime, 'Health check took too long to respond');
    }

    public function test_health_check_with_database_failure(): void
    {
        // Simulate database failure by using invalid connection
        config(['database.connections.testing.database' => 'nonexistent_db']);
        
        $response = $this->get('/health/detailed');
        
        // Should still return a response but with degraded status
        $this->assertContains($response->status(), [200, 503]);
    }

    public function test_health_check_returns_proper_headers(): void
    {
        $response = $this->get('/health');
        
        $response->assertHeader('Content-Type', 'application/json')
                ->assertHeader('Cache-Control');
    }
}