<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Button, Col, Input, Row} from "@sveltestrap/sveltestrap";
    import {helpData} from "./components/data";
    import HelpCard from "./components/HelpCard.svelte";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Help" subTitle="Calendar"/>
    <Row>
        <Col>
            <Row class="d-flex justify-content-center text-center mt-4 pb-5">
                <Col md="8" lg="6" xl="4">
                    <h3 class="fw-semibold">Search for a question</h3>
                    <p class="mb-3 text-muted">Type your question or search keyword</p>
                    <div class="search-bar">
                        <span><i class="bx bx-search-alt"></i></span>
                        <Input type="email" id="search" placeholder="Start typing..."/>
                    </div>
                </Col>
            </Row>
        </Col>
    </Row>

    <Row class="d-flex justify-content-center my-4">
        {#each helpData as help}
            <Col md="6" lg="4" class="mb-3">
                <HelpCard help="{help}"/>
            </Col>
        {/each}
    </Row>

    <Row class="mb-5">
        <Col xs="12" class="text-center">
            <h4>Can't find a questions?</h4>
            <Button type="button" color="success" size="sm" class="mt-2"><i class="bx bx-envelope me-1"></i> Email
                us your question
            </Button>
            <Button type="button" color="info" size="sm" class="mt-2 ms-1"><i class="bx bxl-twitter me-1"></i> Send
                us a tweet
            </Button>
        </Col>
    </Row>
</DefaultLayout>