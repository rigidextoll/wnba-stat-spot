<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Badge, Card, CardBody, CardTitle, Col, Input, Row, Table} from "@sveltestrap/sveltestrap";
    import {inventoryList} from "./components/data";
    import {kebabToTitleCase} from "$lib/helpers/change-casing";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Inventory" subTitle="Ecommerce"/>
    <Row>
        <Col xl="3">
            <Card>
                <CardBody>
                    <CardTitle class="mb-3">
                        Filter Products
                    </CardTitle>
                    <div class="search-bar mb-3">
                        <span><i class="bx bx-search-alt"></i></span>
                        <Input type="search" name="search" id="search" placeholder="Search by name......."/>
                    </div>
                    <div class="mb-3">
                        <label for="productId" class="form-label">Product Id</label>
                        <Input type="text" id="productId" placeholder="Filter by Product Id"/>
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <Input type="select" id="condition">
                            <option value="1">All Conditions</option>
                            <option value="2">New</option>
                            <option value="3">Return</option>
                            <option value="4">Damaged</option>
                        </Input>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <Input type="select" id="category">
                            <option value="1">All Categories</option>
                            <option value="2">Electronics & Accessories</option>
                            <option value="3">Home & Kitchen</option>
                            <option value="4">Cloth</option>
                        </Input>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <Input type="select" id="location">
                            <option value="1">All Locations</option>
                            <option value="2">Warehouse 1</option>
                            <option value="3">Warehouse 2</option>
                            <option value="4">Warehouse 3</option>
                            <option value="5">Warehouse 4</option>
                        </Input>
                    </div>
                    <Row>
                        <Col xs="6">
                            <a href={"#"} class="btn btn-outline-primary w-100">Clear</a>
                        </Col>
                        <Col xs="6">
                            <a href={"#"} class="btn btn-primary w-100">Apply Filters</a>
                        </Col>
                    </Row>
                </CardBody>
            </Card>
        </Col>
        <Col xl="9">
            <Card>
                <CardBody>
                    <Row>
                        <Col>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <a href={"#"} class="btn btn-secondary"><i
                                        class="bx bx-export me-1"></i>Export</a>
                                <a href={"#"} class="btn btn-secondary"><i
                                        class="bx bx-import me-1"></i>Import</a>
                                <a href="/ecommerce/products/create"
                                   class="btn btn-primary d-inline-flex align-items-center ms-md-auto">
                                    <i class="bx bx-plus me-1"></i>
                                    Add Product
                                </a>
                            </div>
                        </Col>
                    </Row>
                    <Table responsive class="text-nowrap table-centered mt-3 mb-0">
                        <thead>
                        <tr>
                            {#each inventoryList.header as thead, idx}
                                <th>{thead}</th>
                            {/each}
                        </tr>
                        </thead>
                        <tbody>
                        {#each inventoryList.body as inventory}
                            <tr>
                                <td>#{inventory.id}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <a href="/ecommerce/products/{inventory.id}">
                                                <img src={inventory.product.image} alt="product-1(1)"
                                                     class="img-fluid avatar-sm"/>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0 mb-1">
                                                {inventory.product.name}
                                            </h5>
                                            <span class="fs-13">Added: {inventory.product.addedDate}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <Badge pill
                                           class={inventory.condition === 'new' ? 'text-bg-success' : inventory.condition === 'return' ? 'text-bg-warning' : 'text-bg-danger'}>
                                        {kebabToTitleCase(inventory.condition)}
                                    </Badge>
                                </td>
                                <td>{inventory.location}</td>
                                <td>{inventory.available}</td>
                                <td>{inventory.reserved}</td>
                                <td>{inventory.onHand}</td>
                                <td>{inventory.modified}</td>
                            </tr>
                        {/each}
                        </tbody>
                    </Table>
                </CardBody>
            </Card>
        </Col>
    </Row>
</DefaultLayout>