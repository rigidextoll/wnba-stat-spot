<script lang="ts">
    import {onMount} from "svelte";
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Button, Col, Form, Input, Row, Toast, ToastBody, ToastHeader} from "@sveltestrap/sveltestrap";

    const logoDark = '/images/logo-dark.png'
    const logoLight = '/images/logo-light.png'


    const anchorNavigation = [
        {
            id: 'basic_examples',
            title: 'Basic Examples'
        },
        {
            id: 'live_example',
            title: 'Live example'
        },
        {
            id: 'default_buttons',
            title: 'Default Buttons'
        },
        {
            id: 'custom_content',
            title: 'Custom Content'
        },
        {
            id: 'transcluent',
            title: 'Transcluent'
        },
        {
            id: 'placement',
            title: 'Placement'
        }
    ]

    let liveExample = false

    onMount(async () => {
        const bootstrap = (await import('bootstrap'))
        // Default
        const toastDefaultTrigger = document.getElementById('liveToastDefaultBtn')
        if (toastDefaultTrigger) {
            toastDefaultTrigger.addEventListener('click', () => {
                liveExample = true
                setInterval(() => {
                    liveExample = false
                }, 3000)
            })
        }

        // Stacking Example
        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast') as HTMLElement
        if (toastTrigger) {
            toastTrigger.addEventListener('click', () => {
                const toast = new bootstrap.Toast(toastLiveExample)

                toast.show()
            })
        }

        const toastTrigger2 = document.getElementById('liveToastBtn2')
        const toastLiveExample2 = document.getElementById('liveToast2') as HTMLElement
        if (toastTrigger2) {
            toastTrigger2.addEventListener('click', () => {
                const toast = new bootstrap.Toast(toastLiveExample2)
                toast.show()
            })
        }
    })

    let selected: string = ''
    const options = [
        {
            value: '',
            text: 'Select a position...'
        },
        {
            value: 'top-0 start-0',
            text: 'Top left'
        },
        {
            value: 'top-0 start-50 translate-middle-x',
            text: 'Top center'
        },
        {
            value: 'top-0 end-0',
            text: 'Top right'
        },
        {
            value: 'top-50 start-0 translate-middle-y',
            text: 'Middle left'
        },
        {
            value: 'top-50 start-50 translate-middle',
            text: 'Middle center'
        },
        {
            value: 'top-50 end-0 translate-middle-y',
            text: 'Middle right'
        },
        {
            value: 'bottom-0 start-0',
            text: 'Bottom left'
        },
        {
            value: 'bottom-0 start-50 translate-middle-x',
            text: 'Bottom center'
        },
        {
            value: 'bottom-0 end-0',
            text: 'Bottom right'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Toasts" subTitle="Base UI"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Examples" id="basic_examples"
                             caption="Toasts are as flexible as you need and have very little required markup. At a minimum, we require a single element to contain your “toasted” content and strongly encourage a dismiss button.">
                <Toast>
                    <ToastHeader>
                        <div class="auth-logo">
                            <img class="logo-dark" src={logoDark} alt="logo-dark" height="18"/>
                            <img class="logo-light" src={logoLight} alt="logo-light" height="18"/>
                        </div>
                    </ToastHeader>
                    <ToastBody>
                        Hello, world! This is a toast message.
                    </ToastBody>
                </Toast>
            </UIComponentCard>

            <UIComponentCard title="Live example" id="live_example"
                             caption="Click the button below to show a toast (positioned with our utilities in the lower right corner) that has been hidden by default.">
                <Button color="primary" on:click={() => liveExample = !liveExample}> Show live toast</Button>

                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <Toast isOpen={liveExample} toggle={() => liveExample = !liveExample}>
                        <ToastHeader>
                            <div class="auth-logo">
                                <img class="logo-dark" src={logoDark} alt="logo-dark" height="18"/>
                                <img class="logo-light" src={logoLight} alt="logo-light" height="18"/>
                            </div>
                        </ToastHeader>
                        <ToastBody>
                            Hello, world! This is a toast message.
                        </ToastBody>
                    </Toast>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Default Buttons" id="default_buttons"
                             caption="Toasts are as flexible as you need and have very little required markup. At a minimum, we require a single element to contain your “toasted” content and strongly encourage a dismiss button.">
                <Button color="primary" id="liveToastBtn" class="me-2"> Show live toast</Button>
                <Button color="primary" id="liveToastBtn2"> Show live toast</Button>

                <div class="toast-container position-fixed end-0 top-0 p-3">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <div class="auth-logo me-auto">
                                <img class="logo-dark" src={logoDark} alt="logo-dark" height="18"/>
                                <img class="logo-light" src={logoLight} alt="logo-light" height="18"/>
                            </div>
                            <small class="text-muted">just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">See? Just like this.</div>
                    </div>

                    <div id="liveToast2" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <div class="auth-logo me-auto">
                                <img class="logo-dark" src={logoDark} alt="logo-dark" height="18"/>
                                <img class="logo-light" src={logoLight} alt="logo-light" height="18"/>
                            </div>
                            <small class="text-muted">2 seconds ago</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">Heads up, toasts will stack automatically</div>
                    </div>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Custom Content" id="custom_content"
                             caption="Alternatively, you can also add additional controls and components to toasts.">
                <Row>
                    <Col md="6">
                        <div class="toast fade show align-items-center mb-3" role="alert" aria-live="assertive"
                             aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">Hello, world! This is a toast message.</div>
                                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                                        aria-label="Close"></button>
                            </div>
                        </div>
                    </Col>
                    <Col md="6">
                        <div class="toast fade show align-items-center text-bg-primary mb-3" role="alert"
                             aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">Hello, world! This is a toast message.</div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </Col>
                </Row>

                <Row>
                    <Col md="6">
                        <div class="toast fade show mb-3 mb-md-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-body">
                                Hello, world! This is a toast message.
                                <div class="mt-2 pt-2 border-top">
                                    <button type="button" class="btn btn-primary btn-sm me-1">Take action</button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </Col>
                    <Col md="6">
                        <div class="toast fade show text-bg-primary" role="alert" aria-live="assertive"
                             aria-atomic="true">
                            <div class="toast-body">
                                Hello, world! This is a toast message.
                                <div class="mt-2 pt-2 border-top">
                                    <button type="button" class="btn btn-light btn-sm me-1">Take action</button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="Transcluent" id="transcluent"
                             caption="Toasts are slightly translucent, too, so they blend over whatever they might appear over. For browsers that support the backdrop-filter CSS property, we’ll also attempt to blur the elements under a toast.">
                <div class="p-3 bg-light">
                    <Toast>
                        <ToastHeader>
                            <div class="auth-logo">
                                <img class="logo-dark" src={logoDark} alt="logo-dark" height="18"/>
                                <img class="logo-light" src={logoLight} alt="logo-light" height="18"/>
                            </div>
                        </ToastHeader>
                        <ToastBody>
                            Hello, world! This is a toast message.
                        </ToastBody>
                    </Toast>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Placement" id="placement">
                <div aria-live="polite" aria-atomic="true" class="bg-light position-relative mt-3"
                     style="min-height: 350px">
                    <div class="toast-container position-absolute p-3 {selected}" id="toastPlacement">
                        <Toast>
                            <ToastHeader>
                                <div class="auth-logo">
                                    <img class="logo-dark" src={logoDark} alt="logo-dark" height="18"/>
                                    <img class="logo-light" src={logoLight} alt="logo-light" height="18"/>
                                </div>
                            </ToastHeader>
                            <ToastBody>
                                Hello, world! This is a toast message.
                            </ToastBody>
                        </Toast>
                    </div>
                </div>

                <Form>
                    <div class="my-3">
                        <label for="selectToastPlacement" class="form-label">Toast placement</label>
                        <Input bind:value={selected} type="select" class="mt-2" id="selectToastPlacement">
                            {#each options as option}
                                <option value={option.value}>{option.text}</option>
                            {/each}
                        </Input>
                    </div>
                </Form>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
