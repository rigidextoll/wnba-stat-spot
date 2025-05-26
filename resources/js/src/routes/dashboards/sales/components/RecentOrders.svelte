<script lang="ts">
    import {recentOrdersTableData} from "./data";
    import {
        Button,
        Card,
        CardBody,
        CardTitle,
        Pagination,
        PaginationItem,
        PaginationLink,
        Table
    } from "@sveltestrap/sveltestrap";
    import {toSentenceCase} from "$lib/helpers/change-casing";

    const perPageItem = 5
    const currentPage = 1

    const tableData = recentOrdersTableData.body.slice(0, 5)
</script>


<Card>
    <CardBody>
        <div class="d-flex align-items-center justify-content-between">
            <CardTitle>Recent Orders</CardTitle>
            <Button size="sm" color="primary">
                <i class="bx bx-plus me-1"></i>
                Create Order
            </Button>
        </div>
    </CardBody>

    <Table responsive class="table-centered mb-0">
        <thead class="bg-light bg-opacity-50">
        <tr>
            {#each recentOrdersTableData.header as header, idx}
                <th class="border-0 py-2">{header}</th>
            {/each}
        </tr>
        </thead>
        <tbody>
        {#each tableData as order}
            <tr>
                <td><a href={"#"}>{order.id}</a></td>
                <td>{order.date}</td>
                <td><img src={order.product.image} alt="" class="img-fluid avatar-sm"/></td>
                <td><a href={"#"}>{order.customer.name}</a></td>
                <td>{order.customer.email}</td>
                <td>{order.customer.phoneNo}</td>
                <td>{order.customer.address}</td>
                <td>{order.paymentType}</td>
                <td>
                    <i class="bx bxs-circle me-1 {order.status === 'completed' ? 'text-success' : order.status === 'processing' ? 'text-primary' : 'text-danger'}">
                    </i>
                    {toSentenceCase(order.status)}
                </td>
            </tr>
        {/each}
        </tbody>
    </Table>

    <div class="d-flex align-items-center justify-content-between g-0 text-center text-sm-start p-3 border-top">
        <div class="text-muted">
            Showing <span class="fw-semibold">{perPageItem}</span> of <span
                class="fw-semibold">{recentOrdersTableData.body.length}</span> orders
        </div>
        <div class="col-sm-auto mt-3 mt-sm-0">
            <Pagination class="pagination-rounded m-0">
                <PaginationItem>
                    <PaginationLink previous href="#"><i class="bx bx-left-arrow-alt"></i></PaginationLink>
                </PaginationItem>
                <PaginationItem active>
                    <PaginationLink href="#">1</PaginationLink>
                </PaginationItem>
                <PaginationItem>
                    <PaginationLink href="#">2</PaginationLink>
                </PaginationItem>
                <PaginationItem>
                    <PaginationLink href="#">3</PaginationLink>
                </PaginationItem>
                <PaginationItem>
                    <PaginationLink next href="#"><i class="bx bx-right-arrow-alt"></i></PaginationLink>
                </PaginationItem>
            </Pagination>
        </div>
    </div>
</Card>