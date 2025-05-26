<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import FlatPicker from "$lib/components/FlatPicker.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import {onMount} from "svelte";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic'
        },
        {
            id: 'datetime',
            title: 'DateTime'
        },
        {
            id: 'human-friendly-dates',
            title: 'Human-friendly Dates'
        },
        {
            id: 'minmax',
            title: 'MinDate and MaxDate'
        },
        {
            id: 'disable',
            title: 'Disabling dates'
        },
        {
            id: 'multiple',
            title: 'Selecting multiple dates'
        },
        {
            id: 'conjunction',
            title: 'Selecting multiple dates - Conjunction'
        },
        {
            id: 'range-calendar',
            title: 'Range Calendar'
        },
        {
            id: 'inline-calendar',
            title: 'Inline Calendar'
        },
        {
            id: 'timepicker-basic',
            title: 'Basic Timepicker'
        },
        {
            id: '24hours',
            title: '24-hour Time Picker'
        },
        {
            id: 'timepicker-minmax',
            title: 'Time Picker with Limits'
        },
        {
            id: 'preloading-time',
            title: 'Preloading Time'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Flatpicker" subTitle="Form"/>

    <Row>
        <Col xl="9">

            <UIComponentCard id="basic" title="Basic">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="basic-datepicker" placeholder="Basic datepicker"/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="datetime" title="DateTime">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="datetime-datepicker" placeholder="Date and Time"
                                    options={{enableTime: true, dateFormat: 'Y-m-d H:i'}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="human-friendly-dates" title="Human-friendly Dates">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="humanfd-datepicker" placeholder="October 9, 2018"
                                    options={{altInput: true, altFormat: 'F j, Y', dateFormat: 'Y-m-d'}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="minmax" title="MinDate and MaxDate">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="minmax-datepicker" placeholder="mindate - maxdate"
                                    options={{minDate: '2020-01', maxDate: '2020-03'}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="disable" title="Disabling dates">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="disable-datepicker" placeholder="Disabling dates"
                                    options={{disable: ['2025-01-10', '2025-01-21', '2025-01-30', new Date(2025, 4, 9)],dateFormat: 'Y-m-d'}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="multiple" title="Selecting multiple dates">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="multiple-datepicker" placeholder="Multiple dates"
                                    options={{mode: 'multiple', dateFormat: 'Y-m-d'}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="conjunction" title="Selecting multiple dates - Conjunction">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="conjunction-datepicker" placeholder="2018-10-10 :: 2018-10-11"
                                    options={{mode: 'multiple', dateFormat: 'Y-m-d', conjunction: ' :: '}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="range-calendar" title="Range Calendar">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="range-datepicker" placeholder="2018-10-03 to 2018-10-10"
                                    options={{mode: 'range'}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="inline-calendar" title="Inline Calendar">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="inline-datepicker" placeholder="Inline calendar"
                                    options={{inline: true}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="timepicker-basic" title="Basic Timepicker">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="basic-timepicker" placeholder="Basic timepicker"
                                    options={{ enableTime: true, noCalendar: true, dateFormat: 'H:i'}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="24hours" title="24-hour Time Picker">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="24hours-timepicker" placeholder="16:21"
                                    options={{enableTime: true, noCalendar: true, dateFormat: 'H:i', time_24hr: true}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="timepicker-minmax" title="Time Picker with Limits">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="minmax-timepicker" placeholder="Limits"
                                    options={{enableTime: true, noCalendar: true, dateFormat: 'H:i', minDate: '16:00', maxDate: '22:30'}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="preloading-time" title="Preloading Time">
                <Row>
                    <Col lg="6">
                        <FlatPicker id="preloading-timepicker" placeholder="Pick a time"
                                    options={{enableTime: true, noCalendar: true, dateFormat: 'H:i', defaultDate: '01:45' }}/>
                    </Col>
                </Row>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>