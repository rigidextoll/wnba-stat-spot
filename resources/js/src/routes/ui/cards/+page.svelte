<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {
        Button,
        Card,
        CardBody,
        CardGroup,
        CardHeader,
        CardText,
        CardTitle,
        Col,
        Row
    } from "@sveltestrap/sveltestrap";

    const smallImg1 = '/images/small/img-1.jpg'
    const smallImg2 = '/images/small/img-2.jpg'
    const smallImg3 = '/images/small/img-3.jpg'
    const smallImg4 = '/images/small/img-4.jpg'
    const smallImg5 = '/images/small/img-5.jpg'
</script>

<DefaultLayout>
    <PageBreadcrumb title="Cards" subTitle="Base UI"/>

    <Row>
        <Col xl="3" md="6">
            <Card class="mb-3 mb-xl-0">
                <img class="card-img-top img-fluid" src={smallImg1} alt="img-1"/>
                <CardBody>
                    <CardTitle class="mb-2">Card title</CardTitle>
                    <p class="card-text text-muted">Some quick example text to build on the card title and make up the
                        bulk of the card's content. With supporting text below as a natural lead-in to additional
                        content.</p>
                    <a href={"#"} class="btn btn-primary">Button</a>
                </CardBody>
            </Card>
        </Col>
        <Col xl="3" md="6">
            <Card class="mb-3">
                <img class="card-img-top img-fluid" src={smallImg2} alt="img-2"/>
                <CardBody>
                    <CardTitle class="mb-2">Card title</CardTitle>
                    <p class="card-text text-muted">Some quick example text to build on the card title.</p>
                </CardBody>
                <ul class="list-group list-group-flush text-muted">
                    <li class="list-group-item text-muted">Dapibus ac facilisis in</li>
                </ul>
                <CardBody>
                    <a href={"#"} class="card-link text-primary">Card link</a>
                    <a href={"#"} class="card-link text-primary">Another link</a>
                </CardBody>
            </Card>
        </Col>
        <Col xl="3" md="6">
            <Card class="mb-3 mb-xl-0">
                <img class="card-img-top img-fluid" src={smallImg4} alt="img-4"/>
                <CardBody>
                    <p class="card-text text-muted">Some quick example text to build on the card title and make up the
                        bulk of the card's content. With supporting text below as a natural lead-in to additional
                        content.</p>
                    <a href={"#"} class="btn btn-primary">Button</a>
                </CardBody>
            </Card>
        </Col>
        <Col xl="3" md="6">
            <Card class="mb-3 mb-xl-0">
                <CardBody>
                    <CardTitle class="mb-0">Card title</CardTitle>
                </CardBody>
                <img class="img-fluid" src={smallImg5} alt="img-5"/>
                <CardBody>
                    <p class="card-text text-muted">Some quick example text to build on the card title.</p>
                    <a href={"#"} class="card-link text-primary">Card link</a>
                    <a href={"#"} class="card-link text-primary">Another link</a>
                </CardBody>
            </Card>
        </Col>
    </Row>

    <Row>
        <Col sm="6">
            <Card class="card-body">
                <CardTitle class="mb-1">Special title treatment</CardTitle>
                <CardText>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</CardText>
                <Button color="primary">Go somewhere</Button>
            </Card>
        </Col>

        <Col sm="6">
            <Card class="card-body">
                <CardTitle class="mb-1">Special title treatment</CardTitle>
                <CardText>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</CardText>
                <Button color="primary">Go somewhere</Button>
            </Card>
        </Col>
    </Row>

    <Row>
        <Col md="4">
            <Card>
                <CardHeader>Featured</CardHeader>
                <CardBody>
                    <CardTitle class="mb-1">Special title treatment</CardTitle>
                    <CardText>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</CardText>
                    <Button color="primary">Go somewhere</Button>
                </CardBody>
            </Card>
        </Col>

        <Col md="4">
            <Card>
                <CardHeader>Quote</CardHeader>
                <CardBody>
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer>Someone famous in <cite>Source Title</cite></footer>
                    </blockquote>
                </CardBody>
            </Card>
        </Col>

        <Col md="4">
            <Card>
                <CardHeader>Featured</CardHeader>
                <CardBody>
                    <Button color="primary">Go somewhere</Button>
                </CardBody>
                <div class="card-footer text-muted">2 days ago</div>
            </Card>
        </Col>
    </Row>


    <!-- Color Card Start -->
    <Row>
        <Col xs="12">
            <CardTitle class="mb-3">Card Colored</CardTitle>
        </Col>
    </Row>

    <Row>
        <Col md="4">
            <Card class="text-bg-primary">
                <CardBody>
                    <CardTitle class="text-white mb-2"> Special title treatment</CardTitle>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a href={"#"} class="btn btn-light btn-sm">Button</a>
                </CardBody>
            </Card>
        </Col>

        <Col md="4">
            <Card class="bg-secondary text-white">
                <CardBody>
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer>
                            Someone famous in
                            <cite title="Source Title">Source Title</cite>
                        </footer>
                    </blockquote>
                </CardBody>
            </Card>
        </Col>

        <Col md="4">
            <Card class="text-bg-success">
                <CardBody>
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer>
                            Someone famous in
                            <cite title="Source Title">Source Title</cite>
                        </footer>
                    </blockquote>
                </CardBody>
            </Card>
        </Col>

        <Col md="4">
            <Card class="text-bg-info">
                <CardBody>
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer>
                            Someone famous in
                            <cite title="Source Title">Source Title</cite>
                        </footer>
                    </blockquote>
                </CardBody>
            </Card>
        </Col>

        <Col md="4">
            <Card class="text-bg-warning">
                <CardBody>
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer>
                            Someone famous in
                            <cite title="Source Title">Source Title</cite>
                        </footer>
                    </blockquote>
                </CardBody>
            </Card>
        </Col>

        <Col md="4">
            <Card class="text-bg-danger">
                <CardBody>
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer>
                            Someone famous in
                            <cite title="Source Title">Source Title</cite>
                        </footer>
                    </blockquote>
                </CardBody>
            </Card>
        </Col>
    </Row>

    <!-- Card Border Start -->
    <Row>
        <Col xs="12">
            <CardTitle class="mb-3">Card Bordered</CardTitle>
        </Col>
    </Row>

    <Row>
        <Col md="4">
            <Card class="border-primary border">
                <CardBody>
                    <CardTitle class="text-primary mb-2"> Special title treatment</CardTitle>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href={"#"} class="btn btn-primary btn-sm">Button</a>
                </CardBody>
            </Card>
        </Col>

        <Col md="4">
            <Card class="border-secondary border">
                <CardBody>
                    <CardTitle class="mb-2"> Special title treatment</CardTitle>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href={"#"} class="btn btn-secondary btn-sm">Button</a>
                </CardBody>
            </Card>
        </Col>

        <Col md="4">
            <Card class="border-success border">
                <CardBody>
                    <CardTitle class="mb-2 text-success"> Special title treatment</CardTitle>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href={"#"} class="btn btn-success btn-sm">Button</a>
                </CardBody>
            </Card>
        </Col>
    </Row>

    <!-- Horizontal Card Start -->
    <Row>
        <Col xs="12">
            <CardTitle class="mb-3">Horizontal Card</CardTitle>
        </Col>
    </Row>

    <Row>
        <Col lg="6">
            <Card>
                <Row class="g-0">
                    <Col md="4">
                        <img src={smallImg1} class="img-fluid rounded-start h-100" alt="img-1"/>
                    </Col>
                    <Col md="8">
                        <CardBody>
                            <CardTitle class="mb-2"> Card title</CardTitle>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </p>
                        </CardBody>
                    </Col>
                </Row>
            </Card>
        </Col>
        <Col lg="6">
            <Card>
                <Row class="g-0">
                    <Col md="8">
                        <CardBody>
                            <CardTitle class="mb-2"> Card title</CardTitle>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </p>
                        </CardBody>
                    </Col>
                    <Col md="4">
                        <img src={smallImg2} class="img-fluid rounded-end h-100" alt="img-2"/>
                    </Col>
                </Row>
            </Card>
        </Col>
    </Row>

    <!-- Stretched Link Start -->

    <Row>
        <Col xs="12">
            <CardTitle class="mb-3">Stretched link</CardTitle>
        </Col>
    </Row>

    <Row>
        <Col md="6" lg="3">
            <Card>
                <img src={smallImg1} class="card-img-top" alt="img-1"/>
                <CardBody>
                    <CardTitle class="mb-2"> Card with stretched link</CardTitle>
                    <a href={"#"} class="btn btn-primary mt-2 stretched-link">Go somewhere</a>
                </CardBody>
            </Card>
        </Col>
        <Col md="6" lg="3">
            <Card>
                <img src={smallImg2} class="card-img-top" alt="img-2"/>
                <CardBody>
                    <CardTitle class="mb-2">
                        <a href={"#"} class="text-primary stretched-link">Card with stretched
                            link</a>
                    </CardTitle>
                    <p class="card-text">Some quick example text to build on the card up the bulk of the card's
                        content.</p>
                </CardBody>
            </Card>
        </Col>
        <Col md="6" lg="3">
            <Card>
                <img src={smallImg3} class="card-img-top" alt="img-3"/>
                <CardBody>
                    <CardTitle class="mb-2"> Card with stretched link</CardTitle>
                    <a href={"#"} class="btn btn-primary mt-2 stretched-link">Go somewhere</a>
                </CardBody>
            </Card>
        </Col>
        <Col md="6" lg="3">
            <Card>
                <img src={smallImg4} class="card-img-top" alt="img-4"/>
                <CardBody>
                    <CardTitle class="mb-2">
                        <a href={"#"} class="stretched-link">Card with stretched link</a>
                    </CardTitle>
                    <p class="card-text">Some quick example text to build on the card up the bulk of the card's
                        content.</p>
                </CardBody>
            </Card>
        </Col>
    </Row>

    <!-- Card Group Start -->
    <Row>
        <Col xs="12">
            <CardTitle class="mb-3">Card Group</CardTitle>
        </Col>
    </Row>

    <Row>
        <Col xs="12">
            <CardGroup class="mb-3">
                <Card class="d-block">
                    <img class="card-img-top" src={smallImg1} alt="img-1"/>
                    <CardBody>
                        <CardTitle class="mb-2"> Card title</CardTitle>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                        <p class="card-text">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </p>
                    </CardBody>
                </Card>
                <Card class="d-block">
                    <img class="card-img-top" src={smallImg2} alt="img-2"/>
                    <CardBody>
                        <CardTitle class="mb-2"> Card title</CardTitle>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional
                            content.</p>
                        <p class="card-text">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </p>
                    </CardBody>
                </Card>
                <Card class="d-block">
                    <img class="card-img-top" src={smallImg3} alt="img-3"/>
                    <CardBody>
                        <CardTitle class="mb-2"> Card title</CardTitle>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                            additional content. This card has even longer content than the first to show that equal
                            height action.</p>
                        <p class="card-text">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </p>
                    </CardBody>
                </Card>
            </CardGroup>
        </Col>
    </Row>

    <!-- Card Decks Start -->
    <Row>
        <Col xs="12">
            <CardTitle class="mb-3">Card Decks</CardTitle>
        </Col>
    </Row>

    <Row>
        <Col xs="12">
            <Row class="row-xs-1 row-xs-md-3 g-3">
                <Col>
                    <Card>
                        <img src={smallImg4} class="card-img-top" alt="img-4"/>
                        <CardBody>
                            <CardTitle class="mb-2"> Card title</CardTitle>
                            <p class="card-text">This is a longer card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </p>
                        </CardBody>
                    </Card>
                </Col>
                <Col>
                    <Card>
                        <img src={smallImg3} class="card-img-top" alt="img-3"/>
                        <CardBody>
                            <CardTitle class="mb-2"> Card title</CardTitle>
                            <p class="card-text">This is a longer card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </p>
                        </CardBody>
                    </Card>
                </Col>
                <Col>
                    <Card>
                        <img src={smallImg2} class="card-img-top" alt="img-2"/>
                        <CardBody>
                            <CardTitle class="mb-2"> Card title</CardTitle>
                            <p class="card-text">This is a longer card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </p>
                        </CardBody>
                    </Card>
                </Col>
            </Row>
        </Col>
    </Row>
</DefaultLayout>