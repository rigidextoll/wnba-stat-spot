<script lang="ts">

    import {
        Card, CardBody,
        CardHeader,
        CardTitle,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle, Table
    } from "@sveltestrap/sveltestrap";
    import Icon from "@iconify/svelte";
    import {salesByCategoryChartOptions, salesByCategoryTableData} from "./data";
    import ApexChart from "$lib/components/ApexChart.svelte";
</script>

<Card>
    <CardHeader class="d-flex justify-content-between align-items-center">
        <CardTitle>
            Sales By Category
        </CardTitle>

        <Dropdown class="p-0">
            <DropdownToggle tag="a" color="link" class="text-dark p-0">
                <Icon icon="iconamoon:menu-kebab-vertical-circle-duotone" class="fs-20 align-middle text-muted"/>
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
        <div dir="ltr">
            <ApexChart id="sale-by-category" options={salesByCategoryChartOptions}/>
        </div>

        <div class="mb-n1 mt-2">
            <Table responsive borderless class="table-sm table-nowrap table-centered mb-0">
                <thead class="bg-light bg-opacity-50">
                <tr>
                    {#each salesByCategoryTableData.header as header, idx}
                        <th class="py-1">{header}</th>
                    {/each}
                </tr>
                </thead>
                <tbody>
                {#each salesByCategoryTableData.body as item, idx}
                    <tr>
                        <td>{item.category}</td>
                        <td>{item.orders}</td>
                        <td>
                            {item.percent.data}%
                            <span class="badge ms-1 ${item.percent.growth> 0 ? 'badge-soft-success text-success' : 'badge-soft-danger text-danger'}">
                                {Math.abs(item.percent.growth)}% {item.percent.growth > 0 ? 'Up' : 'Down'}
                </span>
                        </td>
                    </tr>
                {/each}
                </tbody>
            </Table>
        </div>

    </CardBody>
</Card>