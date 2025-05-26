<script lang="ts">
    import {
        Badge, Button,
        Card,
        CardBody, CardFooter, CardTitle,
        Col,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle,
        Row
    } from "@sveltestrap/sveltestrap";
    import Icon from "@iconify/svelte";

    const img6 = '/images/small/img-6.jpg'
    const avatar1 = '/images/users/avatar-1.jpg'
</script>

<Card>
    <div class="position-relative">
        <img src={img6} alt="" class="card-img rounded-bottom-0" height="200"/>
        <img src={avatar1} alt=""
             class="avatar-lg rounded-circle position-absolute top-100 start-0 translate-middle-y ms-3 border border-light border-3"/>
    </div>
    <CardBody class="mt-4">
        <div class="">
            <div class="d-flex align-items-center">
                <div class="d-block">
                    <h4 class="mb-1">Jeannette C. Mullin</h4>
                    <p class="fs-14 mb-0">Front End Developer</p>
                </div>
                <div class="ms-auto">
                    <Dropdown size="sm">
                        <DropdownToggle color="link" class="text-dark p-0">
                            <i class="bx bx-dots-vertical-rounded fs-18 text-dark mb-1"/>
                        </DropdownToggle>

                        <DropdownMenu>
                            <DropdownItem><i class="bx bx-edit-alt me-2"/>Edit Profile</DropdownItem>
                            <DropdownItem><i class="bx bx-export me-2"/>Export Profile</DropdownItem>
                            <DropdownItem><i class="bx bxs-hand-up me-2"/>Action</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </div>
            </div>
            <Row class="mt-3">
                <Col>
                    <CardTitle
                            class="badge bg-light text-secondary py-1 px-2 fs-13 mb-3 border-start border-secondary border-2 rounded-1">
                        About Me
                    </CardTitle>
                    <p class="fs-15 mb-0 text-muted">Hi I'm Jeannette Mullin. I am user experience and user interface
                        designer. I have been working on Full Stack Developer since last 10 years.</p>
                    <div class="mt-3">
                        <div class="d-flex gap-2 flex-wrap">
                            <Badge color="" class="text-secondary py-1 px-2 fs-12 border rounded-1">Code
                            </Badge>
                            <Badge color="" class="text-secondary py-1 px-2 fs-12 border rounded-1">UX
                                Researcher
                            </Badge>
                            <Badge color="" class="text-secondary py-1 px-2 fs-12 border rounded-1">Python
                            </Badge>
                            <Badge color="" class="text-secondary py-1 px-2 fs-12 border rounded-1">HTML
                            </Badge>
                            <Badge color="" class="text-secondary py-1 px-2 fs-12 border rounded-1">
                                JavaScript
                            </Badge>
                            <Badge color="" class="text-secondary py-1 px-2 fs-12 border rounded-1">WordPress
                            </Badge>
                            <Badge color="" class="text-secondary py-1 px-2 fs-12 border rounded-1">App
                                Development
                            </Badge>
                            <Badge color="" class="text-secondary py-1 px-2 fs-12 border rounded-1">SQL
                            </Badge>
                            <Badge color="" class="text-secondary py-1 px-2 fs-12 border rounded-1">MongoDB
                            </Badge>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5 class="text-dark fw-medium">Links :</h5>
                        <a href={"#"}
                           class="text-primary text-decoration-underline">https://myworkbench-portfolio.com</a>
                        <p class="mb-0 mt-1">
                            <a href={"#"} class="text-primary text-decoration-underline">https://scaly-paddock.biz//a.portfolio </a>
                        </p>
                    </div>
                </Col>
            </Row>
        </div>
    </CardBody>
    <CardFooter class="bg-light-subtle">
        <Row class="g-2 mb-1">
            <Col lg="4">
                <Button color="primary" class="d-flex align-items-center justify-content-center gap-1 w-100">
                    <Icon icon="iconamoon:profile-duotone"></Icon>
                    Follow
                </Button>
            </Col>
            <Col lg="4">
                <Button color="success" class="d-flex align-items-center justify-content-center gap-1 w-100">
                    <Icon icon="iconamoon:comment-dots-duotone"></Icon>
                    Message
                </Button>
            </Col>
            <Col lg="4">
                <Button color="danger" class="d-flex align-items-center justify-content-center gap-1 w-100">
                    <Icon icon="iconamoon:share-1-duotone"></Icon>
                    Share
                </Button>
            </Col>
        </Row>
    </CardFooter>
</Card>