<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
</script>

<DefaultLayout>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">WNBA Stat Spot Dashboard</h4>
                    <p class="text-muted mb-0">Your ultimate destination for WNBA statistics and analytics</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-users text-primary fs-18"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Teams</h5>
                                <p class="text-muted mb-0">Manage WNBA teams and their information</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="/teams" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>
                                View Teams
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-user text-success fs-18"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Players</h5>
                                <p class="text-muted mb-0">Browse player statistics and profiles</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="/players" class="btn btn-success btn-sm">
                                <i class="fas fa-eye me-1"></i>
                                View Players
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3">
                                <i class="fas fa-gamepad text-info fs-18"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-1">Games</h5>
                                <p class="text-muted mb-0">Access game results and statistics</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="/games" class="btn btn-info btn-sm">
                                <i class="fas fa-eye me-1"></i>
                                View Games
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Quick Stats</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-center">
                                    <h3 class="text-primary mb-1">12</h3>
                                    <p class="text-muted mb-0">Total Teams</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h3 class="text-success mb-1">144</h3>
                                    <p class="text-muted mb-0">Active Players</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">System Status</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2">
                                <i class="fas fa-database text-success fs-12"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted">API Connection: Active</p>
                                <small class="text-muted">Last checked: Just now</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2">
                                <i class="fas fa-check text-success fs-12"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted">Database: Connected</p>
                                <small class="text-muted">All systems operational</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</DefaultLayout>
