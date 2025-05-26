<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Button, Card, CardBody, CardTitle, Col, Row} from "@sveltestrap/sveltestrap";
    import {
        areaNullValueChart,
        basicAreaChart,
        dateTimeChart,
        irregularTimeSeries,
        negativeValuesChart,
        spilineChart,
        stackedChart
    } from "./data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Area Chart'
        },
        {
            id: 'spline',
            title: 'Spline Area'
        },
        {
            id: 'datetime',
            title: 'Area Chart - Datetime X-axis'
        },
        {
            id: 'negative',
            title: 'Area with Negative Values'
        },
        {
            id: 'stacked',
            title: 'Stacked Area'
        },
        {
            id: 'timeSeries',
            title: 'Irregular TimeSeries'
        },
        {
            id: 'chart-nullvalues',
            title: 'Area Chart with Null values'
        }
    ]
</script>


<DefaultLayout>
    <PageBreadcrumb title="Area Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Area Chart" id="basic" titleClass="mb-3">
                <div dir="ltr">
                    <div id="basic-area">
                        <ApexChart options={basicAreaChart} id="basic-area"/>
                    </div>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Spline Area" id="spline" titleClass="mb-3">
                <div dir="ltr">
                    <ApexChart options={spilineChart} id="spline-area"/>
                </div>
            </UIComponentCard>

            <Card>
                <CardBody>
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                        <CardTitle class="anchor" id="datetime"> Area Chart - Datetime X-axis<a
                                class="anchor-link" href="#datetime">#</a></CardTitle>
                        <div class="toolbar apex-toolbar hstack gap-1">
                            <Button id="one_month" size="sm" color="" class="btn-soft-secondary"> 1M</Button>
                            <Button id="six_months" size="sm" color="" class="btn-soft-secondary"> 6M
                            </Button>
                            <Button id="one_year" size="sm" color="" class="btn-soft-secondary active"> 1Y
                            </Button>
                            <Button id="ytd" size="sm" color="" class="btn-soft-secondary"> YTD</Button>
                            <Button id="all" size="sm" color="" class="btn-soft-secondary"> ALL</Button>
                        </div>
                    </div>
                    <div dir="ltr">
                        <ApexChart options={dateTimeChart} id="area-chart-datetime"/>
                    </div>
                </CardBody>
            </Card>

            <UIComponentCard title="Area with Negative Values" id="negative" titleClass="mb-3">
                <div dir="ltr">
                    <ApexChart options={negativeValuesChart} id="area-chart-negative"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Stacked Area" id="stacked" titleClass="mb-3">
                <div dir="ltr">
                    <ApexChart options={stackedChart} id="stacked-area"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Irregular TimeSeries" id="timeSeries" titleClass="mb-3">
                <div dir="ltr">
                    <ApexChart options={irregularTimeSeries} id="area-timeSeries"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Area Chart with Null values" id="chart-nullvalues" titleClass="mb-3">
                <div dir="ltr">
                    <ApexChart options={areaNullValueChart} id="area-chart-nullvalues"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>