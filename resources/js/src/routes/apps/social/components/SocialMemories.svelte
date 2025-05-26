<script lang="ts">
    import {
        Card,
        CardBody, CardTitle,
        Col,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle,
        Row
    } from "@sveltestrap/sveltestrap";
    import SocialMemoryCard from "./SocialMemoryCard.svelte";
    import {memoriesData} from "./data";

    const avatar1 = '/images/users/avatar-1.jpg'
    const avatar3 = '/images/users/avatar-3.jpg'

    const post1 = '/images/app-social/post-1.jpg'
    const post2 = '/images/app-social/post-2.jpg'
    const post3 = '/images/app-social/post-3.jpg'
    const post4 = '/images/app-social/post-4.jpg'
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
                    <i class="bx bx-dots-vertical-rounded mb-1"/>
                </DropdownToggle>

                <DropdownMenu>
                    <DropdownItem><i class="bx bx-bookmark align-middle pe-1"/>Save post</DropdownItem>
                    <DropdownItem><i class="bx bx-user-x align-middle pe-1"/>Unfollow</DropdownItem>
                    <DropdownItem><i class="bx bx-x-circle align-middle pe-1"/>Hide post</DropdownItem>
                    <DropdownItem><i class="bx bx-block align-middle pe-1"/>Block</DropdownItem>
                    <DropdownItem divider/>
                    <DropdownItem><i class="bx bx-flag align-middle fa-fw pe-1"/>Report post</DropdownItem>
                </DropdownMenu>
            </Dropdown>
        </div>
        <p>Story based around the idea of time lapse, animation to post soon!</p>

        <div class="bg-soft-primary p-1 rounded text-center mb-3">
            <h5 class="text-primary ms-2">2 years ago</h5>
            <a href={"#"} class="ms-2 text-primary"> See all your memories<i
                    class="bi bi-chevron-right ms-1"></i> </a>
        </div>

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
                <img class="rounded-circle border border-2 border-transparent" src="{avatar3}" height="48"
                     alt="Generic placeholder img"/>
            </div>
            <div class="flex-grow-1">
                <h5 class="my-0">
                    <b class="text-primary">Martin R. Peters</b>
                </h5>
                <small class="mb-0">Post: 07 Feb, 2021 06:00AM</small>
            </div>

            <Dropdown class="text-muted">
                <DropdownToggle color="link" class="p-0">
                    <i class="bx bx-dots-vertical-rounded mb-1"/>
                </DropdownToggle>

                <DropdownMenu>
                    <DropdownItem><i class="bx bx-bookmark align-middle pe-1"/>Save post</DropdownItem>
                    <DropdownItem><i class="bx bx-user-x align-middle pe-1"/>Unfollow</DropdownItem>
                    <DropdownItem><i class="bx bx-x-circle align-middle pe-1"/>Hide post</DropdownItem>
                    <DropdownItem><i class="bx bx-block align-middle pe-1"/>Block</DropdownItem>
                    <DropdownItem divider/>
                    <DropdownItem><i class="bx bx-flag align-middle fa-fw pe-1"/>Report post</DropdownItem>
                </DropdownMenu>
            </Dropdown>

        </div>

        <div class="bg-soft-primary p-1 rounded text-center mb-3">
            <h5 class="text-primary ms-2">2 years ago</h5>
            <a href={"#"} class="ms-2 text-primary">
                See all your memories
                <i class="bi bi-chevron-right ms-1"></i>
            </a>
        </div>

        <Row>
            <Col>
                <p class="text-justify">The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog.
                    Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs.</p>
                <Row class="g-0 align-items-center">
                    <Col md="5">
                        <img src="{post3}" class="card-img" alt="..."/>
                    </Col>
                    <Col md="7">
                        <CardBody>
                            <CardTitle class="fs-16"> DJs flock</CardTitle>
                            <p class="card-text text-muted">One morning, when Gregor Samsa woke from troubled dreams, he
                                found himself transformed in his bed into a horrible vermin. He lay on his armour-like
                                back, and if he lifted his head.</p>
                        </CardBody>
                    </Col>
                </Row>
            </Col>
        </Row>

        <div class="d-flex align-items-center my-2">
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bxs-heart align-middle text-danger"></i>
                2.6k Likes
            </a>
            <a href={"#"} class="btn btn-link text-muted">
                <i class="bx bx-comment align-middle"></i>
                412 Comments
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


{#each memoriesData as item}
    <SocialMemoryCard item="{item}"/>
{/each}
