<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Row, Col, Button, Modal, ModalFooter, ModalBody} from "@sveltestrap/sveltestrap";

    let modal = false
    let staticBackdropModal = false
    let scrollingLongModal = false
    let scrollingLongModal1 = false
    let verticalCenteredModal = false
    let verticalCenteredScrollableModal = false

    let extraLargeModal = false
    let largeModal = false
    let smallModal = false

    let fsModal = false

    let primaryAlertModal = false
    let secondaryAlertModal = false
    let successAlertModal = false
    let infoAlertModal = false

    const anchorNavigation = [
        {
            id: 'default',
            title: 'Default Example'
        },
        {
            id: 'static-backdrop',
            title: 'Static Backdrop'
        },
        {
            id: 'scrolling-long-content',
            title: 'Scrolling Long Content'
        },
        {
            id: 'modal-position',
            title: 'Modal Position'
        },
        {
            id: 'optional-sizes',
            title: 'Optional Sizes'
        },
        {
            id: 'fullscreen-modal',
            title: 'Fullscreen Modal'
        },
        {
            id: 'modal-alerts',
            title: 'Modal Based Alerts'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Modal" subTitle="Base UI"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="Default Modals" id="default"
                             caption="Toggle a working modal demo by clicking the button below. It will slide down and fade in from the top of the page.">
                <Button color="primary" on:click={() => modal = !modal}> Launch demo modal</Button>
            </UIComponentCard>

            <UIComponentCard title="Static Backdrop" id="static-backdrop"
                             caption="When backdrop is set to static, the modal will not close when clicking outside of it. Click the button below to try it.">
                <Button color="primary" on:click={() => staticBackdropModal = !staticBackdropModal}> Launch static
                    backdrop
                    modal
                </Button>
            </UIComponentCard>

            <UIComponentCard title="Scrolling Long Content" id="scrolling-long-content"
                             caption="When modals become too long for the user&rsquo;s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.">
                <!-- Button trigger modal -->
                <Button type="button" color="primary" class="me-2"
                        on:click={() => scrollingLongModal = !scrollingLongModal}> Launch demo modal
                </Button>

                <!-- Button trigger modal -->
                <Button color="primary" on:click={() => scrollingLongModal1 = !scrollingLongModal1}> Launch demo modal
                </Button>
            </UIComponentCard>

            <UIComponentCard title="Modal Position" id="modal-position">
                <div class="d-flex flex-wrap gap-2">
                    <!-- Button trigger modal -->
                    <Button color="primary" on:click={() => verticalCenteredModal = !verticalCenteredModal}> Vertically
                        centered modal
                    </Button>

                    <!-- Button trigger modal -->
                    <Button color="primary"
                            on:click={() => verticalCenteredScrollableModal = !verticalCenteredScrollableModal}>
                        Vertically
                        centered scrollable modal
                    </Button>
                </div>

            </UIComponentCard>

            <UIComponentCard title="Optional Sizes" id="optional-sizes">
                <div class="hstack gap-2">
                    <!-- Button trigger modal -->
                    <Button color="primary" on:click={() => extraLargeModal = !extraLargeModal}> Extra large modal
                    </Button>
                    <Button color="primary" on:click={() => largeModal = !largeModal}> Large modal</Button>
                    <Button color="primary" on:click={() => smallModal = !smallModal}> Small modal</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Fullscreen Modal" id="fullscreen-modal">
                <div class="hstack flex-wrap gap-2">
                    <!-- Button trigger modal -->
                    <Button color="primary" on:click={() => fsModal = !fsModal}> Full screen</Button>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Modal Based Alerts" id="modal-alerts">
                <div class="hstack flex-wrap gap-2">
                    <Button color="primary" on:click={() => primaryAlertModal = !primaryAlertModal}> Primary Alert
                    </Button>
                    <Button color="secondary" on:click={() => secondaryAlertModal = !secondaryAlertModal}> Secondary
                        Alert
                    </Button>
                    <Button color="success" on:click={() => successAlertModal = !successAlertModal}> Success Alert
                    </Button>
                    <Button color="info" on:click={() => infoAlertModal = !infoAlertModal}> Info Alert</Button>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>

    <!-- Default Modals  -->
    <Modal isOpen={modal} toggle={() => modal = !modal} header="Modal title">
        <ModalBody>
            <p>Woo-hoo, you're reading this text in a modal!</p>
        </ModalBody>
        <ModalFooter>
            <Button color="primary" on:click={() => modal = !modal}>Do Something</Button>
            <Button color="secondary" on:click={() => modal = !modal}>Cancel</Button>
        </ModalFooter>
    </Modal>

    <!-- Static Backdrop  -->
    <Modal isOpen={staticBackdropModal} header="Modal title" backdrop="static">
        <ModalBody>
            <p>I will not close if you click outside of me. Don't even try to press escape key.</p>
        </ModalBody>
        <ModalFooter>
            <Button color="primary" on:click={() => staticBackdropModal = !staticBackdropModal}>Do Something</Button>
            <Button color="secondary" on:click={() => staticBackdropModal = !staticBackdropModal}>Cancel</Button>
        </ModalFooter>
    </Modal>

    <!-- Scrolling Long Content -->
    <Modal isOpen={scrollingLongModal} toggle={() => scrollingLongModal = !scrollingLongModal} header="Modal title">
        <ModalBody>
            <div style="min-height: 1500px">
                <p>This is some placeholder content to show the scrolling behavior for modals. Instead of repeating the
                    text
                    the modal, we use an inline style set a minimum height, thereby extending the length of the overall
                    modal and demonstrating the overflow scrolling. When content becomes longer than the height of the
                    viewport, scrolling will move the modal as needed.</p>
            </div>
        </ModalBody>
        <ModalFooter>
            <Button color="primary" on:click={() => scrollingLongModal = !scrollingLongModal}>Save changes</Button>
            <Button color="secondary" on:click={() => scrollingLongModal = !scrollingLongModal}>Cancel</Button>
        </ModalFooter>
    </Modal>

    <Modal isOpen={scrollingLongModal1} toggle={() => scrollingLongModal1 = !scrollingLongModal1} header="Modal title"
           scrollable>
        <ModalBody>
            <p>This is some placeholder content to show the scrolling behavior for modals. We use repeated line breaks
                to
                demonstrate how content can exceed minimum inner height, thereby showing inner scrolling. When content
                becomes longer than the predefined max-height of modal, content will be cropped and scrollable within
                the
                modal.</p>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <p>This content should appear at the bottom after you scroll.</p>
        </ModalBody>
        <ModalFooter>
            <Button color="primary" on:click={() => scrollingLongModal = !scrollingLongModal}>Save changes</Button>
            <Button color="secondary" on:click={() => scrollingLongModal = !scrollingLongModal}>Cancel</Button>
        </ModalFooter>
    </Modal>

    <!-- Modal Position  -->
    <Modal isOpen={verticalCenteredModal} toggle={() => verticalCenteredModal =!verticalCenteredModal}
           header="Modal title" centered>
        <ModalBody>
            <p>This is a vertically centered modal.</p>
        </ModalBody>
        <ModalFooter>
            <Button color="primary" on:click={() => verticalCenteredModal = !verticalCenteredModal}>Save changes
            </Button>
            <Button color="secondary" on:click={() => verticalCenteredModal = !verticalCenteredModal}>Cancel</Button>
        </ModalFooter>
    </Modal>

    <Modal isOpen={verticalCenteredScrollableModal}
           toggle={() => verticalCenteredScrollableModal =!verticalCenteredScrollableModal} header="Modal title"
           centered>
        <ModalBody>
            <p>This is some placeholder content to show a vertically centered modal. We've added some extra copy here to
                show how vertically centering the modal works when combined with scrollable modals. We also use some
                repeated line breaks to quickly extend the height of the content, thereby triggering the scrolling. When
                content becomes longer than the predefined max-height of modal, content will be cropped and scrollable
                within the modal.</p>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <p>Just like that.</p>
        </ModalBody>
        <ModalFooter>
            <Button color="primary" on:click={() => verticalCenteredModal = !verticalCenteredModal}>Save changes
            </Button>
            <Button color="secondary" on:click={() => verticalCenteredModal = !verticalCenteredModal}>Cancel</Button>
        </ModalFooter>
    </Modal>

    <!-- Optional Sizes -->
    <Modal isOpen={extraLargeModal}
           toggle={() => extraLargeModal =!extraLargeModal} header="Extra large modal" size="xl">
        <ModalBody>
            ...
        </ModalBody>
    </Modal>
    <Modal isOpen={largeModal}
           toggle={() => largeModal =!largeModal} header="Large modal" size="lg">
        <ModalBody>
            ...
        </ModalBody>
    </Modal>
    <Modal isOpen={smallModal}
           toggle={() => smallModal =!smallModal} header="Small modal" size="sm">
        <ModalBody>
            ...
        </ModalBody>
    </Modal>

    <!--     Fullscreen Modal -->
    <Modal isOpen={fsModal}
           toggle={() => fsModal =!fsModal} header="Full screen modal" fullscreen>
        <ModalBody>
            ...
        </ModalBody>
    </Modal>

    <!-- Modal Based Alerts -->
    <Modal isOpen={primaryAlertModal}
           toggle={() => primaryAlertModal =!primaryAlertModal} size="sm" contentClassName="bg-primary">
        <ModalBody>
            <div class="text-center">
                <i class="bx bx-check-double display-6 mt-0 text-white"></i>
                <h4 class="mt-3 text-white">Well Done!</h4>
                <p class="mt-3 text-white">Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                    facilisis in, egestas eget quam.</p>
                <Button type="button" color="light" class="mt-3"
                        on:click={() => primaryAlertModal = !primaryAlertModal}>
                    Continue
                </Button>
            </div>
        </ModalBody>
    </Modal>

    <Modal isOpen={secondaryAlertModal}
           toggle={() => secondaryAlertModal =!secondaryAlertModal} size="sm" contentClassName="bg-secondary">
        <ModalBody>
            <div class="text-center">
                <i class="bx bx-check-double display-6 mt-0 text-white"></i>
                <h4 class="mt-3 text-white">Well Done!</h4>
                <p class="mt-3 text-white">Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                    facilisis in, egestas eget quam.</p>
                <Button type="button" color="light" class="mt-3"
                        on:click={() => secondaryAlertModal = !secondaryAlertModal}>
                    Continue
                </Button>
            </div>
        </ModalBody>
    </Modal>

    <Modal isOpen={successAlertModal}
           toggle={() => successAlertModal =!successAlertModal} size="sm" contentClassName="bg-success">
        <ModalBody>
            <div class="text-center">
                <i class="bx bx-check-double display-6 mt-0 text-white"></i>
                <h4 class="mt-3 text-white">Well Done!</h4>
                <p class="mt-3 text-white">Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                    facilisis in, egestas eget quam.</p>
                <Button type="button" color="light" class="mt-3"
                        on:click={() => successAlertModal = !successAlertModal}>
                    Continue
                </Button>
            </div>
        </ModalBody>
    </Modal>

    <Modal isOpen={infoAlertModal}
           toggle={() => infoAlertModal =!infoAlertModal} size="sm" contentClassName="bg-info">
        <ModalBody>
            <div class="text-center">
                <i class="bx bx-check-double display-6 mt-0 text-white"></i>
                <h4 class="mt-3 text-white">Well Done!</h4>
                <p class="mt-3 text-white">Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac
                    facilisis in, egestas eget quam.</p>
                <Button type="button" color="light" class="mt-3"
                        on:click={() => infoAlertModal = !infoAlertModal}>
                    Continue
                </Button>
            </div>
        </ModalBody>
    </Modal>

</DefaultLayout>
