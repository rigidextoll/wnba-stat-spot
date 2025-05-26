<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {basicHeatmap, colorRangeHeatmap, multipleHeatmap, rangeWithoutShade} from "./data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Heatmap - Single Series'
        },
        {
            id: 'multiple-series',
            title: 'Heatmap - Multiple Series'
        },
        {
            id: 'color-range',
            title: 'Heatmap - Color Range'
        },
        {
            id: 'rounded',
            title: 'Heatmap - Range without Shades'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Heatmap Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Heatmap - Single Series" titleClass="mb-3" id="basic">
                <div dir="ltr">
                    <ApexChart options={basicHeatmap} id="basic-heatmap"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Heatmap - Multiple Series" titleClass="mb-3" id="multiple-series">
                <div dir="ltr">
                    <ApexChart options={multipleHeatmap} id="multiple-series-heatmap"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Heatmap - Color Range" titleClass="mb-3" id="color-range">
                <div dir="ltr">
                    <ApexChart options={colorRangeHeatmap} id="color-range-heatmap"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Heatmap - Range without Shades" titleClass="mb-3" id="rounded">
                <div dir="ltr">
                    <ApexChart options={rangeWithoutShade} id="rounded-heatmap"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>