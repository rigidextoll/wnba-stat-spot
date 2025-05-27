<?php

namespace App\Services\WNBA\Math;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class RegressionAnalyzer
{
    private const CACHE_TTL = 3600; // 1 hour
    private const MIN_SAMPLE_SIZE = 10;

    /**
     * Perform simple linear regression analysis
     */
    public function simpleLinearRegression(array $xValues, array $yValues): array
    {
        try {
            if (count($xValues) !== count($yValues) || count($xValues) < self::MIN_SAMPLE_SIZE) {
                return $this->getEmptyRegressionResult();
            }

            $n = count($xValues);
            $sumX = array_sum($xValues);
            $sumY = array_sum($yValues);
            $sumXY = 0;
            $sumX2 = 0;
            $sumY2 = 0;

            for ($i = 0; $i < $n; $i++) {
                $sumXY += $xValues[$i] * $yValues[$i];
                $sumX2 += $xValues[$i] * $xValues[$i];
                $sumY2 += $yValues[$i] * $yValues[$i];
            }

            $denominator = $n * $sumX2 - $sumX * $sumX;
            if ($denominator == 0) {
                return $this->getEmptyRegressionResult();
            }

            $slope = ($n * $sumXY - $sumX * $sumY) / $denominator;
            $intercept = ($sumY - $slope * $sumX) / $n;

            // Calculate R-squared
            $meanY = $sumY / $n;
            $ssTotal = 0;
            $ssResidual = 0;
            $residuals = [];
            $predictions = [];

            for ($i = 0; $i < $n; $i++) {
                $predicted = $slope * $xValues[$i] + $intercept;
                $predictions[] = $predicted;
                $residual = $yValues[$i] - $predicted;
                $residuals[] = $residual;

                $ssTotal += pow($yValues[$i] - $meanY, 2);
                $ssResidual += $residual * $residual;
            }

            $rSquared = $ssTotal > 0 ? 1 - ($ssResidual / $ssTotal) : 0;
            $correlation = sqrt($rSquared) * ($slope > 0 ? 1 : -1);

            // Calculate standard error
            $standardError = sqrt($ssResidual / ($n - 2));

            return [
                'slope' => $slope,
                'intercept' => $intercept,
                'r_squared' => $rSquared,
                'correlation' => $correlation,
                'standard_error' => $standardError,
                'residuals' => $residuals,
                'predictions' => $predictions,
                'sample_size' => $n,
                'residual_analysis' => $this->analyzeResiduals($residuals),
                'confidence_intervals' => $this->calculateConfidenceIntervals($slope, $intercept, $standardError, $n),
                'significance_tests' => $this->performSignificanceTests($slope, $intercept, $standardError, $n),
                'equation' => "y = {$slope}x + {$intercept}",
                'model_diagnostics' => $this->performModelDiagnostics($residuals, $predictions)
            ];

        } catch (\Exception $e) {
            Log::error('Simple linear regression failed: ' . $e->getMessage());
            return $this->getEmptyRegressionResult();
        }
    }

    /**
     * Perform multiple linear regression analysis
     */
    public function multipleLinearRegression(array $xMatrix, array $yValues): array
    {
        try {
            $n = count($yValues);
            $p = count($xMatrix[0]) ?? 0;

            if ($n < self::MIN_SAMPLE_SIZE || $p == 0 || count($xMatrix) !== $n) {
                return $this->getEmptyRegressionResult();
            }

            // Add intercept column (column of 1s)
            $designMatrix = [];
            for ($i = 0; $i < $n; $i++) {
                $designMatrix[$i] = array_merge([1], $xMatrix[$i]);
            }

            // Calculate coefficients using normal equation: β = (X'X)^(-1)X'y
            $xTranspose = $this->transposeMatrix($designMatrix);
            $xTx = $this->multiplyMatrices($xTranspose, $designMatrix);
            $xTxInverse = $this->invertMatrix($xTx);

            if ($xTxInverse === null) {
                return $this->getEmptyRegressionResult();
            }

            $xTy = $this->multiplyMatrixVector($xTranspose, $yValues);
            $coefficients = $this->multiplyMatrixVector($xTxInverse, $xTy);

            // Calculate predictions and residuals
            $predictions = [];
            $residuals = [];
            $ssTotal = 0;
            $ssResidual = 0;
            $meanY = array_sum($yValues) / $n;

            for ($i = 0; $i < $n; $i++) {
                $predicted = $coefficients[0]; // intercept
                for ($j = 0; $j < $p; $j++) {
                    $predicted += $coefficients[$j + 1] * $xMatrix[$i][$j];
                }

                $predictions[] = $predicted;
                $residual = $yValues[$i] - $predicted;
                $residuals[] = $residual;

                $ssTotal += pow($yValues[$i] - $meanY, 2);
                $ssResidual += $residual * $residual;
            }

            $rSquared = $ssTotal > 0 ? 1 - ($ssResidual / $ssTotal) : 0;
            $adjustedRSquared = 1 - ((1 - $rSquared) * ($n - 1) / ($n - $p - 1));

            // Calculate standard errors
            $mse = $ssResidual / ($n - $p - 1);
            $standardErrors = [];
            for ($i = 0; $i <= $p; $i++) {
                $standardErrors[] = sqrt($mse * $xTxInverse[$i][$i]);
            }

            return [
                'coefficients' => $coefficients,
                'intercept' => $coefficients[0],
                'slopes' => array_slice($coefficients, 1),
                'r_squared' => $rSquared,
                'adjusted_r_squared' => $adjustedRSquared,
                'standard_errors' => $standardErrors,
                'residuals' => $residuals,
                'predictions' => $predictions,
                'sample_size' => $n,
                'num_predictors' => $p,
                't_statistics' => $this->calculateTStatistics($coefficients, $standardErrors),
                'p_values' => $this->calculatePValues($coefficients, $standardErrors, $n - $p - 1),
                'f_statistic' => $this->calculateFStatistic($rSquared, $n, $p),
                'residual_analysis' => $this->analyzeResiduals($residuals),
                'model_diagnostics' => $this->performModelDiagnostics($residuals, $predictions)
            ];

        } catch (\Exception $e) {
            Log::error('Multiple linear regression failed: ' . $e->getMessage());
            return $this->getEmptyRegressionResult();
        }
    }

    /**
     * Perform polynomial regression
     */
    public function polynomialRegression(array $xValues, array $yValues, int $degree = 2): array
    {
        try {
            if (count($xValues) !== count($yValues) || count($xValues) < self::MIN_SAMPLE_SIZE || $degree < 1) {
                return $this->getEmptyRegressionResult();
            }

            $n = count($xValues);

            // Create polynomial features matrix
            $xMatrix = [];
            for ($i = 0; $i < $n; $i++) {
                $row = [];
                for ($j = 1; $j <= $degree; $j++) {
                    $row[] = pow($xValues[$i], $j);
                }
                $xMatrix[] = $row;
            }

            // Use multiple regression for polynomial
            $result = $this->multipleLinearRegression($xMatrix, $yValues);

            if (!empty($result['coefficients'])) {
                $result['degree'] = $degree;
                $result['polynomial_equation'] = $this->formatPolynomialEquation($result['coefficients'], $degree);
            }

            return $result;

        } catch (\Exception $e) {
            Log::error('Polynomial regression failed: ' . $e->getMessage());
            return $this->getEmptyRegressionResult();
        }
    }

    /**
     * Perform logistic regression for binary outcomes
     */
    public function logisticRegression(array $xMatrix, array $yValues, int $maxIterations = 100): array
    {
        try {
            $n = count($yValues);
            $p = count($xMatrix[0]) ?? 0;

            if ($n < self::MIN_SAMPLE_SIZE || $p == 0) {
                return $this->getEmptyRegressionResult();
            }

            // Initialize coefficients
            $coefficients = array_fill(0, $p + 1, 0.0);
            $learningRate = 0.01;
            $tolerance = 1e-6;

            // Add intercept column
            $designMatrix = [];
            for ($i = 0; $i < $n; $i++) {
                $designMatrix[$i] = array_merge([1], $xMatrix[$i]);
            }

            // Newton-Raphson iteration
            for ($iteration = 0; $iteration < $maxIterations; $iteration++) {
                $predictions = [];
                $gradient = array_fill(0, $p + 1, 0.0);
                $hessian = array_fill(0, $p + 1, array_fill(0, $p + 1, 0.0));

                // Calculate predictions and gradients
                for ($i = 0; $i < $n; $i++) {
                    $linearCombination = 0;
                    for ($j = 0; $j <= $p; $j++) {
                        $linearCombination += $coefficients[$j] * $designMatrix[$i][$j];
                    }

                    $probability = 1 / (1 + exp(-$linearCombination));
                    $predictions[] = $probability;

                    $error = $yValues[$i] - $probability;

                    // Update gradient
                    for ($j = 0; $j <= $p; $j++) {
                        $gradient[$j] += $error * $designMatrix[$i][$j];
                    }

                    // Update Hessian
                    for ($j = 0; $j <= $p; $j++) {
                        for ($k = 0; $k <= $p; $k++) {
                            $hessian[$j][$k] -= $probability * (1 - $probability) *
                                               $designMatrix[$i][$j] * $designMatrix[$i][$k];
                        }
                    }
                }

                // Update coefficients
                $hessianInverse = $this->invertMatrix($hessian);
                if ($hessianInverse === null) {
                    break;
                }

                $update = $this->multiplyMatrixVector($hessianInverse, $gradient);
                $maxChange = 0;

                for ($j = 0; $j <= $p; $j++) {
                    $coefficients[$j] += $update[$j];
                    $maxChange = max($maxChange, abs($update[$j]));
                }

                if ($maxChange < $tolerance) {
                    break;
                }
            }

            // Calculate final predictions and metrics
            $finalPredictions = [];
            $binaryPredictions = [];
            $logLikelihood = 0;

            for ($i = 0; $i < $n; $i++) {
                $linearCombination = 0;
                for ($j = 0; $j <= $p; $j++) {
                    $linearCombination += $coefficients[$j] * $designMatrix[$i][$j];
                }

                $probability = 1 / (1 + exp(-$linearCombination));
                $finalPredictions[] = $probability;
                $binaryPredictions[] = $probability > 0.5 ? 1 : 0;

                // Log-likelihood
                $logLikelihood += $yValues[$i] * log($probability + 1e-15) +
                                 (1 - $yValues[$i]) * log(1 - $probability + 1e-15);
            }

            return [
                'coefficients' => $coefficients,
                'intercept' => $coefficients[0],
                'slopes' => array_slice($coefficients, 1),
                'predictions' => $finalPredictions,
                'binary_predictions' => $binaryPredictions,
                'log_likelihood' => $logLikelihood,
                'iterations' => min($iteration + 1, $maxIterations),
                'converged' => $iteration < $maxIterations,
                'classification_metrics' => $this->calculateClassificationMetrics($yValues, $binaryPredictions),
                'sample_size' => $n,
                'num_predictors' => $p
            ];

        } catch (\Exception $e) {
            Log::error('Logistic regression failed: ' . $e->getMessage());
            return $this->getEmptyRegressionResult();
        }
    }

    /**
     * Perform ridge regression with L2 regularization
     */
    public function ridgeRegression(array $xMatrix, array $yValues, float $lambda = 1.0): array
    {
        try {
            $n = count($yValues);
            $p = count($xMatrix[0]) ?? 0;

            if ($n < self::MIN_SAMPLE_SIZE || $p == 0) {
                return $this->getEmptyRegressionResult();
            }

            // Add intercept column
            $designMatrix = [];
            for ($i = 0; $i < $n; $i++) {
                $designMatrix[$i] = array_merge([1], $xMatrix[$i]);
            }

            // Calculate coefficients: β = (X'X + λI)^(-1)X'y
            $xTranspose = $this->transposeMatrix($designMatrix);
            $xTx = $this->multiplyMatrices($xTranspose, $designMatrix);

            // Add ridge penalty (don't penalize intercept)
            for ($i = 1; $i <= $p; $i++) {
                $xTx[$i][$i] += $lambda;
            }

            $xTxInverse = $this->invertMatrix($xTx);
            if ($xTxInverse === null) {
                return $this->getEmptyRegressionResult();
            }

            $xTy = $this->multiplyMatrixVector($xTranspose, $yValues);
            $coefficients = $this->multiplyMatrixVector($xTxInverse, $xTy);

            // Calculate predictions and metrics
            $predictions = $this->makePredictions($designMatrix, $coefficients);
            $residuals = [];
            $ssTotal = 0;
            $ssResidual = 0;
            $meanY = array_sum($yValues) / $n;

            for ($i = 0; $i < $n; $i++) {
                $residual = $yValues[$i] - $predictions[$i];
                $residuals[] = $residual;
                $ssTotal += pow($yValues[$i] - $meanY, 2);
                $ssResidual += $residual * $residual;
            }

            $rSquared = $ssTotal > 0 ? 1 - ($ssResidual / $ssTotal) : 0;

            return [
                'coefficients' => $coefficients,
                'intercept' => $coefficients[0],
                'slopes' => array_slice($coefficients, 1),
                'lambda' => $lambda,
                'r_squared' => $rSquared,
                'residuals' => $residuals,
                'predictions' => $predictions,
                'sample_size' => $n,
                'num_predictors' => $p,
                'regularization_effect' => $this->analyzeRegularizationEffect($coefficients, $lambda),
                'residual_analysis' => $this->analyzeResiduals($residuals)
            ];

        } catch (\Exception $e) {
            Log::error('Ridge regression failed: ' . $e->getMessage());
            return $this->getEmptyRegressionResult();
        }
    }

    /**
     * Perform k-fold cross-validation
     */
    public function crossValidation(array $xMatrix, array $yValues, int $folds = 5, string $method = 'linear'): array
    {
        try {
            $n = count($yValues);
            if ($n < $folds || $folds < 2) {
                return ['error' => 'Invalid fold configuration'];
            }

            $foldSize = intval($n / $folds);
            $scores = [];
            $predictions = [];
            $actuals = [];

            // Shuffle indices
            $indices = range(0, $n - 1);
            shuffle($indices);

            for ($fold = 0; $fold < $folds; $fold++) {
                $testStart = $fold * $foldSize;
                $testEnd = ($fold === $folds - 1) ? $n : ($fold + 1) * $foldSize;

                $trainIndices = array_merge(
                    array_slice($indices, 0, $testStart),
                    array_slice($indices, $testEnd)
                );
                $testIndices = array_slice($indices, $testStart, $testEnd - $testStart);

                // Prepare training data
                $trainX = [];
                $trainY = [];
                foreach ($trainIndices as $idx) {
                    $trainX[] = $xMatrix[$idx];
                    $trainY[] = $yValues[$idx];
                }

                // Train model
                switch ($method) {
                    case 'linear':
                        $model = $this->multipleLinearRegression($trainX, $trainY);
                        break;
                    case 'ridge':
                        $model = $this->ridgeRegression($trainX, $trainY);
                        break;
                    default:
                        $model = $this->multipleLinearRegression($trainX, $trainY);
                }

                if (empty($model['coefficients'])) {
                    continue;
                }

                // Test model
                $foldPredictions = [];
                $foldActuals = [];
                foreach ($testIndices as $idx) {
                    $predicted = $model['coefficients'][0]; // intercept
                    for ($j = 0; $j < count($xMatrix[$idx]); $j++) {
                        $predicted += $model['coefficients'][$j + 1] * $xMatrix[$idx][$j];
                    }

                    $foldPredictions[] = $predicted;
                    $foldActuals[] = $yValues[$idx];
                }

                $predictions = array_merge($predictions, $foldPredictions);
                $actuals = array_merge($actuals, $foldActuals);

                // Calculate fold score (R-squared)
                $meanY = array_sum($foldActuals) / count($foldActuals);
                $ssTotal = 0;
                $ssResidual = 0;

                for ($i = 0; $i < count($foldActuals); $i++) {
                    $ssTotal += pow($foldActuals[$i] - $meanY, 2);
                    $ssResidual += pow($foldActuals[$i] - $foldPredictions[$i], 2);
                }

                $foldScore = $ssTotal > 0 ? 1 - ($ssResidual / $ssTotal) : 0;
                $scores[] = $foldScore;
            }

            return [
                'fold_scores' => $scores,
                'mean_score' => array_sum($scores) / count($scores),
                'std_score' => $this->calculateStandardDeviation($scores),
                'predictions' => $predictions,
                'actuals' => $actuals,
                'method' => $method,
                'folds' => $folds
            ];

        } catch (\Exception $e) {
            Log::error('Cross-validation failed: ' . $e->getMessage());
            return ['error' => 'Cross-validation failed'];
        }
    }

    // Private helper methods

    private function analyzeResiduals(array $residuals): array
    {
        if (empty($residuals)) {
            return [];
        }

        $mean = array_sum($residuals) / count($residuals);
        $stdDev = $this->calculateStandardDeviation($residuals);

        return [
            'mean' => $mean,
            'std_dev' => $stdDev,
            'min' => min($residuals),
            'max' => max($residuals),
            'normality_test' => $this->testResidualNormality($residuals),
            'autocorrelation_test' => $this->testAutocorrelation($residuals)
        ];
    }

    private function calculateConfidenceIntervals(float $slope, float $intercept, float $standardError, int $n): array
    {
        $tValue = 1.96; // Approximate for large samples
        if ($n < 30) {
            // Would need t-table for exact values
            $tValue = 2.0;
        }

        $slopeMargin = $tValue * $standardError;
        $interceptMargin = $tValue * $standardError;

        return [
            'slope' => [
                'lower' => $slope - $slopeMargin,
                'upper' => $slope + $slopeMargin
            ],
            'intercept' => [
                'lower' => $intercept - $interceptMargin,
                'upper' => $intercept + $interceptMargin
            ]
        ];
    }

    private function performSignificanceTests(float $slope, float $intercept, float $standardError, int $n): array
    {
        $tSlope = $standardError > 0 ? $slope / $standardError : 0;
        $tIntercept = $standardError > 0 ? $intercept / $standardError : 0;

        return [
            'slope_t_statistic' => $tSlope,
            'intercept_t_statistic' => $tIntercept,
            'slope_significant' => abs($tSlope) > 1.96,
            'intercept_significant' => abs($tIntercept) > 1.96
        ];
    }

    private function transposeMatrix(array $matrix): array
    {
        $rows = count($matrix);
        $cols = count($matrix[0]);
        $transposed = [];

        for ($j = 0; $j < $cols; $j++) {
            for ($i = 0; $i < $rows; $i++) {
                $transposed[$j][$i] = $matrix[$i][$j];
            }
        }

        return $transposed;
    }

    private function multiplyMatrices(array $a, array $b): array
    {
        $rowsA = count($a);
        $colsA = count($a[0]);
        $colsB = count($b[0]);
        $result = [];

        for ($i = 0; $i < $rowsA; $i++) {
            for ($j = 0; $j < $colsB; $j++) {
                $result[$i][$j] = 0;
                for ($k = 0; $k < $colsA; $k++) {
                    $result[$i][$j] += $a[$i][$k] * $b[$k][$j];
                }
            }
        }

        return $result;
    }

    private function multiplyMatrixVector(array $matrix, array $vector): array
    {
        $rows = count($matrix);
        $result = [];

        for ($i = 0; $i < $rows; $i++) {
            $result[$i] = 0;
            for ($j = 0; $j < count($vector); $j++) {
                $result[$i] += $matrix[$i][$j] * $vector[$j];
            }
        }

        return $result;
    }

    private function invertMatrix(array $matrix): ?array
    {
        $n = count($matrix);

        // Create augmented matrix [A|I]
        $augmented = [];
        for ($i = 0; $i < $n; $i++) {
            $augmented[$i] = array_merge($matrix[$i], array_fill(0, $n, 0));
            $augmented[$i][$n + $i] = 1; // Identity matrix
        }

        // Gaussian elimination
        for ($i = 0; $i < $n; $i++) {
            // Find pivot
            $maxRow = $i;
            for ($k = $i + 1; $k < $n; $k++) {
                if (abs($augmented[$k][$i]) > abs($augmented[$maxRow][$i])) {
                    $maxRow = $k;
                }
            }

            // Swap rows
            if ($maxRow !== $i) {
                $temp = $augmented[$i];
                $augmented[$i] = $augmented[$maxRow];
                $augmented[$maxRow] = $temp;
            }

            // Check for singular matrix
            if (abs($augmented[$i][$i]) < 1e-10) {
                return null;
            }

            // Scale pivot row
            $pivot = $augmented[$i][$i];
            for ($j = 0; $j < 2 * $n; $j++) {
                $augmented[$i][$j] /= $pivot;
            }

            // Eliminate column
            for ($k = 0; $k < $n; $k++) {
                if ($k !== $i) {
                    $factor = $augmented[$k][$i];
                    for ($j = 0; $j < 2 * $n; $j++) {
                        $augmented[$k][$j] -= $factor * $augmented[$i][$j];
                    }
                }
            }
        }

        // Extract inverse matrix
        $inverse = [];
        for ($i = 0; $i < $n; $i++) {
            $inverse[$i] = array_slice($augmented[$i], $n);
        }

        return $inverse;
    }

    private function calculateTStatistics(array $coefficients, array $standardErrors): array
    {
        $tStats = [];
        for ($i = 0; $i < count($coefficients); $i++) {
            $tStats[] = $standardErrors[$i] > 0 ? $coefficients[$i] / $standardErrors[$i] : 0;
        }
        return $tStats;
    }

    private function calculatePValues(array $coefficients, array $standardErrors, int $degreesOfFreedom): array
    {
        $pValues = [];
        $tStats = $this->calculateTStatistics($coefficients, $standardErrors);

        foreach ($tStats as $t) {
            // Simplified p-value calculation (would need proper t-distribution)
            $pValues[] = abs($t) > 1.96 ? 0.05 : 0.1;
        }

        return $pValues;
    }

    private function calculateFStatistic(float $rSquared, int $n, int $p): array
    {
        if ($rSquared >= 1 || $p == 0) {
            return ['f_statistic' => 0, 'p_value' => 1];
        }

        $fStat = ($rSquared / $p) / ((1 - $rSquared) / ($n - $p - 1));
        $pValue = $fStat > 3.84 ? 0.05 : 0.1; // Simplified

        return ['f_statistic' => $fStat, 'p_value' => $pValue];
    }

    private function performModelDiagnostics(array $residuals, array $predictions): array
    {
        return [
            'heteroscedasticity_test' => $this->testHeteroscedasticity($residuals, $predictions),
            'outliers' => $this->detectOutliers($residuals),
            'influential_points' => $this->detectInfluentialPoints($residuals)
        ];
    }

    private function formatPolynomialEquation(array $coefficients, int $degree): string
    {
        $equation = "y = {$coefficients[0]}";

        for ($i = 1; $i <= $degree; $i++) {
            $coeff = $coefficients[$i];
            $sign = $coeff >= 0 ? '+' : '';

            if ($i == 1) {
                $equation .= " {$sign}{$coeff}x";
            } else {
                $equation .= " {$sign}{$coeff}x^{$i}";
            }
        }

        return $equation;
    }

    private function calculateClassificationMetrics(array $actual, array $predicted): array
    {
        $tp = $tn = $fp = $fn = 0;

        for ($i = 0; $i < count($actual); $i++) {
            if ($actual[$i] == 1 && $predicted[$i] == 1) $tp++;
            elseif ($actual[$i] == 0 && $predicted[$i] == 0) $tn++;
            elseif ($actual[$i] == 0 && $predicted[$i] == 1) $fp++;
            elseif ($actual[$i] == 1 && $predicted[$i] == 0) $fn++;
        }

        $accuracy = ($tp + $tn) / count($actual);
        $precision = ($tp + $fp) > 0 ? $tp / ($tp + $fp) : 0;
        $recall = ($tp + $fn) > 0 ? $tp / ($tp + $fn) : 0;
        $f1Score = ($precision + $recall) > 0 ? 2 * ($precision * $recall) / ($precision + $recall) : 0;

        return [
            'accuracy' => $accuracy,
            'precision' => $precision,
            'recall' => $recall,
            'f1_score' => $f1Score,
            'true_positives' => $tp,
            'true_negatives' => $tn,
            'false_positives' => $fp,
            'false_negatives' => $fn
        ];
    }

    private function analyzeRegularizationEffect(array $coefficients, float $lambda): array
    {
        $coefficientMagnitudes = array_map('abs', array_slice($coefficients, 1));

        return [
            'lambda' => $lambda,
            'coefficient_shrinkage' => array_sum($coefficientMagnitudes),
            'max_coefficient' => max($coefficientMagnitudes),
            'min_coefficient' => min($coefficientMagnitudes),
            'regularization_strength' => $lambda > 1 ? 'strong' : ($lambda > 0.1 ? 'moderate' : 'weak')
        ];
    }

    private function makePredictions(array $xMatrix, array $coefficients): array
    {
        $predictions = [];

        foreach ($xMatrix as $row) {
            $prediction = 0;
            for ($j = 0; $j < count($row); $j++) {
                $prediction += $coefficients[$j] * $row[$j];
            }
            $predictions[] = $prediction;
        }

        return $predictions;
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

    private function getEmptyRegressionResult(): array
    {
        return [
            'slope' => 0,
            'intercept' => 0,
            'r_squared' => 0,
            'correlation' => 0,
            'error' => 'Insufficient data or invalid input'
        ];
    }

    // Placeholder methods for advanced diagnostics
    private function testResidualNormality(array $residuals): array { return ['normal' => true]; }
    private function testAutocorrelation(array $residuals): array { return ['autocorrelated' => false]; }
    private function testHeteroscedasticity(array $residuals, array $predictions): array { return ['heteroscedastic' => false]; }
    private function detectOutliers(array $residuals): array { return []; }
    private function detectInfluentialPoints(array $residuals): array { return []; }
}
