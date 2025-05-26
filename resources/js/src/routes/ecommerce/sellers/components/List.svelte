<script lang="ts">
    import {Badge, Card, Pagination, PaginationItem, PaginationLink, Table} from "@sveltestrap/sveltestrap";
    import {sellersList} from "./data";
    import {currency} from "$lib/helpers/constants";
</script>

<Card class="overflow-hidden">
    <Table responsive class="table-centered text-nowrap m0">
        <thead>
        <tr>
            <th>Seller</th>
            <th>Store Name</th>
            <th>Rating</th>
            <th>Products</th>
            <th>Wallet Balance</th>
            <th>Create Date</th>
            <th>Revenue</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        {#each sellersList as seller}
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-1">
                        <img src={seller.image} alt="avatar-1"
                             class="img-fluid avatar-sm rounded-circle avatar-border me-1"/>
                        <a href="#!">{seller.name}</a>
                    </div>
                </td>
                <td>{seller.storeName}</td>
                <td>
                    <Badge class="{seller.rating >= 4 ? 'text-bg-success' : seller.rating <= 4 && seller.rating >= 2 ? 'text-bg-warning' : 'text-bg-danger'}">
                        <i class="bx bxs-star me-1"></i>
                        {seller.rating}
                    </Badge>
                </td>
                <td>{seller.products}</td>
                <td>{currency}{seller.walletBalance}</td>
                <td>{seller.createDate}</td>
                <td>{currency}{seller.revenue}</td>
                <td>
                    <a href={"#"} class="btn btn-sm btn-soft-primary me-2">
                        <i class="bx bx-edit fs-18"></i>
                    </a>
                    <a href={"#"} class="btn btn-sm btn-soft-danger">
                        <i class="bx bx-trash fs-18"></i>
                    </a>
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
                <span class="fw-semibold">269</span>
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