<script lang="ts">
    import {
        Card,
        CardBody,
        CardFooter,
        CardHeader,
        CardTitle,
        Col,
        Input,
        Pagination, PaginationItem, PaginationLink,
        Row,
        Table
    } from "@sveltestrap/sveltestrap";
    import {transactionsTableData} from "./data";
    import {kebabToTitleCase} from "$lib/helpers/change-casing";
    import {currency} from "$lib/helpers/constants";

    const transactionTypeOptions = [
        {value: 'all', text: 'All'},
        {value: 'paid', text: 'Paid'},
        {value: 'cancelled', text: 'Cancelled'},
        {value: 'failed', text: 'Failed'},
        {value: 'on-hold', text: 'OnHold'},
    ];

    const perPageItem = 5;

    const tableData = transactionsTableData.body.slice(0, 5);
</script>

<Card>
    <CardHeader class="d-flex justify-content-between align-items-center">
        <CardTitle>Transactions</CardTitle>
        <div class="flex-shrink-0">
            <div class="d-flex gap-2">

                <Input bsSize="sm" type="select">
                    {#each transactionTypeOptions as option}
                        <option value={option.value}>{option.text}</option>
                    {/each}
                </Input>
            </div>
        </div>
    </CardHeader>
    <CardBody class="p-0">
        <div class="table-card mb-0">
            <Table hover borderless responsive class="table-nowrap align-middle mb-0">
                <thead class="bg-light bg-opacity-50">
                <tr>
                    {#each transactionsTableData.header as header}
                        <th scope="col">{header}</th>
                    {/each}
                </tr>
                </thead>

                <tbody>
                {#each tableData as item}
                    <tr>
                        <td>
                            <img src={item.user.avatar} alt="" class="avatar-xs rounded-circle me-1"/>
                            <a href="null" class="text-reset">{item.user.name}</a>
                        </td>
                        <td>{item.description}</td>
                        <td>
                            {#if item.amount > 0}
                                <span>{currency}{Math.abs(item.amount)}</span>
                            {:else }
                                <span class="text-danger">-{currency}{Math.abs(item.amount)}</span>
                            {/if}
                        </td>
                        <td>{item.timestamp}</td>
                        <td>
                            <span class={`badge p-1 ${item.status === 'success' ? 'bg-success-subtle text-success' : item.status === 'cancelled' ? 'bg-info-subtle text-info' : item.status === 'on-hold' ? 'bg-warning-subtle text-warning' : 'bg-danger-subtle text-danger'}`}>
                              {kebabToTitleCase(item.status) }
                            </span>
                        </td>
                    </tr>
                {/each}
                </tbody>
            </Table>
        </div>
    </CardBody>

    <CardFooter class=" border-top border-light">
        <Row class="align-items-center justify-content-between text-center text-sm-start">
            <Col class="col-sm">
                <div class="text-muted">
                    Showing
                    <span class="fw-semibold text-body">{perPageItem}</span> of
                    <span class="fw-semibold">{transactionsTableData.body.length}</span> Transactions
                </div>
            </Col>
            <Col class="col-sm-auto ">
                <Pagination size="sm" class="pagination-boxed justify-content-center">
                    <PaginationItem>
                        <PaginationLink previous href="#"><i class="bx bxs-chevron-left"></i></PaginationLink>
                    </PaginationItem>
                    <PaginationItem active>
                        <PaginationLink href="#">1</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink href="#">2</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink href="#">3</PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                        <PaginationLink next href="#"><i class="bx bxs-chevron-right"></i></PaginationLink>
                    </PaginationItem>
                </Pagination>
            </Col>
        </Row>
    </CardFooter>
</Card>