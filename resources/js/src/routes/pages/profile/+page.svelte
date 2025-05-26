<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import ProfileInfo from "./components/ProfileInfo.svelte";
    import Skills from "./components/Skills.svelte";
    import Activities from "./components/Activities.svelte";
    import Messages from "./components/Messages.svelte";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Profile" subTitle="Pages"/>
    <Row>
        <Col xxl="4">
            <Row>
                <Col>
                    <ProfileInfo/>
                    <Skills/>
                </Col>
            </Row>
            <Activities/>
        </Col>

        <Messages/>
    </Row>
</DefaultLayout>