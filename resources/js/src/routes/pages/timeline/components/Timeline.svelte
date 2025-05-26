<script lang="ts">
    import {Badge, Card, CardBody, Col, Row} from "@sveltestrap/sveltestrap";
    import {timelineData} from "./data";
</script>

<Row>
    <Col lg="12">
        <div class="timeline">
            {#each timelineData as item}

                {#if item.date}
                    <article class="timeline-time">
                        <div class="time-show d-flex align-items-center justify-content-center mt-0">
                            <h5 class="mb-0 text-uppercase fs-14 fw-semibold">
                                { item.date }
                            </h5>
                        </div>
                    </article>
                {/if}

                {#each item.events as event}
                    <article class="timeline-item {event.side === 'left' && 'timeline-item-left'}">
                        <div class="timeline-desk">
                            <div class="timeline-box clearfix">
                                <span class="timeline-icon"></span>
                                <div class="overflow-hidden">
                                    <Card class="d-inline-block">
                                        <CardBody>
                                            <h5 class="mt-0 fs-16">
                                                { event.title }
                                                {#if event.badge}
                                                    <Badge color="secondary"
                                                           class="ms-1 align-items-center">{ event.badge }</Badge>
                                                {/if}
                                            </h5>
                                            <p class="text-muted mb-0">
                                                { event.description }
                                            </p>
                                        </CardBody>
                                    </Card>
                                </div>
                            </div>
                        </div>
                    </article>
                {/each}
            {/each}
        </div>
    </Col>
</Row>
