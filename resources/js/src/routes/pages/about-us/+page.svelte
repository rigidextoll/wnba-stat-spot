<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import About from "./components/About.svelte";
    import Services from "./components/Services.svelte";
    import Team from "./components/Team.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
</script>

<DefaultLayout>
    <PageBreadcrumb title="About Us" subTitle="Pages"/>
    <Row>
        <Col>
            <About/>
            <Services/>
            <Team/>
        </Col>
    </Row>
</DefaultLayout>