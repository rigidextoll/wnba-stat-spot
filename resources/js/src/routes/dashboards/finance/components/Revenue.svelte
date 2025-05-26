<script lang="ts">
    import {Button, Card, CardBody, CardHeader, CardTitle} from "@sveltestrap/sveltestrap";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import {revenueCartOptions} from "./data";
</script>

<Card>
    <CardHeader class="d-flex justify-content-between align-items-center">
        <CardTitle>Revenue</CardTitle>
        <div>
            <Button outline color="light" size="sm" class="me-1">ALL</Button>
            <Button outline color="light" size="sm" class="me-1">1M</Button>
            <Button outline color="light" size="sm" class="me-1">6M</Button>
            <Button outline color="light" size="sm" class="active">1Y</Button>
        </div>
    </CardHeader>

    <CardBody>
        <div dir="ltr">
            <ApexChart id="revenue" options={revenueCartOptions}/>
        </div>
    </CardBody>
</Card>