<?php

namespace App\Services\WNBA\Math;

class PoissonCalculator
{
    /**
     * Calculate Poisson probability for exact value
     */
    public function calculateProbability(float $lambda, int $k): float
    {
        if ($lambda <= 0 || $k < 0) {
            return 0;
        }

        return (pow($lambda, $k) * exp(-$lambda)) / $this->factorial($k);
    }

    /**
     * Calculate probability of getting over a threshold
     */
    public function calculateOverProbability(float $lambda, float $threshold): float
    {
        $underProbability = 0;
        $maxK = min(100, max(50, ceil($threshold + 5 * sqrt($lambda)))); // Reasonable upper bound

        for ($k = 0; $k <= floor($threshold); $k++) {
            $underProbability += $this->calculateProbability($lambda, $k);
        }

        return max(0, min(1, 1 - $underProbability));
    }

    /**
     * Calculate probability of getting under a threshold
     */
    public function calculateUnderProbability(float $lambda, float $threshold): float
    {
        return 1 - $this->calculateOverProbability($lambda, $threshold);
    }

    /**
     * Calculate probability of getting exactly a threshold (for whole numbers)
     */
    public function calculateExactProbability(float $lambda, int $value): float
    {
        return $this->calculateProbability($lambda, $value);
    }

    /**
     * Calculate probability of getting between two values (inclusive)
     */
    public function calculateBetweenProbability(float $lambda, int $lower, int $upper): float
    {
        if ($lower > $upper) {
            return 0;
        }

        $probability = 0;
        for ($k = $lower; $k <= $upper; $k++) {
            $probability += $this->calculateProbability($lambda, $k);
        }

        return $probability;
    }

    /**
     * Calculate cumulative distribution function (CDF)
     */
    public function calculateCDF(float $lambda, int $k): float
    {
        $cdf = 0;
        for ($i = 0; $i <= $k; $i++) {
            $cdf += $this->calculateProbability($lambda, $i);
        }

        return $cdf;
    }

    /**
     * Calculate the mean of Poisson distribution
     */
    public function getMean(float $lambda): float
    {
        return $lambda;
    }

    /**
     * Calculate the variance of Poisson distribution
     */
    public function getVariance(float $lambda): float
    {
        return $lambda;
    }

    /**
     * Calculate the standard deviation of Poisson distribution
     */
    public function getStandardDeviation(float $lambda): float
    {
        return sqrt($lambda);
    }

    /**
     * Calculate confidence interval for Poisson distribution
     */
    public function calculateConfidenceInterval(float $lambda, float $confidenceLevel = 0.95): array
    {
        $alpha = 1 - $confidenceLevel;
        $zScore = $this->getZScore($confidenceLevel);

        $margin = $zScore * sqrt($lambda);

        return [
            'lower' => max(0, $lambda - $margin),
            'upper' => $lambda + $margin,
            'confidence_level' => $confidenceLevel
        ];
    }

    /**
     * Generate probability distribution for a range of values
     */
    public function generateDistribution(float $lambda, int $maxValue = null): array
    {
        if ($maxValue === null) {
            $maxValue = min(50, ceil($lambda + 4 * sqrt($lambda)));
        }

        $distribution = [];
        for ($k = 0; $k <= $maxValue; $k++) {
            $distribution[$k] = $this->calculateProbability($lambda, $k);
        }

        return $distribution;
    }

    /**
     * Find the mode (most likely value) of Poisson distribution
     */
    public function getMode(float $lambda): int
    {
        return floor($lambda);
    }

    /**
     * Calculate percentiles for Poisson distribution
     */
    public function calculatePercentiles(float $lambda, array $percentiles = [0.1, 0.25, 0.5, 0.75, 0.9]): array
    {
        $results = [];
        $maxValue = ceil($lambda + 5 * sqrt($lambda));

        foreach ($percentiles as $percentile) {
            $results[($percentile * 100) . 'th'] = $this->findPercentile($lambda, $percentile, $maxValue);
        }

        return $results;
    }

    /**
     * Calculate the probability mass function for multiple values
     */
    public function calculatePMF(float $lambda, array $values): array
    {
        $pmf = [];
        foreach ($values as $value) {
            $pmf[$value] = $this->calculateProbability($lambda, $value);
        }

        return $pmf;
    }

    /**
     * Estimate lambda from observed data
     */
    public function estimateLambda(array $observations): float
    {
        if (empty($observations)) {
            return 0;
        }

        return array_sum($observations) / count($observations);
    }

    /**
     * Test goodness of fit for Poisson distribution
     */
    public function goodnessOfFit(array $observations, float $lambda = null): array
    {
        if (empty($observations)) {
            return ['chi_squared' => 0, 'p_value' => 0, 'fit_quality' => 'poor'];
        }

        if ($lambda === null) {
            $lambda = $this->estimateLambda($observations);
        }

        // Count frequencies
        $frequencies = array_count_values($observations);
        $maxValue = max(array_keys($frequencies));

        $chiSquared = 0;
        $totalObservations = count($observations);

        for ($k = 0; $k <= $maxValue; $k++) {
            $observed = $frequencies[$k] ?? 0;
            $expected = $this->calculateProbability($lambda, $k) * $totalObservations;

            if ($expected > 0) {
                $chiSquared += pow($observed - $expected, 2) / $expected;
            }
        }

        // Simplified p-value estimation
        $degreesOfFreedom = max(1, $maxValue - 1);
        $pValue = $this->estimatePValue($chiSquared, $degreesOfFreedom);

        $fitQuality = 'poor';
        if ($pValue > 0.05) {
            $fitQuality = 'good';
        } elseif ($pValue > 0.01) {
            $fitQuality = 'fair';
        }

        return [
            'chi_squared' => $chiSquared,
            'degrees_of_freedom' => $degreesOfFreedom,
            'p_value' => $pValue,
            'fit_quality' => $fitQuality,
            'estimated_lambda' => $lambda
        ];
    }

    /**
     * Calculate expected value for betting scenarios
     */
    public function calculateBettingExpectedValue(float $lambda, float $line, float $overOdds, float $underOdds, float $stake = 100): array
    {
        $overProbability = $this->calculateOverProbability($lambda, $line);
        $underProbability = 1 - $overProbability;

        // Convert American odds to decimal
        $overDecimal = $overOdds > 0 ? ($overOdds / 100) + 1 : (100 / abs($overOdds)) + 1;
        $underDecimal = $underOdds > 0 ? ($underOdds / 100) + 1 : (100 / abs($underOdds)) + 1;

        $overEV = ($overProbability * ($overDecimal - 1) * $stake) - ((1 - $overProbability) * $stake);
        $underEV = ($underProbability * ($underDecimal - 1) * $stake) - ((1 - $underProbability) * $stake);

        return [
            'over_probability' => $overProbability,
            'under_probability' => $underProbability,
            'over_expected_value' => round($overEV, 2),
            'under_expected_value' => round($underEV, 2),
            'best_bet' => $overEV > $underEV ? 'over' : 'under',
            'edge' => round(max($overEV, $underEV), 2)
        ];
    }

    /**
     * Simulate Poisson random variables
     */
    public function simulate(float $lambda, int $simulations = 1000): array
    {
        $results = [];

        for ($i = 0; $i < $simulations; $i++) {
            $results[] = $this->generatePoissonRandom($lambda);
        }

        return [
            'simulations' => $results,
            'mean' => array_sum($results) / count($results),
            'variance' => $this->calculateVariance($results),
            'distribution' => array_count_values($results)
        ];
    }

    // Private helper methods

    private function factorial(int $n): float
    {
        if ($n <= 1) return 1;
        if ($n > 170) return INF; // Prevent overflow

        // Use Stirling's approximation for large numbers
        if ($n > 20) {
            return sqrt(2 * M_PI * $n) * pow($n / M_E, $n);
        }

        $result = 1;
        for ($i = 2; $i <= $n; $i++) {
            $result *= $i;
        }

        return $result;
    }

    private function getZScore(float $confidenceLevel): float
    {
        $zScores = [
            0.90 => 1.645,
            0.95 => 1.96,
            0.99 => 2.576
        ];

        return $zScores[$confidenceLevel] ?? 1.96;
    }

    private function findPercentile(float $lambda, float $percentile, int $maxValue): int
    {
        $cumulativeProbability = 0;

        for ($k = 0; $k <= $maxValue; $k++) {
            $cumulativeProbability += $this->calculateProbability($lambda, $k);

            if ($cumulativeProbability >= $percentile) {
                return $k;
            }
        }

        return $maxValue;
    }

    private function estimatePValue(float $chiSquared, int $degreesOfFreedom): float
    {
        // Simplified p-value estimation using chi-squared distribution
        // This is a rough approximation - would need proper chi-squared tables for accuracy

        if ($chiSquared <= $degreesOfFreedom) {
            return 0.5; // Rough estimate for good fit
        }

        $ratio = $chiSquared / $degreesOfFreedom;

        if ($ratio > 3) return 0.001;
        if ($ratio > 2.5) return 0.01;
        if ($ratio > 2) return 0.05;
        if ($ratio > 1.5) return 0.1;

        return 0.2;
    }

    private function generatePoissonRandom(float $lambda): int
    {
        if ($lambda < 30) {
            // Use Knuth's algorithm for small lambda
            $L = exp(-$lambda);
            $k = 0;
            $p = 1;

            do {
                $k++;
                $p *= mt_rand() / mt_getrandmax();
            } while ($p > $L);

            return $k - 1;
        } else {
            // Use normal approximation for large lambda
            $u1 = mt_rand() / mt_getrandmax();
            $u2 = mt_rand() / mt_getrandmax();

            $z = sqrt(-2 * log($u1)) * cos(2 * M_PI * $u2);
            $value = $lambda + sqrt($lambda) * $z;

            return max(0, round($value));
        }
    }

    private function calculateVariance(array $values): float
    {
        if (empty($values)) return 0;

        $mean = array_sum($values) / count($values);
        $squaredDiffs = array_map(function($value) use ($mean) {
            return pow($value - $mean, 2);
        }, $values);

        return array_sum($squaredDiffs) / count($values);
    }
}
