<script lang="ts">
    import type {StatisticCardType} from "$lib/types";
    import {Card, CardBody, Col, Row} from "@sveltestrap/sveltestrap";

    export let item: StatisticCardType
</script>


<Card>
    <CardBody>
        <Row>
            <Col xs="6">
                <div class="avatar-md rounded bg-{item.variant}">
          <span class="avatar-title">
            <i class={`bx fs-24 text-white ${item.icon}`}></i>
          </span>
                </div>
            </Col>

            <Col xs="6" class="text-end">
                <p class="text-muted mb-0 text-truncate">{item.title}</p>
                <h3 class="text-dark mt-1 mb-0">
                    {#if item.prefix}
                        <span>{item.prefix}</span>
                    {/if}
                    {item.statistic}
                    {#if item.suffix}
                        <span>{item.suffix}</span>
                    {/if}
                </h3>
            </Col>
        </Row>
    </CardBody>
</Card>