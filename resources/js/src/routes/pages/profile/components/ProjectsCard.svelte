<script lang="ts">
    import type {ProjectType} from "./types";
    import {Card, CardBody, CardTitle, Progress, Tooltip} from "@sveltestrap/sveltestrap";
    import Icon from "@iconify/svelte";

    export let item: ProjectType
</script>

<Card class="shadow-none mb-0">
    <CardBody class="p-lg-3 p-2">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="avatar-md flex-shrink-0">
          <span class="avatar-title bg-light rounded-circle">
            <Icon icon={item.icon} class="text-{item.iconColor} fs-28"></Icon>
          </span>
            </div>
            <a href={"#"} class="fw-medium text-dark">{item.title}</a>
            <div class="ms-auto">
                <a href={"#"} class="fw-medium text-muted fs-18" id="download-{item.days}">
                    <Icon icon="iconamoon:cloud-download-duotone" class="mb-1"></Icon>
                </a>
                <Tooltip target="download-{item.days}" placement="bottom">
                    Download
                </Tooltip>
            </div>
        </div>
        <div class="d-flex gap-2">
            <CardTitle
                    class="badge text-secondary d-flex gap-1 align-items-center py-1 px-2 fs-13 mb-3 border rounded-1">
                <Icon icon="iconamoon:clock-duotone"></Icon>
                {item.days} day left
            </CardTitle>
            <CardTitle
                    class="badge text-secondary d-flex gap-1 align-items-center py-1 px-2 fs-13 mb-3 border rounded-1">
                <Icon icon="iconamoon:file-duotone"></Icon>
                {item.file} Files
            </CardTitle>
        </div>
        <div>
            <p class="fs-15 mb-1 float-end">
                {item.task}
            </p>
            <p class="fs-15 mb-1">{item.progressValue}%</p>
            <Progress value={item.progressValue} color={item.progressVariant} striped animated
                      class="progress-sm mb-3"/>
        </div>

        <div class="d-flex align-items-center gap-3">
            <div class="avatar-group">
                {#each item.teamMembers as member}
                    <div class="avatar-group-item">
                        <img src={member} alt="" class="rounded-circle avatar-sm"/>
                    </div>
                {/each}
            </div>
            <h5 class="mb-0">{item.team}+ Team Work</h5>
        </div>
    </CardBody>
</Card>