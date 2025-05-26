<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import PricingCard from "./components/PricingCard.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {pricingPlans} from "./components/data";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Pricing" subTitle="Pages"/>
    <Row>
        <Col sm="12">
            <div class="text-center my-4">
                <h3>Simple Pricing Plans</h3>
                <p class="text-muted text-center">Get the power and control you need to manage your organization's
                    technical documentation</p>
            </div>
            <Row class="justify-content-center">
                {#each pricingPlans as item}
                    <Col lg="3">
                        <PricingCard item={item}/>
                    </Col>
                {/each}
            </Row>
        </Col>
    </Row>
</DefaultLayout>