<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Progress, Row} from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'how-works',
            title: 'How it works'
        },
        {
            id: 'backgrounds-color',
            title: 'Backgrounds Color'
        },
        {
            id: 'progress-bar',
            title: 'Progress Bar'
        },
        {
            id: 'height',
            title: 'Height'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Progress" subTitle="Base UI"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="How it works" id="how-works"
                             caption="A progress bar can be used to show a user how far along he/she is in a process.">
                <Progress class="mb-2" value={0}/>
                <Progress class="mb-2" value={35}/>
                <Progress class="mb-2" value={50}/>
                <Progress class="mb-2" value={75}/>
                <Progress value={25}>25%</Progress>
            </UIComponentCard>

            <UIComponentCard title="Backgrounds Color" id="backgrounds-color"
                             caption="Use background utility classes to change the appearance of individual progress bars.">
                <Progress class="mb-2" color="primary" value={25}/>
                <Progress class="mb-2" color="secondary" value={35}/>
                <Progress class="mb-2" color="success" value={50}/>
                <Progress class="mb-2" color="info" value={100}/>
                <Progress multi>
                    <Progress bar value={15}/>
                    <Progress bar value={30} color="secondary"/>
                    <Progress bar value={20} color="success"/>
                </Progress>
            </UIComponentCard>

            <UIComponentCard title="Striped Progress Bar" id="progress-bar">
                <Progress class="mb-2" color="primary" striped value={25}/>
                <Progress class="mb-2" color="secondary" striped value={50}/>
                <Progress class="mb-2" color="success" striped value={75}/>
                <Progress class="mb-2" color="info" striped animated value={65}/>
                <Progress color="warning" striped animated value={100}/>
            </UIComponentCard>

            <UIComponentCard title="Height" id="height">
                <Progress class="mb-2 progress-xs" color="primary" value={25}/>
                <Progress class="mb-2 progress-sm" color="secondary" value={50}/>
                <Progress class="mb-2 progress-md" color="success" value={75}/>
                <Progress class="mb-2 progress-lg" color="info" value={35}/>
                <Progress class="progress-xl" color="warning" value={60}/>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
