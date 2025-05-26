<script lang="ts">

    import FullCalendar, {type CalendarOptions} from 'svelte-fullcalendar';
    import dayGridPlugin from '@fullcalendar/daygrid'
    import timeGridPlugin from '@fullcalendar/timegrid'
    import interactionPlugin, {Draggable} from '@fullcalendar/interaction'
    import bootstrapPlugin from '@fullcalendar/bootstrap'
    import listPlugin from '@fullcalendar/list'
    import {onMount} from "svelte";
    import {externalEvents, initialEvents, options} from "./components/data";
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Button, Card, CardBody, Col, Input, Modal, ModalBody, Row} from "@sveltestrap/sveltestrap";
    import {object, string} from "yup";


    let modal = false
    let eventData: any
    let isEditEvent: boolean = false
    let clickedDate: Date = new Date();

    const toggleModal = () => {
        modal = !modal
        isEditEvent = false
        yupState.eventName = undefined
        yupState.eventCategory = undefined
    }

    const deleteEvent = () => {
        eventData.remove()
        toggleModal()
    }

    const editEvent = (info: any) => {
        modal = !modal
        isEditEvent = true
        eventData = info.event
        yupState.eventName = eventData.title
        yupState.eventCategory = eventData.classNames[0]
    }
    const handleDateClick = (info: any) => {
        clickedDate = info.date;
        toggleModal();
    };

    let calendarOptions: CalendarOptions = {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin, bootstrapPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        slotDuration: '00:30:00',
        slotMinTime: '07:00:00',
        slotMaxTime: '19:00:00',
        themeSystem: 'bootstrap',
        bootstrapFontAwesome: false,
        buttonText: {
            today: 'Today',
            month: 'Month',
            week: 'Week',
            day: 'Day',
            list: 'List',
            prev: 'Prev',
            next: 'Next'
        },
        handleWindowResize: true,
        // height: window.innerHeight - 200,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        droppable: true,
        editable: true,
        selectable: true,
        events: initialEvents,
        eventClick: editEvent,
        dateClick: handleDateClick
    }

    onMount(() => {
        const ele = document.getElementById('external-events')

        if (ele) {
            new Draggable(ele, {
                itemSelector: '.external-event',
                eventData: function (eventEl: any) {
                    return {
                        title: eventEl.innerText,
                        start: new Date(),
                        className: eventEl.getAttribute('data-class')
                    }
                }
            })
        }
    })

    let error: string = ''

    $: yupState = {
        eventName: undefined,
        eventCategory: undefined
    }

    const yupSchema = object({
        eventName: string().required('Event name is required'),
        eventCategory: string().required('Event category is Required'),
    })

    let fullCalendar: FullCalendar

    const handleSubmit = async () => {
        try {
            const res = await yupSchema.validate(yupState);
            error = '';
            if (!isEditEvent) {
                const calendarApi = fullCalendar.getAPI();
                calendarApi.addEvent({
                    title: res.eventName,
                    className: res.eventCategory,
                    start: new Date(clickedDate),
                });
            } else {
                eventData.setProp('title', yupState.eventName);
                eventData.setProp('classNames', [yupState.eventCategory]);
                isEditEvent = false;
            }
            toggleModal();
        } catch (e) {

        }
    };
</script>

<DefaultLayout>
    <PageBreadcrumb title="Schedule" subTitle="Calendar"/>
    <Row>
        <Col xs="12">
            <Card>
                <CardBody>
                    <Row>
                        <Col xl="3">
                            <div class="d-grid">
                                <Button type="button" color="primary" id="btn-new-event" on:click="{toggleModal}">
                                    <i class="bx bx-plus fs-18 me-2"></i>
                                    Add New Schedule
                                </Button>
                            </div>
                            <div id="external-events">
                                <br/>
                                <p class="text-muted">Drag and drop your event or click in the calendar</p>

                                {#each externalEvents as event}
                                    <div class="external-event bg-soft-{event.className} text-{event.className}"
                                         data-class="bg-{event.className}">
                                        <i class="bx bxs-circle me-2 vertical-middle"></i>
                                        {event.title}
                                    </div>
                                {/each}
                            </div>
                        </Col>

                        <Col xl="9">
                            <div class="mt-4 mt-lg-0">
                                <div id="calendar">
                                    <FullCalendar bind:this="{fullCalendar}" options="{calendarOptions}"/>
                                </div>
                            </div>
                        </Col>
                    </Row>
                </CardBody>
            </Card>

            <Modal isOpen="{modal}" header="{isEditEvent ? 'Edit Event' : 'Add Event'}">
                <ModalBody>
                    <form on:submit|preventDefault="{handleSubmit}">

                        {#if (error.length > 0)}
                            <div class="text-danger">{error}</div>
                        {/if}

                        <Row>
                            <Col xs="12">
                                <div class="mb-3">
                                    <label for="" class="control-label form-label">Event Name</label>
                                    <Input type="text" bind:value={yupState.eventName}/>
                                </div>
                            </Col>
                            <Col xs="12">
                                <div class="mb-3">
                                    <label for="" class="control-label form-label">Category</label>
                                    <Input type="select" bind:value={yupState.eventCategory}>
                                        {#each options as option}
                                            <option value="{option.value}">
                                                {option.text}
                                            </option>
                                        {/each}
                                    </Input>
                                </div>
                            </Col>
                        </Row>
                        <Row>
                            <Col xs="6">
                                {#if isEditEvent}
                                    <Button type="button" color="danger" id="btn-delete-event"
                                            on:click="{deleteEvent}">
                                        Delete
                                    </Button>
                                {/if}
                            </Col>
                            <Col xs="6" class="text-end">
                                <Button type="button" color="light" class="me-1"
                                        on:click="{toggleModal}"> Close
                                </Button>
                                <Button type="submit" color="primary" id="btn-save-event">
                                    Save
                                </Button>
                            </Col>
                        </Row>
                    </form>
                </ModalBody>
            </Modal>
        </Col>
    </Row>
</DefaultLayout>
