<script lang="ts">

    import {onMount} from "svelte";
    import AuthLayout from "$lib/layouts/AuthLayout.svelte";
    import {Card, CardBody, Col, Row} from "@sveltestrap/sveltestrap";
    import LogoBox from "$lib/components/LogoBox.svelte";

    const currentDate = new Date()
    const countDown = currentDate.setDate(currentDate.getDate() + 5)
    let timeRemaining = countDown - currentDate.getTime()

    const updateCountdown = () => {
        timeRemaining = countDown - new Date().getTime()
    }

    let days = 0
    let hours = 0
    let minutes = 0
    let seconds = 0

    const calculateTime = () => {
        days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24))
        hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
        minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60))
        seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000)
    }

    onMount(() => {
        const intervalId = setInterval(() => {
            updateCountdown()
            calculateTime()
        }, 1000)

        return () => clearInterval(intervalId)
    })
</script>

<AuthLayout>
    <Col lg="10">
        <Card class="auth-card text-center">
            <CardBody>
                <div class="mx-auto text-center auth-logo my-5">
                    <LogoBox/>
                </div>

                <h2 class="fw-semibold">We Are Launching Soon...</h2>
                <p class="lead mt-3 w-75 mx-auto pb-4 fst-italic">Exciting news is on the horizon! We're thrilled to
                    announce that something incredible is coming your way very soon. Our team has been hard at work
                    behind the scenes, crafting something special just for you.</p>

                <Row class="my-5">
                    <Col>
                        <h3 id="days" class="fw-bold fs-60">
                            {days}
                        </h3>
                        <p class="text-uppercase fw-semibold">Days</p>
                    </Col>
                    <Col>
                        <h3 id="hours" class="fw-bold fs-60">
                            {hours}
                        </h3>
                        <p class="text-uppercase fw-semibold">Hours</p>
                    </Col>
                    <Col>
                        <h3 id="minutes" class="fw-bold fs-60">
                            {minutes}
                        </h3>
                        <p class="text-uppercase fw-semibold">Minutes</p>
                    </Col>
                    <Col>
                        <h3 id="seconds" class="fw-bold fs-60">
                            {seconds}
                        </h3>
                        <p class="text-uppercase fw-semibold">Seconds</p>
                    </Col>
                </Row>

                <a href="/pages/contact-us" class="btn btn-success mb-5">Contact Us</a>
            </CardBody>
        </Card>
    </Col>
</AuthLayout>
