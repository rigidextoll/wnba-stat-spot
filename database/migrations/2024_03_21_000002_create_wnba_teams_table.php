<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wnba_teams', function (Blueprint $table) {
            $table->id();
            $table->string('team_id')->unique();
            $table->string('team_name');
            $table->string('team_location');
            $table->string('team_abbreviation');
            $table->string('team_display_name');
            $table->string('team_uid');
            $table->string('team_slug');
            $table->string('team_logo')->nullable();
            $table->string('team_color')->nullable();
            $table->string('team_alternate_color')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wnba_teams');
    }
};
