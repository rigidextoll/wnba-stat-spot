<script lang="ts">
    import {
        Row,
        Col,
        Card,
        CardBody,
        Form,
        Dropdown,
        DropdownItem,
        Nav,
        NavItem,
        Input, DropdownMenu, DropdownToggle,
    } from '@sveltestrap/sveltestrap';

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import List from "./components/List.svelte";
    import Grid from "./components/Grid.svelte";

    let customersTab = true

    const toggleCustomersTab = () => {
        customersTab = !customersTab;
    };
</script>

<DefaultLayout>
    <PageBreadcrumb title="Customers List" subTitle="Ecommerce"/>
    <Row>
        <Col>
            <Card>
                <CardBody>
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div>
                            <Form class="d-flex flex-wrap align-items-center gap-2">
                                <label for="search" class="visually-hidden">Search</label>
                                <div class="search-bar me-3">
                                    <span><i class="bx bx-search-alt"></i></span>
                                    <Input type="search" id="search" placeholder="Search ..."/>
                                </div>

                                <label for="status-select" class="me-2">Sort By</label>
                                <div class="me-sm-3">
                                    <Input type="select" id="status-select">
                                        <option value="">
                                            All
                                        </option>
                                        <option value="1">
                                            Name
                                        </option>
                                        <option value="2">
                                            Joining Date
                                        </option>
                                        <option value="3">
                                            Phone
                                        </option>
                                        <option value="4">
                                            Orders
                                        </option>
                                    </Input>
                                </div>
                            </Form>
                        </div>
                        <div>
                            <div class="d-flex flex-wrap gap-2 justify-content-md-end align-items-center">
                                <Nav pills class="bg-transparent gap-1 p-0">
                                    <NavItem>
                                        <a href={"#"} class="nav-link {!customersTab && 'active'}"
                                           on:click|preventDefault={toggleCustomersTab}>
                                            <i class="bx bx-grid-alt"></i>
                                        </a>
                                    </NavItem>
                                    <NavItem>
                                        <a href={"#"} class="nav-link {customersTab && 'active'}"
                                           on:click|preventDefault={toggleCustomersTab}>
                                            <i class="bx bx-list-ul"></i>
                                        </a>
                                    </NavItem>
                                </Nav>

                                <Dropdown>
                                    <DropdownToggle>
                                        <span>
                                          <i class="bx bx-sort me-1"></i>Filter
                                        </span>
                                    </DropdownToggle>
                                    <DropdownMenu>
                                        <DropdownItem>By Date</DropdownItem>
                                        <DropdownItem>By Order ID</DropdownItem>
                                        <DropdownItem>By Status</DropdownItem>
                                    </DropdownMenu>
                                </Dropdown>
                                <a href={"#"} class="btn btn-danger">
                                    <i class="bi bi-plus-circle me-1"></i>Add Customer
                                </a>
                            </div>
                        </div>
                    </div>
                </CardBody>
            </Card>
        </Col>
    </Row>

    <div class="tab-content pt-0">
        <div class="tab-pane {customersTab && 'show active'}" id="team-list">
            <List/>
        </div>

        <div class="tab-pane {!customersTab && 'show active'}" id="team-grid">
            <Grid/>
        </div>
    </div>
</DefaultLayout>