<script lang="ts">

    import {emailData, emailTabs} from "./components/data";
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import EmailSidebar from "./components/EmailSidebar.svelte";
    import {
        Button,
        ButtonGroup,
        Card,
        Col,
        Dropdown, DropdownItem,
        DropdownMenu,
        DropdownToggle,
        Offcanvas,
        Row, Tooltip
    } from "@sveltestrap/sveltestrap";
    import MailCard from "./components/MailCard.svelte";
    import EmailRead from "./components/EmailRead.svelte";
    import TabPane from "./components/TabPane.svelte"

    let showEmailSidebar = false

    let showTab = 'primaryMail'
    let category = ''
    let categoryType = ''

    let showEmail = false
    const toggleReadOffcanvas = () => {
        showEmail = !showEmail
    }

    const filterMails = (ele: any, tab: string) => {
        let keyCheck = ''
        keyCheck = isKeyInArray(emailData, ele)

        if (keyCheck) {
            categoryType = 'key'
        } else {
            categoryType = 'type'
        }

        category = ele
        showTab = tab
    }

    const isKeyInArray = (array: any, key: any) => {
        return array.some((obj: any) => obj.hasOwnProperty(key))
    }

    const filterEmails = (categoryType: string, category: any) => {
        if (category) {
            if (categoryType === 'type') {
                return emailData.filter((item) => item.type === category)
            } else {
                // @ts-ignore
                return emailData.filter((item) => item[category] === true)
            }
        } else {
            return emailData
        }
    }

    $: filteredMails = filterEmails(categoryType, category)
</script>


<DefaultLayout>
    <PageBreadcrumb title="Inbox" subTitle="Email"/>
    <Row class="g-1 mb-3">
        <Col xxl="2">
            <div class="offcanvas-xxl offcanvas-start h-100" tabindex="-1" id="EmailSidebaroffcanvas"
                 aria-labelledby="EmailSidebaroffcanvasLabel">
                <EmailSidebar filterMails={filterMails} showTab={showTab}/>
            </div>

            <div class="d-block d-xl-none">
                <Offcanvas isOpen={showEmailSidebar} toggle={() => showEmailSidebar = !showEmailSidebar}
                           class="offcanvas-xxl" placement="start" body={false}>
                    <EmailSidebar filterMails={filterMails} showTab={showTab}/>
                </Offcanvas>
            </div>
        </Col>

        <Col xxl="10">
            <Card>
                <div class="p-3">
                    <div class="d-flex flex-wrap gap-1">
                        <Button color="light" class="d-xxl-none d-flex align-items-center px-2 me-2" type="button"
                                on:click={() => showEmailSidebar = !showEmailSidebar}>
                            <i class="bx bx-menu fs-18"/>
                        </Button>

                        <!-- archive, spam & delete -->
                        <ButtonGroup class="me-1">
                            <Button type="button" color="light" id="archive">
                                <i class="bx bx-archive fs-18"></i>
                            </Button>
                            <Tooltip target="archive" placement="top">
                                Archive
                            </Tooltip>
                            <Button type="button" color="light" id="spam">
                                <i class="bx bx-info-square fs-18"></i>
                            </Button>
                            <Tooltip target="spam" placement="top">
                                Mark as spam
                            </Tooltip>
                            <Button type="button" color="light" id="delete">
                                <i class="bx bx-trash fs-18"></i>
                            </Button>
                            <Tooltip target="delete" placement="top">
                                Delete
                            </Tooltip>
                        </ButtonGroup>

                        <!-- move to -->
                        <Dropdown class="me-1">
                            <DropdownToggle color="light" caret>
                                <i class="bx bx-folder fs-18 me-1"/>
                            </DropdownToggle>
                            <DropdownMenu>
                                <DropdownItem header>Move to</DropdownItem>
                                <DropdownItem>Social</DropdownItem>
                                <DropdownItem>Promotions</DropdownItem>
                                <DropdownItem>Updates</DropdownItem>
                                <DropdownItem>Forums</DropdownItem>
                            </DropdownMenu>
                        </Dropdown>

                        <!-- labels -->
                        <Dropdown class="me-1">
                            <DropdownToggle color="light" caret>
                                <i class="bx bx-bookmarks fs-18 me-1"/>
                            </DropdownToggle>
                            <DropdownMenu>
                                <DropdownItem header>Move to</DropdownItem>
                                <DropdownItem>Social</DropdownItem>
                                <DropdownItem>Promotions</DropdownItem>
                                <DropdownItem>Updates</DropdownItem>
                                <DropdownItem>Forums</DropdownItem>
                            </DropdownMenu>
                        </Dropdown>

                        <!-- more option -->
                        <Dropdown class="me-1">
                            <DropdownToggle color="light" caret>
                                <i class="bx bx-bookmarks fs-18 me-1"/>
                            </DropdownToggle>
                            <DropdownMenu>
                                <DropdownItem header>Move to</DropdownItem>
                                <DropdownItem>Mark as Unread</DropdownItem>
                                <DropdownItem>Add to Tasks</DropdownItem>
                                <DropdownItem>Add Star</DropdownItem>
                                <DropdownItem>Mute</DropdownItem>
                            </DropdownMenu>
                        </Dropdown>
                    </div>
                </div>

                <div class="tab-content pt-0" id="email-tabContent">
                    <div class="tab-pane fade {['primaryMail', 'socialMail', 'PromotionsMail', 'updatesMail', 'forumsMail', 'email-inbox'].includes(showTab) && 'show active'}"
                         id="email-inbox">
                        <div>
                            <ul class="nav nav-tabs nav-justified">
                                <li class="nav-item">
                                    <a href={"#"}
                                       class="nav-link d-flex align-items-center {['primaryMail', 'email-inbox'].includes(showTab) && 'active'}"
                                       on:click="{() => filterMails('', 'primaryMail')}">
                                        <span class="me-2"><i class="bx bxs-inbox fs-18"></i></span>
                                        <span class="d-none d-md-block">Primary</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={"#"}
                                       class="nav-link d-flex align-items-center {showTab === 'socialMail' && 'active'}"
                                       on:click="{() => filterMails('social', 'socialMail')}">
                                        <span class="me-2"><i class="bx bxs-group fs-18"></i></span>
                                        <span class="d-none d-md-block">Social</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={"#"}
                                       class="nav-link d-flex align-items-center {showTab === 'PromotionsMail' && 'active'}"
                                       on:click="{() => filterMails('promotions', 'PromotionsMail')}">
                                        <span class="me-2"><i class="bx bxs-purchase-tag fs-18"></i></span>
                                        <span class="d-none d-md-block">Promotions</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={"#"}
                                       class="nav-link d-flex align-items-center {showTab === 'updatesMail' && 'active'}"
                                       on:click="{() => filterMails('updates', 'updatesMail')}">
                                        <span class="me-2"><i class="bx bxs-info-circle fs-18"></i></span>
                                        <span class="d-none d-md-block">Updates</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href={"#"}
                                       class="nav-link d-flex align-items-center {showTab === 'forumsMail' && 'active'}"
                                       on:click="{() => filterMails('forums', 'forumsMail')}">
                                        <span class="me-2"><i class="bx bxs-chat fs-18"></i></span>
                                        <span class="d-none d-md-block">Forums</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content text-muted pt-0">
                                <div class="tab-pane {['primaryMail', 'email-inbox'].includes(showTab) && 'show active'}"
                                     id="primaryMail">
                                    <ul class="message-list mb-0">
                                        {#each filteredMails as mail}
                                            <MailCard mail="{mail}" toggleReadOffcanvas="{toggleReadOffcanvas}"/>
                                        {/each}
                                    </ul>
                                </div>
                                <div class="tab-pane {showTab === 'socialMail' && 'show active'}" id="socialMail">
                                    <ul class="message-list mb-0">
                                        {#each filteredMails as mail}
                                            <MailCard mail="{mail}" toggleReadOffcanvas="{toggleReadOffcanvas}"/>
                                        {/each}
                                    </ul>
                                </div>
                                <div class="tab-pane {showTab === 'PromotionsMail' && 'show active'}"
                                     id="PromotionsMail">
                                    <ul class="message-list mb-0">
                                        {#each filteredMails as mail}
                                            <MailCard mail="{mail}" toggleReadOffcanvas="{toggleReadOffcanvas}"/>
                                        {/each}
                                    </ul>
                                </div>
                                <div class="tab-pane {showTab === 'updatesMail' && 'show active'}" id="updatesMail">
                                    <ul class="message-list mb-0">
                                        {#each filteredMails as mail}
                                            <MailCard mail="{mail}" toggleReadOffcanvas="{toggleReadOffcanvas}"/>
                                        {/each}
                                    </ul>
                                </div>
                                <div class="tab-pane {showTab === 'forumsMail' && 'show active'}" id="forumsMail">
                                    <ul class="message-list mb-0">
                                        {#each filteredMails as mail}
                                            <MailCard mail="{mail}" toggleReadOffcanvas="{toggleReadOffcanvas}"/>
                                        {/each}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {#each emailTabs as tab}
                        <TabPane tab="{tab}" filteredMails="{filteredMails}" showTab="{showTab}"
                                 toggleReadOffcanvas="{toggleReadOffcanvas}"/>
                    {/each}
                </div>

                <div class="px-3 py-2 mt-auto">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="">Showing 1 - 20 of 289</div>
                        <ButtonGroup>
                            <Button type="button" color="light" size="sm">
                                <i class="bx bx-chevron-left"></i>
                            </Button>
                            <Button type="button" color="primary" size="sm">
                                <i class="bx bx-chevron-right"></i>
                            </Button>
                        </ButtonGroup>
                    </div>
                </div>

                <Offcanvas isOpen="{showEmail}" toggle={()=>showEmail = !showEmail}
                           class="email-offcanvas mail-read shadow" placement="end"
                           id="email-read" >
                    <div slot="header" class="offcanvas-header">
                        <div class="d-flex gap-2 align-items-center w-50">
                            <a href={"#"} role="button" on:click="{toggleReadOffcanvas}">
                                <i class="bx bx-arrow-back fs-18 align-middle"></i>
                            </a>
                            <h5 class="offcanvas-title t w-50" id="email-readLabel">Medium</h5>
                        </div>

                    </div>
                    <EmailRead/>
                </Offcanvas>
            </Card>
        </Col>
    </Row>
</DefaultLayout>