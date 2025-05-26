<script lang="ts">
    import {toasts, ToastContainer, FlatToast, BootstrapToast} from "svelte-toasts";
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Button, Card, CardBody, CardTitle, Col, Row} from "@sveltestrap/sveltestrap";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic'
        },
        {
            id: 'display_position',
            title: 'Display Position Example'
        },
        {
            id: 'rater',
            title: 'Theme, Progress & Duration Example'
        }
    ]

    const showToast = async (options: any) => {
        const toast = toasts.add(options)
    }
</script>

<DefaultLayout>
    <PageBreadcrumb title="Toastify" subTitle="Advanced UI"/>

    <Row>
        <Col xl="9">

            <ToastContainer placement="bottom-right" let:data={data}>
                <FlatToast {data}/>
            </ToastContainer>

            <Card>
                <CardBody>
                    <CardTitle class="anchor mb-3" id="basic">
                        Basic Toastify JS Example
                        <a class="anchor-link" href="#basic">#</a>
                    </CardTitle>

                    <div>
                        <div class="hstack flex-wrap gap-2">
                            <Button color="light"
                                    on:click={() => showToast({ description: 'Welcome Back! This is a Toast Notification', placement: 'top-center', duration:3000,theme:'light' }) }
                                    class="w-xs"> Default
                            </Button>

                            <Button color="light"
                                    on:click={()=>showToast( {description:'Your application was successfully sent', type: 'success', placement: 'top-center',theme:'light'})}
                                    class="w-xs"> Success
                            </Button>

                            <Button color="light"
                                    on:click={()=>showToast({description:'Warning ! Something went wrong try again', type: 'warning', placement: 'top-center',theme:'light'})}
                                    class="w-xs"> Warning
                            </Button>

                            <Button color="light"
                                    on:click={()=>showToast({description:'Error ! An error occurred.', type: 'error', placement: 'top-center',theme:'light' })}
                                    class="w-xs"> Error
                            </Button>
                        </div>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <CardTitle class="mb-3 anchor" id="display_position">
                        Display Position Example
                        <a class="anchor-link" href="#display_position">#</a>
                    </CardTitle>

                    <div>
                        <div class="hstack flex-wrap gap-2">
                            <Button color="light"
                                    on:click={()=>showToast({description:'Welcome Back ! This is a Toast Notification', placement: 'top-left',theme:'light', })}
                                    class="w-xs"> Top Left
                            </Button>

                            <Button color="light"
                                    on:click={()=>showToast({description:'Welcome Back ! This is a Toast Notification', placement: 'top-center',theme:'light', })}
                                    class="w-xs"> Top Center
                            </Button>


                            <Button color="light"
                                    on:click={()=>showToast({description:'Welcome Back ! This is a Toast Notification', placement: 'top-right',theme:'light', })}
                                    class="w-xs"> Top Right
                            </Button>

                            <Button color="light"
                                    on:click={()=>showToast({description:'Welcome Back ! This is a Toast Notification', placement: 'bottom-left',theme:'light', })}
                                    class="w-xs"> Bottom Left
                            </Button>

                            <Button color="light"
                                    on:click={()=>showToast({description:'Welcome Back ! This is a Toast Notification', placement: 'bottom-center',theme:'light', })}
                                    class="w-xs">Bottom Center
                            </Button>


                            <Button color="light"
                                    on:click={()=>showToast({description:'Welcome Back ! This is a Toast Notification',  placement: 'bottom-right',theme:'light', })}
                                    class="w-xs">Bottom Right
                            </Button>
                        </div>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <CardTitle class="mb-3 anchor" id="rater">
                        Theme, Progress & Duration Example
                        <a class="anchor-link" href="#rater">#</a>
                    </CardTitle>

                    <div>
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <Button color="light"
                                    on:click={()=>showToast({description:'Welcome Back ! This is a Toast Notification',theme:'dark' })}
                                    class="w-xs">Dark Theme
                            </Button>

                            <Button color="light"
                                    on:click={()=>showToast({description:'Welcome Back ! This is a Toast Notification',theme:'light',showProgress:true })}
                                    class="w-xs">Progress
                            </Button>

                            <Button color="light"
                                    on:click={()=>showToast({description:'Toast Duration 10s',theme:'light',duration:10000 })}
                                    class="w-xs">Duration
                            </Button>
                        </div>
                    </div>
                </CardBody>
            </Card>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
