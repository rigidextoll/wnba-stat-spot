<script lang="ts">
    import {
        Badge,
        Card,
        CardBody,
        CardHeader,
        CardTitle,
        Dropdown,
        DropdownItem, DropdownMenu,
        DropdownToggle, Table
    } from "@sveltestrap/sveltestrap";
    import Icon from "@iconify/svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import {revenueSourceChartOptions, revenueSourceTableData} from "./data";
</script>


<Card>
    <CardHeader class="d-flex justify-content-between align-items-center">
        <CardTitle>Revenue Sources</CardTitle>

        <Dropdown>
            <DropdownToggle tag="a" color="link" class="text-dark p-0">
                <Icon
                        icon="iconamoon:menu-kebab-vertical-circle-duotone"
                        class="fs-20 align-middle text-muted"
                />
            </DropdownToggle>

            <DropdownMenu>
                <DropdownItem>Sales Report</DropdownItem>
                <DropdownItem>Export Report</DropdownItem>
                <DropdownItem>Profit</DropdownItem>
                <DropdownItem>Action</DropdownItem>
            </DropdownMenu>

        </Dropdown>

    </CardHeader>

    <CardBody>
        <ApexChart id="revenue-source-chart" options={revenueSourceChartOptions}/>

        <div class="mb-n1 mt-1">
            <Table responsive borderless
                   class="table-sm table-nowrap table-centered mb-0">

                <thead class="bg-light bg-opacity-50">
                <tr>
                    {#each revenueSourceTableData.header as header}
                        <th class="py-1">
                            {header}
                        </th>
                    {/each}
                </tr>
                </thead>

                <tbody>
                {#each revenueSourceTableData.body as item}
                    <tr>
                        <td>{item.source}</td>
                        <td>{item.revenue}</td>
                        <td>
                            {item.percent.data}%
                            <Badge class={`ms-1 ${item.percent.growth>0?'badge-soft-success text-success':'badge-soft-danger text-danger'}`}>
                                {Math.abs(item.percent.growth)}% {item.percent.growth > 0 ? 'Up' : 'Down'}
                            </Badge>
                        </td>
                    </tr>
                {/each}
                </tbody>
            </Table>
        </div>

    </CardBody>
</Card>