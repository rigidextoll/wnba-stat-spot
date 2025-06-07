<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wnba_game_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('wnba_games', 'id');
            $table->string('team_id')->index();
            $table->string('opponent_team_id')->index();
            $table->enum('home_away', ['home', 'away']);
            $table->boolean('team_winner');
            $table->integer('team_score');
            $table->integer('opponent_team_score');
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
            $table->timestamps();

            $table->unique(['game_id', 'team_id']);

            // Add foreign key constraints to reference team_id column
            $table->foreign('team_id')->references('team_id')->on('wnba_teams');
            $table->foreign('opponent_team_id')->references('team_id')->on('wnba_teams');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wnba_game_teams');
    }
};
