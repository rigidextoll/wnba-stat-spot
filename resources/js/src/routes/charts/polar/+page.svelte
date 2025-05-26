<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {basicPolarAreaChart, monochromePolarAreaChart} from "./data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Polar Area Chart'
        },
        {
            id: 'monochrome',
            title: 'Monochrome Polar Area'
        }
    ]
</script>


<DefaultLayout>
    <PageBreadcrumb title="Polar Area Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Polar Area Chart" titleClass="mb-3" id="basic">
                <div dir="ltr">
                    <ApexChart options={basicPolarAreaChart} id="basic-polar-area"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Monochrome Polar Area" titleClass="mb-3" id="monochrome">
                <div dir="ltr">
                    <ApexChart options={monochromePolarAreaChart} id="monochrome-polar-area"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>