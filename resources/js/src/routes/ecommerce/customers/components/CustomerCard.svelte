<script lang="ts">

    import type {CustomerType} from "./types";
    import {Card, CardBody} from "@sveltestrap/sveltestrap";

    export let customer: CustomerType
</script>

<Card>
    <CardBody>
        <div class="text-center">
            <img src={customer.image} alt="avatar-1"
                 class="img-fluid avatar-xxl img-thumbnail rounded-circle avatar-border"/>
            <h4 class="mt-3">
                <a href={"#"}>{customer.name}</a>
            </h4>
            <a href={"#"} class="mb-1 d-inline-block">
                <i class="bx bx-location-plus text-danger fs-14 me-1"/>
                {customer.location}
            </a>
            <br/>
            <a href={"#"}>
                <i class="bx bx-phone-call text-success fs-14 me-1"/>
                {customer.phone}
            </a>
            <br/>
            <a href={"#"} class="btn btn-sm btn-outline-primary mt-2">View All Details</a>
        </div>
    </CardBody>
</Card>