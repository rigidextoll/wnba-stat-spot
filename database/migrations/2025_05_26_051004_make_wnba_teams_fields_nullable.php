<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('wnba_teams', function (Blueprint $table) {
            $table->string('team_uid')->nullable()->change();
            $table->string('team_slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wnba_teams', function (Blueprint $table) {
            $table->string('team_uid')->nullable(false)->change();
            $table->string('team_slug')->nullable(false)->change();
        });
    }
};
