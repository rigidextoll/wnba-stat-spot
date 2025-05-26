<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import {chatMsg, dropdownItem} from "./components/data";
    import {object, string} from "yup";
    import {
        Button, ButtonGroup,
        Card,
        CardHeader,
        Col,
        Dropdown, DropdownItem,
        DropdownMenu,
        DropdownToggle, Modal, ModalBody, ModalHeader,
        Offcanvas,
        Row
    } from "@sveltestrap/sveltestrap";
    import ContactOffcanvas from "./components/ContactOffcanvas.svelte";
    import ProfileOffcanvas from "./components/ProfileOffcanvas.svelte";

    const avatar4 = '/images/users/avatar-4.jpg'

    $: chatMessages = chatMsg

    let contactOffcanvas = false
    let profileOffcanvas = false

    let videoModal = false
    let voiceModal = false

    const videoToggleModal = () => {
        videoModal = !videoModal
    }

    const voiceToggleModal = () => {
        voiceModal = !voiceModal
    }

    let error = ''

    const messageSchema = object({
        message: string().required('Message is Required')
    })

    const messageState = {
        message: ''
    }
    const handleYupSubmit = async (event: Event) => {
        await messageSchema
            .validate(messageState)
            .then((res) => {
                error = ''
                // validated message
            })
            .catch((e) => {
                return (error = e.message)
            })
    }
</script>

<DefaultLayout>
    <Row class="g-1">
        <Col xxl="3">
            <div class="offcanvas-xxl offcanvas-start h-100" id="contactOffcanvas">
                <ContactOffcanvas/>
            </div>

            <div class="d-block d-xl-none">
                <Offcanvas isOpen="{contactOffcanvas}" class="offcanvas-xxl h-100" placement="start">
                    <ContactOffcanvas/>
                </Offcanvas>
            </div>
        </Col>

        <Col xxl="9">
            <Card class="position-relative overflow-hidden">
                <CardHeader class="d-flex align-items-center mh-100">
                    <Button color="light" class="d-xxl-none d-flex align-items-center px-2 me-2" type="button"
                            on:click={() => contactOffcanvas = !contactOffcanvas}>
                        <i class="bx bx-menu fs-18"></i>
                    </Button>

                    <div class="d-flex align-items-center">
                        <img src="{avatar4}" class="me-2 rounded" height="36" alt="avatar-4"/>
                        <div class="d-none d-md-flex flex-column">
                            <h5 class="my-0 fs-16 fw-semibold">
                                <a href={"#"} class="text-dark" on:click={()=>profileOffcanvas = !profileOffcanvas}>
                                    Gilbert
                                    Chicoine </a>
                            </h5>
                            <p class="mb-0 text-success fw-semibold fst-italic">typing...</p>
                        </div>
                    </div>

                    <div class="flex-grow-1">
                        <ul class="list-inline float-end d-flex gap-3 mb-0">
                            <li class="list-inline-item fs-20 d-flex align-items-center mt-1">
                                <a href={"#"} class="text-dark" on:click="{videoToggleModal}">
                                    <i class="bx bx-video"></i>
                                </a>
                            </li>

                            <li class="list-inline-item fs-20 d-flex align-items-center mt-1">
                                <a href={"#"} class="text-dark" on:click="{voiceToggleModal}">
                                    <i class="bx bx-phone-call"></i>
                                </a>
                            </li>

                            <li class="list-inline-item fs-20 d-flex align-items-center mt-1">
                                <a href={"#"} class="text-dark" on:click={()=>profileOffcanvas = !profileOffcanvas}>
                                    <i class="bx bx-user"></i>
                                </a>
                            </li>

                            <li class="list-inline-item fs-20 d-none d-md-flex">
                                <Dropdown>
                                    <DropdownToggle color="" class="p-0">
                                        <i class="bx bx-dots-vertical-rounded fs-20"/>
                                    </DropdownToggle>

                                    <DropdownMenu>
                                        <DropdownItem><i class="bx bx-user-circle me-2"></i>View Profile</DropdownItem>
                                        <DropdownItem><i class="bx bx-music me-2"></i>Media, Links and Docs
                                        </DropdownItem>
                                        <DropdownItem><i class="bx bx-search me-2"></i>Search</DropdownItem>
                                        <DropdownItem><i class="bx bx-image me-2"></i>Wallpaper</DropdownItem>
                                        <DropdownItem><i class="bx bx-right-arrow-circle me-2"></i>More</DropdownItem>
                                    </DropdownMenu>
                                </Dropdown>
                            </li>
                        </ul>
                    </div>
                </CardHeader>

                <div class="chat-box">
                    <div data-simplebar class="chat-conversation-list p-3 chatbox-height">
                        {#each chatMessages as content}
                            <li class="clearfix {content.isSender && 'odd'}">
                                {#each content.msg as msg,idx}
                                    <div class="chat-conversation-text ms-0">
                                        {#if (content.isSender)}
                                            <div class="d-flex justify-content-end">
                                                <Dropdown class="chat-conversation-actions dropstart">
                                                    <DropdownToggle color="" class="p-0">
                                                        <a href={"#"}>
                                                            <i class="bx bx-dots-vertical-rounded fs-18"></i>
                                                        </a>
                                                    </DropdownToggle>
                                                    <DropdownMenu>
                                                        {#each dropdownItem as item}
                                                            <a href={"#"} class="dropdown-item">
                                                                <i class="bx me-2 {item.icon}"></i>
                                                                { item.title }
                                                            </a>
                                                        {/each}
                                                    </DropdownMenu>
                                                </Dropdown>
                                                {#if (!msg.isMedia)}
                                                    <div class="chat-ctext-wrap">
                                                        <p>{ msg.text }</p>
                                                    </div>
                                                {/if}

                                                {#if msg.isMedia && msg.mediaContend}
                                                    <div class="chat-ctext-wrap text-start">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="bx fs-24 me-1 {msg.mediaContend.type}"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <a href={"#"}
                                                                   class="text-white">{ msg.mediaContend.title }</a>
                                                                <p class="mb-0">
                                                                    { msg.mediaContend.size }
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                {/if}
                                            </div>
                                        {:else }
                                            <div class="d-flex">
                                                <div class="chat-ctext-wrap">
                                                    {#if msg.text}
                                                        <p>{ msg.text }</p>
                                                    {/if}
                                                    {#if msg.img}
                                                        {#each msg.img as image}
                                                            <a href={"#"}>
                                                                <img src="{image}" alt="attachment"
                                                                     style="height: 84px"
                                                                     class="img-thumbnail me-1"/>
                                                            </a>
                                                        {/each}
                                                    {/if}
                                                </div>
                                                <Dropdown class="chat-conversation-actions dropend">
                                                    <DropdownToggle color="" class="p-0">
                                                        <a href={"#"}>
                                                            <i class="bx bx-dots-vertical-rounded fs-18"></i></a>
                                                    </DropdownToggle>
                                                    <DropdownMenu>
                                                        {#each dropdownItem as item}
                                                            <a href={"#"} class="dropdown-item mb-0">
                                                                <i class="bx me-2 {item.icon}"></i>
                                                                { item.title }
                                                            </a>
                                                        {/each}
                                                    </DropdownMenu>
                                                </Dropdown>
                                            </div>
                                        {/if}
                                        {#if content.timeStamp && content.msg.length - 1 === idx}
                                            <p class="text-muted fs-12 mb-0 mt-1 {!content.isSender && 'ms-2'}">{ content.timeStamp }
                                                {#if (content.isRead)}
                                                    <i class="bx bx-check-double ms-1 text-primary"></i>
                                                {/if}
                                            </p>
                                        {/if}
                                    </div>
                                {/each}
                            </li>
                        {/each}
                    </div>
                    <div class="bg-light bg-opacity-50 p-2">
                        <form class="needs-validation" name="chat-form" id="chat-form"
                              on:submit|preventDefault="{handleYupSubmit}">
                            <Row class="align-items-center">
                                <div class="col mb-2 mb-sm-0 d-flex">
                                    <div class="input-group">
                                        <a href={"#"}
                                           class="btn btn-sm btn-light d-flex align-items-center input-group-text">
                                            <i class="bx bx-smile fs-18"></i>
                                        </a>
                                        <input type="text" class="form-control border-0"
                                               placeholder="Enter your message"
                                               bind:value="{messageState.message}"/>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="">
                                        <ButtonGroup class="btn-toolbar">
                                            <a href={"#"} class="btn btn-sm btn-light">
                                                <i class="bx bx-paperclip fs-18"></i>
                                            </a>
                                            <a href={"#"} class="btn btn-sm btn-light"><i
                                                    class="bx bx-video fs-18"></i></a>
                                            <Button type="submit" color="primary" size="sm"
                                                    class="chat-send">
                                                <i class="bx bx-send fs-18"></i>
                                            </Button>
                                        </ButtonGroup>
                                    </div>
                                </div>
                                {#if error.length > 0}
                                    <span class="text-danger mt-2">{ error }</span>
                                {/if}
                            </Row>
                        </form>
                    </div>
                </div>
            </Card>
        </Col>
    </Row>

    <!-- Profile Start -->
    <Offcanvas isOpen="{profileOffcanvas}" toggle={()=> profileOffcanvas = !profileOffcanvas} class="border-start"
               header="Profile"
               placement="end" body={false}>
        <ProfileOffcanvas/>
    </Offcanvas>

    <!-- Voice Call Modal -->
    <Modal isOpen="{voiceModal}" toggle={()=> voiceModal = !voiceModal} size="sm" centered>

        <ModalHeader class="modal-header border-0 mt-5 justify-content-center">
            <img src="{avatar4}" class="rounded-circle" alt="avatar-4"/>
        </ModalHeader>

        <ModalBody class="pt-0 text-center">
            <h5>Gaston Lapierre</h5>
            <p class="mb-5">Calling...</p>
            <div class="voice-call-action pt-4 pb-2">
                <ul class="list-inline">
                    <li class="list-inline-item avatar-sm fw-bold me-2">
                        <a href={"#"}
                           class="avatar-title rounded-circle bg-soft-secondary text-dark fs-16">
                            <i class="bx bx-microphone-off"></i>
                        </a>
                    </li>
                    <li class="list-inline-item avatar fw-bold me-2"
                        data-bs-dismiss="modal">
                        <a href={"#"}
                           class="avatar-title rounded-circle bg-danger text-white fs-18">
                            <i class="bx bx-phone-off"></i>
                        </a>
                    </li>
                    <li class="list-inline-item avatar-sm fw-bold">
                        <a href={"#"}
                           class="avatar-title rounded-circle bg-soft-secondary text-dark fs-16">
                            <i class="bx bx-volume-full"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </ModalBody>
    </Modal>

    <!-- Video Call Modal -->
    <Modal isOpen="{videoModal}" toggle={()=>videoModal = !videoModal} size="sm" centered
           class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content video-call">
            <ModalHeader class="modal-header border-0 mb-5 justify-content-end">
                <div class="video-call-head">
                    <img src="{avatar4}" class="rounded" alt="avatar-4"/>
                </div>
            </ModalHeader>

            <ModalBody>
                <div class="video-call-action text-center pt-4 pb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item avatar-sm fw-bold me-2">
                            <a href={"#"}
                               class="avatar-title rounded-circle bg-soft-light text-white fs-16">
                                <i class="bx bx-microphone-off"></i>
                            </a>
                        </li>
                        <li class="list-inline-item avatar fw-bold me-2">
                            <a href={"#"}
                               class="avatar-title rounded-circle bg-danger text-white fs-18">
                                <i class="bx bx-video-off"/>
                            </a>
                        </li>
                        <li class="list-inline-item avatar-sm fw-bold">
                            <a href={"#"}
                               class="avatar-title rounded-circle bg-soft-light text-white fs-16">
                                <i class="bx bx-volume-full"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </ModalBody>
        </div>
    </Modal>
</DefaultLayout>

<style>
    .modal-content {
        border: none
    }
</style>