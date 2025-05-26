<script lang="ts">
    import {Card, CardBody, Row, Col} from '@sveltestrap/sveltestrap';
    import Icon from "@iconify/svelte";
    import type {StatisticCardType} from "$lib/types";

    export let item: StatisticCardType
</script>


<Card>
    <CardBody>
        <Row>
            <Col xs="6">
                <div class={`avatar-md bg-opacity-10 rounded bg-${item.variant}`}>
            <span class="avatar-title">
            <Icon icon={item.icon} class={`text-${item.variant}`} height="32"/>
            </span>
                </div>
            </Col>

            <Col xs="6" class="text-end">
                <p class="text-muted mb-0 text-truncate">
                    {item.title}
                </p>
                <h3 class="text-dark mt-1 mb-0">
                    {#if (item.prefix)}
                        <span>{item.prefix}</span>
                    {/if}
                    {item.statistic}
                    {#if (item.suffix)}
                        <span>{item.suffix}</span>
                    {/if}
                </h3>
            </Col>
        </Row>
    </CardBody>
</Card>