<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Badge, Col, Input, Row, Table} from "@sveltestrap/sveltestrap";

    const avatar1 = '/images/users/avatar-1.jpg'
    const avatar2 = '/images/users/avatar-2.jpg'
    const avatar4 = '/images/users/avatar-4.jpg'
    const avatar6 = '/images/users/avatar-6.jpg'
    const avatar7 = '/images/users/avatar-7.jpg'
    const avatar8 = '/images/users/avatar-8.jpg'

    const tableData = {
        head: ['#', 'First', 'Last', 'Handle'],
        body: [
            {
                column1: 1,
                column2: 'Mark',
                column3: 'Otto',
                column4: '@mdo'
            },
            {
                column1: 2,
                column2: 'Jacob',
                column3: 'Thornton',
                column4: '@fat'
            },
            {
                column1: 3,
                column2: 'Larry the Bird',
                column3: 'Simsons',
                column4: '@twitter'
            }
        ],
        foot: ['Footer', 'Footer', 'Footer', 'Footer']
    }

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Example'
        },
        {
            id: 'inverse',
            title: 'Inverse Table'
        },
        {
            id: 'striped',
            title: 'Striped Rows Table'
        },
        {
            id: 'hoverable-row',
            title: 'Hoverable rows'
        },
        {
            id: 'active',
            title: 'Active Table'
        },
        {
            id: 'bordered',
            title: 'Bordered Table'
        },
        {
            id: 'border-color',
            title: 'Bordered Color Table'
        },
        {
            id: 'borderless',
            title: 'Basic Borderless Table'
        },
        {
            id: 'small',
            title: 'Small Table'
        },
        {
            id: 'alignment',
            title: 'Alignment Table'
        },
        {
            id: 'nesting',
            title: 'Nesting Table'
        },
        {
            id: 'head-option',
            title: 'Table head options Table'
        },
        {
            id: 'tablefoot',
            title: 'Tablefoot'
        },
        {
            id: 'captions',
            title: 'Captions'
        },
        {
            id: 'responsive',
            title: 'Always Responsive Table'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Basic" subTitle="Tables"/>

    <Row>
        <Col xl="9">
            <UIComponentCard id="basic" title="Basic Example">
                <Table responsive class="table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="inverse" title="Variants">
                <Table responsive class="mb-0">
                    <thead>
                    <tr>
                        <th scope="col">Class</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Heading</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Default</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>

                    <tr class="table-primary">
                        <td>Primary</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    <tr class="table-secondary">
                        <td>Secondary</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    <tr class="table-success">
                        <td>Success</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    <tr class="table-danger">
                        <td>Danger</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    <tr class="table-warning">
                        <td>Warning</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    <tr class="table-info">
                        <td>Info</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    <tr class="table-light">
                        <td>Light</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    <tr class="table-dark">
                        <td>Dark</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="striped" title="Striped Rows Table">
                <Table striped responsive class="table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="striped" title="Striped Rows Table Dark">
                <Table striped responsive class="table-dark table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="striped" title="Striped Rows Table Success">
                <Table striped responsive class="table-success table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard title="Striped columns" id="">
                <Table responsive class="table-striped-columns table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard title="Striped columns Dark" id="">
                <Table responsive class="table-dark table-striped-columns table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard title="Striped columns Success" id="">
                <Table color="success" responsive class="table-success table-striped-columns table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="hoverable-row" title="Hoverable rows">
                <Table responsive hover class="table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="active" title="Active Tables">
                <Table responsive class="table-centered mb-0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-active">
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="table-active">Larry the Bird</td>
                        <td>Simsons</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard title="Active Tables Dark" id="">
                <Table responsive class="table-dark table-centered mb-0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="table-active">
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="table-active">Larry the Bird</td>
                        <td>Simsons</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="bordered" title="Bordered Table">
                <Table responsive bordered class="mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="border-color" title="Bordered color Table">
                <Table responsive bordered class="border-primary table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="borderless" title="Tables without borders">
                <Table responsive borderless class="table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard title="Tables without borders Dark" id="">
                <Table responsive borderless class="table-dark table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="small" title="Small tables">
                <Table responsive size="sm" class="table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="small" title="Small Tables Dark">
                <Table responsive size="sm" class="table-dark table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="dividers" title="Table group dividers">
                <Table responsive class="table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="alignment" title="Vertical alignment">
                <Table responsive class="align-middle table-centered mb-0">
                    <thead>
                    <tr>
                        <th scope="col" class="w-25">Heading 1</th>
                        <th scope="col" class="w-25">Heading 2</th>
                        <th scope="col" class="w-25">Heading 3</th>
                        <th scope="col" class="w-25">Heading 4</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>This cell inherits <code>align: middle;</code> from the table</td>
                        <td>This cell inherits <code>align: middle;</code> from the table</td>
                        <td>This cell inherits <code>align: middle;</code> from the table</td>
                        <td>This here is some placeholder text, intended to take up quite a bit of vertical space,
                            to demonstrate how the vertical alignment works in the preceding cells.
                        </td>
                    </tr>
                    <tr>
                        <td>This cell inherits <code>align: bottom;</code> from the table row</td>
                        <td>This cell inherits <code>align: bottom;</code> from the table row</td>
                        <td>This cell inherits <code>align: bottom;</code> from the table row</td>
                        <td>This here is some placeholder text, intended to take up quite a bit of vertical space,
                            to demonstrate how the vertical alignment works in the preceding cells.
                        </td>
                    </tr>
                    <tr>
                        <td>This cell inherits <code>align: middle;</code> from the table</td>
                        <td>This cell inherits <code>align: middle;</code> from the table</td>
                        <td class="align-top">This cell is aligned to the top.</td>
                        <td>This here is some placeholder text, intended to take up quite a bit of vertical space,
                            to demonstrate how the vertical alignment works in the preceding cells.
                        </td>
                    </tr>
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="nesting" title="Nesting Table">
                <Table responsive bordered striped class="table-centered mb-0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <Table class="mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Header</th>
                                    <th scope="col">Header</th>
                                    <th scope="col">Header</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>A</td>
                                    <td>First</td>
                                    <td>Last</td>
                                </tr>
                                <tr>
                                    <td>B</td>
                                    <td>First</td>
                                    <td>Last</td>
                                </tr>
                                <tr>
                                    <td>C</td>
                                    <td>First</td>
                                    <td>Last</td>
                                </tr>
                                </tbody>
                            </Table>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="head-option" title="Table head">
                <Table responsive class="table-centered mb-0">
                    <thead class="table-light">
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="tablehead" title="Table head Dark">
                <Table responsive class="table-centered mb-0">
                    <thead class="table-dark">
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="tablefoot" title="Table foot">
                <Table responsive class="table-centered mb-0">
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                    <tfoot>
                    <tr>
                        {#each tableData.foot as footer}
                            <td>{footer}</td>
                        {/each}
                    </tr>
                    </tfoot>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="captions" title="Captions">
                <Table responsive class="table-centered mb-0">
                    <caption>
                        List of users
                    </caption>
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="captions" title="Captions">
                <Table responsive class="caption-top table-centered mb-0">
                    <caption>
                        List of users
                    </caption>
                    <thead>
                    <tr>
                        {#each tableData.head as header}
                            <th scope="col">{header}</th>
                        {/each}
                    </tr>
                    </thead>
                    <tbody>
                    {#each tableData.body as item}
                        <tr>
                            <td>{item.column1}</td>
                            <td>{item.column2}</td>
                            <td>{item.column3}</td>
                            <td>{item.column4}</td>
                        </tr>
                    {/each}
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="responsive" title="Always responsive">
                <Table responsive class="table-centered mb-0">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Heading</th>
                        <th scope="col">Heading</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                        <td>Cell</td>
                    </tr>
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="responsive" title="With avatars">
                <Table responsive hover class="table-centered mb-0">
                    <thead class="table-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <img src={avatar2} alt="" class="avatar-sm rounded-circle"/>
                                <div class="d-block">
                                    <h5 class="mb-0">Tony M. Carter</h5>
                                </div>
                            </div>
                        </td>
                        <td>Designer</td>
                        <td>tonymcarter@jourrapide.com</td>
                        <td>Member</td>
                        <td><a href={"#"} class="btn btn-primary btn-sm w-100">Edit</a></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <img src={avatar1} alt="" class="avatar-sm rounded-circle"/>
                                <div class="d-block">
                                    <h5 class="mb-0">James E. Chamb</h5>
                                </div>
                            </div>
                        </td>
                        <td>UI/UX Designer</td>
                        <td>jamesechambliss@teleworm.us</td>
                        <td>Admin</td>
                        <td><a href={"#"} class="btn btn-primary btn-sm w-100">Edit</a></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <img src={avatar4} alt="" class="avatar-sm rounded-circle"/>
                                <div class="d-block">
                                    <h5 class="mb-0">Charlotte J. Torres</h5>
                                </div>
                            </div>
                        </td>
                        <td>Copywriter</td>
                        <td>charlotte@jourrapide.com</td>
                        <td>Member</td>
                        <td><a href={"#"} class="btn btn-primary btn-sm w-100">Edit</a></td>
                    </tr>
                    <tr class="table-active">
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <img src={avatar6} alt="" class="avatar-sm rounded-circle"/>
                                <div class="d-block">
                                    <h5 class="mb-0 d-flex align-items-center gap-1">Mary J. Germain<i
                                            class="bx bxs-badge-check text-success"></i></h5>
                                </div>
                            </div>
                        </td>
                        <td>Full Stack</td>
                        <td>maryjgermain@jourrapide.com</td>
                        <td>CEO</td>
                        <td><a href={"#"} class="btn btn-primary btn-sm w-100">Edit</a></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <img src={avatar7} alt="" class="avatar-sm rounded-circle"/>
                                <div class="d-block">
                                    <h5 class="mb-0">Kevin C. Reyes</h5>
                                </div>
                            </div>
                        </td>
                        <td>Director of Product</td>
                        <td>kevincreyes@jourrapide.com</td>
                        <td>Member</td>
                        <td><a href={"#"} class="btn btn-primary btn-sm w-100">Edit</a></td>
                    </tr>
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="responsive" title="With checkboxes">
                <Table responsive striped borderless class="table-centered mb-0">
                    <thead class="table-light">
                    <tr>
                        <th scope="col">
                            <div class="form-check">
                                <Input type="checkbox" id="flexCheckDefault5"/>
                            </div>
                        </th>
                        <th scope="col">Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="form-check">
                                <Input type="checkbox" id="flexCheckDefault"/>
                            </div>
                        </td>
                        <td> Tony M. Carter</td>
                        <td>Designer</td>
                        <td>tonymcarter@jourrapide.com</td>
                        <td>Member</td>
                        <td><a href={"#"} class="btn btn-primary btn-sm w-100">Edit</a></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <Input type="checkbox" id="flexCheckDefault2"/>
                            </div>
                        </td>
                        <td>James E. Chamb</td>
                        <td>UI/UX Designer</td>
                        <td>jamesechambliss@teleworm.us</td>
                        <td>Admin</td>
                        <td><a href={"#"} class="btn btn-primary btn-sm w-100">Edit</a></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <Input type="checkbox" id="flexCheckDefault3"/>
                            </div>
                        </td>
                        <td> Charlotte J. Torres</td>
                        <td>Copywriter</td>
                        <td>charlotte@jourrapide.com</td>
                        <td>Member</td>
                        <td><a href={"#"} class="btn btn-primary btn-sm w-100">Edit</a></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <Input type="checkbox" id="flexCheckDefault4"/>
                            </div>
                        </td>
                        <td> Mary J. Germain <i class="bx bxs-badge-check text-success"></i></td>
                        <td>Full Stack</td>
                        <td>maryjgermain@jourrapide.com</td>
                        <td>CEO</td>
                        <td><a href={"#"} class="btn btn-primary btn-sm w-100">Edit</a></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <Input type="checkbox" id="flexCheckDefault5"/>
                            </div>
                        </td>
                        <td>Kevin C. Reyes</td>
                        <td>Director of Product</td>
                        <td>kevincreyes@jourrapide.com</td>
                        <td>Member</td>
                        <td><a href={"#"} class="btn btn-primary btn-sm w-100">Edit</a></td>
                    </tr>
                    </tbody>
                </Table>
            </UIComponentCard>

            <UIComponentCard id="nesting1" title="Nesting Table">
                <Table responsive striped bordered class="table-centered mb-0">
                    <thead>
                    <tr>
                        <th scope="col">Invoice Number</th>
                        <th scope="col">Invoice Amount</th>
                        <th scope="col">Confirmation by the client</th>
                        <th scope="col">Planned payment date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>F-011221/21</td>
                        <td>$ 879.500</td>
                        <td>11/05/2023</td>
                        <td>12/05/2023</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <Table class="mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">ERP number</th>
                                    <th scope="col">Carrier legal entity</th>
                                    <th scope="col">Responsible logistician</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>3-128-3</td>
                                    <td>ToBrookfield Asset Management</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <img src={avatar7} alt="" class="avatar-sm rounded-circle"/>
                                            <div class="d-block">
                                                <h5 class="mb-0">Kevin C. Reyes</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <Badge color=""
                                               class="bg-success-subtle text-success py-1 px-2">Verified
                                        </Badge>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3-128-2</td>
                                    <td>Brookfield Asset Management</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <img src={avatar6} alt="" class="avatar-sm rounded-circle"/>
                                            <div class="d-block">
                                                <h5 class="mb-0">Mary J. Germain</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <Badge color=""
                                               class="bg-warning-subtle text-warning py-1 px-2">Pending
                                        </Badge>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3-128-1</td>
                                    <td>Westfield Asset Management</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <img src={avatar8} alt="" class="avatar-sm rounded-circle"/>
                                            <div class="d-block">
                                                <h5 class="mb-0">Charlotte J. Torres</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <Badge color="" class="bg-danger-subtle text-danger py-1 px-2">
                                            Rejected
                                        </Badge>
                                    </td>
                                </tr>
                                </tbody>
                            </Table>
                        </td>
                    </tr>
                    <tr>
                        <td>F-011221/19</td>
                        <td>$ 93.250</td>
                        <td>9/05/2023</td>
                        <td>10/05/2023</td>
                    </tr>
                    </tbody>
                </Table>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>