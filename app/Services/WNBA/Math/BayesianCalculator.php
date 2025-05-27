<?php

namespace App\Services\WNBA\Math;

class BayesianCalculator
{
    /**
     * Update posterior probability using Bayes' theorem
     * P(H|E) = P(E|H) * P(H) / P(E)
     */
    public function updatePosterior(float $prior, float $likelihood, float $marginalLikelihood): float
    {
        if ($marginalLikelihood <= 0) {
            return $prior;
        }

        $posterior = ($likelihood * $prior) / $marginalLikelihood;
        return max(0, min(1, $posterior));
    }

    /**
     * Calculate likelihood based on recent performance data
     */
    public function calculateLikelihood(array $recentGames, float $proposedValue): float
    {
        if (empty($recentGames)) {
            return 0.5; // Neutral likelihood
        }

        // Calculate how well the proposed value fits recent performance
        $distances = array_map(function($game) use ($proposedValue) {
            return abs($game - $proposedValue);
        }, $recentGames);

        $averageDistance = array_sum($distances) / count($distances);
        $maxDistance = max($distances);

        // Convert distance to likelihood (closer = higher likelihood)
        if ($maxDistance == 0) {
            return 1.0;
        }

        $normalizedDistance = $averageDistance / $maxDistance;
        return max(0.1, 1 - $normalizedDistance);
    }

    /**
     * Calculate marginal likelihood (evidence) across all possible outcomes
     */
    public function calculateMarginalLikelihood(array $allPossibleOutcomes, array $recentGames): float
    {
        $totalLikelihood = 0;
        $totalPrior = 0;

        foreach ($allPossibleOutcomes as $outcome => $prior) {
            $likelihood = $this->calculateLikelihood($recentGames, $outcome);
            $totalLikelihood += $likelihood * $prior;
            $totalPrior += $prior;
        }

        return $totalPrior > 0 ? $totalLikelihood / $totalPrior : 0.5;
    }

    /**
     * Update Beta distribution parameters for shooting percentages
     */
    public function updateBetaDistribution(int $makes, int $attempts, array $priorParams): array
    {
        $priorAlpha = $priorParams['alpha'] ?? 1;
        $priorBeta = $priorParams['beta'] ?? 1;

        $posteriorAlpha = $priorAlpha + $makes;
        $posteriorBeta = $priorBeta + ($attempts - $makes);

        return [
            'alpha' => $posteriorAlpha,
            'beta' => $posteriorBeta,
            'mean' => $posteriorAlpha / ($posteriorAlpha + $posteriorBeta),
            'variance' => ($posteriorAlpha * $posteriorBeta) /
                         (pow($posteriorAlpha + $posteriorBeta, 2) * ($posteriorAlpha + $posteriorBeta + 1))
        ];
    }

    /**
     * Update Gamma distribution parameters for counting stats
     */
    public function updateGammaDistribution(array $observations, array $priorParams): array
    {
        $priorShape = $priorParams['shape'] ?? 1;
        $priorRate = $priorParams['rate'] ?? 1;

        $n = count($observations);
        $sumObservations = array_sum($observations);

        $posteriorShape = $priorShape + $sumObservations;
        $posteriorRate = $priorRate + $n;

        return [
            'shape' => $posteriorShape,
            'rate' => $posteriorRate,
            'mean' => $posteriorShape / $posteriorRate,
            'variance' => $posteriorShape / pow($posteriorRate, 2)
        ];
    }

    /**
     * Update Normal distribution parameters with conjugate prior
     */
    public function updateNormalDistribution(array $observations, array $priorParams): array
    {
        $priorMean = $priorParams['mean'] ?? 0;
        $priorVariance = $priorParams['variance'] ?? 1;
        $priorPrecision = 1 / $priorVariance;

        if (empty($observations)) {
            return $priorParams;
        }

        $n = count($observations);
        $sampleMean = array_sum($observations) / $n;
        $sampleVariance = $this->calculateSampleVariance($observations);
        $samplePrecision = $sampleVariance > 0 ? $n / $sampleVariance : $n;

        // Update parameters
        $posteriorPrecision = $priorPrecision + $samplePrecision;
        $posteriorMean = ($priorPrecision * $priorMean + $samplePrecision * $sampleMean) / $posteriorPrecision;
        $posteriorVariance = 1 / $posteriorPrecision;

        return [
            'mean' => $posteriorMean,
            'variance' => $posteriorVariance,
            'precision' => $posteriorPrecision,
            'confidence' => min(1.0, $n / 10) // Confidence increases with sample size
        ];
    }

    /**
     * Calculate Bayesian credible interval
     */
    public function calculateCredibleInterval(array $posteriorParams, string $distribution = 'normal', float $credibilityLevel = 0.95): array
    {
        $alpha = 1 - $credibilityLevel;

        switch ($distribution) {
            case 'normal':
                return $this->normalCredibleInterval($posteriorParams, $alpha);
            case 'beta':
                return $this->betaCredibleInterval($posteriorParams, $alpha);
            case 'gamma':
                return $this->gammaCredibleInterval($posteriorParams, $alpha);
            default:
                return ['lower' => 0, 'upper' => 0, 'error' => 'Unsupported distribution'];
        }
    }

    /**
     * Perform Bayesian model comparison
     */
    public function compareModels(array $models, array $data): array
    {
        $modelEvidences = [];
        $totalEvidence = 0;

        foreach ($models as $modelName => $modelParams) {
            $evidence = $this->calculateModelEvidence($modelParams, $data);
            $modelEvidences[$modelName] = $evidence;
            $totalEvidence += $evidence;
        }

        // Calculate posterior model probabilities
        $modelProbabilities = [];
        foreach ($modelEvidences as $modelName => $evidence) {
            $modelProbabilities[$modelName] = $totalEvidence > 0 ? $evidence / $totalEvidence : 0;
        }

        // Find best model
        $bestModel = array_keys($modelProbabilities, max($modelProbabilities))[0];

        return [
            'model_evidences' => $modelEvidences,
            'model_probabilities' => $modelProbabilities,
            'best_model' => $bestModel,
            'bayes_factors' => $this->calculateBayesFactors($modelEvidences)
        ];
    }

    /**
     * Calculate Bayesian information criterion (BIC)
     */
    public function calculateBIC(float $logLikelihood, int $numParameters, int $sampleSize): float
    {
        return -2 * $logLikelihood + $numParameters * log($sampleSize);
    }

    /**
     * Calculate Akaike information criterion (AIC)
     */
    public function calculateAIC(float $logLikelihood, int $numParameters): float
    {
        return -2 * $logLikelihood + 2 * $numParameters;
    }

    /**
     * Perform Bayesian hypothesis testing
     */
    public function hypothesisTest(float $nullHypothesis, array $posteriorParams, string $distribution = 'normal'): array
    {
        switch ($distribution) {
            case 'normal':
                $probability = $this->normalHypothesisProbability($nullHypothesis, $posteriorParams);
                break;
            case 'beta':
                $probability = $this->betaHypothesisProbability($nullHypothesis, $posteriorParams);
                break;
            default:
                $probability = 0.5;
        }

        $bayesFactor = $probability / (1 - $probability);

        return [
            'null_hypothesis' => $nullHypothesis,
            'probability_null_true' => $probability,
            'probability_alternative_true' => 1 - $probability,
            'bayes_factor' => $bayesFactor,
            'evidence_strength' => $this->interpretBayesFactor($bayesFactor)
        ];
    }

    /**
     * Calculate predictive distribution
     */
    public function calculatePredictiveDistribution(array $posteriorParams, string $distribution = 'normal'): array
    {
        switch ($distribution) {
            case 'normal':
                return $this->normalPredictiveDistribution($posteriorParams);
            case 'beta':
                return $this->betaPredictiveDistribution($posteriorParams);
            case 'gamma':
                return $this->gammaPredictiveDistribution($posteriorParams);
            default:
                return ['error' => 'Unsupported distribution'];
        }
    }

    /**
     * Sequential Bayesian updating
     */
    public function sequentialUpdate(array $initialPrior, array $dataSequence, string $distribution = 'normal'): array
    {
        $currentPosterior = $initialPrior;
        $updateHistory = [$currentPosterior];

        foreach ($dataSequence as $dataPoint) {
            switch ($distribution) {
                case 'normal':
                    $currentPosterior = $this->updateNormalDistribution([$dataPoint], $currentPosterior);
                    break;
                case 'beta':
                    if (isset($dataPoint['makes']) && isset($dataPoint['attempts'])) {
                        $currentPosterior = $this->updateBetaDistribution(
                            $dataPoint['makes'],
                            $dataPoint['attempts'],
                            $currentPosterior
                        );
                    }
                    break;
                case 'gamma':
                    $currentPosterior = $this->updateGammaDistribution([$dataPoint], $currentPosterior);
                    break;
            }

            $updateHistory[] = $currentPosterior;
        }

        return [
            'final_posterior' => $currentPosterior,
            'update_history' => $updateHistory,
            'convergence_metrics' => $this->calculateConvergenceMetrics($updateHistory)
        ];
    }

    // Private helper methods

    private function calculateSampleVariance(array $observations): float
    {
        if (count($observations) < 2) {
            return 1.0; // Default variance
        }

        $mean = array_sum($observations) / count($observations);
        $squaredDiffs = array_map(function($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $observations);

        return array_sum($squaredDiffs) / (count($observations) - 1);
    }

    private function normalCredibleInterval(array $params, float $alpha): array
    {
        $mean = $params['mean'];
        $variance = $params['variance'];
        $stdDev = sqrt($variance);

        $zScore = $this->getZScore(1 - $alpha / 2);
        $margin = $zScore * $stdDev;

        return [
            'lower' => $mean - $margin,
            'upper' => $mean + $margin,
            'credibility_level' => 1 - $alpha
        ];
    }

    private function betaCredibleInterval(array $params, float $alpha): array
    {
        // Simplified beta credible interval using normal approximation
        $alpha_param = $params['alpha'];
        $beta_param = $params['beta'];

        $mean = $alpha_param / ($alpha_param + $beta_param);
        $variance = ($alpha_param * $beta_param) /
                   (pow($alpha_param + $beta_param, 2) * ($alpha_param + $beta_param + 1));

        $stdDev = sqrt($variance);
        $zScore = $this->getZScore(1 - $alpha / 2);
        $margin = $zScore * $stdDev;

        return [
            'lower' => max(0, $mean - $margin),
            'upper' => min(1, $mean + $margin),
            'credibility_level' => 1 - $alpha
        ];
    }

    private function gammaCredibleInterval(array $params, float $alpha): array
    {
        // Simplified gamma credible interval using normal approximation
        $shape = $params['shape'];
        $rate = $params['rate'];

        $mean = $shape / $rate;
        $variance = $shape / pow($rate, 2);

        $stdDev = sqrt($variance);
        $zScore = $this->getZScore(1 - $alpha / 2);
        $margin = $zScore * $stdDev;

        return [
            'lower' => max(0, $mean - $margin),
            'upper' => $mean + $margin,
            'credibility_level' => 1 - $alpha
        ];
    }

    private function calculateModelEvidence(array $modelParams, array $data): float
    {
        // Simplified model evidence calculation
        // In practice, this would require more sophisticated integration methods

        $logLikelihood = $this->calculateLogLikelihood($modelParams, $data);
        $numParams = count($modelParams);
        $sampleSize = count($data);

        // Use BIC as approximation to log evidence
        $bic = $this->calculateBIC($logLikelihood, $numParams, $sampleSize);

        return exp(-0.5 * $bic);
    }

    private function calculateLogLikelihood(array $modelParams, array $data): float
    {
        // Simplified log-likelihood calculation
        if (empty($data)) {
            return 0;
        }

        $mean = $modelParams['mean'] ?? array_sum($data) / count($data);
        $variance = $modelParams['variance'] ?? $this->calculateSampleVariance($data);

        $logLikelihood = 0;
        foreach ($data as $point) {
            $logLikelihood += -0.5 * log(2 * M_PI * $variance) -
                             (pow($point - $mean, 2) / (2 * $variance));
        }

        return $logLikelihood;
    }

    private function calculateBayesFactors(array $modelEvidences): array
    {
        $bayesFactors = [];
        $modelNames = array_keys($modelEvidences);

        for ($i = 0; $i < count($modelNames); $i++) {
            for ($j = $i + 1; $j < count($modelNames); $j++) {
                $model1 = $modelNames[$i];
                $model2 = $modelNames[$j];

                $bf = $modelEvidences[$model1] / max(1e-10, $modelEvidences[$model2]);
                $bayesFactors["{$model1}_vs_{$model2}"] = $bf;
            }
        }

        return $bayesFactors;
    }

    private function normalHypothesisProbability(float $nullValue, array $params): float
    {
        $mean = $params['mean'];
        $variance = $params['variance'];

        if ($variance <= 0) {
            return $mean == $nullValue ? 1.0 : 0.0;
        }

        $zScore = ($nullValue - $mean) / sqrt($variance);
        return $this->normalCDF($zScore);
    }

    private function betaHypothesisProbability(float $nullValue, array $params): float
    {
        // Simplified calculation using normal approximation
        $alpha = $params['alpha'];
        $beta = $params['beta'];

        $mean = $alpha / ($alpha + $beta);
        $variance = ($alpha * $beta) / (pow($alpha + $beta, 2) * ($alpha + $beta + 1));

        if ($variance <= 0) {
            return $mean == $nullValue ? 1.0 : 0.0;
        }

        $zScore = ($nullValue - $mean) / sqrt($variance);
        return $this->normalCDF($zScore);
    }

    private function normalPredictiveDistribution(array $params): array
    {
        return [
            'distribution' => 'normal',
            'mean' => $params['mean'],
            'variance' => $params['variance'],
            'std_dev' => sqrt($params['variance'])
        ];
    }

    private function betaPredictiveDistribution(array $params): array
    {
        $alpha = $params['alpha'];
        $beta = $params['beta'];

        return [
            'distribution' => 'beta',
            'alpha' => $alpha,
            'beta' => $beta,
            'mean' => $alpha / ($alpha + $beta),
            'variance' => ($alpha * $beta) / (pow($alpha + $beta, 2) * ($alpha + $beta + 1))
        ];
    }

    private function gammaPredictiveDistribution(array $params): array
    {
        return [
            'distribution' => 'gamma',
            'shape' => $params['shape'],
            'rate' => $params['rate'],
            'mean' => $params['shape'] / $params['rate'],
            'variance' => $params['shape'] / pow($params['rate'], 2)
        ];
    }

    private function calculateConvergenceMetrics(array $updateHistory): array
    {
        if (count($updateHistory) < 2) {
            return ['converged' => false, 'convergence_rate' => 0];
        }

        $meanChanges = [];
        for ($i = 1; $i < count($updateHistory); $i++) {
            $prevMean = $updateHistory[$i-1]['mean'] ?? 0;
            $currMean = $updateHistory[$i]['mean'] ?? 0;
            $meanChanges[] = abs($currMean - $prevMean);
        }

        $avgChange = array_sum($meanChanges) / count($meanChanges);
        $converged = $avgChange < 0.01; // Threshold for convergence

        return [
            'converged' => $converged,
            'average_change' => $avgChange,
            'final_change' => end($meanChanges),
            'convergence_rate' => 1 / (1 + $avgChange)
        ];
    }

    private function interpretBayesFactor(float $bayesFactor): string
    {
        if ($bayesFactor > 100) return 'extreme_evidence';
        if ($bayesFactor > 30) return 'very_strong_evidence';
        if ($bayesFactor > 10) return 'strong_evidence';
        if ($bayesFactor > 3) return 'moderate_evidence';
        if ($bayesFactor > 1) return 'weak_evidence';

        return 'no_evidence';
    }

    private function getZScore(float $probability): float
    {
        // Common z-scores for standard probabilities
        $zScores = [
            0.975 => 1.96,  // 95% CI
            0.995 => 2.576, // 99% CI
            0.95 => 1.645,  // 90% CI
        ];

        return $zScores[$probability] ?? 1.96;
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
}
