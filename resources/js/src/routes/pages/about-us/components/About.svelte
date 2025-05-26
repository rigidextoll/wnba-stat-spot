<script lang="ts">
    import {Card, CardBody, Col, Row} from "@sveltestrap/sveltestrap";
    import Icon from "@iconify/svelte";

    const smallImg7 = '/images/small/img-7.jpg'
</script>

<Card>
    <CardBody>
        <div class="position-relative rounded-2 overflow-hidden" style="background-image: url({smallImg7})">
            <div class="bg-overlay bg-black"></div>
            <div class="position-relative p-3 p-lg-4">
                <h4 class="fs-18 fw-bold text-white text-uppercase mb-2">About Us</h4>
                <p class="text-white text-opacity-75 mb-3">
                    Over the past decade, we've distributed more than 45,000 copies of our administrative themes, all of
                    which have been effectively <br/>
                    utilized by businesses ranging from small-scale enterprises to multinational corporations.
                </p>
                <div class="mb-3">
                    <a href={"#"} class="btn btn-success bg-gradient">Join US</a>
                </div>

                <Row>
                    <Col xxl="5" xl="8" lg="10" xs="12">
                        <div class="overflow-hidden rounded">
                            <Row class="g-0">
                                <Col sm="4">
                                    <div class="bg-body border-end">
                                        <div class="text-center p-3">
                                            <div class="avatar-sm mx-auto mb-2">
                                              <span class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                <Icon icon="iconamoon:category-duotone" class="fs-18"></Icon>
                                              </span>
                                            </div>
                                            <h4 class="fw-semibold fs-20 mb-1">1,994+</h4>
                                            <h5 class="fs-14 mb-0">Projects</h5>
                                        </div>
                                    </div>
                                </Col>
                                <Col sm="4">
                                    <div class="bg-body border-end">
                                        <div class="text-center p-3">
                                            <div class="avatar-sm mx-auto mb-2">
                                              <span class="avatar-title bg-success-subtle text-success rounded-circle">
                                                <Icon icon="iconamoon:check-circle-1-duotone" class="fs-18"></Icon>
                                              </span>
                                            </div>
                                            <h4 class="fw-semibold fs-20 mb-1">1,962</h4>
                                            <h5 class="fs-14 mb-0">Completed</h5>
                                        </div>
                                    </div>
                                </Col>
                                <Col sm="4">
                                    <div class="bg-body">
                                        <div class="text-center p-3">
                                            <div class="avatar-sm mx-auto mb-2">
                                                <span class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                    <Icon icon="iconamoon:credit-card-duotone" class="fs-18"></Icon>
                                                </span>
                                            </div>
                                            <h4 class="fw-semibold fs-20 mb-1">98M+</h4>
                                            <h5 class="fs-14 mb-0">Payment</h5>
                                        </div>
                                    </div>
                                </Col>
                            </Row>
                        </div>
                    </Col>
                </Row>
            </div>
        </div>
    </CardBody>
</Card>