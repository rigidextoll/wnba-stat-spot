<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Button, Card, CardBody, Form, Input, Nav, NavItem} from "@sveltestrap/sveltestrap";
    import List from "./components/List.svelte";
    import Grid from "./components/Grid.svelte";

    let sellerTab = true

    const toggleSellerTab = () => {
        sellerTab = !sellerTab;
    };
</script>

<DefaultLayout>
    <PageBreadcrumb title="Sellers List" subTitle="Ecommerce"/>
    <Card>
        <CardBody>
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div>
                    <Form class="d-flex flex-wrap align-items-center gap-2">
                        <label for="search" class="visually-hidden">Search</label>
                        <div class="search-bar me-3">
                            <span><i class="bx bx-search-alt"></i></span>
                            <Input type="search" id="search" placeholder="Search..."/>
                        </div>

                        <label for="status-select" class="me-2">Sort By</label>
                        <div class="me-sm-3">
                            <Input type="select" id="status-select">
                                <option value="All">All</option>
                                <option value="1">Name</option>
                                <option value="2">Store Name</option>
                                <option value="3">Rating</option>
                                <option value="4">Revenue</option>
                            </Input>
                        </div>
                    </Form>
                </div>
                <div>
                    <div class="d-flex flex-wrap gap-2 justify-content-md-end align-items-center">
                        <Nav pills class="bg-transparent gap-1 p-0">
                            <NavItem>
                                <a href={"#"} class="nav-link {!sellerTab && 'active'}"
                                   on:click|preventDefault={toggleSellerTab}>
                                    <i class="bx bx-grid-alt"></i>
                                </a>
                            </NavItem>
                            <NavItem>
                                <a href={"#"} class="nav-link {sellerTab && 'active'}"
                                   on:click|preventDefault={toggleSellerTab}>
                                    <i class="bx bx-list-ul"></i>
                                </a>
                            </NavItem>
                        </Nav>

                        <Button color="danger">
                            <i class="bx bx-plus me-1"></i>Add Seller
                        </Button>
                    </div>
                </div>
            </div>
        </CardBody>
    </Card>

    <div class="tab-content pt-0">
        <div class="tab-pane {sellerTab && 'show active'}" id="seller-list">
            <List/>
        </div>

        <div class="tab-pane {!sellerTab && 'show active'}" id="seller-grid">
            <Grid/>
        </div>
    </div>
</DefaultLayout>