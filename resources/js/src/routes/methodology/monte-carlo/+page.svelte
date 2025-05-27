<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
</script>

<svelte:head>
    <title>Monte Carlo Simulations | Methodology | WNBA Stat Spot</title>
</svelte:head>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="/methodology" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Methodology
                        </a>
                    </div>
                    <h4 class="page-title">Monte Carlo Simulations</h4>
                    <p class="text-muted mb-0">Using computational probability to model uncertainty in sports predictions</p>
                </div>
            </div>
        </div>

        <!-- Introduction -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-dice text-primary me-2"></i>What is Monte Carlo Simulation?
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            Monte Carlo simulation is a computational technique that uses <strong>random sampling</strong>
                            to solve problems that might be deterministically complex or impossible to solve analytically.
                        </p>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="text-primary">Core Concept</h6>
                                <p class="small">
                                    Instead of trying to calculate exact probabilities mathematically,
                                    we run thousands of simulated "games" with random outcomes based on our models.
                                    The distribution of these simulated results approximates the true probability distribution.
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-success">Why Use It?</h6>
                                <p class="small">
                                    Basketball statistics involve complex interactions between players,
                                    game situations, and random events. Monte Carlo allows us to capture
                                    this complexity without making oversimplifying assumptions.
                                </p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h6 class="alert-heading">Historical Context</h6>
                            <p class="mb-0">
                                Named after the Monte Carlo Casino in Monaco, this method was developed during
                                the Manhattan Project in the 1940s. Today, it's used in finance, physics,
                                engineering, and increasingly in sports analytics.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mathematical Foundation -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-calculator text-primary me-2"></i>Mathematical Foundation
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h6 class="text-primary">Law of Large Numbers</h6>
                                <div class="bg-light p-3 rounded mb-3">
                                    <code class="text-dark">lim(n→∞) (1/n)∑Xᵢ = E[X]</code>
                                </div>
                                <p class="small">
                                    As we run more simulations, our sample mean converges to the true expected value.
                                    This guarantees our Monte Carlo estimates become more accurate with more iterations.
                                </p>
                            </div>

                            <div class="col-md-4">
                                <h6 class="text-success">Central Limit Theorem</h6>
                                <div class="bg-light p-3 rounded mb-3">
                                    <code class="text-dark">√n(X̄ₙ - μ) → N(0, σ²)</code>
                                </div>
                                <p class="small">
                                    The distribution of our simulation results approaches normality,
                                    allowing us to construct confidence intervals and assess the precision of our estimates.
                                </p>
                            </div>

                            <div class="col-md-4">
                                <h6 class="text-warning">Convergence Rate</h6>
                                <div class="bg-light p-3 rounded mb-3">
                                    <code class="text-dark">Error ∝ 1/√n</code>
                                </div>
                                <p class="small">
                                    Monte Carlo error decreases proportionally to the square root of the number of simulations.
                                    To halve the error, we need 4× more simulations.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Implementation -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-cogs text-primary me-2"></i>Our Implementation Process
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center mb-4">
                                    <div class="avatar-lg bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <span class="text-primary fw-bold fs-20">1</span>
                                    </div>
                                    <h6>Parameter Estimation</h6>
                                    <p class="small text-muted">
                                        Extract player-specific parameters from historical data using Bayesian inference
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="text-center mb-4">
                                    <div class="avatar-lg bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <span class="text-success fw-bold fs-20">2</span>
                                    </div>
                                    <h6>Random Sampling</h6>
                                    <p class="small text-muted">
                                        Generate random performance values from appropriate probability distributions
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="text-center mb-4">
                                    <div class="avatar-lg bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <span class="text-warning fw-bold fs-20">3</span>
                                    </div>
                                    <h6>Contextual Adjustment</h6>
                                    <p class="small text-muted">
                                        Modify base performance for game context, opponent, rest, etc.
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="text-center mb-4">
                                    <div class="avatar-lg bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <span class="text-info fw-bold fs-20">4</span>
                                    </div>
                                    <h6>Aggregate Results</h6>
                                    <p class="small text-muted">
                                        Collect simulation outcomes and compute summary statistics
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-light p-4 rounded">
                            <h6 class="text-primary mb-3">Simulation Algorithm</h6>
                            <pre class="small mb-0"><code>for i in range(num_simulations):
    # Sample from parameter uncertainty
    θ ~ Posterior(θ | data)

    # Generate base performance
    base_stats ~ Distribution(θ)

    # Apply contextual adjustments
    adjusted_stats = base_stats × context_multipliers

    # Store simulation result
    results[i] = adjusted_stats

# Compute summary statistics
mean = np.mean(results)
percentiles = np.percentile(results, [5, 25, 50, 75, 95])
confidence_intervals = compute_ci(results)</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Distribution Modeling -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-bell text-primary me-2"></i>Distribution Selection
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Counting Statistics</h6>
                        <p class="small mb-3">
                            <strong>Points, Rebounds, Assists:</strong> Negative Binomial distribution
                            handles overdispersion (variance > mean) common in basketball stats.
                        </p>
                        <div class="bg-light p-2 rounded mb-3">
                            <code class="small">X ~ NegBin(r, p) where μ = r(1-p)/p</code>
                        </div>

                        <h6 class="text-success">Percentage Statistics</h6>
                        <p class="small mb-3">
                            <strong>Field Goal %, Free Throw %:</strong> Beta distribution naturally
                            bounded between 0 and 1, with flexible shape parameters.
                        </p>
                        <div class="bg-light p-2 rounded mb-3">
                            <code class="small">X ~ Beta(α, β) where μ = α/(α+β)</code>
                        </div>

                        <h6 class="text-warning">Continuous Statistics</h6>
                        <p class="small mb-0">
                            <strong>Minutes, Plus/Minus:</strong> Gamma or Normal distributions
                            depending on the specific characteristic and constraints.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-link text-success me-2"></i>Correlation Modeling
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Multivariate Approach</h6>
                        <p class="small mb-3">
                            Basketball statistics are correlated. High-scoring games often have more rebounds,
                            assists, and turnovers. We model these relationships explicitly.
                        </p>

                        <h6 class="text-success">Copula Functions</h6>
                        <div class="bg-light p-2 rounded mb-3">
                            <code class="small">C(u₁, u₂, ..., uₙ) = P(U₁ ≤ u₁, ..., Uₙ ≤ uₙ)</code>
                        </div>
                        <p class="small mb-3">
                            Copulas separate marginal distributions from dependence structure,
                            allowing flexible correlation modeling.
                        </p>

                        <h6 class="text-warning">Practical Implementation</h6>
                        <p class="small mb-0">
                            We use Gaussian copulas with empirically estimated correlation matrices,
                            updated continuously as new game data becomes available.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scenario Analysis -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-theater-masks text-primary me-2"></i>Scenario Analysis
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            Monte Carlo simulations excel at scenario analysis - exploring how different
                            game conditions affect player performance distributions.
                        </p>

                        <div class="row g-4">
                            <div class="col-md-4">
                                <h6 class="text-primary">Game Pace Scenarios</h6>
                                <ul class="small mb-0">
                                    <li><strong>Fast Pace:</strong> More possessions, higher counting stats</li>
                                    <li><strong>Slow Pace:</strong> Fewer opportunities, efficiency matters more</li>
                                    <li><strong>Overtime:</strong> Extended playing time, fatigue effects</li>
                                </ul>
                            </div>

                            <div class="col-md-4">
                                <h6 class="text-success">Competitive Balance</h6>
                                <ul class="small mb-0">
                                    <li><strong>Blowout:</strong> Starters rest, bench players get minutes</li>
                                    <li><strong>Close Game:</strong> Stars play heavy minutes</li>
                                    <li><strong>Back-to-Back:</strong> Rotation changes, rest management</li>
                                </ul>
                            </div>

                            <div class="col-md-4">
                                <h6 class="text-warning">Injury Scenarios</h6>
                                <ul class="small mb-0">
                                    <li><strong>Key Player Out:</strong> Usage rate redistribution</li>
                                    <li><strong>Depth Chart Changes:</strong> Opportunity shifts</li>
                                    <li><strong>Load Management:</strong> Planned rest impacts</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Uncertainty Quantification -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-question-circle text-warning me-2"></i>Uncertainty Sources
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Aleatory Uncertainty</h6>
                        <p class="small mb-3">
                            <strong>Inherent randomness</strong> in sports performance. Even the best players
                            have good and bad games due to factors beyond our control.
                        </p>

                        <h6 class="text-success">Epistemic Uncertainty</h6>
                        <p class="small mb-3">
                            <strong>Parameter uncertainty</strong> from limited data. Early in the season,
                            we have less confidence in our player ability estimates.
                        </p>

                        <h6 class="text-warning">Model Uncertainty</h6>
                        <p class="small mb-0">
                            <strong>Structural assumptions</strong> in our models may be imperfect.
                            We account for this through ensemble methods and sensitivity analysis.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-area text-info me-2"></i>Output Interpretation
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Probability Distributions</h6>
                        <p class="small mb-3">
                            Full distributions show the range of possible outcomes and their likelihoods,
                            not just single-point predictions.
                        </p>

                        <h6 class="text-success">Confidence Intervals</h6>
                        <p class="small mb-3">
                            90%, 95%, and 99% intervals quantify our uncertainty.
                            Wider intervals indicate higher uncertainty.
                        </p>

                        <h6 class="text-info">Tail Probabilities</h6>
                        <p class="small mb-0">
                            Monte Carlo excels at estimating rare events (e.g., probability of 40+ points)
                            that are difficult to calculate analytically.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Computational Considerations -->
        <div class="row">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-microchip text-primary me-2"></i>Computational Efficiency
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Simulation Count</h6>
                        <p class="small mb-3">
                            We typically run 10,000-50,000 simulations. More simulations increase accuracy
                            but require more computation time.
                        </p>

                        <h6 class="text-success">Parallel Processing</h6>
                        <p class="small mb-3">
                            Monte Carlo simulations are "embarrassingly parallel" - each simulation
                            is independent, allowing efficient multi-core processing.
                        </p>

                        <h6 class="text-warning">Variance Reduction</h6>
                        <p class="small mb-0">
                            Techniques like antithetic variates and control variates can reduce
                            simulation variance without increasing computation time.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-check-double text-success me-2"></i>Validation Methods
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Convergence Testing</h6>
                        <p class="small mb-3">
                            We monitor how estimates change as we add more simulations,
                            ensuring convergence to stable values.
                        </p>

                        <h6 class="text-success">Cross-Validation</h6>
                        <p class="small mb-3">
                            Historical backtesting verifies that our simulated distributions
                            match observed outcomes over time.
                        </p>

                        <h6 class="text-info">Sensitivity Analysis</h6>
                        <p class="small mb-0">
                            We test how sensitive our results are to model assumptions
                            and parameter choices, identifying robust conclusions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</DefaultLayout>
