<?php

namespace App\Services\WNBA\Predictions;

use Illuminate\Support\Facades\Cache;

class StatisticalEngineService
{
    /**
     * Update Bayesian probability with new evidence
     */
    public function updateBayesianProbability(float $prior, float $likelihood, float $evidence): float
    {
        if ($evidence <= 0) {
            return $prior;
        }

        $posterior = ($likelihood * $prior) / $evidence;
        return max(0, min(1, $posterior));
    }

    /**
     * Calculate Poisson probability for exact value
     */
    public function calculatePoissonProbability(float $lambda, int $k): float
    {
        if ($lambda <= 0 || $k < 0) {
            return 0;
        }

        return (pow($lambda, $k) * exp(-$lambda)) / $this->factorial($k);
    }

    /**
     * Calculate Poisson probability for over/under scenarios
     */
    public function calculatePoissonOverProbability(float $lambda, float $threshold): float
    {
        $underProbability = 0;
        $maxK = max(50, ceil($threshold + 5 * sqrt($lambda))); // Reasonable upper bound

        for ($k = 0; $k <= floor($threshold); $k++) {
            $underProbability += $this->calculatePoissonProbability($lambda, $k);
        }

        return 1 - $underProbability;
    }

    /**
     * Calculate normal distribution probability
     */
    public function calculateNormalProbability(float $mean, float $stdDev, float $value): float
    {
        if ($stdDev <= 0) {
            return $value == $mean ? 1.0 : 0.0;
        }

        $coefficient = 1 / ($stdDev * sqrt(2 * M_PI));
        $exponent = -0.5 * pow(($value - $mean) / $stdDev, 2);

        return $coefficient * exp($exponent);
    }

    /**
     * Calculate normal distribution CDF (cumulative distribution function)
     */
    public function calculateNormalCDF(float $mean, float $stdDev, float $value): float
    {
        if ($stdDev <= 0) {
            return $value >= $mean ? 1.0 : 0.0;
        }

        $zScore = ($value - $mean) / $stdDev;
        return $this->normalCDF($zScore);
    }

    /**
     * Run Monte Carlo simulation
     */
    public function runMonteCarloSimulation(array $playerData, int $iterations = 10000): array
    {
        $results = [];
        $mean = $playerData['mean'] ?? 0;
        $stdDev = $playerData['std_dev'] ?? 1;
        $distributionType = $playerData['distribution_type'] ?? 'normal';

        for ($i = 0; $i < $iterations; $i++) {
            switch ($distributionType) {
                case 'normal':
                    $value = $this->generateNormalRandom($mean, $stdDev);
                    break;
                case 'poisson':
                    $lambda = $playerData['lambda'] ?? $mean;
                    $value = $this->generatePoissonRandom($lambda);
                    break;
                case 'binomial':
                    $n = $playerData['n'] ?? 10;
                    $p = $playerData['p'] ?? 0.5;
                    $value = $this->generateBinomialRandom($n, $p);
                    break;
                default:
                    $value = $this->generateNormalRandom($mean, $stdDev);
            }

            $results[] = max(0, $value); // Ensure non-negative values
        }

        return $this->analyzeSimulationResults($results);
    }

    /**
     * Perform multiple regression analysis
     */
    public function performRegressionAnalysis(array $dependentVar, array $independentVars): array
    {
        $n = count($dependentVar);

        if ($n < 2 || empty($independentVars)) {
            return $this->getEmptyRegressionResult();
        }

        // Simple linear regression for single independent variable
        if (count($independentVars) === 1) {
            return $this->simpleLinearRegression($dependentVar, $independentVars[0]);
        }

        // Multiple regression (simplified implementation)
        return $this->multipleLinearRegression($dependentVar, $independentVars);
    }

    /**
     * Analyze performance trends using time series analysis
     */
    public function analyzePerformanceTrends(array $timeSeriesData): array
    {
        if (count($timeSeriesData) < 3) {
            return $this->getEmptyTrendAnalysis();
        }

        $values = array_column($timeSeriesData, 'value');
        $timestamps = array_column($timeSeriesData, 'timestamp');

        return [
            'linear_trend' => $this->calculateLinearTrend($values),
            'moving_average_5' => $this->calculateMovingAverage($values, 5),
            'moving_average_10' => $this->calculateMovingAverage($values, 10),
            'volatility' => $this->calculateVolatility($values),
            'momentum' => $this->calculateMomentum($values),
            'seasonal_patterns' => $this->detectSeasonalPatterns($timeSeriesData),
            'trend_strength' => $this->calculateTrendStrength($values),
            'change_points' => $this->detectChangePoints($values)
        ];
    }

    /**
     * Calculate correlation between two variables
     */
    public function calculateCorrelation(array $var1, array $var2): float
    {
        $n = min(count($var1), count($var2));

        if ($n < 2) {
            return 0;
        }

        // Trim arrays to same length
        $var1 = array_slice($var1, 0, $n);
        $var2 = array_slice($var2, 0, $n);

        $mean1 = array_sum($var1) / $n;
        $mean2 = array_sum($var2) / $n;

        $numerator = 0;
        $sum1Sq = 0;
        $sum2Sq = 0;

        for ($i = 0; $i < $n; $i++) {
            $diff1 = $var1[$i] - $mean1;
            $diff2 = $var2[$i] - $mean2;

            $numerator += $diff1 * $diff2;
            $sum1Sq += $diff1 * $diff1;
            $sum2Sq += $diff2 * $diff2;
        }

        $denominator = sqrt($sum1Sq * $sum2Sq);

        return $denominator > 0 ? $numerator / $denominator : 0;
    }

    /**
     * Calculate Z-score for value normalization
     */
    public function calculateZScore(float $value, float $mean, float $stdDev): float
    {
        return $stdDev > 0 ? ($value - $mean) / $stdDev : 0;
    }

    /**
     * Calculate confidence intervals
     */
    public function calculateConfidenceInterval(array $data, float $confidenceLevel = 0.95): array
    {
        if (empty($data)) {
            return ['lower' => 0, 'upper' => 0, 'margin_of_error' => 0];
        }

        $n = count($data);
        $mean = array_sum($data) / $n;
        $stdDev = $this->calculateStandardDeviation($data);
        $standardError = $stdDev / sqrt($n);

        // Use normal distribution for large samples (n > 30) or t-distribution for small samples
        $criticalValue = $n > 30 ? $this->getZCriticalValue($confidenceLevel) : $this->getTCriticalValue($confidenceLevel, $n - 1);

        $marginOfError = $criticalValue * $standardError;

        return [
            'lower' => $mean - $marginOfError,
            'upper' => $mean + $marginOfError,
            'margin_of_error' => $marginOfError,
            'confidence_level' => $confidenceLevel
        ];
    }

    /**
     * Detect outliers using IQR method
     */
    public function detectOutliers(array $data): array
    {
        if (count($data) < 4) {
            return ['outliers' => [], 'clean_data' => $data];
        }

        sort($data);
        $n = count($data);

        $q1Index = intval($n * 0.25);
        $q3Index = intval($n * 0.75);

        $q1 = $data[$q1Index];
        $q3 = $data[$q3Index];
        $iqr = $q3 - $q1;

        $lowerBound = $q1 - (1.5 * $iqr);
        $upperBound = $q3 + (1.5 * $iqr);

        $outliers = [];
        $cleanData = [];

        foreach ($data as $value) {
            if ($value < $lowerBound || $value > $upperBound) {
                $outliers[] = $value;
            } else {
                $cleanData[] = $value;
            }
        }

        return [
            'outliers' => $outliers,
            'clean_data' => $cleanData,
            'q1' => $q1,
            'q3' => $q3,
            'iqr' => $iqr,
            'lower_bound' => $lowerBound,
            'upper_bound' => $upperBound
        ];
    }

    /**
     * Calculate weighted average with custom weights
     */
    public function calculateWeightedAverage(array $values, array $weights): float
    {
        if (count($values) !== count($weights) || empty($values)) {
            return 0;
        }

        $weightedSum = 0;
        $totalWeight = 0;

        for ($i = 0; $i < count($values); $i++) {
            $weightedSum += $values[$i] * $weights[$i];
            $totalWeight += $weights[$i];
        }

        return $totalWeight > 0 ? $weightedSum / $totalWeight : 0;
    }

    /**
     * Calculate exponentially weighted moving average
     */
    public function calculateEWMA(array $values, float $alpha = 0.3): array
    {
        if (empty($values)) {
            return [];
        }

        $ewma = [$values[0]];

        for ($i = 1; $i < count($values); $i++) {
            $ewma[] = $alpha * $values[$i] + (1 - $alpha) * $ewma[$i - 1];
        }

        return $ewma;
    }

    // Private helper methods

    private function factorial(int $n): float
    {
        if ($n <= 1) return 1;
        if ($n > 170) return INF; // Prevent overflow

        $result = 1;
        for ($i = 2; $i <= $n; $i++) {
            $result *= $i;
        }

        return $result;
    }

    private function normalCDF(float $z): float
    {
        return 0.5 * (1 + $this->erf($z / sqrt(2)));
    }

    private function erf(float $x): float
    {
        // Abramowitz and Stegun approximation
        $a1 =  0.254829592;
        $a2 = -0.284496736;
        $a3 =  1.421413741;
        $a4 = -1.453152027;
        $a5 =  1.061405429;
        $p  =  0.3275911;

        $sign = $x < 0 ? -1 : 1;
        $x = abs($x);

        $t = 1.0 / (1.0 + $p * $x);
        $y = 1.0 - ((((($a5 * $t + $a4) * $t) + $a3) * $t + $a2) * $t + $a1) * $t * exp(-$x * $x);

        return $sign * $y;
    }

    private function generateNormalRandom(float $mean, float $stdDev): float
    {
        static $hasSpare = false;
        static $spare;

        if ($hasSpare) {
            $hasSpare = false;
            return $spare * $stdDev + $mean;
        }

        $hasSpare = true;
        $u = mt_rand() / mt_getrandmax();
        $v = mt_rand() / mt_getrandmax();

        $mag = $stdDev * sqrt(-2.0 * log($u));
        $spare = $mag * cos(2.0 * M_PI * $v);

        return $mag * sin(2.0 * M_PI * $v) + $mean;
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
            return max(0, round($this->generateNormalRandom($lambda, sqrt($lambda))));
        }
    }

    private function generateBinomialRandom(int $n, float $p): int
    {
        $successes = 0;

        for ($i = 0; $i < $n; $i++) {
            if (mt_rand() / mt_getrandmax() < $p) {
                $successes++;
            }
        }

        return $successes;
    }

    private function analyzeSimulationResults(array $results): array
    {
        sort($results);
        $n = count($results);

        return [
            'mean' => array_sum($results) / $n,
            'median' => $results[intval($n / 2)],
            'std_dev' => $this->calculateStandardDeviation($results),
            'min' => min($results),
            'max' => max($results),
            'percentiles' => [
                '5th' => $results[intval($n * 0.05)],
                '10th' => $results[intval($n * 0.10)],
                '25th' => $results[intval($n * 0.25)],
                '75th' => $results[intval($n * 0.75)],
                '90th' => $results[intval($n * 0.90)],
                '95th' => $results[intval($n * 0.95)]
            ],
            'distribution_shape' => $this->analyzeDistributionShape($results)
        ];
    }

    private function calculateStandardDeviation(array $values): float
    {
        if (empty($values)) return 0;

        $mean = array_sum($values) / count($values);
        $squaredDiffs = array_map(function($value) use ($mean) {
            return pow($value - $mean, 2);
        }, $values);

        $variance = array_sum($squaredDiffs) / count($values);
        return sqrt($variance);
    }

    private function simpleLinearRegression(array $y, array $x): array
    {
        $n = count($y);
        $sumX = array_sum($x);
        $sumY = array_sum($y);
        $sumXY = 0;
        $sumX2 = 0;

        for ($i = 0; $i < $n; $i++) {
            $sumXY += $x[$i] * $y[$i];
            $sumX2 += $x[$i] * $x[$i];
        }

        $slope = ($n * $sumXY - $sumX * $sumY) / ($n * $sumX2 - $sumX * $sumX);
        $intercept = ($sumY - $slope * $sumX) / $n;

        // Calculate R-squared
        $meanY = $sumY / $n;
        $ssTotal = 0;
        $ssResidual = 0;

        for ($i = 0; $i < $n; $i++) {
            $predicted = $slope * $x[$i] + $intercept;
            $ssTotal += pow($y[$i] - $meanY, 2);
            $ssResidual += pow($y[$i] - $predicted, 2);
        }

        $rSquared = $ssTotal > 0 ? 1 - ($ssResidual / $ssTotal) : 0;

        return [
            'slope' => $slope,
            'intercept' => $intercept,
            'r_squared' => $rSquared,
            'correlation' => sqrt($rSquared) * ($slope > 0 ? 1 : -1)
        ];
    }

    private function multipleLinearRegression(array $y, array $independentVars): array
    {
        // Simplified multiple regression - would need matrix operations for full implementation
        $correlations = [];
        $rSquaredSum = 0;

        foreach ($independentVars as $index => $x) {
            $regression = $this->simpleLinearRegression($y, $x);
            $correlations["var_$index"] = $regression;
            $rSquaredSum += $regression['r_squared'];
        }

        return [
            'individual_regressions' => $correlations,
            'combined_r_squared_estimate' => min(1.0, $rSquaredSum / count($independentVars)),
            'note' => 'Simplified multiple regression - individual correlations shown'
        ];
    }

    private function calculateLinearTrend(array $values): array
    {
        $n = count($values);
        if ($n < 2) return ['slope' => 0, 'direction' => 'flat'];

        $x = range(1, $n);
        $regression = $this->simpleLinearRegression($values, $x);

        $direction = 'flat';
        if (abs($regression['slope']) > 0.1) {
            $direction = $regression['slope'] > 0 ? 'increasing' : 'decreasing';
        }

        return [
            'slope' => $regression['slope'],
            'direction' => $direction,
            'strength' => abs($regression['correlation'])
        ];
    }

    private function calculateMovingAverage(array $values, int $window): array
    {
        if ($window <= 0 || $window > count($values)) {
            return $values;
        }

        $movingAverages = [];

        for ($i = $window - 1; $i < count($values); $i++) {
            $sum = 0;
            for ($j = $i - $window + 1; $j <= $i; $j++) {
                $sum += $values[$j];
            }
            $movingAverages[] = $sum / $window;
        }

        return $movingAverages;
    }

    private function calculateVolatility(array $values): float
    {
        if (count($values) < 2) return 0;

        $returns = [];
        for ($i = 1; $i < count($values); $i++) {
            if ($values[$i - 1] != 0) {
                $returns[] = ($values[$i] - $values[$i - 1]) / $values[$i - 1];
            }
        }

        return $this->calculateStandardDeviation($returns);
    }

    private function calculateMomentum(array $values): float
    {
        $n = count($values);
        if ($n < 5) return 0;

        $recent = array_slice($values, -5);
        $earlier = array_slice($values, -10, 5);

        if (empty($earlier)) return 0;

        $recentAvg = array_sum($recent) / count($recent);
        $earlierAvg = array_sum($earlier) / count($earlier);

        return $earlierAvg > 0 ? ($recentAvg - $earlierAvg) / $earlierAvg : 0;
    }

    private function detectSeasonalPatterns(array $timeSeriesData): array
    {
        // Simplified seasonal pattern detection
        $patterns = [];
        $values = array_column($timeSeriesData, 'value');

        // Check for weekly patterns (if we have enough data)
        if (count($values) >= 14) {
            $weeklyPattern = $this->calculateWeeklyPattern($timeSeriesData);
            $patterns['weekly'] = $weeklyPattern;
        }

        return $patterns;
    }

    private function calculateWeeklyPattern(array $timeSeriesData): array
    {
        $dayOfWeekAverages = array_fill(0, 7, []);

        foreach ($timeSeriesData as $dataPoint) {
            $dayOfWeek = date('w', strtotime($dataPoint['timestamp']));
            $dayOfWeekAverages[$dayOfWeek][] = $dataPoint['value'];
        }

        $pattern = [];
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        for ($i = 0; $i < 7; $i++) {
            $pattern[$days[$i]] = !empty($dayOfWeekAverages[$i]) ?
                array_sum($dayOfWeekAverages[$i]) / count($dayOfWeekAverages[$i]) : 0;
        }

        return $pattern;
    }

    private function calculateTrendStrength(array $values): float
    {
        $trend = $this->calculateLinearTrend($values);
        return abs($trend['slope']) * $trend['strength'];
    }

    private function detectChangePoints(array $values): array
    {
        // Simplified change point detection using moving averages
        $changePoints = [];
        $window = max(3, intval(count($values) / 10));

        if (count($values) < $window * 2) {
            return $changePoints;
        }

        $movingAvg = $this->calculateMovingAverage($values, $window);

        for ($i = 1; $i < count($movingAvg); $i++) {
            $change = abs($movingAvg[$i] - $movingAvg[$i - 1]);
            $threshold = $this->calculateStandardDeviation($movingAvg) * 1.5;

            if ($change > $threshold) {
                $changePoints[] = [
                    'index' => $i + $window - 1,
                    'magnitude' => $change,
                    'direction' => $movingAvg[$i] > $movingAvg[$i - 1] ? 'increase' : 'decrease'
                ];
            }
        }

        return $changePoints;
    }

    private function analyzeDistributionShape(array $values): array
    {
        $mean = array_sum($values) / count($values);
        $median = $values[intval(count($values) / 2)];
        $stdDev = $this->calculateStandardDeviation($values);

        // Calculate skewness
        $skewness = $this->calculateSkewness($values, $mean, $stdDev);

        // Calculate kurtosis
        $kurtosis = $this->calculateKurtosis($values, $mean, $stdDev);

        return [
            'skewness' => $skewness,
            'kurtosis' => $kurtosis,
            'symmetry' => abs($skewness) < 0.5 ? 'symmetric' : ($skewness > 0 ? 'right_skewed' : 'left_skewed'),
            'tail_heaviness' => $kurtosis > 3 ? 'heavy_tailed' : ($kurtosis < 3 ? 'light_tailed' : 'normal_tailed')
        ];
    }

    private function calculateSkewness(array $values, float $mean, float $stdDev): float
    {
        if ($stdDev == 0) return 0;

        $n = count($values);
        $sum = 0;

        foreach ($values as $value) {
            $sum += pow(($value - $mean) / $stdDev, 3);
        }

        return $sum / $n;
    }

    private function calculateKurtosis(array $values, float $mean, float $stdDev): float
    {
        if ($stdDev == 0) return 0;

        $n = count($values);
        $sum = 0;

        foreach ($values as $value) {
            $sum += pow(($value - $mean) / $stdDev, 4);
        }

        return $sum / $n;
    }

    private function getZCriticalValue(float $confidenceLevel): float
    {
        // Common critical values for normal distribution
        $criticalValues = [
            0.90 => 1.645,
            0.95 => 1.96,
            0.99 => 2.576
        ];

        return $criticalValues[$confidenceLevel] ?? 1.96;
    }

    private function getTCriticalValue(float $confidenceLevel, int $degreesOfFreedom): float
    {
        // Simplified t-distribution critical values (would need full t-table for precision)
        $alpha = 1 - $confidenceLevel;

        if ($degreesOfFreedom >= 30) {
            return $this->getZCriticalValue($confidenceLevel);
        }

        // Approximate t-values for common confidence levels and small df
        $tValues = [
            0.95 => [1 => 12.706, 2 => 4.303, 3 => 3.182, 4 => 2.776, 5 => 2.571, 10 => 2.228, 20 => 2.086],
            0.99 => [1 => 63.657, 2 => 9.925, 3 => 5.841, 4 => 4.604, 5 => 4.032, 10 => 3.169, 20 => 2.845]
        ];

        return $tValues[$confidenceLevel][$degreesOfFreedom] ?? $this->getZCriticalValue($confidenceLevel);
    }

    private function getEmptyRegressionResult(): array
    {
        return [
            'slope' => 0,
            'intercept' => 0,
            'r_squared' => 0,
            'correlation' => 0,
            'error' => 'Insufficient data for regression analysis'
        ];
    }

    private function getEmptyTrendAnalysis(): array
    {
        return [
            'linear_trend' => ['slope' => 0, 'direction' => 'flat', 'strength' => 0],
            'moving_average_5' => [],
            'moving_average_10' => [],
            'volatility' => 0,
            'momentum' => 0,
            'seasonal_patterns' => [],
            'trend_strength' => 0,
            'change_points' => []
        ];
    }
}
