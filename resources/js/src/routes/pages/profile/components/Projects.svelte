<script lang="ts">
    import {
        Card,
        CardBody,
        CardHeader,
        CardTitle,
        Col,
        Dropdown, DropdownItem,
        DropdownMenu,
        DropdownToggle,
        Row
    } from "@sveltestrap/sveltestrap";
    import ProjectsCard from "./ProjectsCard.svelte";
    import {projectData} from "./data";
</script>

<Row>
    <Col>
        <Card>
            <CardHeader class="d-flex align-items-center">
                <CardTitle>Projects</CardTitle>
                <div class="ms-auto">
                    <Dropdown size="sm">
                        <DropdownToggle color="link" class="text-dark p-0">
                            <i class="bx bx-dots-vertical-rounded fs-18 text-dark mb-1"/>
                        </DropdownToggle>

                        <DropdownMenu>
                            <DropdownItem><i class="bx bx-edit-alt me-2"/>Edit Report</DropdownItem>
                            <DropdownItem><i class="bx bx-export me-2"/>Export Report</DropdownItem>
                            <DropdownItem><i class="bx bxs-hand-up me-2"/>Action</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </div>
            </CardHeader>
            <CardBody>
                <Row class="g-3">
                    {#each projectData as item}
                        <Col lg="6">
                            <ProjectsCard item={item}/>
                        </Col>
                    {/each}
                </Row>
            </CardBody>
        </Card>
    </Col>
</Row>