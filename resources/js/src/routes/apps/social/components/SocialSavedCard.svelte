<script lang="ts">
    import type {SavedPostType} from "./types";
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

    export let item: SavedPostType
</script>

<Card>
    <CardBody>
        <div class="d-flex gap-2 align-items-center mb-2">
            <div class="border border-2 border-primary rounded-circle">
                <img class="rounded-circle border border-2 border-transparent {item.imageContent && 'avatar-md '}"
                     src="{item.avatar}" height="48"
                     alt="Generic placeholder img"/>
            </div>

            {#if item.timestamp}
                <div class="flex-grow-1">
                    <p class="mb-0">
                        {item.title}
                    </p>
                    <small class="text-muted">{item.timestamp}</small>
                </div>
            {:else}
                <div class="flex-grow-1">
                    <h5 class="my-0">
                        {item.title}
                    </h5>
                    <p class="mb-0">
                        Post by
                        <b>{item.postBy}</b>
                    </p>
                </div>
            {/if}

            <Dropdown class="text-muted">
                <DropdownToggle color="link" class="p-0">
                    <i class="bx bx-dots-vertical-rounded mb-1"/>
                </DropdownToggle>

                <DropdownMenu>
                    <DropdownItem><i class="bx bx-share me-1"></i>Share</DropdownItem>
                    <DropdownItem><i class="bx bxl-telegram me-1"></i>Send in Message</DropdownItem>
                    <DropdownItem><i class="bx bx-images me-1"></i>View Original Post</DropdownItem>
                    <DropdownItem><i class="bx bx-link me-1"></i>Copy Link</DropdownItem>
                    <DropdownItem><i class="bx bx-bookmark-minus me-1"></i>Unsave</DropdownItem>
                </DropdownMenu>
            </Dropdown>
        </div>

        {#if item.desc}
            {#each item.desc as description}
                <p class="mb-0">{description}</p>
            {/each}
            {#each item.hashTags ?? [] as hashTag}
                <p class="text-primary mb-3">
                    #{hashTag}
                </p>
            {/each}
            <a href={"#"}>
                <img class="img-fluid rounded" src="{item.imageContent}" alt="favorite-2"/>
            </a>
        {/if}

        {#if item.imgs}
            <Row>
                {#each item.imgs as image}
                    <Col md="5">
                        <img src="{image}" class="img-fluid rounded" alt="post-2"/>
                    </Col>
                {/each}
            </Row>
        {/if}

        {#if item.textContent}
            <p class="text-justify mb-0">
                {item.textContent}
            </p>
        {/if}

        {#if item.videoContent}
            <Row>
                <Col>
                    <div class="ratio ratio-21x9 rounded overflow-hidden">
                        <iframe src="{item.videoContent}" title="YouTube video player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen="{true}"></iframe>
                    </div>
                </Col>
            </Row>
        {/if}

        <div class="d-flex align-items-center mt-2">
            <a href={"#"} class="btn btn-link text-muted"><i
                    class="bx bxs-heart align-middle text-danger"></i> {item.views} Likes</a>
            <a href={"#"} class="btn btn-link text-muted"><i
                    class="bx bx-comment align-middle"></i> {item.comments} Comments</a>
            <a href={"#"} class="btn btn-link text-muted"><i class="bx bx-share-alt align-middle"></i>
                Share</a>
            <a href={"#"} class="btn btn-link text-muted ms-auto"><i
                    class="bx bx-bookmark align-middle"></i> Save</a>
        </div>
    </CardBody>
</Card>