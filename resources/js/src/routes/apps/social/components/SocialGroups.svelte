<script lang="ts">
    import {
        Button,
        Card,
        CardBody,
        CardTitle,
        Col,
        Dropdown, DropdownItem, DropdownMenu,
        DropdownToggle,
        Form,
        Input,
        Row
    } from "@sveltestrap/sveltestrap";
    import {friendsGroup, groupList, joinedGroup, suggestedGroup} from "./data";
    import SocialGroupsCard from "./SocialGroupsCard.svelte";
</script>

<Card>
    <CardBody class="px-0">
        <div class="px-3 mb-3">
            <Dropdown class="float-end">
                <DropdownToggle color="link" class="p-0">
                    <i class="bx bx-cog fs-18 mb-1"/>
                </DropdownToggle>

                <DropdownMenu>
                    <DropdownItem header class="fs-14 fw-medium"> Notification Setting</DropdownItem>

                    <DropdownItem class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bx bx-notification me-2"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="form-check form-switch mb-0 float-end">
                                <input class="form-check-input" type="checkbox" role="switch" id="notification"
                                       checked/>
                            </div>
                            <p class="mb-0">Show Notification Dots</p>
                        </div>
                    </DropdownItem>
                    <DropdownItem divider/>
                    <DropdownItem header class="fs-14 fw-medium"> Manage Groups</DropdownItem>

                    <DropdownItem class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bx bx-pin me-2 fs-18"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0">Pins</p>
                            <small class="text-muted">Pins your favorite groups for quick access.</small>
                        </div>
                    </DropdownItem>

                    <DropdownItem class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bx bx-user-plus me-2 fs-18"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0">Following</p>
                            <small class="text-muted">Follow or unfollow groups to control what you see in
                                Newsfeed</small>
                        </div>
                    </DropdownItem>
                </DropdownMenu>
            </Dropdown>
            <CardTitle> Groups</CardTitle>
        </div>

        <Form class="chat-search px-3">
            <div class="chat-search-box">
                <Input type="text" name="search" id="search" placeholder="Search ..."/>
                <i class="bx bx-search-alt search-icon"></i>
            </div>
        </Form>
        <h5 class="px-3 mb-3">Groups you have joined</h5>
        <div class="px-3 mb-2" data-simplebar style="max-height: 215px">
            {#each joinedGroup as item}
                <div class="d-flex align-items-center position-relative mb-3">
                    <div class="flex-shrink-0">
                        <img src="{item.image}" class="img-fluid avatar-md rounded-circle me-2" alt="group-6"/>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mb-0 fw-medium">
                            <a href={"#"} class="stretched-link">{item.title}</a>
                        </p>
                        <small>{item.member}</small
                        ><br/>
                    </div>
                </div>
            {/each}
        </div>
        <div class="d-grid">
            <Button color="" class="btn-soft-primary mx-3"><i class="bx bx-plus me-1"></i>Create New Group
            </Button>
        </div>
    </CardBody>
</Card>
<Row>
    {#each groupList as item}
        <Col lg="6">
            <SocialGroupsCard item="{item}"/>
        </Col>
    {/each}
</Row>
<CardTitle class="mb-3"> Friends Group</CardTitle>
<Row>
    {#each friendsGroup as item}
        <Col lg="6">
            <SocialGroupsCard item="{item}"/>
        </Col>
    {/each}
</Row>
<CardTitle class="mb-3"> Suggested For You</CardTitle>
<Row>
    {#each suggestedGroup as item}
        <Col lg="6">
            <SocialGroupsCard item="{item}"/>
        </Col>
    {/each}
</Row>