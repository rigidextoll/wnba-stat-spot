<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import GridJsTable from "$lib/components/GridJsTable.svelte";
    import {
        basicTableOptions, fixedHeaderTableOptions, hiddenColumnsTableOptions, loadingStateTableOptions,
        paginationTableOptions,
        searchTableOptions,
        sortingTableOptions
    } from "./components/data";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic'
        },
        {
            id: 'pagination',
            title: 'Pagination'
        },
        {
            id: 'search',
            title: 'Search'
        },
        {
            id: 'sorting',
            title: 'Sorting'
        },
        {
            id: 'loading_state',
            title: 'Loading State'
        },
        {
            id: 'fixed_header',
            title: 'Fixed Header'
        },
        {
            id: 'hidden_column',
            title: 'Hidden Columns'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="GridJs" subTitle="Tables"/>

    <Row>
        <Col xl="10">
            <UIComponentCard id="basic" title="Basic">
                <GridJsTable id="table-gridjs" options={basicTableOptions}/>
            </UIComponentCard>

            <UIComponentCard id="pagination" title="Pagination">
                <GridJsTable id="table-pagination" options={paginationTableOptions}/>
            </UIComponentCard>

            <UIComponentCard id="search" title="Search">
                <GridJsTable id="table-search" options={searchTableOptions}/>
            </UIComponentCard>

            <UIComponentCard id="sorting" title="Search">
                <GridJsTable id="table-sorting" options={sortingTableOptions}/>
            </UIComponentCard>

            <UIComponentCard id="loading_state" title="Loading State">
                <GridJsTable id="table-loading-state" options={loadingStateTableOptions}/>
            </UIComponentCard>

            <UIComponentCard id="fixed_header" title="Fixed Header">
                <GridJsTable id="table-fixed-header" options={fixedHeaderTableOptions}/>
            </UIComponentCard>

            <UIComponentCard id="hidden_column" title="Hidden Columns">
                <GridJsTable id="table-hidden-column" options={hiddenColumnsTableOptions}/>
            </UIComponentCard>
        </Col>

        <Col xl="2">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>