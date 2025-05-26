<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {
        dashedLineChart,
        gradientLineChart,
        lineChart,
        lineWithDataLabel, missingChart, steplineChart,
        zoomableTimeseries
    } from "./data";

    const anchorNavigation = [
        {
            id: 'simple',
            title: 'Simple line chart'
        },
        {
            id: 'datalabel',
            title: 'Line with Data Labels'
        },
        {
            id: 'zoomable',
            title: 'Zoomable Timeseries'
        },
        {
            id: 'gradient',
            title: 'Gradient Line Chart'
        },
        {
            id: 'missing',
            title: 'Missing / Null values'
        },
        {
            id: 'dashed',
            title: 'Dashed Line Chart'
        },
        {
            id: 'stepline',
            title: 'Stepline Chart'
        },
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Line Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Simple line chart" titleClass="mb-3" id="simple">
                <div dir="ltr">
                    <ApexChart options={lineChart} id="line-chart"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Line with Data Labels" titleClass="mb-3" id="datalabel">
                <div dir="ltr">
                    <ApexChart options={lineWithDataLabel} id="line-chart-datalabel"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Zoomable Timeseries" titleClass="mb-3" id="zoomable">
                <div dir="ltr">
                    <ApexChart options={zoomableTimeseries} id="line-chart-zoomable"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Gradient Line Chart" titleClass="mb-3" id="gradient">
                <div dir="ltr">
                    <ApexChart options={gradientLineChart} id="line-chart-gradient"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Missing / Null values" titleClass="mb-3" id="missing">
                <div dir="ltr">
                    <ApexChart options={missingChart} id="line-chart-missing"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Dashed Line Chart" titleClass="mb-3" id="dashed">
                <div dir="ltr">
                    <ApexChart options={dashedLineChart} id="line-chart-dashed"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Stepline Chart" titleClass="mb-3" id="stepline">
                <div dir="ltr">
                    <ApexChart options={steplineChart} id="line-chart-stepline"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>