<script lang="ts">
    import type {GroupType} from "./types";
    import {Card, CardBody, CardTitle} from "@sveltestrap/sveltestrap";

    export let item: GroupType
</script>

<Card class="group">
    <a href={"#"} class="group-action">
        <div class="avatar-sm fw-bold">
        <span class="avatar-title rounded-circle text-bg-primary text-center fs-18">
          <i class="bx bx-x"></i>
        </span>
        </div>
    </a>
    <img class="card-img-top img-fluid" src="{item.image}" alt="group-7"/>
    <CardBody>
        <CardTitle class="fs-16 mb-2">
            {item.title}
        </CardTitle>
        <p class="card-text text-muted text-justify">
            {item.caption}
        </p>
        <a href={"#"} class="btn btn-primary w-100">Join Group</a>
    </CardBody>
</Card>