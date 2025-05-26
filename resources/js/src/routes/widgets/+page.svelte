<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Alert, Button, Card, CardTitle, Col, Row} from "@sveltestrap/sveltestrap";
    import {statistics1, statistics2, statistics3} from "./components/data";
    import StatisticsCard1 from "./components/StatisticsCard1.svelte";
    import {conversionsChartOptions, performanceChartOptions} from "./components/data";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import ProjectSummary from "./components/ProjectSummary.svelte";
    import Schedule from "./components/Schedule.svelte";
    import StatisticsCard2 from "./components/StatisticsCard2.svelte";
    import StatisticsCard3 from "./components/StatisticsCard3.svelte";
    import Tasks from "./components/Tasks.svelte";
    import FriendRequests from "./components/FriendRequests.svelte";
    import RecentTransactions from "./components/RecentTransactions.svelte";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Widgets" subTitle="Reback"/>

    <Row>
        {#each statistics1 as item,idx}
            <div class="col-xl {idx === 4 ? 'col-lg-6 col-md-12' : idx === 3 ? 'col-lg-6 col-md-6' : 'col-lg-4 col-md-6'}">
                <StatisticsCard1 item={item}/>
            </div>
        {/each}
    </Row>

    <Row>
        <Col xl="6">
            <ProjectSummary/>
        </Col>

        <Col xl="6">
            <Schedule/>
        </Col>
    </Row>

    <Row>
        {#each statistics2 as item}
            <Col md="6" xl="3">
                <StatisticsCard2 item={item}/>
            </Col>
        {/each}
    </Row>

    <Row>
        <Col xs="12">
            <Card>
                <div class="p-0">
                    <Row class="g-0">
                        <Col lg="4">
                            <div class="p-3">
                                <CardTitle>
                                    Conversions
                                </CardTitle>

                                <ApexChart id="conversions" options={conversionsChartOptions} customClass="mb-2 mt-n2"/>

                                <Row class="text-center">
                                    <Col xs="6">
                                        <p class="text-muted mb-2">
                                            This Week
                                        </p>
                                        <h3 class="text-dark mb-3">
                                            23.5k
                                        </h3>
                                    </Col>

                                    <Col xs="6">
                                        <p class="text-muted mb-2">
                                            Last Week
                                        </p>
                                        <h3 class="text-dark mb-3">
                                            41.05k
                                        </h3>
                                    </Col>

                                </Row>

                                <div class="text-center">
                                    <Button color="light"
                                            type="button"
                                            class="shadow-none w-100">
                                        View Details
                                    </Button>
                                </div>

                            </div>
                        </Col>

                        <Col lg="8" class="border-start">
                            <div class="p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <CardTitle>
                                        Performance
                                    </CardTitle>
                                    <div>
                                        <Button outline color="light" size="sm" class="me-1">ALL</Button>
                                        <Button outline color="light" size="sm" class="me-1">1M</Button>
                                        <Button outline color="light" size="sm" class="me-1">6M</Button>
                                        <Button outline color="light" size="sm" class="active">1Y</Button>
                                    </div>
                                </div>

                                <Alert color="info" class="mt-3 text text-truncate mb-0">
                                    We regret to inform you that
                                    our server is currently
                                    experiencing technical
                                    difficulties.
                                </Alert>

                                <div dir="ltr">
                                    <ApexChart id="performance" options={performanceChartOptions}/>
                                </div>
                            </div>
                        </Col>

                    </Row>
                </div>
            </Card>
        </Col>
    </Row>

    <Row>
        {#each statistics3 as item}
            <Col md="6" xl="3">
                <StatisticsCard3 item={item}/>
            </Col>
        {/each}
    </Row>

    <Row>
        <Col xl="4">
            <Tasks/>
        </Col>

        <Col xl="4">
            <FriendRequests/>
        </Col>

        <Col xl="4">
            <RecentTransactions/>
        </Col>
    </Row>
</DefaultLayout>