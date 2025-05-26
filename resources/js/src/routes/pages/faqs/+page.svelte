<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Row, Col, Card, CardBody, Button, Accordion, AccordionItem} from "@sveltestrap/sveltestrap";
    import {faqData} from "./data";
</script>

<DefaultLayout>
    <PageBreadcrumb title="FAQs" subTitle="Pages"/>
    <Row>
        <Col>
            <Card>
                <CardBody class="p-4">
                    <Row class="g-xl-4">
                        <Col xl="6">
                            <h4 class="mb-3 fw-semibold fs-16">General</h4>
                            <Accordion>
                                {#each faqData.General as item,idx}
                                    <AccordionItem header={item.question} active={idx === 0}>
                                        {item.answer}
                                    </AccordionItem>
                                {/each}
                            </Accordion>

                            <h4 class="mb-3 mt-4 fw-semibold fs-16">Refunds</h4>
                            <Accordion>
                                {#each faqData.Refunds as item,idx}
                                    <AccordionItem header={item.question} active={idx === 0}>
                                        {item.answer}
                                    </AccordionItem>
                                {/each}
                            </Accordion>
                        </Col>

                        <Col xl="6">
                            <h4 class="mb-3 fw-semibold fs-16">Payments</h4>
                            <Accordion>
                                {#each faqData.Payments as item,idx}
                                    <AccordionItem header={item.question} active={idx === 0}>
                                        {item.answer}
                                    </AccordionItem>
                                {/each}
                            </Accordion>

                            <h4 class="mb-3 mt-4 fw-semibold fs-16">Support</h4>
                            <Accordion>
                                {#each faqData.Support as item,idx}
                                    <AccordionItem header={item.question} active={idx === 0}>
                                        {item.answer}
                                    </AccordionItem>
                                {/each}
                            </Accordion>
                        </Col>
                    </Row>

                    <Row class="my-5">
                        <Col class="text-center">
                            <h4>Can't find a questions?</h4>
                            <Button color="success" class="mt-2">
                                <i class="bx bx-envelope me-1"></i>
                                Email us your question
                            </Button>
                            <Button color="info" class="mt-2 ms-1">
                                <i class="bx bxl-twitter me-1"></i>
                                Send us a tweet
                            </Button>
                        </Col>
                    </Row>
                </CardBody>
            </Card>
        </Col>
    </Row>
</DefaultLayout>