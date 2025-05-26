<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import {Badge, Button, Col, Row} from "@sveltestrap/sveltestrap";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";

    const anchorNavigation = [
        {
            id: 'heading',
            title: 'Heading'
        },
        {
            id: 'default_pill_badges',
            title: 'Default & Pill Badges'
        },
        {
            id: 'outline_badges',
            title: 'Outline & Outline Pill Badges'
        },
        {
            id: 'soft_badges',
            title: 'Soft & Soft Pill Badges'
        },
        {
            id: 'component_badges',
            title: 'Buttons & Position'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Badges" subTitle="Base UI"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Heading" id="heading">
                <h1>
                    h1.Example heading
                    <Badge color="primary">New</Badge>
                </h1>
                <h2>
                    h2.Example heading
                    <Badge color="secondary">New</Badge>
                </h2>
                <h3>
                    h3.Example heading
                    <Badge color="success">New</Badge>
                </h3>
                <h4>
                    h4.Example heading
                    <Badge color="info">New</Badge>
                </h4>
                <h5>
                    h5.Example heading
                    <Badge color="warning">New</Badge>
                </h5>
                <h6 class="mb-0">
                    h6.Example heading
                    <Badge color="danger">New</Badge>
                </h6>
            </UIComponentCard>

            <UIComponentCard title="Default & Pill Badges" id="default_pill_badges">
                <div class="mb-3">
                    <Badge color="primary" class="me-1">Primary</Badge>
                    <Badge color="secondary" class="me-1">Secondary</Badge>
                    <Badge color="success" class="me-1">Success</Badge>
                    <Badge color="info" class="me-1">Info</Badge>
                    <Badge color="warning" class="me-1">Warning</Badge>
                    <Badge color="danger" class="me-1">Danger</Badge>
                    <Badge color="dark" class="me-1">Dark</Badge>
                    <Badge class="bg-purple me-1">Purple</Badge>
                    <Badge class="bg-pink me-1">Pink</Badge>
                    <Badge class="bg-orange me-1">Orange</Badge>
                </div>

                <div>
                    <Badge pill color="primary" class="me-1">Primary</Badge>
                    <Badge pill color="secondary" class="me-1">Secondary</Badge>
                    <Badge pill color="success" class="me-1">Success</Badge>
                    <Badge pill color="info" class="me-1">Info</Badge>
                    <Badge pill color="warning" class="me-1">Warning</Badge>
                    <Badge pill color="danger" class="me-1">Danger</Badge>
                    <Badge pill color="dark" class="me-1">Dark</Badge>
                    <Badge pill class="bg-purple me-1">Purple</Badge>
                    <Badge pill class="bg-pink me-1">Pink</Badge>
                    <Badge pill class="bg-orange me-1">Orange</Badge>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Outline & Outline Pill Badges" id="outline_badges">
                <div class="mb-3">
                    <Badge color="" class="badge-outline-primary me-1">Primary</Badge>
                    <Badge color="" class="badge-outline-secondary me-1">Secondary</Badge>
                    <Badge color="" class="badge-outline-success me-1">Success</Badge>
                    <Badge color="" class="badge-outline-info me-1">Info</Badge>
                    <Badge color="" class="badge-outline-warning me-1">Warning</Badge>
                    <Badge color="" class="badge-outline-danger me-1">Danger</Badge>
                    <Badge color="" class="badge-outline-dark me-1">Dark</Badge>
                    <Badge color="" class="badge-outline-purple me-1">Purple</Badge>
                    <Badge color="" class="badge-outline-pink me-1">Pink</Badge>
                    <Badge color="" class="badge-outline-orange me-1">Orange</Badge>
                </div>
                <div>
                    <Badge pill color="" class="badge-outline-primary me-1">Primary</Badge>
                    <Badge pill color="" class="badge-outline-secondary me-1">Secondary</Badge>
                    <Badge pill color="" class="badge-outline-success me-1">Success</Badge>
                    <Badge pill color="" class="badge-outline-info me-1">Info</Badge>
                    <Badge pill color="" class="badge-outline-warning me-1">Warning</Badge>
                    <Badge pill color="" class="badge-outline-danger me-1">Danger</Badge>
                    <Badge pill color="" class="badge-outline-dark me-1">Dark</Badge>
                    <Badge pill color="" class="badge-outline-purple me-1">Purple</Badge>
                    <Badge pill color="" class="badge-outline-pink me-1">Pink</Badge>
                    <Badge pill color="" class="badge-outline-orange me-1">Orange</Badge>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Soft & Soft Pill Badges" id="soft_badges">
                <div class="my-3">
                    <Badge color="" class="badge-soft-primary me-1">Primary</Badge>
                    <Badge color="" class="badge-soft-secondary me-1">Secondary</Badge>
                    <Badge color="" class="badge-soft-success me-1">Success</Badge>
                    <Badge color="" class="badge-soft-info me-1">Info</Badge>
                    <Badge color="" class="badge-soft-warning me-1">Warning</Badge>
                    <Badge color="" class="badge-soft-danger me-1">Danger</Badge>
                    <Badge color="" class="badge-soft-dark me-1">Dark</Badge>
                    <Badge color="" class="badge-soft-purple me-1">Purple</Badge>
                    <Badge color="" class="badge-soft-pink me-1">Pink</Badge>
                    <Badge color="" class="badge-soft-orange me-1">Orange</Badge>
                </div>
                <div>
                    <Badge pill color="" class="badge-soft-primary me-1">Primary</Badge>
                    <Badge pill color="" class="badge-soft-secondary me-1">Secondary</Badge>
                    <Badge pill color="" class="badge-soft-success me-1">Success</Badge>
                    <Badge pill color="" class="badge-soft-info me-1">Info</Badge>
                    <Badge pill color="" class="badge-soft-warning me-1">Warning</Badge>
                    <Badge pill color="" class="badge-soft-danger me-1">Danger</Badge>
                    <Badge pill color="" class="badge-soft-dark me-1">Dark</Badge>
                    <Badge pill color="" class="badge-soft-purple me-1">Purple</Badge>
                    <Badge pill color="" class="badge-soft-pink me-1">Pink</Badge>
                    <Badge pill color="" class="badge-soft-orange me-1">Orange</Badge>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Buttons & Position" id="component_badges">
                <div class="my-3">
                    <Button color="primary" class="me-1 mb-1">
                        Notifications
                        <Badge color="danger" class="ms-1">4</Badge>
                    </Button>
                    <Button color="outline-primary" class="me-1 mb-1">
                        Notifications
                        <Badge color="primary" class="ms-1">new</Badge>
                    </Button>
                    <Button class="btn-soft-primary me-1 mb-1">
                        Notifications
                        <Badge color="primary" class="ms-1">11</Badge>
                    </Button>
                    <a href={"#"} class="btn me-1 mb-1">
                        Notifications
                        <Badge color="primary" class="ms-1">90+</Badge>
                    </a>
                </div>

                <div>
                    <Button color="primary" class="position-relative me-3">
                        Inbox
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">99+</span>
                    </Button>
                    <Button color="primary" class="position-relative">
                        Profile
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                    </Button>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
