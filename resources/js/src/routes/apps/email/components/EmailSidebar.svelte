<script lang="ts">

    import {
        Badge,
        Button,
        CardBody,
        Dropdown, DropdownItem,
        DropdownMenu, DropdownToggle,
        Modal,
        ModalBody,
        Progress
    } from "@sveltestrap/sveltestrap";
    import {navLinkData} from "./data";
    import QuillEditor from "$lib/components/QuillEditor.svelte";

    let modal = false

    const toggleModal = () => {
        modal = !modal
    }

    export let filterMails: (ele: any, tab: string) => void
    export let showTab: string

    const editorOptions = {
        modules: {
            'toolbar': [[{font: []}, {size: []}], ['bold', 'italic', 'underline', 'strike'], [{color: []}, {background: []}], [{script: 'super'}, {script: 'sub'}], [{header: [false, 1, 2, 3, 4, 5, 6]}, 'blockquote', 'code-block'], [{list: 'ordered'}, {list: 'bullet'}, {indent: '-1'}, {indent: '+1'}], ['direction', {align: []}], ['link', 'image', 'video'], ['clean']]
        },
        theme: "snow",
    }
</script>

<div class="card h-100 mb-0" data-simplebar="">
    <CardBody>
        <div class="d-grid">
            <Button type="button" color="danger" on:click="{toggleModal}">Compose</Button>
        </div>

        <div class="nav flex-column mt-3" id="email-tab" role="tablist" aria-orientation="vertical">
            {#each navLinkData as item,idx}
                {#if (!item.isLabel && !item.isTitle)}
                    <a class="nav-link px-0 py-1 {showTab === item.link && 'active'}" id="{item.link}-tab"
                       href={"#"} on:click={() => filterMails(item.category, item.link)}>
                        {#if !idx}
                             <span class="text-danger fw-bold">
                                 <i class="bx bxs-inbox fs-16 me-2 align-middle"></i>{item.title}
                                 {#if (item.badge)}
                                         <Badge color=""
                                                class="float-end ms-2 badge-soft-{item.badgeVariant}">{item.badge}</Badge>
                                 {/if}
                      </span>
                        {:else }
                            <i class="bx fs-16 align-middle me-2 {item.icon}"></i>{item.title}
                            {#if (item.badge)}
                                <Badge color="" class="float-end ms-2 badge-soft-{item.badgeVariant}">
                                    {item.badge}
                                </Badge>
                            {/if}
                        {/if}
                    </a>
                {/if}

                {#if (item.isTitle)}
                    <h6 class="text-uppercase mt-4">{item.title}</h6>
                {/if}
                {#if item.isLabel}
                    <a class="nav-link px-0 py-1 {showTab === item.link && 'active'}"
                       id="{item.link}-tab"
                       href={"#"} on:click="{() => filterMails(item.category, item.link)}"> <i
                            class="bx bxs-circle font-13 me-2 text-{item.variant}"></i>{item.title} </a>
                {/if}
            {/each}
        </div>

        <div class="mt-5">
            <h4>
                <Badge pill color="" class="p-1 px-2 badge-soft-secondary">FREE</Badge>
            </h4>
            <h6 class="text-uppercase mt-3">Storage</h6>
            <Progress value="46" color="success" class="progress-sm my-2"/>
            <p class="text-muted font-13 mb-0">7.02 GB (46%) of 15 GB used</p>
        </div>
    </CardBody>
</div>

<Modal isOpen="{modal}" toggle="{toggleModal}" size="lg" header="New Message">
    <ModalBody>
        <div class="overflow-hidden">
            <div class="mb-2">
                <input type="email" class="form-control" id="toEmail" placeholder="To: "/>
            </div>
            <div class="mb-2">
                <input type="text" class="form-control" id="subject" placeholder="Subject "/>
            </div>

            <div class="my-2">
                <QuillEditor id="snow-editor2" height="{200}" options={editorOptions}/>
            </div>

            <div class="d-flex float-end">
                <Dropdown class="me-1">
                    <DropdownToggle color="" class="p-0">
                        <a href={"#"}
                           class=" arrow-none btn btn-light">
                            <i class="bx bx-dots-vertical-rounded fs-18"></i>
                        </a>
                    </DropdownToggle>
                    <DropdownMenu>
                        <DropdownItem>Default to full
                            screen
                        </DropdownItem>
                        <DropdownItem divider/>
                        <DropdownItem>Label</DropdownItem>
                        <DropdownItem>Palin text mode</DropdownItem>
                        <DropdownItem divider/>
                        <DropdownItem>Smart Compose
                            Feedback
                        </DropdownItem>
                    </DropdownMenu>
                </Dropdown>
                <a href={"#"} class="btn btn-light compose-close"><i
                        class="bx bxs-trash fs-18"></i></a>
            </div>
            <div>
                <a href={"#"} class="btn btn-primary">Send</a>
            </div>
        </div>
    </ModalBody>
</Modal>