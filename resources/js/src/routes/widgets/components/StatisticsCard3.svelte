<script lang="ts">
    import type {StatisticCardType} from "$lib/types";
    import {Card, CardBody, CardFooter, Col, Row} from "@sveltestrap/sveltestrap";

    export let item:StatisticCardType
</script>


<Card>
    <CardBody>
        <Row>
            <Col xs="6">
                <div class="avatar-md rounded bg-soft-{item.variant}">
          <span class="avatar-title">
            <i class={`bx fs-24 ${item.icon} text-${item.variant}`}></i>
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

    <CardFooter class="py-2 bg-light bg-opacity-50">
        <div class="d-flex align-items-center justify-content-between">
            {#if item.growth}
                <div>
          <span class={`text-${item.growth > 0 ? 'success' : 'danger'}`}>
            {#if item.growth > 0}
              <i class="bx bxs-up-arrow fs-12"></i>
            {:else}
              <i class="bx bxs-down-arrow fs-12"></i>
            {/if}
              {item.growth}%
          </span>
                    <span class="text-muted ms-1 fs-12">Last Month</span>
                </div>
            {/if}
            <a href={"#"} class="text-reset fw-semibold fs-12">View More</a>
        </div>
    </CardFooter>
</Card>