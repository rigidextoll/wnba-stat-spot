<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Button, Card, CardBody, Col, Collapse, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";

    const anchorNavigation = [
        {
            id: 'default',
            title: 'Default Example'
        },
        {
            id: 'horizontal',
            title: 'Horizontal Collapse'
        },
        {
            id: 'multiple-targets',
            title: 'Multiple Targets'
        }
    ]

    let isOpenCollapse1 = false
    let isOpenCollapse2 = false
    let isOpenCollapse3 = false
    let isOpenCollapse4 = false
</script>

<DefaultLayout>
    <PageBreadcrumb title="Collapse" subTitle="Base UI"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="Default Example" id="default">
                <div class="hstack gap-2">
                    <Button color="primary" class="mb-2" on:click={() => isOpenCollapse1 = !isOpenCollapse1}>
                        Toggle
                    </Button>
                </div>
                <Collapse isOpen={isOpenCollapse1} id="collapseExample">
                    <Card class="mb-0">
                        <CardBody> Some placeholder content for the collapse component. This panel is hidden by default
                            but revealed when the user activates the relevant trigger.
                        </CardBody>
                    </Card>
                </Collapse>
            </UIComponentCard>

            <UIComponentCard title="Horizontal" id="horizontal">
                <Button class="mb-2" color="primary" on:click={() => isOpenCollapse2 = !isOpenCollapse2}>Toggle
                </Button>
                <div>
                    <Collapse isOpen={isOpenCollapse2} horizontal id="collapseWidthExample">
                        <Card class="card-body mb-0" style="width: 300px"> This is some placeholder content
                            for a horizontal collapse. It's hidden by default and shown when triggered.
                        </Card>
                    </Collapse>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Multiple Targets" id="multiple-targets">
                <div class="hstack gap-2 mb-3">
                    <Button color="primary" on:click={() => isOpenCollapse3 = !isOpenCollapse3}>Toggle first element
                    </Button>
                    <Button color="primary" on:click={() => isOpenCollapse4 = !isOpenCollapse4}>Toggle second element
                    </Button>
                    <Button color="primary"
                            on:click={() => {isOpenCollapse3 = !isOpenCollapse3; isOpenCollapse4 = !isOpenCollapse4}}>
                        Toggle both
                        elements
                    </Button>
                </div>
                <Row>
                    <Col>
                        <Collapse isOpen={isOpenCollapse3} id="multiCollapseExample1">
                            <Card class="card-body"> Some placeholder content for the first collapse component
                                of this multi-collapse example. This panel is hidden by default but revealed when the
                                user activates the relevant trigger.
                            </Card>
                        </Collapse>
                    </Col>
                    <Col>
                        <Collapse isOpen={isOpenCollapse4} id="multiCollapseExample2">
                            <Card class="card-body"> Some placeholder content for the second collapse
                                component of this multi-collapse example. This panel is hidden by default but revealed
                                when the user activates the relevant trigger.
                            </Card>
                        </Collapse>
                    </Col>
                </Row>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>