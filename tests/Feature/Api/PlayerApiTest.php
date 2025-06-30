<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\WnbaPlayer;
use App\Models\WnbaTeam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class PlayerApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test data
        $this->createTestTeam();
        $this->createTestPlayers();
    }

    public function test_players_index_returns_successful_response(): void
    {
        $response = $this->get('/api/players');
        
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'athlete_id',
                            'athlete_display_name',
                            'athlete_position_name',
                            'created_at',
                            'updated_at'
                        ]
                    ],
                    'meta' => [
                        'current_page',
                        'last_page',
                        'per_page',
                        'total'
                    ]
                ]);
    }

    public function test_players_index_with_search(): void
    {
        $player = WnbaPlayer::first();
        $searchTerm = substr($player->athlete_display_name, 0, 5);
        
        $response = $this->get("/api/players?search={$searchTerm}");
        
        $response->assertStatus(200)
                ->assertJsonFragment([
                    'athlete_display_name' => $player->athlete_display_name
                ]);
    }

    public function test_players_index_with_pagination(): void
    {
        $response = $this->get('/api/players?per_page=5&page=1');
        
        $response->assertStatus(200)
                ->assertJsonPath('meta.per_page', 5)
                ->assertJsonPath('meta.current_page', 1);
    }

    public function test_player_show_returns_correct_data(): void
    {
        $player = WnbaPlayer::first();
        
        $response = $this->get("/api/players/{$player->id}");
        
        $response->assertStatus(200)
                ->assertJsonFragment([
                    'id' => $player->id,
                    'athlete_display_name' => $player->athlete_display_name
                ]);
    }

    public function test_player_show_returns_404_for_nonexistent_player(): void
    {
        $response = $this->get('/api/players/99999');
        
        $response->assertStatus(404);
    }

    public function test_players_api_rate_limiting(): void
    {
        // Make multiple requests to test rate limiting
        for ($i = 0; $i < 5; $i++) {
            $response = $this->get('/api/players');
            $this->assertEquals(200, $response->status());
        }
        
        // Check if rate limiting headers are present
        $response = $this->get('/api/players');
        $this->assertTrue($response->headers->has('X-RateLimit-Limit') || 
                         $response->headers->has('Retry-After'));
    }

    public function test_players_api_validation(): void
    {
        // Test invalid per_page parameter
        $response = $this->get('/api/players?per_page=invalid');
        
        // Should handle gracefully, not return 500
        $this->assertNotEquals(500, $response->status());
    }

    public function test_players_api_returns_consistent_structure(): void
    {
        $response1 = $this->get('/api/players');
        $response2 = $this->get('/api/players?page=1');
        
        $data1 = $response1->json();
        $data2 = $response2->json();
        
        // Both responses should have the same structure
        $this->assertEquals(array_keys($data1), array_keys($data2));
        $this->assertEquals(array_keys($data1['meta']), array_keys($data2['meta']));
    }

    private function createTestTeam(): void
    {
        WnbaTeam::create([
            'team_id' => 'TEST',
            'team_display_name' => 'Test Team',
            'team_location' => 'Test City',
            'team_name' => 'Test Team Name',
            'team_abbreviation' => 'TEST',
            'team_color' => '#FF0000',
            'team_alternate_color' => '#0000FF',
        ]);
    }

    private function createTestPlayers(): void
    {
        $team = WnbaTeam::first();
        
        for ($i = 1; $i <= 10; $i++) {
            WnbaPlayer::create([
                'athlete_id' => "test-player-{$i}",
                'athlete_display_name' => "Test Player {$i}",
                'athlete_short_name' => "Player{$i}",
                'athlete_jersey' => (string) $i,
                'athlete_position_name' => $i <= 5 ? 'Guard' : 'Forward',
                'athlete_position_abbreviation' => $i <= 5 ? 'G' : 'F',
                'team_id' => $team->team_id,
            ]);
        }
    }
}