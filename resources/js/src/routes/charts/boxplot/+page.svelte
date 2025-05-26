<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {basicBoxplotChart, scatterBoxplotChart} from "./data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Boxplot'
        },
        {
            id: 'scatter',
            title: 'Scatter Boxplot'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Bar Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Boxplot" id="basic" titleClass="mb-3">
                <div dir="ltr">
                    <ApexChart options={basicBoxplotChart} id="basic-boxplot"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Scatter Boxplot" id="scatter" titleClass="mb-3">
                <div dir="ltr">
                    <ApexChart options={scatterBoxplotChart} id="scatter-boxplot"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>