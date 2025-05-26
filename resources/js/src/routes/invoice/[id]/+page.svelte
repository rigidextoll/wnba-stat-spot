<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Card, CardBody, CardTitle, Col, Row, Table} from "@sveltestrap/sveltestrap";
    import {currency} from "$lib/helpers/constants";

    const logoDark = '/images/logo-dark.png'
    export let data;
    const print = () => {
        window.print()
    }

</script>

<DefaultLayout>
    <PageBreadcrumb title="Invoice Details" subTitle="Invoice"/>
    <Row>
        <Col xs="12">
            <Card>
                <CardBody>
                    <div class="clearfix">
                        <div class="float-sm-end">
                            <div class="auth-logo">
                                <img class="logo-dark me-1" src={logoDark} alt="logo-dark" height="24"/>
                            </div>
                            <address class="mt-3">
                                1729 Bangor St,<br/>
                                Houlton, ME, 04730 <br/>
                                <abbr title="Phone">P:</abbr>
                                (207) 532-9109
                            </address>
                        </div>
                        <div class="float-sm-start">
                            <CardTitle class="mb-2"> Invoice: #{data.id} </CardTitle>
                        </div>
                    </div>

                    <Row class="mt-3">
                        <Col md="6">
                            <h6 class="fw-normal text-muted">Customer</h6>
                            <h6 class="fs-16">Glenn H Smith</h6>
                            <address>
                                135 White Cemetery Rd,<br/>
                                Perryville, KY, 40468<br/>
                                <abbr title="Phone">P:</abbr>
                                (304) 584-4345
                            </address>
                        </Col>
                    </Row>

                    <Row>
                        <Col xs="12">
                            <Table responsive class="text-nowrap table-centered mt-3 mb-0">
                                <thead class="bg-light bg-opacity-50">
                                <tr>
                                    <th class="border-0 py-2"> Product Name</th>
                                    <th class="border-0 py-2"> Quantity</th>
                                    <th class="border-0 py-2"> Price</th>
                                    <th class="text-end border-0 py-2"> Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>G15 Gaming Laptop</td>
                                    <td>3</td>
                                    <td>{currency}240.59</td>
                                    <td class="text-end">{currency}721.77</td>
                                </tr>
                                <tr>
                                    <td>Sony Alpha ILCE 6000Y 24.3 MP Mirrorless Digital SLR Camera</td>
                                    <td>5</td>
                                    <td>{currency}135.99</td>
                                    <td class="text-end">{currency}679.95</td>
                                </tr>
                                <tr>
                                    <td>Sony Over-Ear Wireless Headphone with Mic</td>
                                    <td>1</td>
                                    <td>{currency}99.49</td>
                                    <td class="text-end">{currency}99.49</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td>Adam ROMA USB-C / USB-A 3.1 (2-in-1 Flash Drive) – 128GB</td>
                                    <td>2</td>
                                    <td>{currency}350.19</td>
                                    <td class="text-end">700.38</td>
                                </tr>
                                </tbody>
                            </Table>
                        </Col>
                    </Row>

                    <Row class="mt-3">
                        <Col sm="7">
                            <div class="clearfix pt-xl-3 pt-0">
                                <h6 class="text-muted">Notes:</h6>

                                <small class="text-muted"> All accounts are to be paid within 7 days from receipt of
                                    invoice. To be paid by cheque or credit card or direct payment online. If account is
                                    not paid within 7 days the credits details supplied as confirmation of work
                                    undertaken will be charged the agreed quoted fee noted above. </small>
                            </div>
                        </Col>
                        <Col sm="5">
                            <div class="float-end">
                                <p>
                                    <span class="fw-medium">Sub-total :</span>
                                    <span class="float-end">{currency}2266.59</span>
                                </p>
                                <p>
                                    <span class="fw-medium">Discount (10%) :</span>
                                    <span class="float-end"> &nbsp;&nbsp;&nbsp; {currency}226.659</span>
                                </p>
                                <h3>{currency}2039.931 USD</h3>
                            </div>
                            <div class="clearfix"></div>
                        </Col>
                    </Row>

                    <div class="mt-5 mb-1">
                        <div class="text-end d-print-none">
                            <a href={"#"} on:click={print} class="btn btn-primary me-1">Print</a>
                            <a href={"#"} class="btn btn-outline-primary">Submit</a>
                        </div>
                    </div>
                </CardBody>
            </Card>
        </Col>
    </Row>
</DefaultLayout>