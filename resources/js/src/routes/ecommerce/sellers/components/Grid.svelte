<script lang="ts">
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import SellerCard from "./SellerCard.svelte";
    import {sellersList} from "./data";
</script>

<Row class="row-cols-1 row-cols-md-2 row-cols-xl-5 gx-3">
    {#each sellersList as seller}
        <Col>
            <SellerCard seller={seller}/>
        </Col>
    {/each}
</Row>