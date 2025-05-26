<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Breadcrumb, BreadcrumbItem, Col, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";

    const anchorNavigation = [
        {
            id: 'default',
            title: 'Default Example'
        },
        {
            id: 'dividers_breadcrumb',
            title: 'Dividers Breadcrumb'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Breadcrumb" subTitle="Base UI"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="Default Example" id="default">
                <Breadcrumb>
                    <BreadcrumbItem active>Home</BreadcrumbItem>
                </Breadcrumb>

                <Breadcrumb>
                    <BreadcrumbItem>
                        <a href={"#"}>Home</a>
                    </BreadcrumbItem>
                    <BreadcrumbItem active>Library</BreadcrumbItem>
                </Breadcrumb>

                <Breadcrumb>
                    <BreadcrumbItem>
                        <a href={"#"}>Home</a>
                    </BreadcrumbItem>
                    <BreadcrumbItem>
                        <a href={"#"}>Library</a>
                    </BreadcrumbItem>
                    <BreadcrumbItem active>Data</BreadcrumbItem>
                </Breadcrumb>
            </UIComponentCard>

            <UIComponentCard title="Dividers Breadcrumb" id="dividers_breadcrumb">
                <Breadcrumb>
                    <BreadcrumbItem active>Home</BreadcrumbItem>
                </Breadcrumb>

                <Breadcrumb divider=">">
                    <BreadcrumbItem>
                        <a href={"#"}>Home</a>
                    </BreadcrumbItem>
                    <BreadcrumbItem active>Library</BreadcrumbItem>
                </Breadcrumb>

                <Breadcrumb divider=">">
                    <BreadcrumbItem>
                        <a href={"#"}>Home</a>
                    </BreadcrumbItem>
                    <BreadcrumbItem>
                        <a href={"#"}>Library</a>
                    </BreadcrumbItem>
                    <BreadcrumbItem active>Data</BreadcrumbItem>
                </Breadcrumb>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>