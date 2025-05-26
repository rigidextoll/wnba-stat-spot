<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import {
        Button,
        Card,
        CardBody,
        CardHeader,
        Col,
        Dropdown, DropdownItem, DropdownMenu,
        DropdownToggle,
        Form,
        Input,
        Row, Tooltip
    } from "@sveltestrap/sveltestrap";
    import Icon from "@iconify/svelte";
</script>

<DefaultLayout>
    <Row class="justify-content-center text-center mt-4">
        <Col lg="6">
            <h3 class="fw-semibold">Contact Us with Our Team</h3>
            <p>Got any questions about the product or scaling on our platform? We're here to help. Chat to our friendly
                team 24/7 and get onboard in less than 5 minutes.</p>
        </Col>
    </Row>

    <Row class="justify-content-center mt-4">
        <Col lg="12">
            <Card>
                <CardBody>
                    <Row>
                        <Col xxl="6">
                            <Card class="mb-0 shadow-none border-0">
                                <CardHeader class="bg-light-subtle border-0">
                                    <h4 class="mb-0">Ask your different questions</h4>
                                </CardHeader>
                                <CardBody>
                                    <Form class="authentication-form">
                                        <Row class="mb-3">
                                            <Col lg="6">
                                                <label class="form-label" for="example-name">First Name</label>
                                                <Input type="text" id="example-name" placeholder="First name"/>
                                            </Col>
                                            <Col lg="6">
                                                <label class="form-label" for="last-name">Last Name</label>
                                                <Input type="text" id="last-name" placeholder="Last name"/>
                                            </Col>
                                        </Row>
                                        <div class="mb-3">
                                            <label class="form-label" for="example-email">Email</label>
                                            <Input type="email" id="example-email" placeholder="Enter your email"/>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="contactnumber">Contact Number</label>
                                            <Dropdown class="form-group input-group">
                                                <DropdownToggle caret color="light">U.S.A</DropdownToggle>
                                                <DropdownMenu>
                                                    <DropdownItem href="#"> U.S.A</DropdownItem>
                                                    <DropdownItem href="#"> India</DropdownItem>
                                                    <DropdownItem href="#"> Iraq</DropdownItem>
                                                    <DropdownItem href="#"> South Africa</DropdownItem>
                                                    <DropdownItem href="#"> France</DropdownItem>
                                                </DropdownMenu>
                                                <Input type="tel" class="form-control" id="contactnumber"
                                                       placeholder="+0(222)000-0000" required/>
                                            </Dropdown>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="exampleFormControlTextarea1">Message</label>
                                            <Input type="textarea" id="exampleFormControlTextarea1" rows={5}
                                                   placeholder="Max 150 words"/>
                                        </div>
                                        <div class="mb-3">
                                            <h5 class="my-3">Services</h5>
                                            <Row>
                                                <Col xxl="6">
                                                    <div class="mb-2">
                                                        <Input type="checkbox" label="Website Design"/>
                                                    </div>
                                                    <div class="mb-2">
                                                        <Input type="checkbox" label="UX Design"/>
                                                    </div>
                                                    <div class="mb-2">
                                                        <Input type="checkbox" label="User Research"/>
                                                    </div>
                                                </Col>
                                                <Col xxl="6">
                                                    <div class="mb-2">
                                                        <Input type="checkbox" label="Content Creation"/>
                                                    </div>
                                                    <div class="mb-2">
                                                        <Input type="checkbox" label="Strategy & Consulting"/>
                                                    </div>
                                                    <div class="mb-2">
                                                        <Input type="checkbox" label="Other"/>
                                                    </div>
                                                </Col>
                                            </Row>
                                        </div>
                                        <div class="text-center d-grid">
                                            <Button color="primary" type="submit"> Send Message</Button>
                                        </div>
                                    </Form>
                                </CardBody>
                            </Card>
                        </Col>

                        <Col xxl="6">
                            <div class="mapouter">
                                <div class="gmap_canvas">
                                    <iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no"
                                            marginheight="0" marginwidth="0" title=""
                                            src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=University of Oxford&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                                    <a href="https://strandsgame.net/">Strands</a>
                                </div>
                            </div>
                            <div class="my-4">
                                <h4 class="fw-medium">Do you need quick help with some general inquiries ?</h4>
                                <p>You can use any of the support systems below if your query is urgent, We will be
                                    happy to be of help.</p>
                                <Row class="g-4">
                                    <Col xl="6">
                                        <div class="d-flex p-1">
                                            <div class="avatar-md">
                          <span class="avatar-title bg-light text-dark fs-24 rounded-circle">
                            <Icon icon="iconamoon:location-pin-duotone"></Icon>
                          </span>
                                            </div>
                                            <div class="d-block align-self-center text-truncate ms-2">
                                                <h5 class="fw-medium fs-14 text-uppercase">Office Address</h5>
                                                <span>660 Courtright Bismarck, ND</span>
                                            </div>
                                        </div>
                                    </Col>
                                    <Col xl="6">
                                        <div class="d-flex p-1">
                                            <div class="avatar-md">
                          <span class="avatar-title bg-light text-dark fs-24 rounded-circle">
                            <Icon icon="iconamoon:phone-duotone"></Icon>
                          </span>
                                            </div>
                                            <div class="d-block align-self-center text-truncate ms-2">
                                                <h5 class="fw-medium fs-14 text-uppercase">Telephone number</h5>
                                                <span>1-888-452-1505</span>
                                            </div>
                                        </div>
                                    </Col>
                                    <Col xl="6">
                                        <div class="d-flex p-1">
                                            <div class="avatar-md">
                          <span class="avatar-title bg-light text-dark fs-24 rounded-circle">
                            <Icon icon="iconamoon:email-duotone"></Icon>
                          </span>
                                            </div>
                                            <div class="d-block align-self-center text-truncate ms-2">
                                                <h5 class="fw-medium fs-14 text-uppercase">Email Address</h5>
                                                <span>rachelmtrojano@armyspy.com</span>
                                            </div>
                                        </div>
                                    </Col>
                                    <Col xl="6">
                                        <div class="d-flex p-1">
                                            <div class="avatar-md">
                          <span class="avatar-title bg-light text-dark fs-24 rounded-circle">
                            <Icon icon="iconamoon:link-external-duotone"></Icon>
                          </span>
                                            </div>
                                            <div class="d-block align-self-center text-truncate ms-2">
                                                <h5 class="fw-medium fs-14 text-uppercase">Social Contact</h5>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <a href="#!"
                                                       class="btn fs-20 d-inline-flex align-items-center justify-content-center text-primary p-0"
                                                       id="tooltip1">
                                                        <i class="bx bxl-facebook"></i>
                                                        <Tooltip class="primary-tooltip" target="tooltip1"
                                                                 placement="bottom">
                                                            Facebook
                                                        </Tooltip>
                                                    </a>
                                                    <a href="#!"
                                                       class="btn fs-20 d-inline-flex align-items-center justify-content-center text-danger p-0"
                                                       id="tooltip2">
                                                        <i class="bx bxl-instagram-alt"></i>
                                                        <Tooltip class="danger-tooltip" target="tooltip2"
                                                                 placement="bottom">
                                                            Instagram
                                                        </Tooltip>
                                                    </a>
                                                    <a href="#!"
                                                       class="btn fs-20 d-inline-flex align-items-center justify-content-center text-info p-0"
                                                       id="tooltip3">
                                                        <i class="bx bxl-twitter"></i>
                                                        <Tooltip class="info-tooltip" target="tooltip3"
                                                                 placement="bottom">
                                                            Twitter
                                                        </Tooltip>
                                                    </a>
                                                    <a href="#!"
                                                       class="btn fs-20 d-inline-flex align-items-center justify-content-center text-primary p-0"
                                                       id="tooltip4">
                                                        <i class="bx bxl-linkedin"></i>
                                                        <Tooltip class="primary-tooltip" target="tooltip4"
                                                                 placement="bottom">
                                                            Linkedin
                                                        </Tooltip>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </Col>
                                </Row>
                            </div>
                        </Col>
                    </Row>
                </CardBody>
            </Card>
        </Col>
    </Row>
</DefaultLayout>