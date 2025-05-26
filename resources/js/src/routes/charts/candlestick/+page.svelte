<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {candlestickWithLine, categoryXAxisChart, simpleChart} from "./data";

    const anchorNavigation = [
        {
            id: 'simple',
            title: 'Simple Candlestick Chart'
        },
        {
            id: 'x-axis',
            title: 'Category X-Axis'
        },
        {
            id: 'line',
            title: 'Candlestick with Line'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Candlestick Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Simple Candlestick Chart" id="simple">
                <div dir="ltr">
                    <ApexChart options={simpleChart} id="simple-candlestick"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Category X-Axis" id="x-axis" titleClass="mb-3">
                <div dir="ltr">
                    <ApexChart options={categoryXAxisChart} id="x-axis-candlestick"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Candlestick with Line" id="line" titleClass="mb-3">
                <div dir="ltr">
                    <ApexChart options={candlestickWithLine} id="candlestick-with-line"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>