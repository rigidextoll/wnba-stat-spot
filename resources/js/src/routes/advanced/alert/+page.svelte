<script lang="ts">
    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/dist/sweetalert2.css'
    import {onMount} from "svelte";
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Button, Card, CardBody, Col, Row} from "@sveltestrap/sveltestrap";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";

    type TVueSwalInstance = typeof Swal & typeof Swal.fire

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Example'
        },
        {
            id: 'title',
            title: 'A Title with a Text Under'
        },
        {
            id: 'message',
            title: 'Message'
        },
        {
            id: 'longcontent',
            title: 'Long content Images Message'
        },
        {
            id: 'parameter',
            title: 'Parameter'
        }
    ]

    onMount(() => {
        //Basic
        const basic = document.getElementById('sweetalert-basic')
        if (basic) {
            basic.addEventListener('click', function () {
                ;(Swal as TVueSwalInstance).fire({
                    title: 'Any fool can use a computer',
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    // buttonsStyling: false,
                    confirmButtonColor: '#1c84ee',
                    showCloseButton: false
                })
            })
        }

        //A title with a text under
        const sweetalertTitle = document.getElementById('sweetalert-title')
        if (sweetalertTitle) {
            sweetalertTitle.addEventListener('click', function () {
                ;(Swal as TVueSwalInstance).fire({
                    title: 'The Internet?',
                    text: 'That thing is still around?',
                    icon: 'question',
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    confirmButtonColor: '#1c84ee',
                    // buttonsStyling: false,
                    showCloseButton: false
                })
            })
        }

        //Success Message
        const success = document.getElementById('sweetalert-success')
        if (success) {
            success.addEventListener('click', function () {
                ;(Swal as TVueSwalInstance).fire({
                    title: 'Good job!',
                    text: 'You clicked the button!',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                    cancelButtonClass: 'btn btn-danger w-xs mt-2',
                    confirmButtonColor: '#1c84ee',
                    cancelButtonColor: '#ef5f5f',
                    // buttonsStyling: false,
                    showCloseButton: false
                })
            })
        }

        //error Message
        const error = document.getElementById('sweetalert-error')
        if (error) {
            error.addEventListener('click', function () {
                ;(Swal as TVueSwalInstance).fire({
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    icon: 'error',
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    confirmButtonColor: '#1c84ee',
                    // buttonsStyling: false,
                    footer: '<a href="">Why do I have this issue?</a>',
                    showCloseButton: false
                })
            })
        }

        //info Message
        const info = document.getElementById('sweetalert-info')
        if (info) {
            info.addEventListener('click', function () {
                ;(Swal as TVueSwalInstance).fire({
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    icon: 'info',
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    confirmButtonColor: '#1c84ee',
                    // buttonsStyling: false,
                    footer: '<a href="">Why do I have this issue?</a>',
                    showCloseButton: false
                })
            })
        }

        //Warning Message
        const warning = document.getElementById('sweetalert-warning')
        if (warning) {
            warning.addEventListener('click', function () {
                ;(Swal as TVueSwalInstance).fire({
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    icon: 'warning',
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    confirmButtonColor: '#1c84ee',
                    // buttonsStyling: false,
                    footer: '<a href="">Why do I have this issue?</a>',
                    showCloseButton: false
                })
            })
        }

        // long content
        const longContent = document.getElementById('sweetalert-longcontent')
        if (longContent) {
            longContent.addEventListener('click', function () {
                ;(Swal as TVueSwalInstance).fire({
                    imageUrl: 'https://placeholder.pics/svg/300x1500',
                    imageHeight: 1500,
                    imageAlt: 'A tall image',
                    confirmButtonClass: 'btn btn-primary w-xs mt-2',
                    confirmButtonColor: '#1c84ee',
                    // buttonsStyling: false,
                    showCloseButton: false
                })
            })
        }

        //Parameter
        const params = document.getElementById('sweetalert-params')
        if (params) {
            params.addEventListener('click', function () {
                ;(Swal as TVueSwalInstance)
                    .fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                        cancelButtonClass: 'btn btn-danger w-xs mt-2',
                        confirmButtonColor: '#1c84ee',
                        cancelButtonColor: '#ef5f5f',
                        // buttonsStyling: false,
                        showCloseButton: false
                    })
                    .then(function (result: any) {
                        if (result.value) {
                            ;(Swal as TVueSwalInstance).fire({
                                title: 'Deleted!',
                                text: 'Your file has been deleted.',
                                icon: 'success',
                                confirmButtonClass: 'btn btn-primary w-xs mt-2',
                                confirmButtonColor: '#1c84ee'
                                // buttonsStyling: false
                            })
                        } else if (
                            // Read more about handling dismissals
                            result.dismiss === (Swal as TVueSwalInstance).DismissReason.cancel
                        ) {
                            ;(Swal as TVueSwalInstance).fire({
                                title: 'Cancelled',
                                text: 'Your imaginary file is safe :)',
                                icon: 'error',
                                confirmButtonClass: 'btn btn-primary mt-2',
                                confirmButtonColor: '#1c84ee'
                                // buttonsStyling: false
                            })
                        }
                    })
            })
        }
    })
</script>

<DefaultLayout>
    <PageBreadcrumb title="Sweet Alert" subTitle="Advanced UI"/>

    <Row>
        <Col xl="9">
            <Card>
                <CardBody>
                    <h5 class="card-title mb-3 anchor" id="basic">Basic<a class="anchor-link" href="#basic">#</a></h5>

                    <div>
                        <Button color="primary" id="sweetalert-basic"> Click me</Button>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-3 anchor" id="title">A Title with a Text Under<a class="anchor-link"
                                                                                              href="#title">#</a></h5>

                    <div>
                        <Button class="btn btn-primary" id="sweetalert-title"> Click me</Button>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-3 anchor" id="message">Message<a class="anchor-link" href="#message">#</a>
                    </h5>

                    <div class="hstack gap-2">
                        <Button color="success" id="sweetalert-success"> Success</Button>
                        <Button color="warning" id="sweetalert-warning"> Warning</Button>
                        <Button color="info" id="sweetalert-info"> Info</Button>
                        <Button color="danger" id="sweetalert-error"> Error</Button>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-3 anchor" id="longcontent">Long content Images Message<a
                            class="anchor-link" href="#longcontent">#</a></h5>

                    <div>
                        <Button color="primary" id="sweetalert-longcontent"> Click me</Button>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <h5 class="card-title mb-3 anchor" id="parameter">Parameter<a class="anchor-link" href="#parameter">#</a>
                    </h5>

                    <div>
                        <Button color="primary" id="sweetalert-params"> Click me</Button>
                    </div>
                </CardBody>
            </Card>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
