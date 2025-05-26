<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Card, CardBody, Col, Row} from "@sveltestrap/sveltestrap";
</script>

<DefaultLayout>
    <PageBreadcrumb title="404" subTitle="Pages"/>
    <Row class="justify-content-center">
        <Col xl="5">
            <Card>
                <CardBody class="px-3 py-5">
                    <div class="p-4">
                        <div class="mx-auto mb-4 text-center">
                            <h1 class="mb-3 fw-bold fs-60">404</h1>
                            <h2 class="fs-22 lh-base">Page Not Found !</h2>
                            <p class="text-muted mt-1 mb-4">
                                The page you're trying to reach seems to have gone <br/>
                                missing in the digital wilderness.
                            </p>

                            <div class="text-center">
                                <a href="/" class="btn btn-success">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </CardBody>
            </Card>
        </Col>
    </Row>
</DefaultLayout>