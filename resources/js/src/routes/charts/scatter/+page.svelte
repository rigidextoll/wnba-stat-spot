<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {dateTimeChart, scatterWithImagesChart, scatterXYChart} from "./data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Scatter (XY) Chart'
        },
        {
            id: 'datetime',
            title: 'Scatter Chart - Datetime'
        },
        {
            id: 'images',
            title: 'Scatter - Images'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Scatter Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Scatter (XY) Chart" id="basic">
                <div dir="ltr">
                    <ApexChart options={scatterXYChart} id="basic-scatter"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Scatter Chart - Datetime" id="datetime">
                <div dir="ltr">
                    <ApexChart options={dateTimeChart} id="datetime-scatter"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Scatter - Images" id="images">
                <div dir="ltr">
                    <ApexChart options={scatterWithImagesChart} customClass="scatter-images-chart"
                               id="scatter-images"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>