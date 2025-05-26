<script lang="ts">

    import {onMount} from "svelte";
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Button, Card, CardBody, CardTitle, Col, Row} from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Example'
        },
        {
            id: 'step',
            title: 'Rater with Step Example'
        },
        {
            id: 'custom-message',
            title: 'Custom Messages Example'
        },
        {
            id: 'readOnly',
            title: 'ReadOnly Example'
        },
        {
            id: 'onhover',
            title: 'On Hover Event Example'
        },
        {
            id: 'reset',
            title: 'Clear/Reset Rater Example'
        }
    ]

    onMount(async () => {

        const raterJs = (await import('rater-js/index')).default

        // basic-rater
        if (document.querySelector('#basic-rater')) {
            raterJs({
                starSize: 22,
                rating: 3,
                element: document.querySelector('#basic-rater'),
                rateCallback: function rateCallback(rating: number, done: any) {
                    this.setRating(rating)
                    done()
                }
            })
        }

        // rater-step
        if (document.querySelector('#rater-step')) {
            raterJs({
                starSize: 22,
                rating: 1.5,
                element: document.querySelector('#rater-step'),
                rateCallback: function rateCallback(rating: number, done: any) {
                    this.setRating(rating)
                    done()
                }
            })
        }

        // rater-message
        let messageDataService = {
            rate: function (rating: number) {
                return {
                    then: function (callback: any) {
                        setTimeout(function () {
                            callback(Math.random() * 5)
                        }, 1000)
                    }
                }
            }
        }

        if (document.querySelector('#rater-message')) {
            const starRatingMessage = raterJs({
                isBusyText: 'Rating in progress. Please wait...',
                starSize: 22,
                element: document.querySelector('#rater-message'),
                rateCallback: function rateCallback(rating: number, done: any) {
                    starRatingMessage.setRating(rating)
                    messageDataService.rate(rating).then(function (avgRating: number) {
                        starRatingMessage.setRating(avgRating)
                        done()
                    })
                }
            })
        }

        // rater-unlimitedstar
        if (document.querySelector('#rater-unlimitedstar')) {
            raterJs({
                starSize: 22,
                max: 5,
                readOnly: true,
                rating: 3.5,
                element: document.querySelector('#rater-unlimitedstar')
            })
        }

        // rater-onhover
        if (document.querySelector('#rater-onhover')) {
            raterJs({
                starSize: 22,
                rating: 1,
                element: document.querySelector('#rater-onhover'),
                rateCallback: function rateCallback(rating: number, done: any) {
                    this.setRating(rating)
                    done()
                },
                onHover: function (currentIndex: number, currentRating: number) {
                    document.querySelector('.ratingnum')!.textContent = currentIndex.toString()
                },
                onLeave: function (currentIndex: number, currentRating: number) {
                    document.querySelector('.ratingnum')!.textContent = currentRating.toString()
                }
            })
        }

        // rater-reset
        if (document.querySelector('#raterreset')) {
            const starRatingReset = raterJs({
                starSize: 22,
                rating: 2,
                element: document.querySelector('#raterreset'),
                rateCallback: function rateCallback(rating: number, done: any) {
                    this.setRating(rating)
                    done()
                }
            })

            const resetButton = document.querySelector('#raterreset-button')
            if (resetButton)
                resetButton.addEventListener(
                    'click',
                    function () {
                        starRatingReset.clear()
                    },
                    false
                )
        }
    })
</script>

<DefaultLayout>
    <PageBreadcrumb title="Ratings" subTitle="Advanced UI"/>

    <Row>
        <Col xl="9">
            <Card>
                <CardBody>
                    <CardTitle class="mb-3 anchor" id="basic">
                        Basic Rater Example
                        <a class="anchor-link" href="#basic">#</a>
                    </CardTitle>

                    <div>
                        <div id="basic-rater" dir="ltr"></div>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <CardTitle class="mb-3 anchor" id="step">
                        Rater with Step Example
                        <a class="anchor-link" href="#step">#</a>
                    </CardTitle>

                    <div>
                        <div id="rater-step" dir="ltr"></div>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <CardTitle class="mb-3 anchor" id="custom-message">
                        Custom Messages Example
                        <a class="anchor-link" href="#custom-message">#</a>
                    </CardTitle>

                    <div>
                        <div id="rater-message" dir="ltr"></div>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <CardTitle class="mb-3 anchor" id="readOnly">
                        ReadOnly Example
                        <a class="anchor-link" href="#readOnly">#</a>
                    </CardTitle>

                    <div>
                        <div id="rater-unlimitedstar" dir="ltr"></div>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <CardTitle class="mb-3 anchor" id="onhover">
                        On Hover Event Example
                        <a class="anchor-link" href="#onhover">#</a>
                    </CardTitle>

                    <div>
                        <div dir="ltr">
                            <div id="rater-onhover" class="align-middle"></div>
                            <span class="ratingnum badge bg-info align-middle ms-2"></span>
                        </div>
                    </div>
                </CardBody>
            </Card>

            <Card>
                <CardBody>
                    <CardTitle class="mb-3 anchor" id="reset">
                        Clear/Reset Rater Example
                        <a class="anchor-link link-offset-2" href="#reset">#</a>
                    </CardTitle>

                    <div>
                        <div dir="ltr">
                            <div id="raterreset" class="align-middle"></div>
                            <span class="clear-rating"></span>
                            <Button color="light" size="sm" id="raterreset-button" class="ms-2"> Reset</Button>
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