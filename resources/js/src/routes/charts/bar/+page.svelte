<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";

    import {
        basicBarChart, chartWithMarker, customDataLabelsChart,
        fullStackedChart,
        groupedBarChart, imageChart,
        negativeValueChart, patternChart,
        reversedChart,
        stackedChart
    } from "./data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Bar Chart'
        },
        {
            id: 'grouped',
            title: 'Grouped Bar Chart'
        },
        {
            id: 'stacked',
            title: 'Stacked Bar Chart'
        },
        {
            id: 'full-stacked',
            title: '100% Stacked Bar Chart'
        },
        {
            id: 'negative',
            title: 'Bar with Negative Values'
        },
        {
            id: 'reversed',
            title: 'Reversed Bar Chart'
        },
        {
            id: 'image-fill',
            title: 'Bar with Image Fill'
        },
        {
            id: 'datalables',
            title: 'Custom DataLabels Bar'
        },
        {
            id: 'pattern',
            title: 'Patterned Bar Chart'
        },
        {
            id: 'markers',
            title: 'Bar with Markers'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Bar Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Bar Chart" id="basic">
                <ApexChart options={basicBarChart} id="basic-bar"/>
            </UIComponentCard>

            <UIComponentCard title="Grouped Bar Chart" id="grouped">
                <ApexChart options={groupedBarChart} customClass="text-white" id="grouped-bar"/>
            </UIComponentCard>

            <UIComponentCard title="Stacked Bar Chart" id="stacked">
                <ApexChart options={stackedChart} id="stacked-bar" dir="ltr"/>
            </UIComponentCard>

            <UIComponentCard title="100% Stacked Bar Chart" id="full-stacked">
                <ApexChart options={fullStackedChart} id="full-stacked-bar"/>
            </UIComponentCard>

            <UIComponentCard title="Bar with Negative Values" id="negative">
                <ApexChart options={negativeValueChart} id="negative-bar"/>
            </UIComponentCard>

            <UIComponentCard title="Reversed Bar Chart" id="reversed">
                <ApexChart options={reversedChart} id="reversed-bar"/>
            </UIComponentCard>

            <UIComponentCard title="Bar with Image Fill" id="image-fill">
                <ApexChart options={imageChart} id="image-fill-bar"/>
            </UIComponentCard>

            <UIComponentCard title="Custom DataLabels Bar" id="datalables">
                <ApexChart options={customDataLabelsChart} id="datalables-bar"/>
            </UIComponentCard>

            <UIComponentCard title="Patterned Bar Chart" id="pattern">
                <ApexChart options={patternChart} id="pattern-bar"/>
            </UIComponentCard>

            <UIComponentCard title="Bar with Markers" id="markers">
                <ApexChart options={chartWithMarker} id="bar-bar"/>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
