<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {
        Card,
        CardBody,
        Col,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle,
        Input, Pagination, PaginationItem, PaginationLink,
        Row, Table
    } from "@sveltestrap/sveltestrap";
    import {orderList} from "./components/data";
    import {kebabToTitleCase} from "$lib/helpers/change-casing";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Orders List" subTitle="Ecommerce"/>
    <Row>
        <Col>
            <Card>
                <CardBody>
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                        <div class="search-bar">
                            <span><i class="bx bx-search-alt"></i></span>
                            <Input type="search" id="search" placeholder="Search..."/>
                        </div>

                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                            <Dropdown>
                                <DropdownToggle>
                                    <i class="bx bx-sort me-1"/>Filter
                                </DropdownToggle>
                                <DropdownMenu>
                                    <DropdownItem>By Date</DropdownItem>
                                    <DropdownItem>By Order ID</DropdownItem>
                                    <DropdownItem>By Status</DropdownItem>
                                </DropdownMenu>
                            </Dropdown>
                            <a href="#!" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i>Create Contact
                            </a>
                        </div>
                    </div>
                </CardBody>
                <Table responsive class="text-nowrap table-centered m0">
                    <thead class="bg-light bg-opacity-50">
                    <tr>
                        {#each orderList.header as thead}
                            <th>{thead}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each orderList.body as order}
                        <tr>
                            <td>
                                <a href="/ecommerce/orders/{order.orderID}">#{order.orderID}</a>
                            </td>
                            <td>{order.date}</td>
                            <td>
                                <img src={order.image} alt="product-1(1)" class="img-fluid avatar-sm"/>
                            </td>
                            <td>
                                <a href="#!">{order.name}</a>
                            </td>
                            <td>{order.email}</td>
                            <td>{order.phone}</td>
                            <td>{order.address}</td>
                            <td>{order.paymentType}</td>
                            <td>
                                <i class="bx bxs-circle {order.status === 'completed' ? 'text-success' : order.status === 'processing' ? 'text-primary' : 'text-danger'}"></i>
                                {kebabToTitleCase(order.status) }
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
                            <span class="fw-semibold">90,521</span>
                            orders
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
        </Col>
    </Row>
</DefaultLayout>