<script lang="ts">
    import {Card, CardBody, CardTitle, Col} from "@sveltestrap/sveltestrap";
</script>

<Col lg="4">
    <Card class="card-height-100">
        <CardBody>
            <div class="float-end">
                <a href={"#"} class="text-primary">
                    <i class="bx bx-edit me-1"></i>
                    Change
                </a>
            </div>
            <CardTitle class="mb-3">
                Billing Information
            </CardTitle>
            <p class="mb-1">
                Payment Type :
                <span class="text-muted me-2"></span>
                <b>Credit Card</b>
            </p>
            <p class="mb-1">Holder Name : <span class="text-muted me-2"></span> <b>Alice S. Shepherd</b></p>
            <p class="mb-1">
                Provider :
                <span class="text-muted me-2"></span>
                <b>Visa ending in 4589</b>
            </p>
            <p class="mb-1">
                Valid Date :
                <span class="text-muted me-2"></span>
                <b>21/05</b>
            </p>
            <p class="mb-0">
                CVV :
                <span class="text-muted me-2"></span>
                <b>xxx</b>
            </p>
        </CardBody>
    </Card>
</Col>