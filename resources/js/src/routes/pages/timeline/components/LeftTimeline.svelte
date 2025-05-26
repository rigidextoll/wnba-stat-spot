<script lang="ts">
    import {Badge, Card, CardBody, CardTitle, Col, Row} from "@sveltestrap/sveltestrap";
    import {leftTimeLine} from "./data";
</script>

<Row>
    <Col>
        <CardTitle class="mb-3">Left Timeline</CardTitle>
        {#each leftTimeLine as item}
            <div class="d-flex flex-row fs-18 align-items-center mb-3">
                <h5 class="mb-0">{item.date}</h5>
            </div>
            <ul class="list-unstyled left-timeline">
                {#each item.events as event}
                    <li class="left-timeline-list">
                        <Card class="d-inline-block">
                            <CardBody>
                                <h5 class="mt-0 fs-16">
                                    {event.title}
                                    {#if (event.badge)}
                                        <Badge color="secondary" class="ms-1 align-items-center">{event.badge}</Badge>
                                    {/if}
                                </h5>
                                <p class="text-muted mb-0">
                                    {event.description}
                                </p>
                            </CardBody>
                        </Card>
                    </li>
                {/each}
            </ul>
        {/each}
    </Col>
</Row>
