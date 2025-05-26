<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ApexChart from "$lib/components/ApexChart.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {
        basicChart, columnWithNegativeValue,
        columnWithRotatedLabels,
        dataLabelsChart, dataPointSelectionHandler, distributedColumn,
        fullStackedChart,
        groupLabelChart,
        markersChart, quarterChartOptions, rangeColumn,
        stackedChart, yearChartOptions
    } from "./data";
    import {onMount} from "svelte";

    onMount(() => {
        const chart = document.getElementById('chart-year')

        if (chart) {
            // chart.addEventListener('dataPointSelection', dataPointSelectionHandler)
        }
    })

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Column Chart'
        },
        {
            id: 'datalabels',
            title: 'Column Chart with Datalabels'
        },
        {
            id: 'stacked',
            title: 'Stacked Column Chart'
        },
        {
            id: 'full-stacked',
            title: '100% Stacked Column Chart'
        },
        {
            id: 'markers',
            title: 'Column with Markers'
        },
        {
            id: 'group',
            title: 'Column with Group Label'
        },
        {
            id: 'rotate-labels',
            title: 'Column Chart with rotated labels & Annotations'
        },
        {
            id: 'negative-value',
            title: 'Column Chart with negative values'
        },
        {
            id: 'distributed',
            title: 'Distributed Column Chart'
        },
        {
            id: 'range',
            title: 'Range Column Chart'
        },
        {
            id: 'dynamic',
            title: 'Dynamic Loaded Chart'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Column Charts" subTitle="Charts"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Basic Column Chart" id="basic">
                <div dir="ltr">
                    <ApexChart options={basicChart} id="basic-column"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Column Chart with Datalabels" titleClass="mb-3" id="datalabels">
                <div dir="ltr">
                    <ApexChart options={dataLabelsChart} id="datalabels-column"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Stacked Column Chart" id="stacked">
                <div dir="ltr">
                    <ApexChart options={stackedChart} id="stacked-column"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="100% Stacked Column Chart" id="full-stacked">
                <div dir="ltr">
                    <ApexChart options={fullStackedChart} id="full-stacked-column"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Column with Markers" id="markers">
                <div dir="ltr">
                    <ApexChart options={markersChart} id="column-with-markers"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Column with Group Label" id="group">
                <div dir="ltr">
                    <ApexChart options={groupLabelChart} id="column-with-group-label"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Column Chart with rotated labels & Annotations" id="rotate-labels">
                <div dir="ltr">
                    <ApexChart options={columnWithRotatedLabels} id="rotate-labels-column"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Column Chart with negative values" id="negative-value">
                <div dir="ltr">
                    <ApexChart options={columnWithNegativeValue} id="negative-value-column"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Distributed Column Chart" id="distributed">
                <div dir="ltr">
                    <ApexChart options={distributedColumn} id="distributed-column"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Range Column Chart" id="range">
                <div dir="ltr">
                    <ApexChart options={rangeColumn} id="range-column"/>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Dynamic Loaded Chart" id="dynamic">
                <div dir="ltr">
                    <ApexChart options={yearChartOptions} id="chart-year"/>
                    <ApexChart options={quarterChartOptions} id="chart-quarter"/>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>