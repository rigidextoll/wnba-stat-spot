<script lang="ts">
    import type {EventListType} from "./types";
    import {Card, CardBody, CardTitle} from "@sveltestrap/sveltestrap";

    export let item: EventListType
</script>

<Card>
    <img class="card-img-top img-fluid" src="{item.image}" alt="group-2"/>
    <CardBody>
        <h6>
            {item.date}
        </h6>
        <CardTitle class="fs-16 lh-base mb-1">
            <a href={"#"} class="text-reset">{item.name}</a>
        </CardTitle>
        <p class="card-text text-muted">
            {item.location}
        </p>
        <div class="d-flex">
            <a href={"#"} class="btn btn-primary w-100 me-1"><i class="bx bxs-star me-1"></i>Interested</a>
            <a href={"#"} class="btn btn-primary"><i class="bx bxl-telegram"></i></a>
        </div>
    </CardBody>
</Card>