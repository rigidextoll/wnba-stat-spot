<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
</script>

<svelte:head>
    <title>Prop Betting Analysis | Methodology | WNBA Stat Spot</title>
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
                    <h4 class="page-title">Prop Betting Analysis</h4>
                    <p class="text-muted mb-0">Mathematical framework for identifying profitable betting opportunities</p>
                </div>
            </div>
        </div>

        <!-- Expected Value Framework -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-calculator text-primary me-2"></i>Expected Value Framework
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            Our prop betting analysis is built on <strong>Expected Value (EV)</strong> theory,
                            which quantifies the long-term profitability of betting decisions.
                        </p>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="text-primary">Core Formula</h6>
                                <div class="bg-light p-3 rounded mb-3">
                                    <code class="text-dark">EV = (P_win × Payout) - (P_lose × Stake)</code>
                                </div>
                                <p class="small">
                                    Where <strong>P_win</strong> is our predicted probability of winning,
                                    <strong>Payout</strong> is the amount won if successful, and
                                    <strong>P_lose</strong> is the probability of losing.
                                </p>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-success">Practical Application</h6>
                                <div class="bg-light p-3 rounded mb-3">
                                    <code class="text-dark">EV = P_true × (Odds - 1) - (1 - P_true)</code>
                                </div>
                                <p class="small">
                                    For decimal odds, this simplifies to our true probability estimate
                                    times the net payout minus the probability of losing.
                                </p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h6 class="alert-heading">Key Insight</h6>
                            <p class="mb-0">
                                A bet has positive expected value when our predicted probability
                                is higher than the implied probability from the betting odds.
                                This represents a <strong>market inefficiency</strong> we can exploit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Probability Estimation -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-bell text-primary me-2"></i>Probability Estimation
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Distribution Modeling</h6>
                        <p class="small mb-3">
                            We model each statistic using appropriate probability distributions:
                        </p>
                        <ul class="small mb-3">
                            <li><strong>Points/Rebounds/Assists:</strong> Negative Binomial (handles overdispersion)</li>
                            <li><strong>Shooting %:</strong> Beta distribution (bounded between 0-1)</li>
                            <li><strong>Minutes:</strong> Gamma distribution (continuous, positive)</li>
                        </ul>

                        <h6 class="text-success">Contextual Adjustments</h6>
                        <p class="small mb-0">
                            Base distributions are adjusted for:
                        </p>
                        <ul class="small mb-0">
                            <li>Opponent strength and pace</li>
                            <li>Player rest and recent form</li>
                            <li>Home/away effects</li>
                            <li>Injury reports and lineup changes</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-balance-scale text-success me-2"></i>Over/Under Calculation
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Probability Integration</h6>
                        <div class="bg-light p-3 rounded mb-3">
                            <code class="small">P(Over) = ∫[line to ∞] f(x) dx</code><br>
                            <code class="small">P(Under) = ∫[0 to line] f(x) dx</code>
                        </div>
                        <p class="small mb-3">
                            We integrate the probability density function to find the exact
                            probability of exceeding (Over) or staying below (Under) the betting line.
                        </p>

                        <h6 class="text-success">Monte Carlo Verification</h6>
                        <p class="small mb-0">
                            Analytical calculations are verified through Monte Carlo simulation:
                            10,000+ random draws from the distribution to empirically estimate probabilities.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Market Analysis -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-line text-primary me-2"></i>Market Analysis & Edge Detection
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h6 class="text-primary">Implied Probability</h6>
                                <div class="bg-light p-3 rounded mb-3">
                                    <code class="text-dark">P_implied = 1 / Decimal_Odds</code>
                                </div>
                                <p class="small">
                                    Convert betting odds to implied probabilities,
                                    accounting for the sportsbook's built-in margin (vig).
                                </p>
                            </div>

                            <div class="col-md-4">
                                <h6 class="text-success">Edge Calculation</h6>
                                <div class="bg-light p-3 rounded mb-3">
                                    <code class="text-dark">Edge = P_true - P_implied</code>
                                </div>
                                <p class="small">
                                    Our betting edge is the difference between our estimated
                                    true probability and the market's implied probability.
                                </p>
                            </div>

                            <div class="col-md-4">
                                <h6 class="text-warning">Kelly Criterion</h6>
                                <div class="bg-light p-3 rounded mb-3">
                                    <code class="text-dark">f* = (bp - q) / b</code>
                                </div>
                                <p class="small">
                                    Optimal bet sizing based on edge size and odds,
                                    maximizing long-term growth while managing risk.
                                </p>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h6 class="alert-heading">Profitable Opportunities</h6>
                            <p class="mb-0">
                                We flag bets with <strong>positive expected value (EV > 0)</strong> and
                                sufficient edge (typically >3-5%) to overcome transaction costs and model uncertainty.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Risk Management -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-shield-alt text-warning me-2"></i>Risk Management
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Confidence Intervals</h6>
                        <p class="small mb-3">
                            We provide 90%, 95%, and 99% confidence intervals around our predictions
                            to quantify uncertainty and avoid overconfident betting.
                        </p>

                        <h6 class="text-success">Model Uncertainty</h6>
                        <p class="small mb-3">
                            Parameter uncertainty is propagated through Bayesian inference,
                            ensuring our confidence reflects both data limitations and model assumptions.
                        </p>

                        <h6 class="text-warning">Bankroll Management</h6>
                        <p class="small mb-0">
                            Kelly Criterion sizing prevents overbetting, while fractional Kelly
                            (typically 25-50%) provides additional safety margin against model errors.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-exclamation-triangle text-danger me-2"></i>Limitations & Biases
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-danger">Known Limitations</h6>
                        <ul class="small mb-3">
                            <li>Models assume past patterns continue</li>
                            <li>Cannot predict injuries or coaching decisions</li>
                            <li>Market efficiency may eliminate edges quickly</li>
                            <li>Small sample bias early in seasons</li>
                        </ul>

                        <h6 class="text-warning">Cognitive Biases</h6>
                        <ul class="small mb-0">
                            <li><strong>Recency bias:</strong> Overweighting recent games</li>
                            <li><strong>Confirmation bias:</strong> Seeking supporting evidence</li>
                            <li><strong>Overconfidence:</strong> Underestimating uncertainty</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Practical Implementation -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-cogs text-primary me-2"></i>Implementation Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="avatar-lg bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <i class="fas fa-database text-primary fs-20"></i>
                                    </div>
                                    <h6>Data Pipeline</h6>
                                    <p class="small text-muted">
                                        Real-time ingestion of player stats, injury reports,
                                        and betting lines from multiple sources
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="avatar-lg bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <i class="fas fa-brain text-success fs-20"></i>
                                    </div>
                                    <h6>Model Updates</h6>
                                    <p class="small text-muted">
                                        Bayesian updates after each game,
                                        with automatic retraining on schedule
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="avatar-lg bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <i class="fas fa-search text-warning fs-20"></i>
                                    </div>
                                    <h6>Opportunity Scanning</h6>
                                    <p class="small text-muted">
                                        Automated scanning of all available props
                                        across multiple sportsbooks
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="avatar-lg bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        <i class="fas fa-bell text-info fs-20"></i>
                                    </div>
                                    <h6>Alert System</h6>
                                    <p class="small text-muted">
                                        Notifications for high-value opportunities
                                        and significant line movements
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Metrics -->
        <div class="row">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-bar text-success me-2"></i>Performance Tracking
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Key Metrics</h6>
                        <ul class="small mb-3">
                            <li><strong>ROI:</strong> Return on investment over time</li>
                            <li><strong>Hit Rate:</strong> Percentage of winning bets</li>
                            <li><strong>Sharpe Ratio:</strong> Risk-adjusted returns</li>
                            <li><strong>Maximum Drawdown:</strong> Worst losing streak</li>
                        </ul>

                        <h6 class="text-success">Calibration</h6>
                        <p class="small mb-0">
                            We track whether our predicted probabilities match observed frequencies.
                            Well-calibrated models have predicted 70% events occur ~70% of the time.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-graduation-cap text-info me-2"></i>Continuous Learning
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary">Model Evolution</h6>
                        <p class="small mb-3">
                            Our models continuously learn from new data, adapting to:
                        </p>
                        <ul class="small mb-3">
                            <li>Rule changes and meta-game shifts</li>
                            <li>Player development and aging curves</li>
                            <li>Market efficiency improvements</li>
                        </ul>

                        <h6 class="text-info">Research Pipeline</h6>
                        <p class="small mb-0">
                            Ongoing research into new features, model architectures,
                            and market inefficiencies to maintain competitive advantage.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</DefaultLayout>
