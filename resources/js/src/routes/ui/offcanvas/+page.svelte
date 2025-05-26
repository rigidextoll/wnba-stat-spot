<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {
        Button,
        Col,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle,
        Offcanvas,
        Row
    } from "@sveltestrap/sveltestrap";

    let defaultOffcanvas = false
    let offcanvasEnd = false
    let offcanvasStart = false
    let offcanvasTop = false
    let offcanvasBottom = false

    let offcanvasScrolling = false
    let offcanvasBackdrop = false
    let offcanvasScrollingBackdrop = false

    const anchorNavigation = [
        {
            id: 'default',
            title: 'Default Buttons'
        },
        {
            id: 'static-backdrop',
            title: 'Static Backdrop'
        },
        {
            id: 'offcanvas-position',
            title: 'Offcanvas Position'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Offcanvas" subTitle="Base UI"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Default Button" id="default">
                <div class="button-list mt-3">
                    <Button color="secondary" type="button" on:click={()=>defaultOffcanvas = !defaultOffcanvas}>
                        Button
                    </Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Static Backdrop" id="static-backdrop">
                <div class="button-list mt-3">
                    <Button color="primary" type="button" on:click={()=>offcanvasScrolling = !offcanvasScrolling}>
                        Enable
                        Body Scrolling
                    </Button>
                    <Button color="secondary" type="button" on:click={()=>offcanvasBackdrop = !offcanvasBackdrop}>
                        Enable
                        Backdrop (Default)
                    </Button>
                    <Button color="success" type="button"
                            on:click={()=>offcanvasScrollingBackdrop = !offcanvasScrollingBackdrop}> Enable Both
                        Scrolling &
                        Backdrop
                    </Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Offcanvas Position" id="offcanvas-position">
                <div class="button-list mt-3">
                    <Button color="primary" type="button" on:click={()=>offcanvasStart = !offcanvasStart}> Left
                        Offcanvas
                    </Button>
                    <Button color="secondary" type="button" on:click={()=>offcanvasEnd = !offcanvasEnd}> Right Offcanvas
                    </Button>
                    <Button color="success" type="button" on:click={()=>offcanvasTop = !offcanvasTop}> Top Offcanvas
                    </Button>
                    <Button color="info" type="button" on:click={()=>offcanvasBottom = !offcanvasBottom}> Bottom
                        Offcanvas
                    </Button>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>

    <!-- Default offcanvas -->
    <Offcanvas isOpen={defaultOffcanvas} toggle="{() => defaultOffcanvas = !defaultOffcanvas}"
               placement="start" header="Offcanvas"
    >
        <p>Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists,
            etc.</p>

        <Dropdown class="mt-3">
            <DropdownToggle color="primary" caret>Dropdown button</DropdownToggle>
            <DropdownMenu>
                <DropdownItem>Action</DropdownItem>
                <DropdownItem>Another action</DropdownItem>
                <DropdownItem>Something else here</DropdownItem>
            </DropdownMenu>
        </Dropdown>
    </Offcanvas>

    <!-- Scrolling offcanvas -->
    <Offcanvas isOpen={offcanvasScrolling} toggle="{() => offcanvasScrolling = !offcanvasScrolling}"
               placement="start" header="Offcanvas"
               backdrop={false} scroll>
        <p>Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists,
            etc.</p>
        <Dropdown class="mt-3">
            <DropdownToggle color="primary" caret>Dropdown button</DropdownToggle>
            <DropdownMenu>
                <DropdownItem>Action</DropdownItem>
                <DropdownItem>Another action</DropdownItem>
                <DropdownItem>Something else here</DropdownItem>
            </DropdownMenu>
        </Dropdown>
    </Offcanvas>

    <!-- Backdrop offcanvas -->
    <Offcanvas isOpen={offcanvasBackdrop} toggle="{() => offcanvasBackdrop = !offcanvasBackdrop}"
               placement="start" header="Offcanvas"
    >
        <p>Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists,
            etc.</p>

        <Dropdown class="mt-3">
            <DropdownToggle color="primary" caret>Dropdown button</DropdownToggle>
            <DropdownMenu>
                <DropdownItem>Action</DropdownItem>
                <DropdownItem>Another action</DropdownItem>
                <DropdownItem>Something else here</DropdownItem>
            </DropdownMenu>
        </Dropdown>
    </Offcanvas>

    <!-- scrolling & Backdrop offcanvas -->
    <Offcanvas isOpen={offcanvasScrollingBackdrop}
               toggle="{() => offcanvasScrollingBackdrop = !offcanvasScrollingBackdrop}"
               placement="start" header="Offcanvas" scroll
    >
        <p>Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists,
            etc.</p>

        <Dropdown class="mt-3">
            <DropdownToggle color="primary" caret>Dropdown button</DropdownToggle>
            <DropdownMenu>
                <DropdownItem>Action</DropdownItem>
                <DropdownItem>Another action</DropdownItem>
                <DropdownItem>Something else here</DropdownItem>
            </DropdownMenu>
        </Dropdown>
    </Offcanvas>

    <!-- Left offcanvas -->
    <Offcanvas isOpen={offcanvasStart}
               toggle="{() => offcanvasStart = !offcanvasStart}"
               placement="start" header="Offcanvas"
    >
        <p>Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists,
            etc.</p>

        <Dropdown class="mt-3">
            <DropdownToggle color="primary" caret>Dropdown button</DropdownToggle>
            <DropdownMenu>
                <DropdownItem>Action</DropdownItem>
                <DropdownItem>Another action</DropdownItem>
                <DropdownItem>Something else here</DropdownItem>
            </DropdownMenu>
        </Dropdown>
    </Offcanvas>

    <!-- Right offcanvas -->
    <Offcanvas isOpen={offcanvasEnd}
               toggle="{() => offcanvasEnd = !offcanvasEnd}"
               placement="end" header="Offcanvas"
    >
        <p>Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists,
            etc.</p>

        <Dropdown class="mt-3">
            <DropdownToggle color="primary" caret>Dropdown button</DropdownToggle>
            <DropdownMenu>
                <DropdownItem>Action</DropdownItem>
                <DropdownItem>Another action</DropdownItem>
                <DropdownItem>Something else here</DropdownItem>
            </DropdownMenu>
        </Dropdown>
    </Offcanvas>

    <!-- Top offcanvas -->
    <Offcanvas isOpen={offcanvasTop}
               toggle="{() => offcanvasTop = !offcanvasTop}"
               placement="top" header="Offcanvas"
    >
        <p>Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists,
            etc.</p>

        <Dropdown class="mt-3">
            <DropdownToggle color="primary" caret>Dropdown button</DropdownToggle>
            <DropdownMenu>
                <DropdownItem>Action</DropdownItem>
                <DropdownItem>Another action</DropdownItem>
                <DropdownItem>Something else here</DropdownItem>
            </DropdownMenu>
        </Dropdown>
    </Offcanvas>

    <!-- Bottom offcanvas -->
    <Offcanvas isOpen={offcanvasBottom}
               toggle="{() => offcanvasBottom = !offcanvasBottom}"
               placement="bottom" header="Offcanvas"
    >
        <p>Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists,
            etc.</p>

        <Dropdown class="mt-3">
            <DropdownToggle color="primary" caret>Dropdown button</DropdownToggle>
            <DropdownMenu>
                <DropdownItem>Action</DropdownItem>
                <DropdownItem>Another action</DropdownItem>
                <DropdownItem>Something else here</DropdownItem>
            </DropdownMenu>
        </Dropdown>
    </Offcanvas>
</DefaultLayout>