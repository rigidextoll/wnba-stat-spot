<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Row, Col} from "@sveltestrap/sveltestrap";
    import {statistics} from "./components/data";
    import StatisticsCard from "./components/StatisticsCard.svelte";
    import Overview from "./components/Overview.svelte";
    import SalesByCategory from "./components/SalesByCategory.svelte";
    import NewAccounts from "./components/NewAccounts.svelte";
    import RecentTransactions from "./components/RecentTransactions.svelte";
    import RecentOrders from "./components/RecentOrders.svelte";
</script>

<DefaultLayout>

    <PageBreadcrumb title="Sales" subTitle="Dashboards"/>

    <Row>
        {#each statistics as item,idx}
            <div class={`col-xl ${idx === 4 ? 'col-lg-6 col-md-12' : idx === 3 ? 'col-lg-6 col-md-6' : 'col-lg-4 col-md-6'}`}>
                <StatisticsCard item={item}/>
            </div>
        {/each}
    </Row>

    <Row>
        <Col xxl="8">
            <Overview/>
        </Col>

        <Col xxl="4">
            <SalesByCategory/>
        </Col>
    </Row>

    <Row>
        <Col xl="6">
            <NewAccounts/>
        </Col>

        <Col xl="6">
            <RecentTransactions/>
        </Col>
    </Row>

    <Row>
        <Col>
            <RecentOrders/>
        </Col>
    </Row>

</DefaultLayout>