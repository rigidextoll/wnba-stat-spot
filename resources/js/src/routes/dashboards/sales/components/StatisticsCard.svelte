<script lang="ts">
    import type {StatisticCardType} from "$lib/types";
    import Icon from "@iconify/svelte";
    import {Card, CardBody, Badge} from "@sveltestrap/sveltestrap";

    export let item: StatisticCardType
</script>


<Card>
    <CardBody class="overflow-hidden position-relative">
        <Icon icon={item.icon} class={`fs-36 mb-1 text-${item.variant}`}/>
        <h3 class="mb-0 fw-bold mt-3 mb-1">
            {item.prefix}{item.statistic}{item.suffix}
        </h3>
        <p class="text-muted">{item.title}</p>
        {#if (item.growth)}
            <Badge class={`fs-12 ${item.growth>0?'badge-soft-success text-success':'badge-soft-danger text-danger'}`}>
                {Math.abs(item.growth)}%
            </Badge>
        {/if}
        <i class={`widget-icon ${item.background?.icon}`}></i>
    </CardBody>
</Card>