<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {basicRadarChart, polygonFillChart, multipleSeriesChart} from "./data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Radar Chart'
        },
        {
            id: 'polygon',
            title: 'Radar with Polygon-fill'
        },
        {
            id: 'multiple-series',
            title: 'Radar – Multiple Series'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Radar Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Radar Chart" titleClass="mb-3" id="basic">
                <div dir="ltr">
                    <ApexChart options={basicRadarChart} id="basic-radar"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Radar with Polygon-fill" titleClass="mb-3" id="polygon">
                <div dir="ltr">
                    <ApexChart options={polygonFillChart} id="radar-polygon"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Radar – Multiple Series" titleClass="mb-3" id="multiple-series">
                <div dir="ltr">
                    <ApexChart options={multipleSeriesChart} id="multiple-series"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>