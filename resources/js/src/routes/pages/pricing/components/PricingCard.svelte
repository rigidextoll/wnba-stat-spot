<script lang="ts">
    import type {PlanType} from "./types";
    import {Button, Card, CardBody} from "@sveltestrap/sveltestrap";
    import {currency} from "$lib/helpers/constants";

    export let item: PlanType
</script>

<Card class="card-pricing">
    <CardBody>
        {#if (item.ribbon)}
            <div class="pricing-ribbon pricing-ribbon-primary float-end">
                { item.ribbon }
            </div>
        {/if}
        <h5 class="mt-0 mb-3 fs-14 text-uppercase fw-semibold">
            { item.name }
        </h5>
        <h2 class="mt-0 mb-3 fw-bold">
            { currency }{ item.price }
            <span class="fs-14 fw-medium text-muted">/ { item.period }</span>
        </h2>

        <ul class="card-pricing-features text-muted border-top pt-2 mt-2 ps-0 list-unstyled">
            {#each item.features as feat}
                <li class="text-dark"><i class="bx bx-check-circle text-primary fs-15 me-1"></i>{ feat }</li>
            {/each}
        </ul>

        <div class="mt-4 text-center">
            <Button color="primary" class="px-sm-4 w-100" disabled={item.button.disabled}>
                { item.button.text }
            </Button>
        </div>
    </CardBody>
</Card>