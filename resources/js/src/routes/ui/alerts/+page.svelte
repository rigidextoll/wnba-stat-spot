<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import {Alert, Col, Row} from "@sveltestrap/sveltestrap";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";

    const anchorNavigation = [
        {
            id: 'overview',
            title: 'Basic Example'
        },
        {
            id: 'alert-dismissible',
            title: 'Alert Dismissible'
        },
        {
            id: 'alert-link',
            title: 'Alert Link'
        },
        {
            id: 'alert-icon',
            title: 'Icons Alert'
        },
        {
            id: 'alert-additional',
            title: 'Additional Content Alert'
        }
    ]

    const alerts = [
        {variant: 'primary', content: 'A simple primary alert—check it out!', dismissible: true},
        {variant: 'secondary', content: 'A simple secondary alert—check it out!', dismissible: true},
        {variant: 'success', content: 'A simple success alert—check it out!', dismissible: true},
        {variant: 'danger', content: 'A simple danger alert—check it out!', dismissible: true},
        {variant: 'warning', content: 'A simple warning alert—check it out!', dismissible: true},
        {variant: 'info', content: 'A simple info alert—check it out!', dismissible: true},
        {variant: 'light', content: 'A simple light alert—check it out!', dismissible: true},
        {variant: 'dark', content: 'A simple dark alert—check it out!', dismissible: true}
    ];


    const iconAlerts = [
        {variant: 'primary', icon: 'bx bx-info-circle', content: 'A simple primary alert—check it out!'},
        {variant: 'secondary', icon: 'bx bx-x-circle', content: 'A simple secondary alert—check it out!'},
        {variant: 'success', icon: 'bx bx-check-shield', content: 'A simple success alert—check it out!'},
        {variant: 'danger', icon: 'bx bx-info-circle', content: 'A simple danger alert—check it out!'}
    ];
</script>

<DefaultLayout>
    <PageBreadcrumb title="Alerts" subTitle="Base UI"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Example" id="overview">
                {#each alerts as alert}
                    <Alert color={alert.variant}>
                        {alert.content}
                    </Alert>
                {/each}
            </UIComponentCard>

            <UIComponentCard title="Dismissible Alerts Example" id="alert-dismissible">
                {#each alerts as alert}
                    <Alert color={alert.variant} dismissible={alert.dismissible}>
                        {alert.content}
                    </Alert>
                {/each}
            </UIComponentCard>

            <UIComponentCard title="Alert Link Example" id="alert-link">
                {#each iconAlerts as alert}
                    <Alert color={alert.variant}>
                        A simple primary alert with <a href={"#"} class="alert-link">an example link</a> Give it a click
                        if you like.
                    </Alert>
                {/each}
            </UIComponentCard>

            <UIComponentCard title="Icons Alerts Example" id="alert-icon">
                {#each iconAlerts as alert}
                    <Alert color={alert.variant} class="alert-icon">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm rounded bg-{alert.variant} d-flex justify-content-center align-items-center fs-18 me-2 flex-shrink-0">
                                <i class={alert.icon + ' text-white'}></i>
                            </div>
                            <div class="flex-grow-1">{alert.content}</div>
                        </div>
                    </Alert>
                {/each}
            </UIComponentCard>

            <UIComponentCard title="Additional Content Alert Example" id="alert-additional">
                <Row>
                    <Col xl="6">
                        <Alert color="primary" class="mb-3 p-3 mb-xl-0">
                            <h4 class="alert-heading">Well done!</h4>
                            <p class="mb-0">Aww yeah, you successfully read this important alert message. This example
                                text is going to run a bit longer so that you can see how spacing within an alert works
                                with this kind of content.</p>
                            <hr/>
                            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice
                                and tidy.</p>
                        </Alert>
                    </Col>
                    <Col xl="6">
                        <Alert color="secondary" class="p-3 mb-0">
                            <h4 class="alert-heading">Well done!</h4>
                            <p class="mb-0">Aww yeah, you successfully read this important alert message. This example
                                text is going to run a bit longer so that you can see how spacing within an alert works
                                with this kind of content.</p>
                            <hr/>
                            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice
                                and tidy.</p>
                        </Alert>
                    </Col>
                </Row>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>