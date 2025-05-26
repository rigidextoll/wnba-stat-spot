<script lang="ts">
    import {
        Card,
        CardBody,
        CardTitle,
        Dropdown, DropdownItem,
        DropdownMenu,
        DropdownToggle,
        Form,
        Input
    } from "@sveltestrap/sveltestrap";
    import {friendsRequestList} from "./data";

    const avatar2 = '/images/users/avatar-2.jpg'
    const avatar3 = '/images/users/avatar-3.jpg'
</script>

<Card class="card h-100" data-simplebar>
    <CardBody>
        <CardTitle class="mb-3"> Friends</CardTitle>

        <Form class="chat-search">
            <div class="chat-search-box">
                <Input type="text" name="search" id="search" placeholder="Search ..."/>
                <i class="bx bx-search-alt search-icon"></i>
            </div>
        </Form>

        <h5 class="mb-3">Pending Request (2)</h5>

        <div class="d-flex position-relative mb-3">
            <div class="flex-shrink-0">
                <img src="{avatar2}" class="img-fluid avatar-sm rounded me-2" alt="avatar-2"/>
            </div>
            <div class="flex-grow-1 text-truncate">
                <p class="mb-0">
                    <a href={"#"} class="text-dark stretched-link"><b>Daniel J. Olsen</b> sent you a request</a>
                </p>
                <small>46 mutual friends</small><br/>
            </div>
        </div>

        <hr class="mb-3"/>

        <div class="d-flex position-relative">
            <div class="flex-shrink-0">
                <img src="{avatar3}" class="img-fluid avatar-sm rounded me-2" alt="avatar-3"/>
            </div>
            <div class="flex-grow-1 text-truncate">
                <p class="mb-0">
                    <a href={"#"} class="text-dark stretched-link"><b>Jack P. Roldan</b> sent you a request</a>
                </p>
                <small>23 mutual friends</small><br/>
            </div>
        </div>
    </CardBody>
    <CardBody class="border-top">
        <CardTitle class="mb-3"> Friends Request</CardTitle>

        {#each friendsRequestList as item,idx}
            <div class="d-flex align-items-center {!(friendsRequestList.length - 1 === idx) && 'mb-3'}">
                <div class="flex-shrink-0">
                    <img src="{item.avatar}" class="img-fluid avatar-sm rounded me-2" alt="avatar-5"/>
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
                    <h5 class="mb-1 fs-14">
                        <a href={"#"}>{item.name}</a>
                    </h5>
                    <p class="mb-0">
                        {item.mutualFriends}
                    </p>
                </div>
            </div>
        {/each}
    </CardBody>
</Card>