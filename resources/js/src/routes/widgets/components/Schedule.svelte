<script lang="ts">
    import {
        Alert,
        Card,
        CardBody,
        CardTitle, Col,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle, Row
    } from "@sveltestrap/sveltestrap";
    import {scheduleData} from "./data";
    import 'simplebar'
</script>

<Card>
    <CardBody>
        <Dropdown class="float-end">
            <DropdownToggle color="link" class="text-dark p-0">
                <a href={"#"} class="dropdown-toggle arrow-none">
                    <i class="bx bx-dots-vertical-rounded fs-18 text-dark mb-1"></i>
                </a>
            </DropdownToggle>
            <DropdownMenu>
                <DropdownItem>
                    <i class="bx bx-list-ul me-2"></i>To Do
                </DropdownItem>
                <DropdownItem>
                    <i class="bx bx-line-chart me-2"></i>In Progress
                </DropdownItem>
                <DropdownItem>
                    <i class="bx bx-check-square me-2"></i>Completed
                </DropdownItem>
            </DropdownMenu>
        </Dropdown>
        <CardTitle class="mb-3">Today's Schedules</CardTitle>
        {#each scheduleData as schedule, idx}
            <Row class="align-items-center">
                <Col xs="3" sm="2">
                    <p class={idx === scheduleData.length - 1 ? 'mb-0' : ''}>{schedule.time.startAt}</p>
                </Col>
                <Col sm="10" xs="9">
                    <Alert color={schedule.variant} class="px-2 {idx === scheduleData.length - 1 ? 'mb-0' : ''}"
                           isOpen={true}>
                        <p class="mb-0">{schedule.task}</p>
                        <p class="mb-0">{schedule.time.startAt} - {schedule.time.endAt}</p>
                    </Alert>
                </Col>
            </Row>
        {/each}
    </CardBody>
</Card>