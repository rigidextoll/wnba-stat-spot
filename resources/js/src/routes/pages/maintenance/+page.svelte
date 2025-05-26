<script lang="ts">
    import AuthLayout from "$lib/layouts/AuthLayout.svelte";
    import LogoBox from "$lib/components/LogoBox.svelte";
    import {Card, CardBody, Col, Row} from "@sveltestrap/sveltestrap";

    const signIn = '/images/sign-in.svg'
</script>

<AuthLayout>
    <Col xl="12">
        <Card class="auth-card">
            <CardBody class="p-0">
                <Row class="align-items-center g-0">
                    <Col lg="6" class="d-none d-lg-inline-block border-end">
                        <div class="auth-page-sidebar">
                            <img src={signIn} alt="auth" class="img-fluid"/>
                        </div>
                    </Col>
                    <Col lg="6">
                        <div class="p-4">
                            <div class="mx-auto mb-4 text-center auth-logo">
                                <LogoBox/>
                            </div>
                            <h2 class="fw-bold text-center lh-base">We are currently performing maintenance</h2>
                            <p class="text-muted text-center mt-1 mb-4">We're making the system more awesome. We'll be
                                back shortly.</p>

                            <div class="text-center">
                                <a href="/pages/contact-us" class="btn btn-success">Contact Us</a>
                            </div>
                        </div>
                    </Col>
                </Row>
            </CardBody>
        </Card>
    </Col>
</AuthLayout>