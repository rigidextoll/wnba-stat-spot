<script lang="ts">
    import AuthLayout from "$lib/layouts/AuthLayout.svelte";
    import LogoBox from "$lib/components/LogoBox.svelte";
    import {Button, Card, CardBody, Col, Form, Input} from "@sveltestrap/sveltestrap";
</script>

<AuthLayout>
    <Col xl="5">
        <Card class="auth-card">
            <CardBody class="px-3 py-5">
                <div class="mx-auto mb-4 text-center auth-logo">
                    <LogoBox/>
                </div>

                <h2 class="fw-bold text-center fs-18">Hi ! Gaston</h2>
                <p class="text-muted text-center mt-1 mb-4">Enter your password to access the admin.</p>

                <div class="px-4">
                    <Form class="authentication-form">
                        <div class="mb-3">
                            <label class="form-label visually-hidden" for="example-password">Password</label>
                            <Input type="password" id="example-password" placeholder="Enter your password"/>
                        </div>

                        <div class="mb-1 text-center d-grid">
                            <Button color="primary" type="submit"> Sign In</Button>
                        </div>
                    </Form>
                </div>
            </CardBody>
        </Card>

        <p class="text-white mb-0 text-center">
            Not you? return
            <a href="/auth/sign-in-2" class="text-white fw-bold ms-1">Sign In</a>
        </p>
    </Col>
</AuthLayout>