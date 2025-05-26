<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import IntegrationCard from "./components/IntegrationCard.svelte";
    import {integrationData} from "./components/data";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Integration" subTitle="Calendar"/>
    <Row class="row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 gx-3">
        {#each integrationData as integration}
            <Col>
                <IntegrationCard integration="{integration}"/>
            </Col>
        {/each}
    </Row>
</DefaultLayout>