<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {
        Col,
        Row,
        Card,
        CardBody,
        Table,
        Button,
        Pagination,
        PaginationItem,
        PaginationLink
    } from "@sveltestrap/sveltestrap";
    import {products} from "./components/data";
    import {currency} from "$lib/helpers/constants";
    import {kebabToTitleCase} from "$lib/helpers/change-casing";

    const perPageItem = 5;
</script>

<DefaultLayout>
    <PageBreadcrumb title="Products List" subTitle="Ecommerce"/>
    <Row>
        <Col>
            <Card>
                <CardBody>
                    <div class="d-flex flex-wrap justify-content-between gap-3">
                        <div class="search-bar">
                            <span><i class="bx bx-search-alt"></i></span>
                            <input type="search" id="search" placeholder="Search..." class="form-control"/>
                        </div>
                        <div>
                            <a href="/ecommerce/products/create" class="btn btn-primary d-flex align-items-center">
                                <i class="bx bx-plus me-1"></i>Add Product
                            </a>
                        </div>
                    </div>
                </CardBody>
                <div>
                    <Table responsive class="table-centered text-nowrap mb-0">
                        <thead class="bg-light bg-opacity-50">
                        <tr>
                            {#each products.header as thead, idx}
                                <th>{thead}</th>
                            {/each}
                        </tr>
                        </thead>
                        <tbody>
                        {#each products.body as product, idx}
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <a href="/ecommerce/products/details/{product.id}">
                                                <img src={product.product.image} alt="product-1(1)"
                                                     class="img-fluid avatar-sm"/>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0 mb-1">
                                                <a href="/ecommerce/products/details/{product.id}" class="text-reset">
                                                    {product.product.name}
                                                </a>
                                            </h5>
                                            <span class="fs-13">{product.product.caption}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{product.category}</td>
                                <td>{currency}{product.price}</td>
                                <td class={product.inventory === 'limited' ? 'text-primary' : product.inventory === 'in-stock' ? 'text-success' : 'text-danger'}>
                                    <i class="bx bxs-circle me-1 {product.inventory === 'limited' ? 'text-primary' : product.inventory === 'in-stock' ? 'text-success' : 'text-danger'}"></i>
                                    {kebabToTitleCase(product.inventory)}
                                </td>
                                <td>
                                    <Button type="button" color="soft-danger" size="sm" class="btn-soft-secondary me-1">
                                        <i class="bx bx-edit fs-18"></i>
                                    </Button>
                                    <Button type="button" color="soft-danger" size="sm" class="btn-soft-danger ms-1">
                                        <i class="bx bx-trash fs-18"></i>
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
                                <span class="fw-semibold">7</span>
                                of
                                <span class="fw-semibold">15</span>
                                Results
                            </div>
                        </div>
                        <div class="col-sm-auto mt-3 mt-sm-0">
                            <Pagination class="pagination-rounded m-0">
                                <PaginationItem>
                                    <PaginationLink previous href="#"><i class="bx bx-left-arrow-alt"></i>
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
                                    <PaginationLink next href="#"><i class="bx bx-right-arrow-alt"></i></PaginationLink>
                                </PaginationItem>
                            </Pagination>
                        </div>
                    </div>
                </div>
            </Card>
        </Col>
    </Row>
</DefaultLayout>