<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wnba_plays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('wnba_games', 'id');
            $table->string('play_id')->unique();
            $table->integer('play_sequence_number');
            $table->string('period');
            $table->string('period_display_value');
            $table->string('clock_display_value');
            $table->string('team_id')->index();
            $table->foreignId('player_id')->nullable()->constrained('wnba_players', 'id');
            $table->string('play_type_id');
            $table->string('play_type_text');
            $table->string('play_type_abbreviation');
            $table->text('play_text');
            $table->integer('score_value')->nullable();
            $table->string('score_team_id')->nullable()->index();
            $table->timestamps();

            // Add foreign key constraints to reference team_id column
            $table->foreign('team_id')->references('team_id')->on('wnba_teams');
            $table->foreign('score_team_id')->references('team_id')->on('wnba_teams');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wnba_plays');
    }
};
