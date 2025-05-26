<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Button, Card, Col, Offcanvas, Row} from "@sveltestrap/sveltestrap";
    import ProfileFeed from "./components/ProfileFeed.svelte";
    import SocialFeed from "./components/SocialFeed.svelte";
    import SocialFriends from "./components/SocialFriends.svelte";
    import SocialEvents from "./components/SocialEvents.svelte";
    import SocialGroups from "./components/SocialGroups.svelte";
    import SocialSaved from "./components/SocialSaved.svelte";
    import SocialMemories from "./components/SocialMemories.svelte";
    import FriendsFeed from "./components/FriendsFeed.svelte";

    let show = false
    let socialTab = 'social-feed'


    const toggleTabs = (e: string) => {
        socialTab = e
    }

    const toggleOffcanvas = () => {
        show = !show
    }

    let showProfile = false

    const toggleProfileOffcanvas = () => {
        showProfile = !showProfile
    }
</script>

<DefaultLayout>
    <PageBreadcrumb title="Social" subTitle="Apps"/>
    <Row class="justify-content-center">
        <Col xxl="3">
            <div class="sticky-bar">
                <div class="offcanvas-xxl offcanvas-start" id="accountInfoffcanvas">
                    <ProfileFeed socialTab="{socialTab}" toggleTabs="{toggleTabs}"/>
                </div>
                <div class="d-block d-xl-none">
                    <Offcanvas isOpen="{showProfile}" toggle={()=> showProfile = !showProfile} class="offcanvas-xxl"
                               placement="start">
                        <ProfileFeed socialTab="{socialTab}" toggleTabs="{toggleTabs}"/>
                    </Offcanvas>
                </div>
            </div>
        </Col>
        <Col xxl="6">
            <Card class="d-xxl-none d-flex">
                <div class="d-flex gap-2 align-items-center p-2">
                    <Button color="light" class="px-2 d-inline-flex align-items-center" type="button"
                            on:click="{toggleProfileOffcanvas}">
                        <i class="bx bx-menu fs-18"></i>
                    </Button>

                    <h5 class="me-auto mb-0">Gatson Keller</h5>

                    <Button color="light" class="px-2 d-inline-flex align-items-center" type="button"
                            on:click="{toggleOffcanvas}">
                        <i class="bx bx-menu fs-18"></i>
                    </Button>
                </div>
            </Card>

            <div class="tab-content pt-0">
                <div class="tab-pane fade {socialTab === 'social-feed' && 'show active'}" id="social-feed">
                    <SocialFeed/>
                </div>

                <div class="tab-pane fade {socialTab === 'social-friends' && 'show active'}" id="social-friends">
                    <SocialFriends/>
                </div>

                <div class="tab-pane fade {socialTab === 'social-events' && 'show active'}" id="social-events">
                    <SocialEvents/>
                </div>

                <div class="tab-pane fade {socialTab === 'social-groups' && 'show active'}" id="social-groups">
                    <SocialGroups/>
                </div>

                <div class="tab-pane fade {socialTab === 'social-saved' && 'show active'}" id="social-saved">
                    <SocialSaved/>
                </div>

                <div class="tab-pane fade {socialTab === 'social-memories' && 'show active'}" id="social-memories">
                    <SocialMemories/>
                </div>
            </div>
        </Col>

        <Col xxl="3">
            <div class="sticky-bar">
                <div class="offcanvas-xxl offcanvas-end" id="friendListffcanvas">
                    <FriendsFeed/>
                </div>
                <div class="d-block d-xl-none">
                    <Offcanvas isOpen="{show}" toggle={()=>show = !show} class="offcanvas-xxl" placement="end">
                        <FriendsFeed/>
                    </Offcanvas>
                </div>
            </div>
        </Col>
    </Row>
</DefaultLayout>