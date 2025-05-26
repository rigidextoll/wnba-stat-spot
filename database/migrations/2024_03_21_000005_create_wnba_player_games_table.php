<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wnba_player_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('wnba_games', 'id');
            $table->foreignId('player_id')->constrained('wnba_players', 'id');
            $table->foreignId('team_id')->constrained('wnba_teams', 'id');
            $table->string('minutes')->nullable();
            $table->integer('field_goals_made');
            $table->integer('field_goals_attempted');
            $table->integer('three_point_field_goals_made');
            $table->integer('three_point_field_goals_attempted');
            $table->integer('free_throws_made');
            $table->integer('free_throws_attempted');
            $table->integer('offensive_rebounds');
            $table->integer('defensive_rebounds');
            $table->integer('rebounds');
            $table->integer('assists');
            $table->integer('steals');
            $table->integer('blocks');
            $table->integer('turnovers');
            $table->integer('fouls');
            $table->integer('plus_minus');
            $table->integer('points');
            $table->boolean('starter');
            $table->boolean('ejected');
            $table->boolean('did_not_play');
            $table->string('reason')->nullable();
            $table->boolean('active');
            $table->timestamps();

            $table->unique(['game_id', 'player_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wnba_player_games');
    }
};
