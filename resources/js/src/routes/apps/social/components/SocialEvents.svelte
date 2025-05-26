<script lang="ts">
    import SocialEventsCard from "./SocialEventsCard.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {eventList} from "./data";
</script>

<Row>
    {#each eventList as item}
        <Col lg="6">
            <SocialEventsCard item="{item}"/>
        </Col>
    {/each}
</Row>