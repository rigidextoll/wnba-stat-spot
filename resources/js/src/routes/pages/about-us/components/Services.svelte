<script lang="ts">
    import {Card, CardBody, CardTitle, Col, Row} from "@sveltestrap/sveltestrap";
    import {serviceData} from "./data";
</script>

<Card>
    <CardBody class="p-4">
        <CardTitle class="fw-bold text-uppercase mb-2"> Our Services</CardTitle>
        <p class="mb-4">Our work stands as a testament to dedication, innovation, and excellence. With meticulous
            attention to detail and a passion for surpassing expectations, we strive to deliver solutions that inspire
            and empower.</p>

        <Row>
            {#each serviceData as item}
                <Col md="4">
                    <div class="d-flex flex-wrap flex-md-nowrap gap-2 p-3 mb-3">
                        <div class="flex-shrink-0 avatar-sm">
                            <div class="avatar-title bg-gradient text-white rounded-circle {item.variant}">
                                <i class="bx fs-20 {item.icon}"></i>
                            </div>
                        </div>

                        <div class="flex-grow-1 d-flex flex-grow-1 flex-column">
                            <h5 class="fs-16 fw-semibold lh-base">
                                <a href="#!" class="text-reset">{item.title}</a>
                            </h5>

                            <span class="flex-grow-1 text-muted">{item.description}</span>
                        </div>
                    </div>
                </Col>
            {/each}
        </Row>

        <div class="mt-3 text-center">
            <a href="#!" class="text-primary">
                <i class="bx bx-loader-circle spin-icon fs-22 align-middle me-1"></i>
                Loading
            </a>
        </div>
    </CardBody>
</Card>