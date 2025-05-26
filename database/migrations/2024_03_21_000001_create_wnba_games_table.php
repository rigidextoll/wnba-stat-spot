<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wnba_games', function (Blueprint $table) {
            $table->id();
            $table->string('game_id')->unique();
            $table->integer('season');
            $table->integer('season_type');
            $table->date('game_date');
            $table->dateTime('game_date_time');
            $table->string('venue_id')->nullable();
            $table->string('venue_name')->nullable();
            $table->string('venue_city')->nullable();
            $table->string('venue_state')->nullable();
            $table->string('venue_country')->nullable();
            $table->integer('venue_capacity')->nullable();
            $table->string('venue_surface')->nullable();
            $table->boolean('venue_indoor')->nullable();
            $table->string('status_id')->nullable();
            $table->string('status_name')->nullable();
            $table->string('status_type')->nullable();
            $table->string('status_abbreviation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wnba_games');
    }
};
