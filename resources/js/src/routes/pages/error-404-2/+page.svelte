<script lang="ts">
    import AuthLayout from "$lib/layouts/AuthLayout.svelte";
    import LogoBox from "$lib/components/LogoBox.svelte";
    import {Card, CardBody, Col} from "@sveltestrap/sveltestrap";
</script>

<AuthLayout>
    <Col xl="5">
        <Card class="auth-card">
            <CardBody class="px-3 py-5">
                <div class="p-4">
                    <div class="mx-auto mb-4 text-center">
                        <div class="mx-auto mb-4 text-center auth-logo">
                            <LogoBox/>
                        </div>

                        <h1 class="mt-5 mb-3 fw-bold fs-60">404</h1>
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
</AuthLayout>