<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Button, Col, Popover, Row} from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'live-demo',
            title: 'Live demo'
        },
        {
            id: 'popover-directions',
            title: 'Popover Directions'
        },
        {
            id: 'dismiss',
            title: 'Dismiss on Next Click'
        },
        {
            id: 'hover',
            title: 'Hover'
        },
        {
            id: 'custom-popovers',
            title: 'Custom Popovers'
        },
        {
            id: 'dismissible',
            title: 'Dismissible'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Popovers" subTitle="Base UI"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Live demo" id="live-demo">
                <Button color="danger" id="default"> Click to toggle popover</Button>

                <Popover
                        target="default"
                        placement="right"
                        title="Popover title">
                    And here's some amazing content. It's very engaging. Right?
                </Popover>
            </UIComponentCard>

            <UIComponentCard title="Popover Directions" id="popover-directions"
                             caption="Four options are available: top, right, bottom, and left aligned.">
                <div class="d-flex flex-wrap gap-2">
                    <!-- Top Position -->
                    <Button color="primary" id="position-top">
                        Popover on top
                    </Button>

                    <Popover
                            target="position-top"
                            placement="top">
                        Vivamus sagittis lacus vel augue laoreet rutrum faucibus.
                    </Popover>

                    <!-- Bottom Position -->
                    <Button color="primary" id="position-bottom">
                        Popover on bottom
                    </Button>

                    <Popover
                            target="position-bottom"
                            placement="bottom">
                        Vivamus sagittis lacus vel augue laoreet rutrum faucibus.
                    </Popover>

                    <!-- Left Position -->
                    <Button color="primary" id="position-left">
                        Popover on left
                    </Button>

                    <Popover
                            target="position-left"
                            placement="left">
                        Vivamus sagittis lacus vel augue laoreet rutrum faucibus.
                    </Popover>

                    <!-- Right Position -->
                    <Button color="primary" id="position-right">
                        Popover on right
                    </Button>

                    <Popover
                            target="position-right"
                            placement="right">
                        Vivamus sagittis lacus vel augue laoreet rutrum faucibus.
                    </Popover>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Dismiss on Next Click" id="dismiss">
                <Button color="success" id="focus">
                    Dismissible popover
                </Button>

                <Popover
                        trigger="focus"
                        target="focus"
                        placement="right"
                        title="Dismissible popover"
                >
                    And here's some amazing content. It's very engaging. Right?
                </Popover>
            </UIComponentCard>

            <UIComponentCard title="Hover" id="hover">
                <Button color="dark" id="trigger-hover">
                    Please Hover Me
                </Button>

                <Popover
                        trigger="hover"
                        target="trigger-hover"
                        placement="right"
                        title="Ohh Wow !"
                >
                    And here's some amazing content. It's very engaging. Right?
                </Popover>
            </UIComponentCard>

            <UIComponentCard title="Custom Popovers" id="custom-popovers">
                <div class="button-list mt-3">
                    <Button color="primary" id="popover-1">
                        Primary popover
                    </Button>

                    <Popover
                            target="popover-1"
                            placement="top"
                            title="Primary popover"
                            class="primary-popover"
                    >
                        This popover is themed via CSS variables.
                    </Popover>

                    <Button color="success" id="popover-2">
                        Success popover
                    </Button>

                    <Popover
                            target="popover-2"
                            placement="top"
                            title="Success popover"
                            class="success-popover"
                    >
                        This popover is themed via CSS variables.
                    </Popover>

                    <Button color="danger" id="popover-3">
                        Danger popover
                    </Button>

                    <Popover
                            target="popover-3"
                            placement="top"
                            title="Danger popover"
                            class="danger-popover"
                    >
                        This popover is themed via CSS variables.
                    </Popover>

                    <Button color="info" id="popover-4">
                        Info popover
                    </Button>

                    <Popover
                            target="popover-4"
                            placement="top"
                            title="Info popover"
                            class="info-popover"
                    >
                        This popover is themed via CSS variables.
                    </Popover>

                </div>
            </UIComponentCard>

            <UIComponentCard title="Dismissible Elements" id="dismissible">
                <Button color="primary" id="btn-dismissible">
                    Dismissible button
                </Button>

                <Popover placement="right" target="btn-dismissible" dismissible>
                    This Popover is dismissible when any click occurs.
                </Popover>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
