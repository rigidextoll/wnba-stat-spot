<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {
        Badge,
        Button,
        Card,
        CardBody,
        Col,
        Input, Pagination,
        PaginationItem,
        PaginationLink,
        Row,
        Table
    } from "@sveltestrap/sveltestrap";
    import {todosData} from "./components/data";
    import {kebabToTitleCase} from "$lib/helpers/change-casing";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Todo" subTitle="Apps"/>
    <Row>
        <Col>
            <Card>
                <CardBody>
                    <div class="d-flex flex-wrap justify-content-between gap-3">
                        <div class="search-bar">
                            <span><i class="bx bx-search-alt"></i></span>
                            <Input type="search" id="search" placeholder="Search task..."/>
                        </div>
                        <div>
                            <a href={"#"} class="btn btn-primary d-inline-flex align-items-center"> <i
                                    class="bx bx-plus me-1"></i>Create Task </a>
                        </div>
                    </div>
                </CardBody>
                <div>
                    <Table responsive class="text-nowrap table-centered mb-0">
                        <thead class="bg-light bg-opacity-50">
                        <tr>
                            <th class="border-0 py-2"> Task Name</th>
                            <th class="border-0 py-2"> Created Date</th>
                            <th class="border-0 py-2"> Due Date</th>
                            <th class="border-0 py-2"> Assigned</th>
                            <th class="border-0 py-2"> Status</th>
                            <th class="border-0 py-2"> Priority</th>
                            <th class="border-0 py-2"> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {#each todosData as todo}
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="form-check form-todo ps-4">
                                            <input type="checkbox" class="form-check-input rounded-circle mt-0 fs-18"
                                                   id="customCheck{todo.id}" checked="{todo.checked}"/>
                                            <label class="form-check-label" for="customCheck{todo.id}">
                                                {todo.taskName}
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {todo.createDate}
                                    <small>{todo.time}</small>
                                </td>
                                <td>{todo.dueDate}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{todo.assigned.avatar}" alt="" class="avatar-xs rounded-circle me-2"/>
                                        <div>
                                            <h5 class="fs-14 mt-1 fw-normal">
                                                {todo.assigned.name}
                                            </h5>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <Badge color=""
                                           class="{todo.status === 'completed' ? 'badge-soft-success' : todo.status === 'new' ? 'badge-soft-info' : todo.status === 'pending' ? 'badge-soft-primary' : 'badge-soft-warning'}">
                                        {kebabToTitleCase(todo.status) }
                                    </Badge>
                                </td>
                                <td class="{todo.priority === 'High' ? 'text-danger' : todo.priority === 'Medium' ? 'text-warning' : 'text-success'}">
                                    <i class="bx bxs-circle me-1"></i>{todo.priority} </td>
                                <td>
                                    <Button type="button" size="sm" color="" class="btn-soft-secondary me-2">
                                        <i class="bx bx-edit fs-16"></i>
                                    </Button>
                                    <Button type="button" size="sm" color="" class="btn-soft-danger">
                                        <i class="bx bx-trash fs-16"></i>
                                    </Button>
                                </td>
                            </tr>
                        {/each}
                        </tbody>
                    </Table>
                    <div class="align-items-center justify-content-between row g-0 text-center text-sm-start p-3 border-top">
                        <div class="col-sm">
                            <div class="text-muted">
                                Showing
                                <span class="fw-semibold">10</span>
                                of
                                <span class="fw-semibold">52</span>
                                tasks
                            </div>
                        </div>
                        <div class="col-sm-auto mt-3 mt-sm-0">
                            <Pagination class="pagination-rounded m-0">
                                <PaginationItem>
                                    <PaginationLink href="#" previous><i class="bx bx-left-arrow-alt"></i>
                                    </PaginationLink>
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
                                    <PaginationLink href="#" next><i class="bx bx-right-arrow-alt"></i></PaginationLink>
                                </PaginationItem>
                            </Pagination>
                        </div>
                    </div>
                </div>
            </Card>
        </Col>
    </Row>
</DefaultLayout>