<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import ProductDetails from "../components/ProductDetails.svelte";
    import OrderDescription from "../components/OrderDescription.svelte";
    import ShippingInformation from "../components/ShippingInformation.svelte";
    import BillingInformation from "../components/BillingInformation.svelte";
    import DeliveryInformation from "../components/DeliveryInformation.svelte";

    export let data;

</script>

<DefaultLayout>
    <PageBreadcrumb title="Order Details" subTitle="Ecommerce"/>
    <Row class="justify-content-center">
        <Col lg="8" xl="7">
            <ul class="progressbar ps-0 my-5 pb-5">
                <li class="active">Order Placed</li>
                <li>Packed</li>
                <li>Shipped</li>
                <li>Delivered</li>
            </ul>
        </Col>
    </Row>

    <Row>
        <ProductDetails id={data.id}/>
        <OrderDescription id={data.id}/>
    </Row>

    <Row>
        <ShippingInformation/>
        <BillingInformation/>
        <DeliveryInformation id={data.id}/>
    </Row>
</DefaultLayout>