<script lang="ts">
    import {
        Card,
        CardBody,
        CardHeader,
        CardTitle, Dropdown, DropdownItem,
        DropdownMenu,
        DropdownToggle
    } from "@sveltestrap/sveltestrap";
    import {friendRequests} from "./data";
</script>


<Card>
    <CardHeader class="d-flex justify-content-between align-items-center">
        <CardTitle>Friends Request (10)</CardTitle>
    </CardHeader>

    <CardBody class="p-0 pb-3">
        <div data-simplebar class="p-3 pb-0" style="max-height: 400px;">
            {#each friendRequests as friend, idx}
                <div class="d-flex align-items-center {idx !== friendRequests.length - 1 ? 'mb-3' : ''}">
                    <div class="flex-shrink-0">
                        <img src={friend.avatar} class="img-fluid avatar-sm rounded me-2" alt="avatar-{idx + 1}"/>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1 fs-14">
                            <a href="#!">{friend.name}</a>
                        </h5>
                        <p class="mb-0">{friend.mutualFriends === 0 ? 'no mutual friends' : `${friend.mutualFriends} mutual friends`}</p>
                    </div>

                    <Dropdown>
                        <DropdownToggle color="link" class="text-dark p-0">
                            <i class="bx bx-dots-vertical-rounded fs-18"></i>
                        </DropdownToggle>
                        <DropdownMenu end>
                            <DropdownItem>
                                <i class="bx bxs-user-detail me-1"></i> See Profile
                            </DropdownItem>
                            <DropdownItem>
                                <i class="bx bxl-telegram me-1"></i> Message to {friend.name}
                            </DropdownItem>
                            <DropdownItem>
                                <i class="bx bx-user-x me-1"></i> Unfriend {friend.name}
                            </DropdownItem>
                            <DropdownItem>
                                <i class="bx bx-block me-1"></i> Block {friend.name}
                            </DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </div>
            {/each}
        </div>
    </CardBody>
</Card>