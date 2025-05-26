<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Row, Col} from "@sveltestrap/sveltestrap";
    import {statistics} from "./components/data";
    import StatisticsCard from "./components/StatisticsCard.svelte";
    import Revenue from "./components/Revenue.svelte";
    import Expenses from "./components/Expenses.svelte";
    import Transactions from "./components/Transactions.svelte";
    import RevenueSources from "./components/RevenueSources.svelte";
</script>

<DefaultLayout>

    <PageBreadcrumb title="Finance" subTitle="Dashboards"/>

    <Row>
        {#each statistics as item}
            <Col>
                <StatisticsCard item={item}/>
            </Col>
        {/each}
    </Row>

    <Row>
        <Col xxl="6">
            <Revenue/>
        </Col>

        <Col xxl="6">
            <Expenses/>
        </Col>
    </Row>

    <Row>
        <Col xxl="8">
            <Transactions/>
        </Col>

        <Col xxl="4">
            <RevenueSources/>
        </Col>
    </Row>

</DefaultLayout>