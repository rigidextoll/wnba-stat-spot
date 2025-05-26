<script lang="ts">

    import {
        Accordion, AccordionItem,
        Badge,
        Button,
        Card,
        CardHeader,
        CardTitle,
        Form,
        Input,
        Offcanvas
    } from "@sveltestrap/sveltestrap";

    let userSetting = false

    let contactTab = 'chat-list'

    const avatar1 = '/images/users/avatar-1.jpg'
    const avatar2 = '/images/users/avatar-2.jpg'
    const avatar3 = '/images/users/avatar-3.jpg'
    const avatar4 = '/images/users/avatar-4.jpg'
    const avatar5 = '/images/users/avatar-5.jpg'
    const avatar6 = '/images/users/avatar-6.jpg'
    const avatar7 = '/images/users/avatar-7.jpg'
    const avatar8 = '/images/users/avatar-8.jpg'
    const avatar9 = '/images/users/avatar-9.jpg'
    const avatar10 = '/images/users/avatar-10.jpg'
    import Swiper from "$lib/components/Swiper.svelte";
    import {contactList, groupList, userContact} from "./data";
    import type {SwiperOptions} from "swiper/types";

    const onlineContact = [avatar1, avatar2, avatar3, avatar4, avatar5, avatar6, avatar7, avatar8, avatar9, avatar10]

    const swiperOptions: SwiperOptions = {
        loop: true,
        pagination: {el: '.swiper-pagination', clickable: true},
        slidesPerView: 'auto',
        spaceBetween: 8,
        autoHeight: true,
    }
</script>


<Card class="position-relative overflow-hidden">
    <CardHeader class="border-0 d-flex justify-content-between align-items-center">
        <CardTitle>Chat</CardTitle>
        <a href={"#"} class="fs-18" type="button" on:click={() => userSetting = !userSetting}>
            <i class="bx bx-cog"></i>
        </a>
    </CardHeader>

    <Form class="chat-search px-3">
        <div class="chat-search-box">
            <Input type="text" name="search" id="search" placeholder="Search..."/>
            <Button color="link" size="sm" type="submit" class="search-icon p-0">
                <i class="bx bx-search-alt"></i>
            </Button>
        </div>
    </Form>
    <Swiper id="avatar-swiper" customClass="mySwiper p-1 mx-3" options={swiperOptions}>
        <div class="swiper-wrapper">
            {#each onlineContact as item}
                <div class="swiper-slide avatar-sm">
                    <div class="chat-user-status-box">
                        <span>
                          <img src="{item}" alt="avatar-1" class="img-fluid avatar-sm rounded-circle avatar-border"/>
                        </span>
                    </div>
                </div>
            {/each}
        </div>
    </Swiper>
    <ul class="nav nav-tabs nav-justified nav-bordered border-top mt-2">
        <li class="nav-item">
            <a href={"#"} class="nav-link py-2 {contactTab === 'chat-list' && 'active'}"
               on:click={()=> contactTab = 'chat-list'}> Chat </a>
        </li>
        <li class="nav-item">
            <a href={"#"} class="nav-link py-2 {contactTab === 'group-list' && 'active'}"
               on:click={()=> contactTab = 'group-list'}> Group </a>
        </li>
        <li class="nav-item">
            <a href={"#"} class="nav-link py-2 {contactTab === 'contact-list' && 'active'}"
               on:click={()=> contactTab = 'contact-list'}> Contact </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane {contactTab === 'chat-list' && 'show active'}" id="chat-list">
            <div class="px-3 mb-3 chat-setting-height" data-simplebar>
                {#each contactList as contact}
                    <a href={"#"} class="text-body">
                        <div class="d-flex align-items-center p-2 chat-item">
                            <div class="flex-shrink-0 position-relative">
                                <img src="{contact.image}" class="me-2 rounded-circle" height="36" alt="avatar-2"/>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="my-0">
                                    <span class="float-end text-muted fs-13">{contact.timeStamp}</span>
                                    {contact.name}
                                </h5>
                                <p class="mt-1 mb-0 fs-13 text-muted d-flex align-items-end justify-content-between">
                                    <span class="w-75">{contact.lastMsg}</span>
                                    {#if contact.isRead}
                                        <i class="bx bx-check-double text-success"></i>
                                    {/if}
                                </p>
                            </div>
                        </div>
                    </a>
                {/each}
            </div>
        </div>

        <div class="tab-pane {contactTab === 'group-list' && 'show active'}" id="group-list">
            <div class="px-3 mb-3 chat-setting-height" data-simplebar>
                <div class="d-flex align-items-center position-relative mb-3">
                    <a href={"#"}
                       class="me-2 stretched-link rounded text-bg-primary avatar d-flex align-items-center justify-content-center fs-18">
                        <i class="bx bxs-user"></i>
                    </a>
                    <div class="flex-grow-1">
                        <h5 class="my-0 fs-14">New Group</h5>
                    </div>
                </div>

                {#each groupList as group}
                    <div class="chat-item d-flex mb-3 align-items-center position-relative">
                        <a href={"#"}
                           class="me-2 stretched-link rounded bg-soft-primary text-primary avatar d-flex align-items-center justify-content-center fs-18">{
                            group
                                .name.charAt(0).toUpperCase()
                        }</a>
                        <div class="flex-grow-1 ps-1 overflow-hidden">
                            {#if (group.badge)}
                                <div class="float-end">
                                    <Badge color="" class="badge-outline-danger">+{group.badge}</Badge>
                                </div>
                            {/if}
                            <h5 class="fs-14 m-0">#{group.name}</h5>
                        </div>
                    </div>
                {/each}
            </div>
        </div>

        <div class="tab-pane {contactTab === 'contact-list' && 'show active'}" id="contact-list">
            <div class="px-3 mb-3 chat-setting-height" data-simplebar>
                <div class="chat-item d-flex align-items-center position-relative py-2">
                    <a href={"#"}
                       class="me-2 stretched-link rounded-circle text-bg-primary avatar d-flex align-items-center justify-content-center fs-18">
                        <i class="bx bx-group"></i>
                    </a>
                    <div class="flex-grow-1">
                        <h5 class="my-0 fs-14">New Group</h5>
                    </div>
                </div>
                <div class="chat-item d-flex align-items-center position-relative py-2">
                    <a href={"#"}
                       class="me-2 stretched-link rounded-circle text-bg-primary avatar d-flex align-items-center justify-content-center fs-18">
                        <i class="bx bx-user-plus"></i>
                    </a>
                    <div class="flex-grow-1">
                        <h5 class="my-0 fs-14">New Contact</h5>
                    </div>
                </div>
                {#each userContact as contact}
                    <div class="chat-item d-flex align-items-center position-relative py-2">
                        <a href={"#"} class="stretched-link">
                            <img src="{contact.avatar}" class="me-2 rounded-circle" height="36" alt="avatar-2"/>
                        </a>
                        <div class="flex-grow-1">
                            <h5 class="my-0 fs-14">
                                {contact.name}
                            </h5>
                            <p class="mt-1 mb-0 text-muted">
                                <span class="w-75">{contact.status}</span>
                            </p>
                        </div>
                    </div>
                {/each}
            </div>
        </div>
    </div>

    <Offcanvas isOpen={userSetting} toggle={() => userSetting = !userSetting} class="position-absolute shadow"
               placement="start"
               header="Setting" body={false}>
        <div data-simplebar>
            <div class="d-flex align-items-center px-3 pb-3 border-bottom">
                <img src={avatar1} class="me-2 rounded-circle" height="36" alt="avatar-1"/>
                <div class="flex-grow-1">
                    <div class="float-end">
                        <a href={"#"}><i class="bx bx-qr-scan fs-20"></i></a>
                    </div>
                    <h5 class="my-0 fs-14">Gaston Lapierre</h5>
                    <p class="mt-1 mb-0 text-muted">
                        <span class="w-75">Hey there! I am using Reback Chat.</span>
                    </p>
                </div>
            </div>

            <div class="px-3 my-3 app-chat-setting">
                <Accordion class="custom-accordion" id="accordionSetting">
                    <AccordionItem class="border-0">
                <span slot="header" class="d-flex align-items-center">
                  <i class="bx bx-key me-3 fs-20"></i>
                  <span class="flex-grow-1">
                    <span class="fs-14 h5 mt-0 mb-1 d-block">Account</span>
                    <span class="mt-1 mb-0 text-muted w-75">Privacy, security, change number</span>
                  </span>
                </span>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href={"#"}><i class="bx bx-lock-alt fs-18 me-2"></i>Privacy</a>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}><i class="bx bx-check-Reback fs-18 me-2"></i>Security</a>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}><i class="bx bx-badge-check fs-18 me-2"></i>Two-step
                                    verification</a>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}><i class="bx bx-arrow-from-left fs-18 me-2"></i>Change
                                    number</a>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}><i class="bx bx-info-circle fs-18 me-2"></i>Request
                                    account info</a>
                            </li>
                            <li>
                                <a href={"#"}><i class="bx bx-trash fs-18 me-2"></i>Delete my
                                    account</a>
                            </li>
                        </ul>
                    </AccordionItem>
                    <AccordionItem class="border-0">

                <span slot="header" class="d-flex align-items-center">
                  <i class="bx bx-message-dots me-3 fs-20"></i>
                  <span class="flex-grow-1">
                    <span class="fs-14 h5 mt-0 mb-1 d-block">Chats</span>
                    <span class="mt-1 mb-0 text-muted w-75">Theme, wallpapers, chat history</span>
                  </span>
                </span>

                        <h5 class="mb-2">Display</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 d-flex">
                                <i class="bx bx-palette fs-18 me-2"></i>
                                <div class="flex-grow-1">
                                    <a href={"#"}>Theme</a>
                                    <p class="mb-0 text-muted fs-12">System default</p>
                                </div>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}><i class="bx bx-image fs-16 me-2"></i>Wallpaper</a>
                            </li>
                        </ul>
                        <hr/>
                        <h5>Chat Setting</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2 ms-2">
                                <div class="float-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="media"
                                               checked/>
                                    </div>
                                </div>
                                <a href={"#"}>Media Visibility</a>
                                <p class="mb-0 text-muted fs-12">Show Newly downloaded media in your
                                    phone's gallery</p>
                            </li>
                            <li class="mb-2 ms-2">
                                <div class="float-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="enter"/>
                                    </div>
                                </div>
                                <a href={"#"}>Enter is send</a>
                                <p class="mb-0 text-muted fs-12">Enter key will send your message</p>
                            </li>
                            <li class="mb-2 ms-2">
                                <a href={"#"}>Font size</a>
                                <p class="mb-0 text-muted fs-12">small</p>
                            </li>
                        </ul>
                        <hr/>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <div class="d-flex">
                                    <i class="bx bx-text fs-16 me-2"></i>
                                    <div class="flex-grow-1">
                                        <a href={"#"}>App Language</a>
                                        <p class="mb-0 text-muted fs-12">English</p>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}><i class="bx bx-cloud-upload fs-16 me-2"></i>Chat
                                    Backup</a>
                            </li>
                            <li>
                                <a href={"#"}><i class="bx bx-history fs-16 me-2"></i>Chat History</a>
                            </li>
                        </ul>
                    </AccordionItem>
                    <AccordionItem class="border-0">
                <span slot="header" class="d-flex align-items-center">
                  <i class="bx bx-bell me-3 fs-20"></i>
                  <span class="flex-grow-1">
                    <span class="fs-14 h5 mt-0 mb-1 d-block">Notification</span>
                    <span class="mt-1 mb-0 text-muted w-75">Message, group, call tones</span>
                  </span>
                </span>

                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <div class="float-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               id="conversation" checked/>
                                    </div>
                                </div>
                                <a href={"#"}>Conversation Tones</a>
                                <p class="mb-0 text-muted fs-12">Play sound for incoming and outgoing
                                    message.</p>
                            </li>
                        </ul>
                        <hr/>
                        <h5>Messages</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href={"#"}>Notification Tone</a>
                                <p class="mb-0 text-muted fs-12">Default ringtone</p>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}>Vibrate</a>
                                <p class="mb-0 text-muted fs-12">Default</p>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}>Light</a>
                                <p class="mb-0 text-muted fs-12">White</p>
                            </li>
                        </ul>
                        <hr/>
                        <h5>Groups</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href={"#"}>Notification Tone</a>
                                <p class="mb-0 text-muted fs-12">Default ringtone</p>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}>Vibrate</a>
                                <p class="mb-0 text-muted fs-12">Off</p>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}>Light</a>
                                <p class="mb-0 text-muted fs-12">Dark</p>
                            </li>
                        </ul>
                        <hr/>
                        <h5>Calls</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href={"#"}>Ringtone</a>
                                <p class="mb-0 text-muted fs-12">Default ringtone</p>
                            </li>
                            <li>
                                <a href={"#"}>Vibrate</a>
                                <p class="mb-0 text-muted fs-12">Default</p>
                            </li>
                        </ul>
                    </AccordionItem>
                    <AccordionItem class="border-0">

                <span slot="header" class="d-flex align-items-center">
                  <i class="bx bx-history me-3 fs-20"></i>
                  <span class="flex-grow-1">
                    <span class="fs-14 h5 mt-0 mb-1 d-block">Storage and data</span>
                    <span class="mt-1 mb-0 text-muted w-75">Network usage, auto download</span>
                  </span>
                </span>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex">
                                <i class="bx bx-folder fs-16 me-2"></i>
                                <div class="flex-grow-1">
                                    <a href={"#"}>Manage storage</a>
                                    <p class="mb-0 text-muted fs-12">2.4 GB</p>
                                </div>
                            </li>
                        </ul>
                        <hr/>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex">
                                <i class="bx bx-wifi fs-16 me-2"></i>
                                <div class="flex-grow-1">
                                    <a href={"#"}>Network usage</a>
                                    <p class="mb-0 text-muted fs-12">7.2 GB sent - 13.8 GB received</p>
                                </div>
                            </li>
                        </ul>
                        <hr/>
                        <h5 class="mb-0">Media auto-download</h5>
                        <p class="mb-0 text-muted fs-12">Voice message are always automatically
                            downloaded</p>
                        <ul class="list-unstyled mb-0 mt-2">
                            <li class="mb-2">
                                <a href={"#"}>When using mobile data</a>
                                <p class="mb-0 text-muted fs-12">No media</p>
                            </li>
                            <li class="mb-2 ms-2">
                                <a href={"#"}>When connected on wi-fi</a>
                                <p class="mb-0 text-muted fs-12">No media</p>
                            </li>
                            <li class="mb-2 ms-2">
                                <a href={"#"}>When roaming</a>
                                <p class="mb-0 text-muted fs-12">No media</p>
                            </li>
                        </ul>
                        <hr/>
                        <h5 class="mb-0">Media upload quality</h5>
                        <p class="mb-0 text-muted fs-12">Choose the quality of media files to be
                            sent</p>
                        <ul class="list-unstyled mb-0 mt-2">
                            <li class="ms-2">
                                <a href={"#"}>Photo upload quality</a>
                                <p class="mb-0 text-muted fs-12">Auto (recommended)</p>
                            </li>
                        </ul>
                    </AccordionItem>
                    <AccordionItem class="border-0">

                <span slot="header" class="d-flex align-items-center">
                  <i class="bx bx-info-circle me-3 fs-20"></i>
                  <span class="flex-grow-1">
                    <span class="fs-14 h5 mt-0 mb-1 d-block">Help</span>
                    <span class="mt-1 mb-0 text-muted w-75">Help center, contact us, privacy policy</span>
                  </span>
                </span>

                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href={"#"}><i class="bx bx-info-circle fs-16 me-2"></i>Help
                                    center</a>
                            </li>
                            <li class="mb-2 d-flex">
                                <i class="bx bxs-contact fs-16 me-2"></i>
                                <div class="flex-grow-1">
                                    <a href={"#"}>Contact us</a>
                                    <p class="mb-0 text-muted fs-12">Questions?</p>
                                </div>
                            </li>
                            <li class="mb-2">
                                <a href={"#"}><i class="bx bx-book-content fs-16 me-2"></i>Teams and
                                    Privacy Policy</a>
                            </li>
                            <li>
                                <a href={"#"}><i class="bx bx-info-circle fs-16 me-2"></i>App info</a>
                            </li>
                        </ul>
                    </AccordionItem>
                </Accordion>
            </div>
        </div>
    </Offcanvas>
</Card>