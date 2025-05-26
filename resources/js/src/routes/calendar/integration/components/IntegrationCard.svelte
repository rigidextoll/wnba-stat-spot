<script lang="ts">
    import type {IntegrationType} from "./types";
    import {Card, CardBody, CardTitle, Input} from "@sveltestrap/sveltestrap";

    export let integration: IntegrationType
</script>


<Card class="card-height-100">
    <CardBody>
        <div class="float-end">
            <div class="form-check form-switch">
                <Input type="checkbox" id="googleMailSwitch"
                       checked="{integration.checked}"/>
            </div>
        </div>
        <img src="{integration.image}" alt="Google Mail" class="img-fluid avatar-sm"/>
        <CardTitle class="mt-3 mb-2">
            {integration.name}
        </CardTitle>
        <p class="mb-0">
            {integration.description}
        </p>
    </CardBody>
</Card>