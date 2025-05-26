<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {
        Badge, Button,
        Card,
        CardBody,
        Col,
        Form,
        Input,
        Nav,
        NavItem,
        NavLink,
        Row
    } from "@sveltestrap/sveltestrap";
    import {currency} from "$lib/helpers/constants";

    const product12 = '/images/products/product-1(2).png';
    const product11 = '/images/products/product-1(1).png';
    const product13 = '/images/products/product-1(3).png';
    const product14 = '/images/products/product-1(4).png';

    export let data;

    let productTab = 'product-1'

    function setProductTab(tab: string) {
        productTab = tab;
    }
</script>

<DefaultLayout>
    <PageBreadcrumb title="Product Details" subTitle="Ecommerce"/>
    <Row>
        <Col>
            <Card>
                <CardBody>
                    <Row>
                        <Col lg="4">
                            <div class="tab-content">
                                <div class={`tab-pane ${productTab === 'product-1' ? 'show active' : ''}`}
                                     id="product-1-item">
                                    <img src={product12} alt="product-1(2)" class="img-fluid mx-auto d-block rounded"/>
                                </div>
                                <div class={`tab-pane ${productTab === 'product-2' ? 'show active' : ''}`}
                                     id="product-2-item">
                                    <img src={product11} alt="product-1(1)" class="img-fluid mx-auto d-block rounded"/>
                                </div>
                                <div class={`tab-pane ${productTab === 'product-3' ? 'show active' : ''}`}
                                     id="product-3-item">
                                    <img src={product13} alt="product-1(3)" class="img-fluid mx-auto d-block rounded"/>
                                </div>
                                <div class={`tab-pane ${productTab === 'product-4' ? 'show active' : ''}`}
                                     id="product-4-item">
                                    <img src={product14} alt="product-1(4)" class="img-fluid mx-auto d-block rounded"/>
                                </div>
                            </div>
                            <Nav pills justified>
                                <NavItem>
                                    <NavLink href="javascript:void(0)"
                                             class={`product-thumb ${productTab === 'product-1' ? 'active' : ''}`}
                                             on:click={() => setProductTab('product-1')}>
                                        <img src={product12} alt="product-1(2)" class="img-fluid mx-auto rounded"/>
                                    </NavLink>
                                </NavItem>
                                <NavItem>
                                    <NavLink href="javascript:void(0)"
                                             class={`product-thumb ${productTab === 'product-2' ? 'active' : ''}`}
                                             on:click={() => setProductTab('product-2')}>
                                        <img src={product11} alt="product-1(1)" class="img-fluid mx-auto rounded"/>
                                    </NavLink>
                                </NavItem>
                                <NavItem>
                                    <NavLink href="javascript:void(0)"
                                             class={`product-thumb ${productTab === 'product-3' ? 'active' : ''}`}
                                             on:click={() => setProductTab('product-3')}>
                                        <img src={product13} alt="product-1(3)" class="img-fluid mx-auto rounded"/>
                                    </NavLink>
                                </NavItem>
                                <NavItem>
                                    <NavLink href="javascript:void(0)"
                                             class={`product-thumb ${productTab === 'product-4' ? 'active' : ''}`}
                                             on:click={() => setProductTab('product-4')}>
                                        <img src={product14} alt="product-1(4)" class="img-fluid mx-auto rounded"/>
                                    </NavLink>
                                </NavItem>
                            </Nav>
                        </Col>
                        <Col lg="8">
                            <div class="ps-xl-3 mt-3 mt-xl-0">
                                <a href={"#"} class="text-primary mb-2 d-inline-block">Apple MacBook Air M1 (#{data.id}
                                    )</a>
                                <h4 class="mb-3">(8 GB/256 GB SSD/Mac OS Big Sur) MGN63HN/A (13.3 inch, Space Grey, 1.29
                                    kg)</h4>
                                <p class="text-muted float-start me-3 hstack gap-1">
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                </p>
                                <p class="mb-3">
                                    <a href={"#"} class="text-muted">( 36 Customer Reviews )</a>
                                </p>
                                <h6 class="text-danger text-uppercase">20 % Off</h6>
                                <h4 class="mb-3">
                                    Price :
                                    <span class="text-muted me-2"><del>{currency}999 USD</del></span>
                                    <b class="ms-1">{currency}899 USD</b>
                                </h4>
                                <h4>
                                    <Badge color="success" class="mb-3">In Stock</Badge>
                                </h4>

                                <Form class="d-flex flex-wrap align-items-center mb-2">
                                    <label class="my-1 me-2" for="color">Color:</label>
                                    <div class="me-3">
                                        <Input type="select" bsSize="sm" class="my-1" id="color">
                                            <option value="1">Black</option>
                                            <option value="2">Blue</option>
                                            <option value="3">Midnight</option>
                                        </Input>
                                    </div>

                                    <label class="my-1 me-2" for="sizeinput">Size:</label>
                                    <div class="me-sm-3">
                                        <Input type="select" bsSize="sm" class="my-1" id="sizeinput">
                                            <option value="1">256 GB</option>
                                            <option value="2">512 GB</option>
                                        </Input>
                                    </div>
                                </Form>

                                <div class="mb-3 pb-3 border-bottom">
                                    <h5>Processor Brand: <b>Apple</b></h5>
                                    <h5>Processor Name: <b>M1</b></h5>
                                    <h5>SSD: <b>Yes</b></h5>
                                    <h5>SSD Capacity: <b>256 GB</b></h5>
                                    <h5>RAM: <b>8 GB</b></h5>
                                </div>
                                <div class="mb-3">
                                    <h5>About this item:</h5>
                                    <p class="text-muted mb-1"><i class="bx bx-check-circle text-primary me-2"></i>Quad
                                        LED Backlit IPS Display (227 PPI, 400 nits Brightness, Wide Colour (P3), True
                                        Tone Technology)</p>
                                    <p class="text-muted mb-1"><i class="bx bx-check-circle text-primary me-2"></i>Built-in
                                        Speakers</p>
                                    <p class="text-muted mb-1"><i class="bx bx-check-circle text-primary me-2"></i>Three-mic
                                        Array with Directional Beamforming</p>
                                    <p class="text-muted mb-1"><i class="bx bx-check-circle text-primary me-2"></i>Stereo
                                        Speakers, Wide Stereo Sound, Support for Dolby Atmos Playback</p>
                                    <p class="text-muted mb-1"><i class="bx bx-check-circle text-primary me-2"></i>49.9
                                        WHr Li-polymer Battery</p>
                                    <p class="text-muted mb-1"><i class="bx bx-check-circle text-primary me-2"></i>Backlit
                                        Magic Keyboard</p>
                                </div>

                                <div>
                                    <Button type="button" color="danger" class="me-2">
                                        <i class="bx bx-heart fs-18"></i>
                                    </Button>
                                    <Button type="button" color="primary" class="ms-1">
                                        <i class="bx bx-cart fs-18 me-2"></i>Add to cart
                                    </Button>
                                </div>
                            </div>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

        </Col>
    </Row>
</DefaultLayout>