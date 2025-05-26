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
    import type {MemoriesType} from "./types";

    export let item: MemoriesType
</script>

<Card>
    <CardBody>
        <div class="d-flex gap-2 align-items-center mb-2">
            <div class="border border-2 border-primary rounded-circle">
                <img class="rounded-circle border border-2 border-transparent" src="{item.avatar}" height="48"
                     alt="Generic placeholder img"/>
            </div>
            <div class="flex-grow-1">
                <p class="mb-0">
                    {item.title}
                </p>
                <small class="text-muted">{item.timeStamp}</small>
            </div>

            <Dropdown class="text-muted">
                <DropdownToggle color="link" class="p-0">
                    <i class="bx bx-dots-vertical-rounded mb-1"/>
                </DropdownToggle>

                <DropdownMenu>
                    <DropdownItem class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bx bx-bell me-2"/>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0">Turn on notification</p>
                        </div>
                    </DropdownItem>
                    <DropdownItem divider/>
                    <DropdownItem class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bx bx-bookmark me-2"/>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0">Save Video</p>
                            <small class="text-muted">Add this to your save items.</small>
                        </div>
                    </DropdownItem>

                    <DropdownItem class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bx bx-link me-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0">Copy Link</p>
                        </div>
                    </DropdownItem>
                    <DropdownItem divider/>
                    <DropdownItem class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bx bx-x-circle me-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0">Hide this video</p>
                            <small class="text-muted">You won't see this video.</small>
                        </div>
                    </DropdownItem>

                    <DropdownItem class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bx bx-x-circle me-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0">Report this video</p>
                            <small class="text-muted">Tell us about a problem with this video.</small>
                        </div>
                    </DropdownItem>
                </DropdownMenu>

            </Dropdown>
        </div>

        <Row>
            <Col>
                <div class="ratio ratio-21x9 rounded overflow-hidden">
                    <iframe src="{item.link}" title="YouTube video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </Col>
        </Row>

        <div class="d-flex align-items-center mt-2">
            <a href={"#"} class="btn btn-link text-muted"><i class="bx bx-tv align-middle"></i> {item.views} Views</a>
            <a href={"#"} class="btn btn-link text-muted"><i
                    class="bx bx-comment align-middle"></i> {item.comments} Comments</a>
            <a href={"#"} class="btn btn-link text-muted"><i class="bx bx-share-alt align-middle"></i>
                Share</a>
            <a href={"#"} class="btn btn-link text-muted ms-auto"><i
                    class="bx bx-bookmark align-middle"></i> Save</a>
        </div>
    </CardBody>
</Card>