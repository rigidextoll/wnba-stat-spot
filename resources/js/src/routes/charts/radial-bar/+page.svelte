<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {
        basicRadialBarChart,
        circleWithImageChart,
        customAngleChart, gradientCircularChart,
        multipleRadialBarsChart, semiCircleGaugeChart,
        strokedCircularGuageChart
    } from "./data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic RadialBar Chart'
        },
        {
            id: 'multiple',
            title: 'Multiple RadialBars'
        },
        {
            id: 'circle-angle',
            title: 'Circle Chart - Custom Angle'
        },
        {
            id: 'image',
            title: 'Circle Chart with Image'
        },
        {
            id: 'stroked-guage',
            title: 'Stroked Circular Gauge'
        },
        {
            id: 'gradient',
            title: 'Gradient Circular Chart'
        },
        {
            id: 'semi-circle',
            title: 'Semi Circle Gauge'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="RadialBar Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic RadialBar Chart" titleClass="mb-4" id="basic">
                <div dir="ltr">
                    <ApexChart options={basicRadialBarChart} id="basic-radialbar"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Multiple RadialBars" titleClass="mb-4" id="multiple">
                <div dir="ltr">
                    <ApexChart options={multipleRadialBarsChart} id="multiple-radialbar"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Circle Chart - Custom Angle" titleClass="mb-4" id="circle-angle">
                <div class="text-center" dir="ltr">
                    <ApexChart options={customAngleChart} id="circle-angle-radial"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Circle Chart with Image" titleClass="mb-4" id="image">
                <div dir="ltr">
                    <ApexChart options={circleWithImageChart} id="image-radial"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Stroked Circular Gauge" titleClass="mb-4" id="stroked-guage">
                <div dir="ltr">
                    <ApexChart options={strokedCircularGuageChart} id="stroked-guage-radial"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Gradient Circular Chart" titleClass="mb-4" id="gradient">
                <div dir="ltr">
                    <ApexChart options={gradientCircularChart} id="gradient-chart"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Semi Circle Gauge" titleClass="mb-4" id="semi-circle">
                <div dir="ltr">
                    <ApexChart options={semiCircleGaugeChart} id="semi-circle-gauge"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>