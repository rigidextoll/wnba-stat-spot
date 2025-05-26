<script lang="ts">
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import CustomerCard from "./CustomerCard.svelte";
    import {customerList} from "./data";
</script>

<Row class="row-cols-1 row-cols-md-2 row-cols-xl-5 gx-3">
    {#each customerList as customer}
        <Col>
            <CustomerCard customer={customer}/>
        </Col>
    {/each}
</Row>