<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {
        advancedTimelineChart,
        basicTimelineChart,
        distributedTimelineChart, groupRowsTimelineChart,
        multiSeriesTimelineChart
    } from "./data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Timeline'
        },
        {
            id: 'distributed',
            title: 'Distributed Timeline'
        },
        {
            id: 'multi-series',
            title: 'Multi Series Timeline'
        },
        {
            id: 'advanced',
            title: 'Advanced Timeline'
        },
        {
            id: 'group-rows',
            title: 'Multiple Series - Group Rows'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Timeline Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Timeline" titleClass="mb-3" id="basic">
                <div dir="ltr">
                    <ApexChart options={basicTimelineChart} id="basic-timeline"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Distributed Timeline" titleClass="mb-3" id="distributed">
                <div dir="ltr">
                    <ApexChart options={distributedTimelineChart} id="distributed-timeline"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Multi Series Timeline" titleClass="mb-3" id="multi-series">
                <div dir="ltr">
                    <ApexChart options={multiSeriesTimelineChart} id="multi-series-timeline"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Advanced Timeline" titleClass="mb-3" id="advanced">
                <div dir="ltr">
                    <ApexChart options={advancedTimelineChart} id="advanced-timeline"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Multiple Series - Group Rows" titleClass="mb-3" id="group-rows">
                <div dir="ltr">
                    <ApexChart options={groupRowsTimelineChart} id="group-rows-timeline"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>