<script lang="ts">
    import {
        Button,
        Card,
        CardBody,
        CardTitle,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle, Tooltip
    } from "@sveltestrap/sveltestrap";
</script>
<Card>
    <CardBody>
        <Dropdown class="float-end">

            <DropdownToggle color="link" class="p-0">
                <i class="bx bx-slider-alt fs-18"/>
            </DropdownToggle>

            <DropdownMenu>
                <DropdownItem header class=" text-center fs-14">Post Filters</DropdownItem>
                <DropdownItem divider class="mt-0"/>
                <DropdownItem class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="bx bx-bookmark fs-18 align-middle me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-0">Save Link</p>
                        <small class="text-muted">Add this to your saved item</small>
                    </div>
                </DropdownItem>
                <DropdownItem class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="bx bx-bell-off fs-18 align-middle me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-0">Notification</p>
                        <small class="text-muted">Turn off notification for this post</small>
                    </div>
                </DropdownItem>
            </DropdownMenu>
        </Dropdown>

        <CardTitle class="mb-3"> Create Post</CardTitle>

        <div class="d-md-flex mb-2">
            <Dropdown class="me-1">
                <DropdownToggle color="" class="btn-outline-light text-dark">
                    Who can see your post ?
                </DropdownToggle>
                <DropdownMenu>
                    <DropdownItem><i class="bx bx-globe-alt me-1"></i>Public</DropdownItem>
                    <DropdownItem><i class="bx bx-user me-1"></i>Friends</DropdownItem>
                    <DropdownItem><i class="bx bx-user-check me-1"></i>Friends Except..</DropdownItem>
                </DropdownMenu>
            </Dropdown>

            <Dropdown class="me-1 mt-md-0">
                <DropdownToggle color="" class="btn-outline-light text-dark">
                    <i class="bx bx-plus me-1"/>Album
                </DropdownToggle>
                <DropdownMenu>
                    <DropdownItem><i class="bx bx-images me-1"></i>Untitled Album</DropdownItem>
                    <DropdownItem><i class="bx bx-images me-1"></i>My Dream</DropdownItem>
                    <DropdownItem><i class="bx bx-images me-1"></i>Tours Story</DropdownItem>
                </DropdownMenu>
            </Dropdown>
        </div>
        <div class="mb-3">
            <textarea class="form-control" id="description" rows="3" placeholder="What's on your mind?"></textarea>
        </div>
        <div class="d-flex gap-1">
            <a href={"#"} class="btn btn-outline-light text-dark btn-sm fs-16" id="tooltip1">
                <i class="bx bx-images"></i>
            </a>
            <Tooltip target="tooltip1" placement="top">
                Photo / Video
            </Tooltip>

            <a href={"#"} class="btn btn-outline-light text-dark btn-sm fs-16" id="tooltip2">
                <i class="bx bxs-user-plus"></i>
            </a>
            <Tooltip target="tooltip2" placement="top">
                Tag People
            </Tooltip>

            <a href={"#"} class="btn btn-outline-light text-dark btn-sm fs-16" id="tooltip3">
                <i class="bx bxs-smile"></i>
            </a>
            <Tooltip target="tooltip3" placement="top">
                Feeling / Activity
            </Tooltip>

            <a href={"#"} class="btn btn-outline-light text-dark btn-sm fs-16" id="tooltip4">
                <i class="bx bxs-location-plus"></i>
            </a>
            <Tooltip target="tooltip4" placement="top">
                Check In
            </Tooltip>

            <a href={"#"} class="btn btn-outline-light text-dark btn-sm fs-16" id="tooltip5">
                <i class="bx bxs-camera"></i>
            </a>
            <Tooltip target="tooltip5" placement="top">
                Camera
            </Tooltip>

            <Button type="button" color="primary" class="ms-auto"> Publish</Button>
        </div>
    </CardBody>
</Card>