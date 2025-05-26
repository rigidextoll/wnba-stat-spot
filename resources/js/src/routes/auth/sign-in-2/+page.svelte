<script lang="ts">
    import AuthLayout from "$lib/layouts/AuthLayout.svelte";
    import LogoBox from "$lib/components/LogoBox.svelte";
    import {Button, Card, CardBody, Col, Form, Input} from "@sveltestrap/sveltestrap";
    import SignWithOptions from "../components/SignWithOptions.svelte";
</script>

<AuthLayout>
    <Col xl="5">
        <Card class="auth-card">
            <CardBody class="px-3 py-5">
                <div class="mx-auto mb-4 text-center auth-logo">
                    <LogoBox/>
                </div>

                <h2 class="fw-bold text-center fs-18">Sign In</h2>
                <p class="text-muted text-center mt-1 mb-4">Enter your email address and password to access admin
                    panel.</p>

                <div class="px-4">
                    <Form class="authentication-form">
                        <div class="mb-3">
                            <label class="form-label" for="example-email">Email</label>
                            <Input type="email" id="example-email" placeholder="Enter your email"/>
                        </div>

                        <div class="mb-3">
                            <a href="/auth/reset-password-2" class="float-end text-muted text-unline-dashed ms-1">Reset
                                password</a>
                            <label class="form-label" for="example-password">Password</label>
                            <Input type="password" id="example-password" placeholder="Enter your password"/>
                        </div>

                        <div class="mb-3">
                            <Input type="checkbox" label="Remember me"/>
                        </div>

                        <div class="mb-1 text-center d-grid">
                            <Button color="primary" type="submit"> Sign In</Button>
                        </div>
                    </Form>

                    <p class="mt-3 fw-semibold no-span">OR sign with</p>

                    <SignWithOptions/>
                </div>
            </CardBody>
        </Card>

        <p class="text-white mb-0 text-center">
            Don't have an account?
            <a href="/auth/sign-up-2" class="text-white fw-bold ms-1">Sign Up</a>
        </p>
    </Col>
</AuthLayout>
