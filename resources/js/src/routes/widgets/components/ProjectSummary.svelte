<script lang="ts">
    import {Card, CardBody, CardTitle, Progress, Table} from "@sveltestrap/sveltestrap";
    import {recentProjectsSummaryTableData} from "./data";
</script>

<Card>
    <CardBody class="p-0">
        <div class="pt-3 px-3">
            <div class="float-end">
                <a href={"#"} class="text-primary">
                    Export
                    <i class="bx bx-export ms-1"></i>
                </a>
            </div>
            <CardTitle class="mb-3">Recent Project Summary</CardTitle>
        </div>
        <div class="mb-3" data-simplebar style="max-height: 324px;">
            <Table hover responsive class="mb-0 table-centered table-nowrap px-3">
                <thead>
                <tr>
                    {#each recentProjectsSummaryTableData.header as header, idx}
                        <th>{header}</th>
                    {/each}
                </tr>
                </thead>

                <tbody>
                {#each recentProjectsSummaryTableData.body as item, idx}
                    <tr>
                        <td>{item.project}</td>
                        <td>{item.client}</td>
                        <td class="avatar-group">
                            {#each item.team as member, idx}
                                <a href={"#"} class="avatar-group-item">
                                    <img src={member.avatar} alt=""
                                         class="img-fluid avatar-xs rounded-circle avatar-border"/>
                                </a>
                            {/each}
                        </td>
                        <td>{item.deadline}</td>
                        <td>
                            <Progress color={item.progress.variant} value={item.progress.data}
                                      style="height:5px"></Progress>
                        </td>
                    </tr>
                {/each}
                </tbody>
            </Table>
        </div>
    </CardBody>
</Card>