<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {lineAreaChart, lineColumnAreaChart, lineColumnChart, multipleYAxisChart} from "./data";

    const anchorNavigation = [
        {
            id: 'line-column',
            title: 'Line & Column Chart'
        },
        {
            id: 'multiple-yaxis',
            title: 'Multiple Y-Axis Chart'
        },
        {
            id: 'line-area',
            title: 'Line & Area Chart'
        },
        {
            id: 'all',
            title: 'Line, Column & Area Chart'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Mixed Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Line & Column Chart" titleClass="mb-3" id="line-column">
                <div dir="ltr">
                    <ApexChart options={lineColumnChart} id="line-column-mixed"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Multiple Y-Axis Chart" titleClass="mb-3" id="multiple-yaxis">
                <div dir="ltr">
                    <ApexChart options={multipleYAxisChart} id="multiple-yaxis-mixed"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Line & Area Chart" titleClass="mb-3" id="line-area">
                <div dir="ltr">
                    <ApexChart options={lineAreaChart} id="line-area-mixed"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Line, Column & Area Chart" titleClass="mb-3" id="all">
                <div dir="ltr">
                    <ApexChart options={lineColumnAreaChart} id="all-mixed"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>