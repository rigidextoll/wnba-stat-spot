<script lang="ts">
    import {Badge, Card, CardHeader, CardTitle, Table} from "@sveltestrap/sveltestrap";
    import {topPagesTableData} from "./data";
</script>

<Card>
    <CardHeader class="d-flex align-items-center justify-content-between gap-2">
        <CardTitle class="flex-grow-1">
            Top Pages
        </CardTitle>
        <div>
            <a href="null" class="btn btn-sm btn-soft-primary">View All</a>
        </div>
    </CardHeader>

    <Table hover responsive class="table-nowrap table-centered m-0">

        <thead class="bg-light bg-opacity-50">
        <tr>
            {#each topPagesTableData.header as header}
                <th class="text-muted py-1">
                    {header}
                </th>
            {/each}
        </tr>
        </thead>

        <tbody>

        {#each topPagesTableData.body as item}
            <tr>
                <td>
                    <a href="null" class="text-muted">{item.pagePath}</a>
                </td>
                <td>{item.pageViews}</td>
                <td>{item.avgTimeOnPage}</td>
                <td>
                    <Badge class={item.exitRate < 10 ? 'badge-soft-success text-success' : item.exitRate > 10 && item.exitRate <20 ? 'badge-soft-warning text-warning' : 'badge-soft-danger text-danger'}>
                        {
                            Math.abs(item.exitRate)
                        }%
                    </Badge>
                </td>
            </tr>
        {/each}

        </tbody>
    </Table>

</Card>