<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import { gradientDonut, imageFill, monochromePie, patternedDonut, simpleDonut, simplePie} from "./data";

    const anchorNavigation = [
        {
            id: 'simple_pie',
            title: 'Simple Pie Chart'
        },
        {
            id: 'simple_donut',
            title: 'Simple Donut Chart'
        },
        {
            id: 'monochrome',
            title: 'Monochrome Pie Area'
        },
        {
            id: 'gradient',
            title: 'Gradient Donut Chart'
        },
        {
            id: 'patterned',
            title: 'Patterned Donut Chart'
        },
        {
            id: 'image',
            title: 'Pie Chart with Image fill'
        },
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Pie Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Simple Pie Chart" titleClass="mb-3" id="simple_pie">
                <div dir="ltr">
                    <ApexChart options={simplePie} id="simple-pie"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Simple Donut Chart" titleClass="mb-3" id="simple_donut">
                <div dir="ltr">
                    <ApexChart options={simpleDonut} id="simple-donut"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Monochrome Pie Chart" titleClass="mb-3" id="monochrome">
                <div dir="ltr">
                    <ApexChart options={monochromePie} id="monochrome-pie"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Gradient Donut Chart" titleClass="mb-3" id="gradient">
                <div dir="ltr">
                    <ApexChart options={gradientDonut} id="gradient-donut"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Patterned Donut Chart" titleClass="mb-3" id="patterned">
                <div dir="ltr">
                    <ApexChart options={patternedDonut} id="patterned-donut"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Pie Chart with Image fill" titleClass="mb-3" id="image">
                <div dir="ltr">
                    <ApexChart options={imageFill} id="image-pie"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>