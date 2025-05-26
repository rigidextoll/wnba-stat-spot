<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {
        Button,
        Card,
        CardHeader,
        Col,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle, Input,
        Row
    } from "@sveltestrap/sveltestrap";
    import TeamCard from "./components/TeamCard.svelte";
    import {teamData} from "./components/data";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Our Team" subTitle="Pages"/>
    <Row>
        <Col lg="12">
            <Card>
                <CardHeader>
                    <Row class="g-2">
                        <Col sm="4">
                            <div class="search-bar">
                                <span><i class="bx bx-search-alt"></i></span>
                                <Input type="search" id="search" placeholder="Search..."/>
                            </div>
                        </Col>
                        <div class="col-sm-auto ms-auto">
                            <div class="d-flex gap-1">
                                <Button color="danger">
                                    <i class="bx bx-plus me-1 align-middle"/>
                                    Add Members
                                </Button>
                                <Button type="button" class="btn-soft-primary fs-14">
                                    <i class="bx bxs-grid"/>
                                </Button>
                                <Button type="button" class="btn-soft-primary fs-14">
                                    <i class="bx bx-list-ul"/>
                                </Button>

                                <Dropdown>
                                    <DropdownToggle color="light">
                                        <i class="bx bx-dots-vertical-rounded"/>
                                    </DropdownToggle>
                                    <DropdownMenu>
                                        <DropdownItem>All</DropdownItem>
                                        <DropdownItem>Last Week</DropdownItem>
                                        <DropdownItem>Last Month</DropdownItem>
                                        <DropdownItem>Last Year</DropdownItem>
                                    </DropdownMenu>
                                </Dropdown>
                            </div>
                        </div>
                    </Row>
                </CardHeader>
            </Card>
            <Row>
                {#each teamData as item}
                    <Col xxl="4" md="6">
                        <TeamCard item={item}/>
                    </Col>
                {/each}
            </Row>
        </Col>
    </Row>
</DefaultLayout>