<script lang="ts">
    import type {ContactType} from "./types";
    import {Card, CardBody} from "@sveltestrap/sveltestrap";

    export let contact: ContactType
</script>

<Card>
    <CardBody>
        <div class="text-center">
            <img src={contact.avatar} alt="avatar-1"
                 class="img-fluid avatar-xl img-thumbnail rounded-circle avatar-border"/>
            <h4 class="mt-3 fs-18">
                <a href={"#"} class="text-dark">{ contact.name }</a>
            </h4>
            <a href={"#"} class="mb-1 d-inline-block">
                <i class="bx bx-location-plus text-danger fs-14 me-1"></i>
                { contact.location }
            </a>
            <br/>
            <a href={"#"}><i class="bx bx-phone-call text-success fs-14 me-1"></i>
                { contact.phone }
            </a>
            <br/>
            <a href="/pages/profile" class="btn btn-sm btn-outline-primary mt-3">View Profile</a>
        </div>
    </CardBody>
</Card>