<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {
        Badge,
        Button,
        Card,
        CardBody,
        Col,
        Input, Pagination,
        PaginationItem,
        PaginationLink,
        Row,
        Table
    } from "@sveltestrap/sveltestrap";
    import {invoicesData} from "./components/data";
    import {currency} from "$lib/helpers/constants";
    import {kebabToTitleCase} from "$lib/helpers/change-casing";
    import moment from "moment";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Invoices List" subTitle="Invoice"/>
    <Row>
        <Col>
            <Card>
                <CardBody>
                    <div class="d-flex flex-wrap justify-content-between gap-3">
                        <div class="search-bar">
                            <span><i class="bx bx-search-alt"></i></span>
                            <Input type="search" id="search" placeholder="Search invoice..."/>
                        </div>
                        <div>
                            <a href={"#"} class="btn btn-success"> <i class="bx bx-plus me-1"></i>Create Invoice </a>
                        </div>
                    </div>
                </CardBody>
                <div>
                    <Table responsive class="text-nowrap table-centered m0">
                        <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="border-0 py-2"> Invoice ID</th>
                            <th class="border-0 py-2"> Customer</th>
                            <th class="border-0 py-2"> Created Date</th>
                            <th class="border-0 py-2"> Due Date</th>
                            <th class="border-0 py-2"> Amount</th>
                            <th class="border-0 py-2"> Payment Status</th>
                            <th class="border-0 py-2"> Via</th>
                            <th class="border-0 py-2"> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {#each invoicesData as item}
                            <tr>
                                <td>
                                    <a href="/invoice/{item.invoiceNumber}" class="fw-medium">
                                        #{item.invoiceNumber} </a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{item.client.avatar}" alt="" class="avatar-xs rounded-circle me-2"/>
                                        <div>
                                            <h5 class="fs-14 mt-1 fw-normal">
                                                {item.client.name}
                                            </h5>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {moment(item.issueDate).format('DD MMMM, YYYY') }
                                    <small>{moment(item.issueDate).format('h:mm a') }</small>
                                </td>
                                <td>{moment(item.dueDate).format('DD MMMM, YYYY') }</td>
                                <td>{currency}{item.amount}</td>
                                <td>
                                    <Badge color=""
                                           class="{item.status === 'paid' ? 'badge-soft-success' : item.status === 'send' ? 'badge-soft-primary' : 'badge-soft-warning'}">
                                        {kebabToTitleCase(item.status) }
                                    </Badge>
                                </td>
                                <td>{item.paymentMethod}</td>
                                <td>
                                    <Button type="button" size="sm" color="" class="btn-soft-secondary me-2">
                                        <i class="bx bx-edit fs-16"></i>
                                    </Button>
                                    <Button type="button" size="sm" color="" class="btn-soft-danger">
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
                                <span class="fw-semibold">52</span>
                                invoices
                            </div>
                        </div>
                        <div class="col-sm-auto mt-3 mt-sm-0">
                            <Pagination class="pagination-rounded m-0">
                                <PaginationItem>
                                    <PaginationLink href="#" previous><i class="bx bx-left-arrow-alt"></i>
                                    </PaginationLink>
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
                </div>
            </Card>
        </Col>
    </Row>
</DefaultLayout>