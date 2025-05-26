<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {
        basicTreemapChart,
        colorRangeTreemapChart,
        distributedTreemapChart,
        multipleSeriesTreemapChart
    } from "./data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic'
        },
        {
            id: 'multiple',
            title: 'Treemap Multiple Series'
        },
        {
            id: 'distributed',
            title: 'Distributed Treemap'
        },
        {
            id: 'color-range',
            title: 'Color Range Treemap'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Treemap Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Treemap" id="basic">
                <div dir="ltr">
                    <ApexChart options={basicTreemapChart} id="basic-treemap"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Treemap Multiple Series" id="multiple">
                <div dir="ltr">
                    <ApexChart options={multipleSeriesTreemapChart} id="multiple-treemap"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Distributed Treemap" id="distributed">
                <div dir="ltr">
                    <ApexChart options={distributedTreemapChart} id="distributed-treemap"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Color Range Treemap" id="color-range">
                <div dir="ltr">
                    <ApexChart options={colorRangeTreemapChart} id="color-range-treemap"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>