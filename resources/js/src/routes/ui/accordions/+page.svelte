<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Accordion, AccordionItem, Col, Row} from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'default',
            title: 'Default Example'
        },
        {
            id: 'flush',
            title: 'Flush Accordion'
        },
        {
            id: 'always-open',
            title: 'Always Open'
        }
    ]

    let items = [
        {
            title: 'Accordion Item #1',
            content: '<strong>This is the first item\'s accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.',
            visible: true,
        },
        {
            title: 'Accordion Item #2',
            content: '<strong>This is the second item\'s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.',
            visible: false,
        },
        {
            title: 'Accordion Item #3',
            content: '<strong>This is the third item\'s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It\'s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.',
            visible: false,
        },
    ];
</script>

<DefaultLayout>
    <PageBreadcrumb title="Accordion" subTitle="Base UI"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Example" id="default">
                <Accordion>
                    {#each items as item, idx}
                        <AccordionItem active={idx === 0} header="{item.title}">
                            {@html item.content}
                        </AccordionItem>
                    {/each}
                </Accordion>
            </UIComponentCard>

            <UIComponentCard title="Flush Accordion" id="flush">
                <Accordion flush>
                    {#each items as item, idx}
                        <AccordionItem header="{item.title}">
                            {@html item.content}
                        </AccordionItem>
                    {/each}
                </Accordion>
            </UIComponentCard>

            <UIComponentCard title="Always Open Accordion" id="always-open">
                <Accordion stayOpen>
                    {#each items as item, idx}
                        <AccordionItem header="{item.title}">
                            {@html item.content}
                        </AccordionItem>
                    {/each}
                </Accordion>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
