<script lang="ts">
    import {Badge, Button, Card, CardBody, CardHeader, CardTitle, Table} from "@sveltestrap/sveltestrap";
    import {newAccountsTableData} from "./data";
    import {toSentenceCase} from "$lib/helpers/change-casing";
</script>


<Card>
    <CardHeader class="d-flex justify-content-between align-items-center">
        <CardTitle>New Accounts</CardTitle>
        <Button color="light" size="sm">View All</Button>
    </CardHeader>

    <CardBody class="pb-1">
        <Table hover responsive class="mb-0 table-centered">
            <thead>
            <tr>
                {#each newAccountsTableData.header as header, idx}
                    <th class="py-1">{header}</th>
                {/each}
            </tr>
            </thead>
            <tbody>
            {#each newAccountsTableData.body as item, idx}
                <tr>
                    <td>{item.id}</td>
                    <td>{item.date}</td>
                    <td>
                        <img src={item.user.avatar} alt="avatar" class="img-fluid avatar-xs rounded-circle"/>
                        <span class="align-middle ms-1">{item.user.name}</span>
                    </td>
                    <td>
                        <Badge class={
                item.account === 'verified'
                  ? 'badge-soft-success text-success'
                  : item.account === 'pending'
                    ? 'badge-soft-warning text-warning'
                    : 'badge-soft-danger text-danger'}>
                            {toSentenceCase(item.account)}
                        </Badge>
                    </td>
                    <td>{item.username}</td>
                </tr>
            {/each}
            </tbody>
        </Table>
    </CardBody>
</Card>
