<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {bubbleChart3D, simpleChart} from "./data";

    const anchorNavigation = [
        {
            id: 'simple',
            title: 'Simple Bubble Chart'
        },
        {
            id: '3d-bubble',
            title: '3D Bubble Chart'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Bubble Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Simple Bubble Chart" id="simple">
                <div dir="ltr">
                    <ApexChart options={simpleChart} id="simple-bubble"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="3D Bubble Chart" id="3d-bubble">
                <div dir="ltr">
                    <ApexChart options={bubbleChart3D} id="second-bubble"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>