<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import {
        Button,
        ButtonGroup,
        Col,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle,
        Row
    } from "@sveltestrap/sveltestrap";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";

    const anchorNavigation = [
        {
            id: 'default',
            title: 'Default Example'
        },
        {
            id: 'rounded',
            title: 'Rounded Buttons'
        },
        {
            id: 'outline',
            title: 'Outline Buttons'
        },
        {
            id: 'outline-rounded',
            title: 'Outline Rounded Buttons'
        },
        {
            id: 'soft',
            title: 'Soft Buttons'
        },
        {
            id: 'soft-rounded',
            title: 'Soft Rounded Buttons'
        },
        {
            id: 'width',
            title: 'Button Width'
        },
        {
            id: 'sizes',
            title: 'Button Sizes'
        },
        {
            id: 'disabled',
            title: 'Disabled Button'
        },
        {
            id: 'icon',
            title: 'Icon Button'
        },
        {
            id: 'group',
            title: 'Button Group'
        },
        {
            id: 'block',
            title: 'Block Button'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Buttons" subTitle="Base UI"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="Default Buttons" id="default">
                <div class="button-list">
                    <Button color="primary"> Primary</Button>
                    <Button color="secondary"> Secondary</Button>
                    <Button color="success"> Success</Button>
                    <Button color="info"> Info</Button>
                    <Button color="warning"> Warning</Button>
                    <Button color="danger"> Danger</Button>
                    <Button color="dark"> Dark</Button>
                    <Button color="purple">Purple</Button>
                    <Button color="pink">Pink</Button>
                    <Button color="orange">Orange</Button>
                    <Button color="light"> Light</Button>
                    <Button color="link"> Link</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Rounded Buttons" id="rounded">
                <div class="button-list">
                    <Button class="rounded-pill" color="primary"> Primary</Button>
                    <Button class="rounded-pill" color="secondary"> Secondary</Button>
                    <Button class="rounded-pill" color="success"> Success</Button>
                    <Button class="rounded-pill" color="info"> Info</Button>
                    <Button class="rounded-pill" color="warning"> Warning</Button>
                    <Button class="rounded-pill" color="danger"> Danger</Button>
                    <Button class="rounded-pill" color="dark"> Dark</Button>
                    <Button class="rounded-pill" color="purple">Purple</Button>
                    <Button class="rounded-pill" color="pink">Pink</Button>
                    <Button class="rounded-pill" color="orange">Orange</Button>
                    <Button class="rounded-pill" color="light"> Light</Button>
                    <Button class="rounded-pill" color="link"> Link</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Outline Buttons" id="outline">
                <div class="button-list">
                    <Button outline color="primary"> Primary</Button>
                    <Button outline color="secondary"> Secondary</Button>
                    <Button outline color="success"> Success</Button>
                    <Button outline color="info"> Info</Button>
                    <Button outline color="warning"> Warning</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Outline Rounded Buttons" id="outline-rounded">
                <div class="button-list">
                    <Button outline class="rounded-pill" color="primary"> Primary</Button>
                    <Button outline class="rounded-pill" color="secondary"> Secondary</Button>
                    <Button outline class="rounded-pill" color="success"> Success</Button>
                    <Button outline class="rounded-pill" color="info"> Info</Button>
                    <Button outline class="rounded-pill" color="warning"> Warning</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Soft Buttons" id="soft">
                <div class="button-list">
                    <Button class="btn-soft-primary" color=""> Primary</Button>
                    <Button class="btn-soft-secondary" color=""> Secondary</Button>
                    <Button class="btn-soft-success" color=""> Success</Button>
                    <Button class="btn-soft-info" color=""> Info</Button>
                    <Button class="btn-soft-warning" color=""> Warning</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Soft Rounded Buttons" id="soft-rounded">
                <div class="button-list">
                    <Button class="rounded-pill btn-soft-primary" color=""> Primary</Button>
                    <Button class="rounded-pill btn-soft-secondary" color=""> Secondary</Button>
                    <Button class="rounded-pill btn-soft-success" color=""> Success</Button>
                    <Button class="rounded-pill btn-soft-info" color=""> Info</Button>
                    <Button class="rounded-pill btn-soft-warning" color=""> Warning</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Button Width" id="width">
                <div class="button-list">
                    <Button class="width-xl" color="primary"> Primary</Button>
                    <Button class="width-lg" color="secondary"> Secondary</Button>
                    <Button class="width-md" color="success"> Success</Button>
                    <Button class="width-sm" color="info"> Info</Button>
                    <Button class="width-xs" color="warning"> Warning</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Button Sizes" id="sizes">
                <div class="button-list">
                    <Button size="sm" color="primary"> Small</Button>
                    <Button size="md" color="secondary"> Normal</Button>
                    <Button size="lg" color="success"> Large</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Disabled Button" id="disabled">
                <div class="button-list">
                    <Button color="primary" disabled> Primary</Button>
                    <Button color="secondary" disabled> Secondary</Button>
                    <Button color="success" disabled> Success</Button>
                    <Button color="info" disabled> Info</Button>
                    <Button color="warning" disabled> Warning</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Icon Button" id="icon">
                <div class="button-list">
                    <Button color="primary">
                        <i class="bx bx-heart"></i>
                    </Button>
                    <Button color="secondary">
                        <i class="bx bx-user-voice"></i>
                    </Button>
                    <Button color="success">
                        <i class="bx bx-check-double"></i>
                    </Button>
                    <Button color="info"><i class="bx bx-cloud me-1"></i>Cloud Hosting</Button>
                    <Button color="warning"><i class="bx bx-info-circle me-1"></i>Warning</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Button Group" id="group">
                <Row class="mt-3">
                    <Col md="6">
                        <ButtonGroup class="mb-1 me-1">
                            <Button color="light"> Left</Button>
                            <Button color="light"> Middle</Button>
                            <Button color="light"> Right</Button>
                        </ButtonGroup>
                        <ButtonGroup class="mb-1 me-1">
                            <Button color="light"> 1</Button>
                            <Button color="light"> 2</Button>
                            <Button color="secondary"> 3</Button>
                            <Button color="light"> 4</Button>
                        </ButtonGroup>
                        <ButtonGroup class="mb-1 me-1">
                            <Button color="light"> 5</Button>
                            <Button color="secondary"> 6</Button>
                            <Button color="light"> 7</Button>

                            <Dropdown>
                                <DropdownToggle caret color="light">
                                    Dropdown
                                </DropdownToggle>
                                <DropdownMenu>
                                    <DropdownItem>Dropdown link</DropdownItem>
                                    <DropdownItem>Dropdown link</DropdownItem>
                                </DropdownMenu>
                            </Dropdown>
                        </ButtonGroup>
                    </Col>
                    <Col md="6">
                        <ButtonGroup vertical class="me-4">
                            <Button color="light"> Top</Button>
                            <Button color="light"> Middle</Button>
                            <Button color="light"> Bottom</Button>
                        </ButtonGroup>
                        <ButtonGroup vertical>
                            <Button color="light"> Button 1</Button>
                            <Button color="light"> Button 2</Button>
                            <Dropdown>
                                <DropdownToggle caret color="light">
                                    Button 3
                                </DropdownToggle>
                                <DropdownMenu>
                                    <DropdownItem>Dropdown link</DropdownItem>
                                    <DropdownItem>Dropdown link</DropdownItem>
                                </DropdownMenu>
                            </Dropdown>
                        </ButtonGroup>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Block Button" id="block">
                <div class="d-grid gap-2">
                    <Button size="sm" color="primary" block> Block Button</Button>
                    <Button size="md" color="secondary" block> Block Button</Button>
                    <Button size="lg" color="success" block> Block Button</Button>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>