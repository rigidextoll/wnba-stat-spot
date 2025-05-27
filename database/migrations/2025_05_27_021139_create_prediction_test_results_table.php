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
        Schema::create('prediction_test_results', function (Blueprint $table) {
            $table->id();

            // Test identification
            $table->string('test_batch_id'); // Groups related tests together
            $table->string('test_type')->default('single'); // 'single', 'bulk', 'historical'

            // Player information
            $table->string('player_id'); // athlete_id from wnba_players
            $table->string('player_name');
            $table->string('player_position')->nullable();

            // Test parameters
            $table->string('stat_type'); // points, rebounds, assists, steals, blocks
            $table->integer('test_games'); // number of games tested
            $table->json('betting_lines'); // array of lines tested
            $table->decimal('season_average', 8, 2);

            // Results summary
            $table->integer('total_predictions');
            $table->integer('correct_predictions');
            $table->decimal('accuracy_percentage', 5, 2);
            $table->decimal('confidence_score', 5, 3)->nullable();

            // Detailed results
            $table->json('line_results'); // detailed results for each betting line
            $table->json('actual_game_results'); // actual game values tested
            $table->json('insights')->nullable(); // generated insights

            // Performance metrics
            $table->decimal('best_line_accuracy', 5, 2)->nullable();
            $table->decimal('worst_line_accuracy', 5, 2)->nullable();
            $table->decimal('average_line_accuracy', 5, 2)->nullable();
            $table->decimal('volatility_score', 5, 3)->nullable();

            // Metadata
            $table->integer('sample_size'); // number of historical games available
            $table->decimal('data_quality_score', 5, 3)->nullable();
            $table->timestamp('tested_at');
            $table->string('test_version')->default('1.0'); // for tracking model versions

            $table->timestamps();

            // Indexes for efficient querying
            $table->index(['player_id', 'stat_type']);
            $table->index(['stat_type', 'accuracy_percentage']);
            $table->index(['tested_at']);
            $table->index(['test_batch_id']);
            $table->index(['accuracy_percentage']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediction_test_results');
    }
};
