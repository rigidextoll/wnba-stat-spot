<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Badge, Col, Input, ListGroup, ListGroupItem, Row} from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic'
        },
        {
            id: 'active',
            title: 'Active items'
        },
        {
            id: 'disabled',
            title: 'Disabled items'
        },
        {
            id: 'links-buttons',
            title: 'Links and buttons'
        },
        {
            id: 'flush',
            title: 'Flush'
        },
        {
            id: 'numbered',
            title: 'Numbered'
        },
        {
            id: 'horizontal',
            title: 'Horizontal'
        },
        {
            id: 'contextual-classes',
            title: 'Contextual classes'
        },
        {
            id: 'custom-content',
            title: 'Custom content'
        },
        {
            id: 'checkboxes-radios',
            title: 'Checkboxes and Radios'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="List Group" subTitle="Base UI"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic" id="basic">
                <Row>
                    <Col lg="6">
                        <ListGroup>
                            <ListGroupItem>An item</ListGroupItem>
                            <ListGroupItem>A second item</ListGroupItem>
                            <ListGroupItem>A third item</ListGroupItem>
                            <ListGroupItem>A fourth item</ListGroupItem>
                            <ListGroupItem>And a fifth one</ListGroupItem>
                        </ListGroup>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Active items" id="active">
                <Row>
                    <Col lg="6">
                        <ListGroup>
                            <ListGroupItem active>An active item</ListGroupItem>
                            <ListGroupItem>A second item</ListGroupItem>
                            <ListGroupItem>A third item</ListGroupItem>
                            <ListGroupItem>A fourth item</ListGroupItem>
                            <ListGroupItem>And a fifth one</ListGroupItem>
                        </ListGroup>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Disabled items" id="disabled">
                <Row>
                    <Col lg="6">
                        <ListGroup>
                            <ListGroupItem disabled>A disabled item</ListGroupItem>
                            <ListGroupItem>A second item</ListGroupItem>
                            <ListGroupItem>A third item</ListGroupItem>
                            <ListGroupItem>A fourth item</ListGroupItem>
                            <ListGroupItem>And a fifth one</ListGroupItem>
                        </ListGroup>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Links and buttons" id="links-buttons">
                <Row class="px-3">
                    <Col md="6">
                        <ListGroup>
                            <ListGroupItem href="#" active>The current link item</ListGroupItem>
                            <ListGroupItem href="#">A second link item</ListGroupItem>
                            <ListGroupItem href="#">A third link item</ListGroupItem>
                            <ListGroupItem href="#">A fourth link item</ListGroupItem>
                            <ListGroupItem href="#" disabled>A disabled link item</ListGroupItem>
                        </ListGroup>
                    </Col>
                    <Col md="6">
                        <ListGroup>
                            <ListGroupItem active>The current button</ListGroupItem>
                            <ListGroupItem>A second button item</ListGroupItem>
                            <ListGroupItem>A third button item</ListGroupItem>
                            <ListGroupItem>A fourth button item</ListGroupItem>
                            <ListGroupItem disabled>A disabled button item</ListGroupItem>
                        </ListGroup>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Flush" id="flush">
                <Row>
                    <Col lg="6">
                        <div class="px-3">
                            <ListGroup flush>
                                <ListGroupItem>An item</ListGroupItem>
                                <ListGroupItem>A second item</ListGroupItem>
                                <ListGroupItem>A third item</ListGroupItem>
                                <ListGroupItem>A fourth item</ListGroupItem>
                                <ListGroupItem>And a fifth one</ListGroupItem>
                            </ListGroup>
                        </div>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Numbered" id="numbered">
                <Row class="px-3">
                    <Col md="6">
                        <ListGroup numbered>
                            <ListGroupItem> A list item</ListGroupItem>
                            <ListGroupItem> A list item</ListGroupItem>
                            <ListGroupItem> A list item</ListGroupItem>
                        </ListGroup>
                    </Col>
                    <Col md="6">
                        <ListGroup numbered>
                            <ListGroupItem class="d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Subheading</div>
                                    Content for list item
                                </div>
                                <Badge color="primary" pill>14</Badge>
                            </ListGroupItem>
                            <ListGroupItem class="d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Subheading</div>
                                    Content for list item
                                </div>
                                <Badge color="primary" pill>14</Badge>
                            </ListGroupItem>
                            <ListGroupItem class="d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Subheading</div>
                                    Content for list item
                                </div>
                                <Badge color="primary" pill>14</Badge>
                            </ListGroupItem>
                        </ListGroup>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Horizontal" id="horizontal">
                <Row>
                    <Col lg="6">
                        <div class="d-flex flex-column gap-2">
                            <ListGroup horizontal>
                                <ListGroupItem>An item</ListGroupItem>
                                <ListGroupItem>A second item</ListGroupItem>
                                <ListGroupItem>A third item</ListGroupItem>
                            </ListGroup>
                            <ListGroup horizontal>
                                <ListGroupItem>An item</ListGroupItem>
                                <ListGroupItem>A second item</ListGroupItem>
                                <ListGroupItem>A third item</ListGroupItem>
                            </ListGroup>
                            <ListGroup horizontal>
                                <ListGroupItem>An item</ListGroupItem>
                                <ListGroupItem>A second item</ListGroupItem>
                                <ListGroupItem>A third item</ListGroupItem>
                            </ListGroup>
                            <ListGroup horizontal>
                                <ListGroupItem>An item</ListGroupItem>
                                <ListGroupItem>A second item</ListGroupItem>
                                <ListGroupItem>A third item</ListGroupItem>
                            </ListGroup>
                            <ListGroup horizontal>
                                <ListGroupItem>An item</ListGroupItem>
                                <ListGroupItem>A second item</ListGroupItem>
                                <ListGroupItem>A third item</ListGroupItem>
                            </ListGroup>
                            <ListGroup horizontal>
                                <ListGroupItem>An item</ListGroupItem>
                                <ListGroupItem>A second item</ListGroupItem>
                                <ListGroupItem>A third item</ListGroupItem>
                            </ListGroup>
                        </div>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Contextual classes" id="contextual-classes">
                <Row>
                    <Col lg="6">
                        <ListGroup>
                            <ListGroupItem>A simple default list group item</ListGroupItem>
                            <ListGroupItem color="primary">A simple primary list group item</ListGroupItem>
                            <ListGroupItem color="secondary">A simple secondary list group item
                            </ListGroupItem>
                            <ListGroupItem color="success">A simple success list group item</ListGroupItem>
                            <ListGroupItem color="danger">A simple danger list group item</ListGroupItem>
                            <ListGroupItem color="warning">A simple warning list group item</ListGroupItem>
                            <ListGroupItem color="info">A simple info list group item</ListGroupItem>
                            <ListGroupItem color="light">A simple light list group item</ListGroupItem>
                            <ListGroupItem color="dark">A simple dark list group item</ListGroupItem>
                        </ListGroup>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Custom content" id="custom-content">
                <Row>
                    <Col lg="6">
                        <ListGroup>
                            <ListGroupItem active>
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 text-reset">List group item heading</h5>
                                    <small>3 days ago</small>
                                </div>
                                <p class="mb-1">Some placeholder content in a paragraph.</p>
                                <small>And some small print.</small>
                            </ListGroupItem>
                            <ListGroupItem>
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">List group item heading</h5>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Some placeholder content in a paragraph.</p>
                                <small class="text-muted">And some muted small print.</small>
                            </ListGroupItem>
                            <ListGroupItem>
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">List group item heading</h5>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Some placeholder content in a paragraph.</p>
                                <small class="text-muted">And some muted small print.</small>
                            </ListGroupItem>
                        </ListGroup>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Checkboxes and radios" id="checkboxes-radios">
                <Row>
                    <Col lg="6">
                        <ListGroup>
                            <ListGroupItem>
                                <Input type="checkbox" class="me-1" id="checkbox-1" name="checkbox-1"
                                       label="First checkbox"/>
                            </ListGroupItem>
                            <ListGroupItem>
                                <Input type="checkbox" class="me-1" id="checkbox-2" name="checkbox-2"
                                       label="Second checkbox"/>
                            </ListGroupItem>
                            <ListGroupItem>
                                <Input type="checkbox" class="me-1" id="checkbox-3" name="checkbox-3"
                                       label="Third checkbox"/>
                            </ListGroupItem>
                        </ListGroup>
                    </Col>
                </Row>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
