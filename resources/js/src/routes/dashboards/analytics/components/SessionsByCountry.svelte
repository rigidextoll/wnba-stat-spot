<script lang="ts">
    import {
        Card,
        CardBody,
        CardHeader,
        CardTitle,
        Row,
        Col,
        Dropdown,
        DropdownToggle,
        DropdownItem, DropdownMenu, Progress
    } from "@sveltestrap/sveltestrap";
    import Icon from "@iconify/svelte";
    import {sessionData, totalSessions, worldMapOptions} from "./data";
    import JsVectorMap from "$lib/components/JsVectorMap.svelte";

    const calculateProgress = (session: number) => {
        return (session / totalSessions) * 100
    }
</script>

<Card>
    <CardHeader class="d-flex justify-content-between align-items-center border-bottom border-dashed">
        <CardTitle>
            Sessions by Country
        </CardTitle>

        <Dropdown size="sm">
            <DropdownToggle color="light" outline caret>View Data</DropdownToggle>
            <DropdownMenu class="dropdown-menu dropdown-menu-end">
                <DropdownItem>Download</DropdownItem>
                <DropdownItem>Export</DropdownItem>
                <DropdownItem>Import</DropdownItem>
            </DropdownMenu>
        </Dropdown>
    </CardHeader>

    <CardBody class="pt-0">
        <Row class="align-items-center">
            <Col lg="7">
                <JsVectorMap id="world-map-markers" customClass="my-3" height={300} options={worldMapOptions}/>
            </Col>
            <Col lg="5" dir="ltr">
                <div class="p-3 pb-0">

                    {#each sessionData as item}
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-1">
                                <Icon icon={item.country.icon} class="fs-16 align-middle me-1"/>
                                <span class="align-middle">{item.country.name}</span>
                            </p>
                        </div>
                        <Row class="align-items-center mb-3">
                            <Col>
                                <Progress color={item.variant}
                                          value={calculateProgress(item.sessions)} style={'height:5px'}/>
                            </Col>
                            <Col class="col-auto">
                                <p class="mb-0 fs-13 fw-semibold">
                                    {item.sessions}
                                    {#if item.suffix}
                                        <span>{item.suffix}</span>
                                    {/if}
                                </p>
                            </Col>
                        </Row>
                    {/each}
                </div>
            </Col>
        </Row>
    </CardBody>
</Card>