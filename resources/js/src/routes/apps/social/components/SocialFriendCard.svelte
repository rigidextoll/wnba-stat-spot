<script lang="ts">
    import {Card, CardBody, Dropdown, DropdownItem, DropdownMenu, DropdownToggle} from "@sveltestrap/sveltestrap";
    import type {FriendsRequestListType} from "./types";

    export let item: FriendsRequestListType
</script>

<Card>
    <CardBody>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <img src="{item.avatar}" class="img-fluid avatar-md rounded me-2" alt="avatar-1"/>
            </div>
            <div class="flex-grow-1">
                <Dropdown class="float-end">
                    <DropdownToggle color="link" class="p-0">
                        <i class="bx bx-dots-vertical-rounded fs-18 mb-1"/>
                    </DropdownToggle>
                    <DropdownMenu>
                        <DropdownItem><i class="bx bxs-user-detail me-1"></i>See Profile</DropdownItem>
                        <DropdownItem><i class="bx bxl-telegram me-1"></i>Message to {item.name.split(' ')[0]}
                        </DropdownItem>
                        <DropdownItem><i class="bx bx-user-x me-1"></i>Unfriend {item.name.split(' ')[0]}
                        </DropdownItem>
                        <DropdownItem><i class="bx bx-block me-1"></i>Block {item.name.split(' ')[0]}
                        </DropdownItem>
                    </DropdownMenu>
                </Dropdown>
                <h5>
                    <a href={"#"} class="text-reset">{item.name}</a>
                </h5>
                <p class="mb-0">
                    {item.mutualFriends}
                </p>
            </div>
        </div>
    </CardBody>
</Card>