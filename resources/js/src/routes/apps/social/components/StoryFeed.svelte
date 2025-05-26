<script lang="ts">
    import {
        Card,
        CardBody,
        Col,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle,
        Row
    } from "@sveltestrap/sveltestrap";

    const post1 = '/images/app-social/post-1.jpg'
    const post2 = '/images/app-social/post-2.jpg'
    const post4 = '/images/app-social/post-4.jpg'
    const post3 = '/images/app-social/post-3.jpg'

    const avatar1 = '/images/users/avatar-1.jpg'
    const avatar3 = '/images/users/avatar-3.jpg'
    const avatar4 = '/images/users/avatar-4.jpg'
    const avatar6 = '/images/users/avatar-6.jpg'
</script>

<Card>
    <CardBody>
        <div class="d-flex gap-2 align-items-center mb-2">
            <div class="border border-2 border-primary rounded-circle">
                <img class="rounded-circle border border-2 border-transparent" src="{avatar3}" height="48"
                     alt="Generic placeholder img"/>
            </div>
            <div class="flex-grow-1">
                <h5 class="m-0">
                    <a href="/pages/profile" class="text-reset">Jeremy Tomlinson</a>
                </h5>
                <p class="text-muted mb-0">
                    <small>about 2 minuts ago</small>
                </p>
            </div>

            <Dropdown class="text-muted">
                <DropdownToggle color="link" class="p-0">
                    <i class="bx bx-dots-vertical-rounded"/>
                </DropdownToggle>
                <DropdownMenu>
                    <DropdownItem><i class="bx bx-bookmark align-middle pe-1"></i>Save post</DropdownItem>
                    <DropdownItem><i class="bx bx-user-x align-middle pe-1"></i>Unfollow</DropdownItem>
                    <DropdownItem><i class="bx bx-x-circle align-middle pe-1"></i>Hide post</DropdownItem>
                    <DropdownItem><i class="bx bx-block align-middle pe-1"></i>Block</DropdownItem>
                    <DropdownItem divider/>
                    <DropdownItem><i class="bx bx-flag align-middle fa-fw pe-1"></i>Report post</DropdownItem>
                </DropdownMenu>
            </Dropdown>
        </div>
        <p>Story based around the idea of time lapse, animation to post soon!</p>

        <Row>
            <Col md="6">
                <img src="{post1}" class="img-fluid rounded" alt="post-1"/>
            </Col>
            <Col md="6">
                <Row>
                    <Col>
                        <div class="mb-3 mt-3 mt-md-0">
                            <img src="{post2}" class="img-fluid rounded" alt="post-2"/>
                        </div>
                    </Col>
                </Row>
                <Row>
                    <Col md="6">
                        <img src="{post4}" class="img-fluid rounded" alt="post-4"/>
                    </Col>
                    <Col md="6" class="mt-3 mt-md-0">
                        <div class="position-relative overflow-hidden rounded">
                            <a href={"#"}>
                                <img src="{post3}" class="img-fluid rounded" alt="post-3"/>
                                <div class="bg-overlay bg-dark"></div>
                                <h3 class="position-absolute top-50 start-50 translate-middle my-0 text-white">+7</h3>
                            </a>
                        </div>
                    </Col>
                </Row>
            </Col>
        </Row>

        <div class="d-flex align-items-center my-2">
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bxs-heart align-middle text-danger"></i>
                1.5k Likes
            </a>
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bx-comment align-middle"></i>
                521 Comments
            </a>
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bx-share-alt align-middle"></i>
                Share
            </a>
            <a href={"#"} class="btn btn-link text-muted ms-auto">
                <i class="bx bx-bookmark align-middle"></i>
                Save
            </a>
        </div>

        <div class="d-flex align-items-start">
            <img src="{avatar1}" height="32" class="align-self-start rounded me-2" alt="Arya Stark"/>
            <div class="w-100">
                <input type="text" class="form-control bg-light border-0 form-control-sm"
                       placeholder="Write a comment"/>
            </div>
        </div>
    </CardBody>
</Card>

<Card>
    <CardBody>
        <div class="d-flex gap-2 align-items-center mb-2">
            <div class="border border-2 border-primary rounded-circle">
                <img class="rounded-circle border border-2 border-transparent" src="{avatar4}" height="48"
                     alt="Generic placeholder img"/>
            </div>
            <div class="flex-grow-1">
                <h5 class="m-0">
                    <a href="/pages/profile" class="text-reset">Thelma Fridley</a>
                </h5>
                <p class="text-muted mb-0">
                    <small>about 1 hour ago</small>
                </p>
            </div>

            <Dropdown class="text-muted">
                <DropdownToggle color="link" class="p-0">
                    <i class="bx bx-dots-vertical-rounded mb-2"/>
                </DropdownToggle>
                <DropdownMenu>
                    <DropdownItem><i class="bx bx-bookmark align-middle pe-1"></i>Save post</DropdownItem>
                    <DropdownItem><i class="bx bx-user-x align-middle pe-1"></i>Unfollow</DropdownItem>
                    <DropdownItem><i class="bx bx-x-circle align-middle pe-1"></i>Hide post</DropdownItem>
                    <DropdownItem><i class="bx bx-block align-middle pe-1"></i>Block</DropdownItem>
                    <DropdownItem divider/>
                    <DropdownItem><i class="bx bx-flag align-middle fa-fw pe-1"></i>Report post</DropdownItem>
                </DropdownMenu>
            </Dropdown>
        </div>

        <div class="fs-16 text-center fst-italic text-dark">🌟✨ Just spent the most amazing weekend camping in the
            wilderness! 🏕️🌲 Nothing beats disconnecting from the hustle and bustle of city life and reconnecting with
            nature.
        </div>

        <div class="d-flex align-items-center my-2">
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bxs-heart align-middle text-danger"></i>
                1.5k Likes
            </a>
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bx-comment align-middle"></i>
                521 Comments
            </a>
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bx-share-alt align-middle"></i>
                Share
            </a>
            <a href={"#"} class="btn btn-link text-muted ms-auto"
            ><i class="bx bx-bookmark align-middle"></i>
                Save
            </a>
        </div>

        <div class="post-user-comment-box mt-2">
            <div class="d-flex align-items-start">
                <img class="me-2 avatar-sm rounded-circle" src="{avatar3}" alt="Generic placeholder img"/>
                <div class="w-100">
                    <div class="w-100 bg-light p-2 rounded">
                        <h5 class="mt-0">
                            <a href="/pages/profile" class="text-reset">Jeremy Tomlinson
                            </a>
                            <small class="text-muted"> 3 hours ago</small>
                        </h5>
                        Nice work, makes me think of The Money Pit.
                    </div>
                    <div class="d-flex gap-2">
                        <a href={"#"} class="text-muted fs-13 d-inline-block mt-2">
                            <i class="bx bxs-heart align-middle"></i>
                            Like(2)
                        </a>
                        <a href={"#"} class="text-muted fs-13 d-inline-block mt-2">
                            <i class="bx bx-share align-middle"></i>
                            Reply
                        </a>
                    </div>

                    <div class="d-flex align-items-start mt-3">
                        <a class="pe-2" href={"#"}>
                            <img src="{avatar4}" class="avatar-sm rounded-circle" alt="Generic placeholder img"/>
                        </a>
                        <div class="w-100 bg-light p-2 rounded">
                            <h5 class="mt-0">
                                <a href="/pages/profile" class="text-reset">Kathleen Thomas
                                </a>
                                <small class="text-muted"> 5 hours ago</small>
                            </h5>
                            i'm in the middle of a timelapse animation myself! (Very different though.) Awesome stuff.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CardBody>
</Card>

<Card>
    <CardBody>
        <div class="d-flex gap-2 align-items-center mb-2">
            <div class="border border-2 border-primary rounded-circle">
                <img class="rounded-circle border border-2 border-transparent" src="{avatar6}" height="48"
                     alt="Generic placeholder img"/>
            </div>
            <div class="flex-grow-1">
                <h5 class="m-0">
                    <a href="/pages/profile" class="text-reset">Jonathan Tiner</a>
                </h5>
                <p class="text-muted mb-0">
                    <small>about 11 hour ago</small>
                </p>
            </div>

            <Dropdown class="text-muted">
                <DropdownToggle color="link" class="p-0">
                    <i class="bx bx-dots-vertical-rounded mb-2"/>
                </DropdownToggle>
                <DropdownMenu>
                    <DropdownItem><i class="bx bx-bookmark align-middle pe-1"></i>Save post</DropdownItem>
                    <DropdownItem><i class="bx bx-user-x align-middle pe-1"></i>Unfollow</DropdownItem>
                    <DropdownItem><i class="bx bx-x-circle align-middle pe-1"></i>Hide post</DropdownItem>
                    <DropdownItem><i class="bx bx-block align-middle pe-1"></i>Block</DropdownItem>
                    <DropdownItem divider/>
                    <DropdownItem><i class="bx bx-flag align-middle fa-fw pe-1"></i>Report post</DropdownItem>
                </DropdownMenu>
            </Dropdown>
        </div>

        <p>The parallax is a little odd but O.o that house build is awesome!!</p>

        <Row>
            <Col>
                <div class="ratio ratio-16x9 rounded overflow-hidden">
                    <iframe src="https://player.vimeo.com/video/87993762" class="img-fluid border-0" title=""></iframe>
                </div>
            </Col>
        </Row>

        <div class="d-flex align-items-center mt-2">
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bx-tv align-middle"></i>
                3.5k Views
            </a>
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bx-comment align-middle"></i>
                521 Comments
            </a>
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bx-share-alt align-middle"></i>
                Share
            </a>
            <a href={"#"} class="btn btn-link text-muted ms-auto">
                <i class="bx bx-bookmark align-middle"></i>
                Save
            </a>
        </div>
    </CardBody>
</Card>