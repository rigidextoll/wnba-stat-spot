<script lang="ts">
    import {Card, CardBody, CardTitle, Col, Row} from "@sveltestrap/sveltestrap";
    import MemberCard from "./MemberCard.svelte";
    import {teamData} from "./data";
</script>

<Card>
    <CardBody>
        <CardTitle class="fw-bold text-uppercase mb-2"> Our Creative Team</CardTitle>
        <p class="mb-4">A dedicated group of experts committed to crafting visually stunning and highly functional user
            interfaces. With a keen eye for design and a passion for innovation, our team transforms concepts into
            captivating HTML-based interfaces. From sleek layouts to seamless interactions, we deliver UI solutions that
            elevate user experiences and exceed expectations.</p>

        <Row>
            {#each teamData as item}
                <Col xxl="3" md="6">
                    <MemberCard item={item}/>
                </Col>
            {/each}
        </Row>

        <div class="mt-3 text-center">
            <a href="/pages/our-team" class="btn btn-link link-primary text-decoration-underline">
                View All
                <i class="bx bx-right-arrow-alt fs-16 align-middle ms-1"></i>
            </a>
        </div>
    </CardBody>
</Card>