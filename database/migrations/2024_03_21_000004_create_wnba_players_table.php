<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wnba_players', function (Blueprint $table) {
            $table->id();
            $table->string('athlete_id')->unique();
            $table->string('athlete_display_name');
            $table->string('athlete_short_name');
            $table->string('athlete_jersey')->nullable();
            $table->string('athlete_headshot_href')->nullable();
            $table->string('athlete_position_name')->nullable();
            $table->string('athlete_position_abbreviation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wnba_players');
    }
};
