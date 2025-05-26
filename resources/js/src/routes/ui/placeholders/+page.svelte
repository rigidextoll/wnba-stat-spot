<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Button, Card, CardBody, CardTitle, Col, Row} from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'default',
            title: 'Overview'
        },
        {
            id: 'how-works',
            title: 'How it works'
        },
        {
            id: 'width',
            title: 'Width'
        },
        {
            id: 'color',
            title: 'Color'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Placeholder" subTitle="Base UI"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Default" id="default"
                             caption="A progress bar can be used to show a user how far along he/she is in a process.">
                <Row class="g-4">
                    <Col md="4">
                        <Card>
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="180"
                                 xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                                 preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#20c997"></rect>
                            </svg>

                            <CardBody>
                                <CardTitle class="mb-2"> Card title</CardTitle>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href={"#"} class="btn btn-primary">Go somewhere</a>
                            </CardBody>
                        </Card>
                    </Col>

                    <Col md="4">
                        <Card aria-hidden="true">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="180"
                                 xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                                 preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#868e96"></rect>
                            </svg>

                            <CardBody>
                                <div class="h5 card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </div>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                    <span class="placeholder col-4"></span>
                                    <span class="placeholder col-6"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <Button color="primary" disabled class="placeholder  col-6" aria-hidden="true"></Button>
                            </CardBody>
                        </Card>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="How it works" id="how-works"
                             caption="Create placeholders with the <code>.placeholder</code> class and a grid column class (e.g., <code>.col-6</code>) to set the <code>width</code>. They can replace the text inside an element or be added as a modifier class to an existing component.">
                <p aria-hidden="true">
                    <span class="placeholder col-6"></span>
                </p>
                <Button color="primary" disabled class="placeholder col-4" aria-hidden="true"></Button>
            </UIComponentCard>

            <UIComponentCard title="Width" id="width"
                             caption="You can change the <code>width</code> through grid column classes, width utilities, or inline styles.">
                <span class="placeholder col-6"></span>
                <span class="placeholder w-75"></span>
                <span class="placeholder" style="width: 25%"></span>
            </UIComponentCard>

            <UIComponentCard title="Color" id="color"
                             caption="By default, the <code>placeholder</code> uses <code>currentColor</code>. This can be overridden with a custom color or utility class.">
                <span class="placeholder col-12"></span>
                <span class="placeholder col-12 bg-primary"></span>
                <span class="placeholder col-12 bg-secondary"></span>
                <span class="placeholder col-12 bg-success"></span>
                <span class="placeholder col-12 bg-danger"></span>
                <span class="placeholder col-12 bg-warning"></span>
                <span class="placeholder col-12 bg-info"></span>
                <span class="placeholder col-12 bg-light"></span>
                <span class="placeholder col-12 bg-dark"></span>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>