<script lang="ts">
    import {Badge, Button, Card, CardBody, CardHeader, CardTitle, Table} from "@sveltestrap/sveltestrap";
    import {recentTransactionsTableData} from "./data";
    import {toSentenceCase} from "$lib/helpers/change-casing";
</script>


<Card>
    <CardHeader class="d-flex justify-content-between align-items-center">
        <CardTitle>Recent Transactions</CardTitle>
        <Button color="light" size="sm">View All</Button>
    </CardHeader>

    <CardBody>
        <Table hover responsive class="mb-0 table-centered">
            <thead>
            <tr>
                {#each recentTransactionsTableData.header as header, idx}
                    <th class="py-1">{header}</th>
                {/each}
            </tr>
            </thead>
            <tbody>
            {#each recentTransactionsTableData.body as item, idx}
                <tr>
                    <td>{item.id}</td>
                    <td>{item.date}</td>
                    <td>{item.amount}</td>
                    <td>
                        <Badge class={item.status === 'cr' ? 'bg-success' : 'bg-danger'}>
                            {toSentenceCase(item.status)}
                        </Badge>
                    </td>
                    <td>{item.description}</td>
                </tr>
            {/each}
            </tbody>
        </Table>
    </CardBody>
</Card>