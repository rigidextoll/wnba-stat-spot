<script lang="ts">
    import AuthLayout from "$lib/layouts/AuthLayout.svelte";
    import LogoBox from "$lib/components/LogoBox.svelte";
    import {Button, Card, CardBody, Col, Form, Input, Row} from "@sveltestrap/sveltestrap";
    import SignWithOptions from "../components/SignWithOptions.svelte";
    import type {Actions} from "@sveltejs/kit";

    const signInImg = '/images/sign-in.svg'

    export let form: Actions
</script>


<AuthLayout>
    <Col xl="12">
        <Card class="auth-card">
            <CardBody class="p-0">
                <Row class="align-items-center g-0">
                    <Col lg="6" class="d-none d-lg-inline-block border-end">
                        <div class="auth-page-sidebar">
                            <img src={signInImg} alt="auth" class="img-fluid"/>
                        </div>
                    </Col>
                    <Col lg="6">
                        <div class="p-4">
                            <div class="mx-auto mb-4 text-center auth-logo">
                                <LogoBox/>
                            </div>

                            <h2 class="fw-bold text-center fs-18">Sign In</h2>
                            <p class="text-muted text-center mt-1 mb-4">Enter your email address and password to access
                                admin panel.</p>

                            <Row class="justify-content-center">
                                <Col md="8" xs="12">
                                    <Form method="POST" action="?/login" class="authentication-form">
                                        {#if form?.invalid}
                                            <div class="mb-2 text-danger">Email and password is required.</div>
                                        {/if}
                                        {#if form?.credentials}
                                            <div class="mb-2 text-danger">You have entered wrong credentials.</div>
                                        {/if}
                                        <div class="mb-3">
                                            <label class="form-label" for="example-email">Email</label>
                                            <Input type="email" id="example-email" name="email"
                                                   placeholder="Enter your email" value="user@demo.com"/>
                                        </div>

                                        <div class="mb-3">
                                            <a href="/auth/reset-password"
                                               class="float-end text-muted text-unline-dashed ms-1"> Reset password
                                            </a>
                                            <label class="form-label" for="example-password">Password</label>
                                            <Input type="password" id="example-password" name="password"
                                                   placeholder="Enter your password" value="123456"/>
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
                                </Col>
                            </Row>
                        </div>
                    </Col>
                </Row>
            </CardBody>
        </Card>

        <p class="text-white mb-0 text-center">
            Don't have an account?
            <a href="/auth/sign-up" class="text-white fw-bold ms-1">Sign Up</a>
        </p>
    </Col>
</AuthLayout>
