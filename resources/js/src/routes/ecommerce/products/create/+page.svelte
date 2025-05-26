<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Card, CardBody, CardHeader, Col, Nav, NavItem, NavLink, Row} from "@sveltestrap/sveltestrap";
    import GeneralDetail from "./components/GeneralDetail.svelte";
    import ProductImages from "./components/ProductImages.svelte";
    import MetaData from "./components/MetaData.svelte";
    import Finish from "./components/Finish.svelte";
    // import ProductImages from "./components/ProductImages.svelte";
    // import MetaData from "./components/MetaData.svelte";
    // import Finish from "./components/Finish.svelte";

    let productTab = 1;

    const setProductTab = (tab: number) => {
        productTab = tab;
    }

    const nextTab = () => {
        if (productTab < 4) productTab += 1;
    }

    const previousTab = () => {
        if (productTab > 1) productTab -= 1;
    }

</script>

<DefaultLayout>
    <PageBreadcrumb title="Create Product" subTitle="Ecommerce"/>
    <Row>
        <Col>
            <Card id="horizontalwizard">
                <CardHeader>
                    <Nav tabs class="card-header-tabs border-0">
                        <NavItem>
                            <NavLink href="javascript:void(0)" class={`pb-3 ${productTab === 1 ? 'active' : ''}`}
                                     on:click={() => setProductTab(1)}>
                                <i class="bx bxs-contact me-2"></i>
                                <span class="d-none d-sm-inline">General Detail</span>
                            </NavLink>
                        </NavItem>
                        <NavItem>
                            <NavLink href="javascript:void(0)" class={`pb-3 ${productTab === 2 ? 'active' : ''}`}
                                     on:click={() => setProductTab(2)}>
                                <i class="bx bx-images me-2"></i>
                                <span class="d-none d-sm-inline">Product Images</span>
                            </NavLink>
                        </NavItem>
                        <NavItem>
                            <NavLink href="javascript:void(0)" class={`pb-3 ${productTab === 3 ? 'active' : ''}`}
                                     on:click={() => setProductTab(3)}>
                                <i class="bx bxs-book me-2"></i>
                                <span class="d-none d-sm-inline">Meta Data</span>
                            </NavLink>
                        </NavItem>
                        <NavItem>
                            <NavLink href="javascript:void(0)" class={`pb-3 ${productTab === 4 ? 'active' : ''}`}
                                     on:click={() => setProductTab(4)}>
                                <i class="bx bxs-check-circle me-2"></i>
                                <span class="d-none d-sm-inline">Finish</span>
                            </NavLink>
                        </NavItem>
                    </Nav>
                </CardHeader>
                <CardBody>
                    <div class="tab-content pt-0">
                        <div class={`tab-pane ${productTab === 1 ? 'show active' : ''}`} id="generalDetail">
                            <GeneralDetail/>
                        </div>
                        <div class={`tab-pane ${productTab === 2 ? 'show active' : ''}`} id="productImages">
                            <ProductImages/>
                        </div>
                        <div class={`tab-pane ${productTab === 3 ? 'show active' : ''}`} id="metaData">
                            <MetaData/>
                        </div>
                        <div class={`tab-pane ${productTab === 4 ? 'show active' : ''}`} id="finish">
                            <Finish/>
                        </div>
                        <div class="d-flex flex-wrap gap-2 wizard justify-content-between mt-3">
                            <div class="first d-none">
                                <a href={"#"} class="btn btn-primary">First</a>
                            </div>
                            <div class="previous me-2">
                                <a href={"#"} class={`btn btn-primary ${productTab === 1 ? 'disabled' : ''}`}
                                   on:click={previousTab}>
                                    <i class="bx bx-left-arrow-alt me-2"></i>Back To Previous
                                </a>
                            </div>
                            <div class="next">
                                <a href={"#"} class={`btn btn-primary ${productTab === 4 ? 'disabled' : ''}`}
                                   on:click={nextTab}>
                                    Next Step<i class="bx bx-right-arrow-alt ms-2"></i>
                                </a>
                            </div>
                            <div class="last d-none">
                                <a href={"#"} class="btn btn-primary">Finish</a>
                            </div>
                        </div>
                    </div>
                </CardBody>
            </Card>
        </Col>
    </Row>
</DefaultLayout>