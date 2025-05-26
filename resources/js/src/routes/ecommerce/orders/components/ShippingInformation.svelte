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
                Shipping Information
            </CardTitle>
            <h5 class="">Alice S. Shepherd</h5>
            <address class="mb-0">
                4251 Private Lane, <br/>
                Valdosta, GA 31601 <br/>
                <abbr title="phone">Phone :</abbr>
                229-269-1411 <br/>
                <abbr title="mobile">Mobile :</abbr>
                740-302-6656
            </address>
        </CardBody>
    </Card>
</Col>