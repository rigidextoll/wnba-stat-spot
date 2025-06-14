<?php

namespace App\Services\WNBA\Predictions;

use Illuminate\Support\Facades\Log;

class BettingRecommendationService
{
    private PredictionEngine $predictionEngine;

    public function __construct(PredictionEngine $predictionEngine)
    {
        $this->predictionEngine = $predictionEngine;
    }

    /**
     * Ensure value is positive and rounded to nearest .5 increment
     */
    private function ensurePositiveAndRoundToHalf(float $value): float
    {
        // Ensure positive value (minimum 0.5)
        $positiveValue = max(0.5, abs($value));

        // Round to nearest .5 increment
        return round($positiveValue * 2) / 2;
    }

    /**
     * Get betting recommendation for a specific prop
     */
    public function getRecommendation(
        int $playerId,
        string $statType,
        float $line,
        float $oddsOver,
        float $oddsUnder,
        ?int $gameId = null,
        ?int $season = null
    ): array {
        try {
            // Use a mock game ID if none provided
            $gameId = $gameId ?? 1;

            // Get prediction for the stat
            $prediction = $this->predictionEngine->predict($statType, $playerId, $gameId, $line);

            if (empty($prediction['probabilities'])) {
                return $this->getEmptyRecommendation($playerId, $statType, $line, $oddsOver, $oddsUnder);
            }

            $predictedValue = $prediction['prediction']['adjusted_value'];
            $confidence = $prediction['prediction']['confidence'];
            $overProbability = $prediction['probabilities']['over'];
            $underProbability = $prediction['probabilities']['under'];

            // Convert American odds to decimal
            $decimalOddsOver = $this->convertAmericanToDecimal($oddsOver);
            $decimalOddsUnder = $this->convertAmericanToDecimal($oddsUnder);

            // Calculate expected values
            $evOver = $this->calculateExpectedValue($overProbability, $decimalOddsOver);
            $evUnder = $this->calculateExpectedValue($underProbability, $decimalOddsUnder);

            // Determine recommendation
            $recommendation = $this->determineRecommendation($confidence, $evOver, $evUnder, $predictedValue, $line);

            return [
                'player_id' => $playerId,
                'stat_type' => $statType,
                'line' => $line,
                'predicted_value' => $this->ensurePositiveAndRoundToHalf($predictedValue),
                'confidence' => $confidence,
                'over_probability' => $overProbability,
                'under_probability' => $underProbability,
                'odds_over' => $oddsOver,
                'odds_under' => $oddsUnder,
                'expected_value_over' => $evOver,
                'expected_value_under' => $evUnder,
                'recommendation' => $recommendation['action'],
                'reasoning' => $this->getRecommendationReasoning($recommendation['action'], $confidence, $evOver, $evUnder),
                'timestamp' => now()->toISOString()
            ];

        } catch (\Exception $e) {
            Log::error('Error generating betting recommendation', [
                'player_id' => $playerId,
                'stat_type' => $statType,
                'line' => $line,
                'error' => $e->getMessage()
            ]);

            return $this->getEmptyRecommendation($playerId, $statType, $line, $oddsOver, $oddsUnder);
        }
    }

    /**
     * Convert American odds to decimal
     */
    private function convertAmericanToDecimal(float $americanOdds): float
    {
        return $americanOdds > 0 ? ($americanOdds / 100) + 1 : (100 / abs($americanOdds)) + 1;
    }

    /**
     * Calculate expected value
     */
    private function calculateExpectedValue(float $probability, float $decimalOdds): float
    {
        return ($probability * ($decimalOdds - 1)) - ((1 - $probability) * 1);
    }

    /**
     * Determine betting recommendation
     */
    private function determineRecommendation(
        float $confidence,
        float $evOver,
        float $evUnder,
        float $predictedValue,
        float $line
    ): array {
        // Reduced thresholds for more realistic recommendations
        $minConfidence = 0.55; // Was 0.7 (70%) - now 55% for more reasonable filtering
        $minEdge = 0.02; // Was 0.05 (5%) - now 2% for more realistic edge detection

        if ($confidence < $minConfidence) {
            return [
                'action' => 'avoid',
                'reasoning' => 'Insufficient confidence in prediction'
            ];
        }

        // Check for significant directional edge (prediction vs line difference)
        $predictionDifference = abs($predictedValue - $line);
        $significantDifference = $predictionDifference > ($line * 0.1); // 10% difference threshold

        // If we have a strong directional prediction, lower the EV requirement
        $adjustedMinEdge = $significantDifference ? max(0.01, $minEdge * 0.5) : $minEdge;

        if ($evOver > $adjustedMinEdge) {
            return [
                'action' => 'over',
                'reasoning' => sprintf(
                    'Strong edge on over: %.1f predicted vs %.1f line (EV: %.1f%%)',
                    $predictedValue,
                    $line,
                    $evOver * 100
                )
            ];
        }

        if ($evUnder > $adjustedMinEdge) {
            return [
                'action' => 'under',
                'reasoning' => sprintf(
                    'Strong edge on under: %.1f predicted vs %.1f line (EV: %.1f%%)',
                    $predictedValue,
                    $line,
                    $evUnder * 100
                )
            ];
        }

        // If we have high confidence but low EV, still consider direction
        if ($confidence >= 0.65 && $significantDifference) {
            if ($predictedValue > $line && $evOver > -0.02) {
                return [
                    'action' => 'over',
                    'reasoning' => sprintf(
                        'High confidence directional play: %.1f predicted vs %.1f line',
                        $predictedValue,
                        $line
                    )
                ];
            }

            if ($predictedValue < $line && $evUnder > -0.02) {
                return [
                    'action' => 'under',
                    'reasoning' => sprintf(
                        'High confidence directional play: %.1f predicted vs %.1f line',
                        $predictedValue,
                        $line
                    )
                ];
            }
        }

        return [
            'action' => 'avoid',
            'reasoning' => 'No significant edge detected'
        ];
    }

    /**
     * Get empty recommendation
     */
    private function getEmptyRecommendation(
        int $playerId,
        string $statType,
        float $line,
        float $oddsOver,
        float $oddsUnder,
        ?string $error = null
    ): array {
        return [
            'player_id' => $playerId,
            'stat_type' => $statType,
            'line' => $line,
            'predicted_value' => $line,
            'confidence' => 0.5,
            'over_probability' => 0.5,
            'under_probability' => 0.5,
            'expected_value_over' => 0,
            'expected_value_under' => 0,
            'recommendation' => 'avoid',
            'reasoning' => $error ?? 'Insufficient data for reliable prediction',
            'odds' => [
                'over' => $oddsOver,
                'under' => $oddsUnder
            ],
            'generated_at' => now()->toISOString()
        ];
    }

    private function getRecommendationReasoning(string $action, float $confidence, float $evOver, float $evUnder): string
    {
        switch ($action) {
            case 'over':
                return "Recommend OVER based on {$confidence}% confidence and positive expected value of {$evOver}%";
            case 'under':
                return "Recommend UNDER based on {$confidence}% confidence and positive expected value of {$evUnder}%";
            case 'avoid':
                return "Avoid this bet due to low confidence ({$confidence}%) or negative expected values";
            default:
                return "No clear recommendation available";
        }
    }
}
