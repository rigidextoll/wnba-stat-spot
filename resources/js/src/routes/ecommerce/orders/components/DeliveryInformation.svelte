<script lang="ts">
    import {Card, CardBody, CardTitle, Col} from "@sveltestrap/sveltestrap";

    export let id: string
</script>

<Col lg="4">
    <Card class="card-height-100">
        <CardBody>
            <div class="float-end">
                <a href={"#"} class="text-primary">View All Detail</a>
            </div>
            <CardTitle class="mb-3">
                Delivery Information
            </CardTitle>
            <div class="text-center">
                <i class="bx bx-cart h2"></i>
                <h5>UPS Delivery</h5>
                <p class="mb-1">
                    Order ID :
                    <span class="text-muted me-2"></span>
                    <b>#{id}</b>
                </p>
                <p class="mb-0">
                    Payment Mode :
                    <span class="text-muted me-2"></span>
                    <b>COD</b>
                </p>
            </div>
        </CardBody>
    </Card>
</Col>