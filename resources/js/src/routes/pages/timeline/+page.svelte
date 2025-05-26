<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import Timeline from "./components/Timeline.svelte";
    import LeftTimeline from "./components/LeftTimeline.svelte";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Timeline" subTitle="Pages"/>

    <Timeline/>

    <LeftTimeline/>
</DefaultLayout>