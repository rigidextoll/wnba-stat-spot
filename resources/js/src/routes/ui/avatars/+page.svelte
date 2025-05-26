<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";

    const avatar2 = '/images/users/avatar-2.jpg'
    const avatar3 = '/images/users/avatar-3.jpg'
    const avatar4 = '/images/users/avatar-4.jpg'
    const avatar5 = '/images/users/avatar-5.jpg'
    const avatar6 = '/images/users/avatar-6.jpg'
    const avatar7 = '/images/users/avatar-7.jpg'
    const avatar8 = '/images/users/avatar-8.jpg'
    const avatar9 = '/images/users/avatar-9.jpg'

    const smallImg2 = '/images/small/img-2.jpg'
    const smallImg3 = '/images/small/img-3.jpg'

    const anchorNavigation = [
        {
            id: 'basic-example',
            title: 'Basic Example'
        },
        {
            id: 'rounded-circle',
            title: 'Rounded Circle'
        },
        {
            id: 'images-shapes',
            title: 'Images Shapes'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Avatars" subTitle="Base UI"/>
    <Row>
        <Col xl="9">
            <UIComponentCard id="basic-example" title="Basic Example">
                <Row>
                    <Col md="3">
                        <img src={avatar2} alt="img" class="img-fluid avatar-xs rounded"/>
                        <p>
                            <code>.avatar-xs</code>
                        </p>
                        <img src={avatar3} alt="img" class="img-fluid avatar-sm rounded mt-2"/>
                        <p class="mb-2 mb-sm-0">
                            <code>.avatar-sm</code>
                        </p>
                    </Col>
                    <Col md="3">
                        <img src={avatar4} alt="img" class="img-fluid avatar-md rounded"/>
                        <p>
                            <code>.avatar-md</code>
                        </p>
                    </Col>

                    <Col md="3">
                        <img src={avatar5} alt="img" class="img-fluid avatar-lg rounded"/>
                        <p>
                            <code>.avatar-lg</code>
                        </p>
                    </Col>

                    <Col md="3">
                        <img src={avatar6} alt="img" class="img-fluid avatar-xl rounded"/>
                        <p class="mb-0">
                            <code>.avatar-xl</code>
                        </p>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="rounded-circle" title="Rounded Circle">
                <Row class="mt-3">
                    <Col md="4">
                        <img src={avatar7} alt="img" class="img-fluid avatar-md rounded-circle"/>
                        <p class="mt-1">
                            <code>.avatar-md .rounded-circle</code>
                        </p>
                    </Col>

                    <Col md="4">
                        <img src={avatar8} alt="img" class="img-fluid avatar-lg rounded-circle"/>
                        <p>
                            <code>.avatar-lg .rounded-circle</code>
                        </p>
                    </Col>

                    <Col md="4">
                        <img src={avatar9} alt="img" class="img-fluid avatar-xl rounded-circle"/>
                        <p class="mb-0">
                            <code>.avatar-xl .rounded-circle</code>
                        </p>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="images-shapes" title="Images Shapes"
                             caption="Avatars with different sizes and shapes.">
                <div class="d-flex flex-wrap gap-3 align-items-end">
                    <div>
                        <img src={smallImg2} alt="img" class="img-fluid rounded" width="200"/>
                        <p class="mb-0">
                            <code>.rounded</code>
                        </p>
                    </div>

                    <div>
                        <img src={avatar5} alt="img" class="img-fluid rounded" width="120"/>
                        <p class="mb-0">
                            <code>.rounded</code>
                        </p>
                    </div>

                    <div>
                        <img src={avatar7} alt="img" class="img-fluid rounded-circle" width="120"/>
                        <p class="mb-0">
                            <code>.rounded-circle</code>
                        </p>
                    </div>

                    <div>
                        <img src={smallImg3} alt="img" class="img-fluid img-thumbnail" width="200"/>
                        <p class="mb-0">
                            <code>.img-thumbnail</code>
                        </p>
                    </div>

                    <div>
                        <img src={avatar8} alt="img" class="img-fluid rounded-circle img-thumbnail" width="120"/>
                        <p class="mb-0">
                            <code>.rounded-circle .img-thumbnail</code>
                        </p>
                    </div>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>