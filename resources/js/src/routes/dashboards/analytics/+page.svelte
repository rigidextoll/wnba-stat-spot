<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Row, Col, Card, CardBody, CardTitle, Button, Alert} from "@sveltestrap/sveltestrap";
    import StatisticsCard from "./components/StatisticsCard.svelte";
    import {conversionsChartOptions, performanceChartOptions, statistics} from "./components/data";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import SessionsByCountry from "./components/SessionsByCountry.svelte";
    import SessionsByBrowser from "./components/SessionsByBrowser.svelte";
    import TopPages from "./components/TopPages.svelte";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Analytics" subTitle="Dashboards"/>


    <Row>
        <Col xxl="3">
            <Row>
                {#each statistics as item}
                    <Col md="6" xxl="12">
                        <StatisticsCard item={item}/>
                    </Col>
                {/each}
            </Row>
        </Col>

        <Col xxl="9">
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
        <Col>
            <SessionsByCountry/>
        </Col>
    </Row>

    <Row>

        <Col lg="4">
            <SessionsByBrowser/>
        </Col>

        <Col lg="8">
            <TopPages/>
        </Col>
    </Row>
</DefaultLayout>