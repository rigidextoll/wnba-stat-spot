<script lang="ts">
    import {Card, CardBody, CardTitle, Col, Table} from "@sveltestrap/sveltestrap";
    import {currency} from "$lib/helpers/constants";

    export let id: string
</script>

<Col xl="5">
    <Card>
        <CardBody>
            <CardTitle class="mb-3">
                Products From Order #{id}
            </CardTitle>
            <Table responsive class="text-nowrap table-centered mb-0">
                <thead>
                <tr>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Grand Total :</td>
                    <td>{currency}2201.59</td>
                </tr>
                <tr>
                    <td>Shipping Charge :</td>
                    <td>FREE</td>
                </tr>
                <tr>
                    <td>Estimated tax :</td>
                    <td>{currency}15</td>
                </tr>
                <tr>
                    <td class="fw-semibold">
                        Total :
                    </td>
                    <td class="fw-semibold">
                        {currency}2266.59
                    </td>
                </tr>
                </tbody>
            </Table>
        </CardBody>
    </Card>
</Col>