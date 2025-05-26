<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Button, Col, Row, Spinner} from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'border_spinner',
            title: 'Border Spinner'
        },
        {
            id: 'color_spinners',
            title: 'Color Spinners'
        },
        {
            id: 'growing_spinners',
            title: 'Growing Spinners'
        },
        {
            id: 'color_growing',
            title: 'Color Growing Spinners'
        },
        {
            id: 'alignment',
            title: 'Alignment'
        },
        {
            id: 'size',
            title: 'Size'
        },
        {
            id: 'placement',
            title: 'Placement'
        },
        {
            id: 'button_spinner',
            title: 'Buttons Spinner'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Spinners" subTitle="Base UI"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Border Spinners" id="border_spinner"
                             caption="Use the border spinners for a lightweight loading indicator.">
                <Spinner color="primary"/>
            </UIComponentCard>

            <UIComponentCard title="Color Spinners" id="color_spinners"
                             caption="You can use any of our text color utilities on the standard spinner.">
                <Spinner color="primary" class="me-3"/>
                <Spinner color="secondary" class="me-3"/>
                <Spinner color="success" class="me-3"/>
                <Spinner color="info" class="me-3"/>
                <Spinner color="warning" class="me-3"/>
                <Spinner color="danger" class="me-3"/>
            </UIComponentCard>

            <UIComponentCard title="Growing Spinners" id="growing_spinners"
                             caption="If you don’t fancy a border spinner, switch to the grow spinner. While it doesn’t technically spin, it does repeatedly grow!">
                <Spinner color="primary" type="grow"/>
            </UIComponentCard>

            <UIComponentCard title="Color Growing Spinners" id="color_growing"
                             caption="You can use any of our text color utilities on the standard spinner.">
                <Spinner color="primary" type="grow" class="me-3"/>
                <Spinner color="secondary" type="grow" class="me-3"/>
                <Spinner color="success" type="grow" class="me-3"/>
                <Spinner color="info" type="grow" class="me-3"/>
                <Spinner color="warning" type="grow" class="me-3"/>
                <Spinner color="danger" type="grow" class="me-3"/>
            </UIComponentCard>

            <UIComponentCard title="Alignment" id="alignment"
                             caption="Use flexbox utilities, float utilities, or text alignment utilities to place spinners exactly where you need them in any situation.">
                <div class="d-flex justify-content-center border p-2">
                    <Spinner color="primary" type="grow" class="me-3"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Size" id="size">
                <div class="mt-3">
                    <Spinner color="primary" class="me-3" size="sm"/>
                    <Spinner color="primary" type="grow" class="me-3" size="sm"/>
                    <Spinner color="primary" class="me-3"/>
                    <Spinner color="primary" type="grow" class="me-3"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Placement" id="placement"
                             caption="Use <code>flexbox utilities</code>, <code>float utilities</code>, or <code>text alignment</code> utilities to place spinners exactly where you need them in any situation.">
                <div class="d-flex align-items-center border p-2">
                    <strong>Loading...</strong>
                    <Spinner color="primary" class="ms-auto"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Buttons Spinner" id="button_spinner"
                             caption="Use spinners within buttons to indicate an action is currently processing or taking place. You may also swap the text out of the spinner element and utilize button text as needed.">
                <Button color="primary" class="me-1" disabled>
                    <Spinner size="sm"/>
                    Loading...
                </Button>

                <Button color="primary" disabled>
                    <Spinner type="grow" size="sm"/>
                    Loading...
                </Button>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
