<script lang="ts">
    import {Button, Card, Pagination, PaginationItem, PaginationLink, Table} from "@sveltestrap/sveltestrap";
    import {customerList} from "./data";
</script>

<Card class="overflow-hidden">
    <Table responsive class="text-nowrap table-centered m-0">
        <thead>
        <tr>
            <th>Customer Name</th>
            <th>Date</th>
            <th>Email ID</th>
            <th>Phone No.</th>
            <th>Location</th>
            <th>Orders</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        {#each customerList as customer}
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-1">
                        <img src={customer.image} alt="avatar-1"
                             class="img-fluid avatar-xs rounded-circle avatar-border me-1"/>
                        <a href={"#"}>{ customer.name }</a>
                    </div>
                </td>
                <td>{ customer.date }</td>
                <td>{ customer.email }</td>
                <td>{ customer.phone }</td>
                <td>{ customer.location }</td>
                <td>{ customer.orders }</td>
                <td>
                    <Button size="sm" class="btn-soft-secondary me-2">
                        <i class="bx bx-edit fs-16"></i>
                    </Button>
                    <Button size="sm" class="btn-soft-danger">
                        <i class="bx bx-trash fs-16"></i>
                    </Button>
                </td>
            </tr>
        {/each}
        </tbody>
    </Table>
    <div class="align-items-center justify-content-between row g-0 text-center text-sm-start p-3 border-top">
        <div class="col-sm">
            <div class="text-muted">
                Showing
                <span class="fw-semibold">10</span>
                of
                <span class="fw-semibold">2,852</span>
                Results
            </div>
        </div>
        <div class="col-sm-auto mt-3 mt-sm-0">
            <Pagination class="pagination-rounded m-0">
                <PaginationItem>
                    <PaginationLink href="#" previous><i class="bx bx-left-arrow-alt"></i></PaginationLink>
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
                    <PaginationLink href="#" next><i class="bx bx-right-arrow-alt"></i></PaginationLink>
                </PaginationItem>
            </Pagination>
        </div>
    </div>
</Card>