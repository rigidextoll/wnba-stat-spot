<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Pagination, PaginationItem, PaginationLink, Row} from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'default-buttons',
            title: 'Default Buttons'
        },
        {
            id: 'rounded-pagination',
            title: 'Rounded Pagination'
        },
        {
            id: 'theme',
            title: 'Theme'
        },
        {
            id: 'sizing',
            title: 'Sizing'
        }
    ]
</script>


<DefaultLayout>
    <PageBreadcrumb title="Pagination" subTitle="Base UI"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="Default Buttons" id="default-buttons">

                <Pagination class="mb-3">
                    <PaginationItem>
                        <PaginationLink previous>Previous</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>1</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>2</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>3</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink next>Next</PaginationLink>
                    </PaginationItem>
                </Pagination>

                <Pagination>
                    <PaginationItem>
                        <PaginationLink previous><span aria-hidden="true">&laquo;</span></PaginationLink>
                    </PaginationItem>
                    <PaginationItem active>
                        <PaginationLink>1</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>2</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>3</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink next><span aria-hidden="true">&raquo;</span>
                        </PaginationLink>
                    </PaginationItem>
                </Pagination>

            </UIComponentCard>

            <UIComponentCard title="Rounded Pagination" id="rounded-pagination">

                <Pagination class="pagination-rounded mb-3">
                    <PaginationItem>
                        <PaginationLink previous>Previous</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>1</PaginationLink>
                    </PaginationItem>
                    <PaginationItem active>
                        <PaginationLink>2</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>3</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink next>Next</PaginationLink>
                    </PaginationItem>
                </Pagination>

                <Pagination class="pagination-rounded mb-0">
                    <PaginationItem>
                        <PaginationLink previous><span aria-hidden="true">&laquo;</span>
                        </PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>1</PaginationLink>
                    </PaginationItem>
                    <PaginationItem active>
                        <PaginationLink>2</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>3</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink next><span aria-hidden="true">&raquo;</span></PaginationLink>
                    </PaginationItem>
                </Pagination>

            </UIComponentCard>

            <UIComponentCard title="Theme" id="theme">

                <Pagination theme="dark" class="justify-content-center mb-3">
                    <PaginationItem>
                        <PaginationLink previous>Previous</PaginationLink>
                    </PaginationItem>
                    <PaginationItem active>
                        <PaginationLink>1</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>2</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>3</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink next>Next</PaginationLink>
                    </PaginationItem>
                </Pagination>

                <Pagination theme="light" class="justify-content-end mb-0">
                    <PaginationItem>
                        <PaginationLink previous>Previous</PaginationLink>
                    </PaginationItem>
                    <PaginationItem active>
                        <PaginationLink>1</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>2</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>3</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink next>Next</PaginationLink>
                    </PaginationItem>
                </Pagination>

            </UIComponentCard>

            <UIComponentCard title="Sizing" id="sizing">

                <Pagination size="lg" class="mb-3">
                    <PaginationItem active>
                        <PaginationLink>1</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>2</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>3</PaginationLink>
                    </PaginationItem>
                </Pagination>

                <Pagination class="mb-3">
                    <PaginationItem active>
                        <PaginationLink>1</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>2</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>3</PaginationLink>
                    </PaginationItem>
                </Pagination>

                <Pagination size="sm" class="mb-0">
                    <PaginationItem active>
                        <PaginationLink>1</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>2</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink>3</PaginationLink>
                    </PaginationItem>
                </Pagination>

            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>