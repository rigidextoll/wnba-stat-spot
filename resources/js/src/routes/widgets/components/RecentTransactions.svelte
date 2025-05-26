<script lang="ts">
    import {Badge, Button, Card, CardBody, CardHeader, CardTitle, Table} from "@sveltestrap/sveltestrap";
    import {toSentenceCase} from "$lib/helpers/change-casing";
    import {recentTransaction} from "./data";
</script>

<Card>
    <CardHeader class="d-flex justify-content-between align-items-center">
        <CardTitle>Recent Transactions</CardTitle>
        <div>
            <Button size="sm" color="primary">
                <i class="bx bx-plus me-1"></i>Add
            </Button>
        </div>
    </CardHeader>

    <CardBody class="p-0">
        <div data-simplebar class="px-3" style="max-height: 406px;">
            <Table hover class="mb-0 table-centered">
                <tbody>
                {#each recentTransaction as transaction}
                    <tr>
                        <td>{transaction.date}</td>
                        <td>{transaction.amount}</td>
                        <td>
                            <Badge class={transaction.status === 'cr' ? 'bg-success' : 'bg-danger'}>
                                {toSentenceCase(transaction.status)}
                            </Badge>
                        </td>
                        <td>{transaction.description}</td>
                    </tr>
                {/each}
                </tbody>
            </Table>
        </div>
    </CardBody>
</Card>
