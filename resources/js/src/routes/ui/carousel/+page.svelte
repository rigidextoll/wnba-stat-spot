<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Row, Col, Carousel, CarouselItem, CarouselControl, CarouselIndicators} from "@sveltestrap/sveltestrap";

    const smallImg1 = '/images/small/img-1.jpg'
    const smallImg2 = '/images/small/img-2.jpg'
    const smallImg3 = '/images/small/img-3.jpg'
    const smallImg4 = '/images/small/img-4.jpg'
    const smallImg5 = '/images/small/img-5.jpg'
    const smallImg6 = '/images/small/img-6.jpg'
    const smallImg7 = '/images/small/img-7.jpg'
    const smallImg8 = '/images/small/img-8.jpg'
    const smallImg9 = '/images/small/img-9.jpg'
    const smallImg10 = '/images/small/img-10.jpg'

    const anchorNavigation = [
        {
            id: 'slides-only',
            title: 'Slide Only'
        },
        {
            id: 'with-controls',
            title: 'With Controls'
        },
        {
            id: 'with-indicators',
            title: 'With Indicators'
        }
    ]

    const items = [smallImg2, smallImg3, smallImg4];
    let activeIndex = 0;
</script>

<DefaultLayout>
    <PageBreadcrumb title="Carousel" subTitle="Base UI"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="Slides Only" id="slides-only">
                <Row>
                    <Col lg="6">
                        <div class="mx-auto">
                            <Carousel {items} bind:activeIndex>
                                <div class="carousel-inner">
                                    {#each items as item, idx}
                                        <CarouselItem bind:activeIndex itemIndex={idx}>
                                            <img src={item} alt="" class="d-block w-100"/>
                                        </CarouselItem>
                                    {/each}
                                </div>
                            </Carousel>
                        </div>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="With Controls" id="with-controls"
                             caption="Adding in the previous and next controls:">
                <Row>
                    <Col lg="6">
                        <Carousel {items} bind:activeIndex>
                            <div class="carousel-inner">
                                {#each items as item, idx}
                                    <CarouselItem bind:activeIndex itemIndex={idx}>
                                        <img src={item} alt="" class="d-block w-100"/>
                                    </CarouselItem>
                                {/each}
                            </div>

                            <CarouselControl direction="prev" bind:activeIndex {items}/>
                            <CarouselControl direction="next" bind:activeIndex {items}/>

                        </Carousel>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard title="With Indicators" id="with-indicators"
                             caption="You can also add the indicators to the carousel, alongside the controls, too.">
                <Row>
                    <Col lg="6">
                        <Carousel {items} bind:activeIndex>

                            <CarouselIndicators bind:activeIndex {items}/>

                            <div class="carousel-inner">
                                {#each items as item, idx}
                                    <CarouselItem bind:activeIndex itemIndex={idx}>
                                        <img src={item} alt="" class="d-block w-100"/>
                                    </CarouselItem>
                                {/each}
                            </div>

                            <CarouselControl direction="prev" bind:activeIndex {items}/>
                            <CarouselControl direction="next" bind:activeIndex {items}/>

                        </Carousel>
                    </Col>
                </Row>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>