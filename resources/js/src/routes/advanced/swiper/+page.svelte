<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Card, CardBody, Col, Row} from "@sveltestrap/sveltestrap";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";

    const smallImg1 = '/images/small/img-1.jpg'
    const smallImg2 = '/images/small/img-2.jpg'
    const smallImg3 = '/images/small/img-3.jpg'
    const smallImg4 = '/images/small/img-4.jpg'
    const smallImg5 = '/images/small/img-5.jpg'
    const smallImg6 = '/images/small/img-6.jpg'

    import Swiper from "$lib/components/Swiper.svelte";
    import {
        defaultOptions,
        effectCreativeOptions,
        effectFadeOptions, effectFlipOptions, mousewheelOptions,
        navigationAndPaginationOptions,
        paginationOptions, responsiveOptions, scrollbarOptions, verticalOptions
    } from "./data";

    const anchorNavigation = [
        {
            id: 'default',
            title: 'Default Swiper'
        },
        {
            id: 'navigation',
            title: 'Navigation & Pagination Swiper'
        },
        {
            id: 'pagination-dynamic',
            title: 'Pagination Dynamic Swiper'
        },
        {
            id: 'effect-fade',
            title: 'Effect Fade Swiper'
        },
        {
            id: 'effect-creative',
            title: 'Effect Creative Swiper'
        },
        {
            id: 'effect-flip',
            title: 'Effect Flip Swiper'
        },
        {
            id: 'scrollbar',
            title: 'Scrollbar Swiper'
        },
        {
            id: 'vertical',
            title: 'Vertical Swiper'
        },
        {
            id: 'mousewheel',
            title: 'Mousewheel Control Swiper'
        },
        {
            id: 'responsive',
            title: 'Responsive Breakpoints Swiper'
        }
    ]

</script>

<DefaultLayout>
    <PageBreadcrumb title="Swiper Slider" subTitle="Advanced UI"/>

    <Row>
        <Col xl="9">
            <Card>
                <CardBody>
                    <h5 class="card-title mb-1 anchor" id="default">
                        Default Swiper
                        <a class="anchor-link" href="#default">#</a>
                    </h5>

                    <Row>
                        <Col lg="6" class="mt-2">
                            <Swiper id="swiper-default" customClass="rounded" options={defaultOptions}>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src={smallImg1} alt="" class="img-fluid"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg2} alt="" class="img-fluid"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg3} alt="" class="img-fluid"/>
                                    </div>
                                </div>
                            </Swiper>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-1 anchor" id="navigation">
                        Navigation & Pagination Swiper
                        <a class="anchor-link" href="#navigation">#</a>
                    </h5>

                    <Row>
                        <Col lg="6" class="mt-2">
                            <Swiper id="swiper-navigation" customClass="rounded"
                                    options={navigationAndPaginationOptions}>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src={smallImg4} alt="" class="img-fluid"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg5} alt="" class="img-fluid"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg6} alt="" class="img-fluid"/>
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-pagination"></div>
                            </Swiper>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-1 anchor" id="pagination-dynamic">
                        Pagination Dynamic Swiper
                        <a class="anchor-link" href="#pagination-dynamic">#</a>
                    </h5>
                    <Row>
                        <Col lg="6" class="mt-2">
                            <Swiper id="swiper-pagination" customClass="rounded" options={paginationOptions}>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src={smallImg4} alt="" class="img-fluid"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg5} alt="" class="img-fluid"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg6} alt="" class="img-fluid"/>
                                    </div>
                                </div>
                                <div class="swiper-pagination dynamic-pagination"></div>
                            </Swiper>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-1 anchor" id="effect-fade">
                        Effect Fade Swiper
                        <a class="anchor-link" href="#effect-fade">#</a>
                    </h5>

                    <Row>
                        <Col lg="6" class="mt-2">
                            <Swiper id="swiper-effect-fade" customClass="rounded" options={effectFadeOptions}>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src={smallImg3} alt="" class="img-fluid"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg4} alt="" class="img-fluid"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg5} alt="" class="img-fluid"/>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </Swiper>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-1 anchor" id="effect-creative">
                        Effect Creative Swiper
                        <a class="anchor-link" href="#effect-creative">#</a>
                    </h5>

                    <Row>
                        <Col lg="6" class="mt-2">
                            <Swiper id="swiper-effect-creative" customClass="rounded" options={effectCreativeOptions}>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src={smallImg3} alt="" class="img-fluid rounded"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg4} alt="" class="img-fluid rounded"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg5} alt="" class="img-fluid rounded"/>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </Swiper>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-1 anchor" id="effect-flip">
                        Effect Flip Swiper
                        <a class="anchor-link" href="#effect-flip">#</a>
                    </h5>

                    <Row>
                        <Col lg="6" class="mt-2">
                            <Swiper id="swiper-effect-flip" options={effectFlipOptions}>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src={smallImg3} alt="" class="img-fluid rounded"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg4} alt="" class="img-fluid rounded"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg5} alt="" class="img-fluid rounded"/>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </Swiper>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-1 anchor" id="scrollbar">
                        Scrollbar Swiper
                        <a class="anchor-link" href="#scrollbar">#</a>
                    </h5>

                    <Row>
                        <Col lg="6" class="mt-2">
                            <Swiper id="swiper-scrollbar" options={scrollbarOptions}>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src={smallImg3} alt="" class="img-fluid rounded"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg4} alt="" class="img-fluid rounded"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg5} alt="" class="img-fluid rounded"/>
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-scrollbar"></div>
                            </Swiper>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-1 anchor" id="vertical">
                        Vertical Swiper
                        <a class="anchor-link" href="#vertical">#</a>
                    </h5>

                    <Row>
                        <Col lg="6" class="mt-2">
                            <Swiper id="swiper-vertical" options={verticalOptions} style="height: 320px">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src={smallImg3} alt="" class="img-fluid rounded"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg4} alt="" class="img-fluid rounded"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg5} alt="" class="img-fluid rounded"/>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </Swiper>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-1 anchor" id="mousewheel">
                        Mousewheel Control Swiper
                        <a class="anchor-link" href="#mousewheel">#</a>
                    </h5>

                    <Row>
                        <Col lg="6" class="mt-2">
                            <Swiper customClass="rounded" id="swiper-mousewheel" options={mousewheelOptions}
                                    style="height: 324px">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src={smallImg3} alt="" class="img-fluid rounded"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg4} alt="" class="img-fluid rounded"/>
                                    </div>
                                    <div class="swiper-slide">
                                        <img src={smallImg5} alt="" class="img-fluid rounded"/>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </Swiper>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-1 anchor" id="responsive">
                        Responsive Breakpoints Swiper
                        <a class="anchor-link" href="#overview">#</a>
                    </h5>

                    <div class="mt-3">
                        <Swiper customClass="rounded gallery-light pb-4" id="swiper-responsive"
                                options={responsiveOptions}>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src={smallImg1} alt="" class="img-fluid rounded"/>
                                </div>
                                <div class="swiper-slide">
                                    <img src={smallImg2} alt="" class="img-fluid rounded"/>
                                </div>
                                <div class="swiper-slide">
                                    <img src={smallImg3} alt="" class="img-fluid rounded"/>
                                </div>
                                <div class="swiper-slide">
                                    <img src={smallImg4} alt="" class="img-fluid rounded"/>
                                </div>
                                <div class="swiper-slide">
                                    <img src={smallImg5} alt="" class="img-fluid rounded"/>
                                </div>
                                <div class="swiper-slide">
                                    <img src={smallImg6} alt="" class="img-fluid rounded"/>
                                </div>
                            </div>
                            <div class="swiper-pagination swiper-pagination-dark"></div>
                        </Swiper>
                    </div>
                </CardBody>
            </Card>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>