<script lang="ts">
    import type {StatisticCardType} from "$lib/types";
    import {Card, CardBody} from "@sveltestrap/sveltestrap";
    import Icon from "@iconify/svelte";

    export let item: StatisticCardType
</script>

<Card>
    <CardBody>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="mb-0 fw-bold mb-2">
                    {item.prefix}{item.statistic}{item.suffix}
                </h3>
                <p class="text-muted">
                    {item.title}
                </p>
                {#if item.growth}
                    <span class={`badge fs-12 ${item.growth>0?'badge-soft-success':'badge-soft-danger'}`}>
                            {Math.abs(item.growth)}%
                    </span>
                {/if}
            </div>
            <div>
                <div class="avatar-lg d-inline-block me-1">
            <span class={`avatar-title rounded-circle bg-${item.variant}-subtle text-${item.variant}`}>
              <Icon icon={item.icon} class="fs-32"/>
            </span>
                </div>
            </div>
        </div>
    </CardBody>
</Card>