<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import JsVectorMap from "$lib/components/JsVectorMap.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";

    const worldMapOptions = {
        map: 'world',
        selector: '#world-map-markers',
        zoomOnScroll: false,
        zoomButtons: true,
        markersSelectable: true,
        markers: [
            {name: 'Greenland', coords: [72, -42]},
            {name: 'Canada', coords: [56.1304, -106.3468]},
            {name: 'Brazil', coords: [-14.235, -51.9253]},
            {name: 'Egypt', coords: [26.8206, 30.8025]},
            {name: 'Russia', coords: [61, 105]},
            {name: 'China', coords: [35.8617, 104.1954]},
            {name: 'United States', coords: [37.0902, -95.7129]},
            {name: 'Norway', coords: [60.472024, 8.468946]},
            {name: 'Ukraine', coords: [48.379433, 31.16558]}
        ],
        markerStyle: {
            initial: {fill: '#5B8DEC'},
            selected: {fill: '#ef5f5f'}
        },
        labels: {
            markers: {
                render: (marker: any) => marker.name
            }
        },
        regionStyle: {
            initial: {
                fill: 'rgba(169,183,197, 0.2)',
                fillOpacity: 1
            }
        }
    }

    const canadaMap = {
        map: 'canada',
        selector: '#canada-vector-map',
        zoomOnScroll: false,
        regionStyle: {
            initial: {
                fill: '#5B8DEC'
            }
        }
    }

    const russiaMap = {
        map: 'russia',
        selector: '#russia-vector-map',
        zoomOnScroll: false,
        regionStyle: {
            initial: {
                fill: '#5d7186'
            }
        }
    }

    const iraqMap = {
        map: 'iraq',
        selector: '#iraq-vector-map',
        zoomOnScroll: false,
        regionStyle: {
            initial: {
                fill: '#20c8e9'
            }
        }
    }

    const spainMap = {
        map: 'spain',
        selector: '#spain-vector-map',
        zoomOnScroll: false,
        regionStyle: {
            initial: {
                fill: '#ffe381'
            }
        }
    }

    const anchorNavigation = [
        {
            id: 'world_vector_map',
            title: 'World Vector Map'
        },
        {
            id: 'canada_vector_map',
            title: 'Canada Vector Map'
        },
        {
            id: 'russia_vector_map',
            title: 'Russia Vector Map'
        },
        {
            id: 'iraq_vector_map',
            title: 'Iraq Vector Map'
        },
        {
            id: 'spain_vector_map',
            title: 'Spain Vector Map'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Vector Maps" subTitle="Maps"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="World Vector Map" id="world_vector_map">
                <JsVectorMap id="world-map-markers" height={360} options={worldMapOptions}/>
            </UIComponentCard>

            <UIComponentCard title="Canada Vector Map" id="canada_vector_map">
                <JsVectorMap id="canada-vector-map" height={360} options={canadaMap}/>
            </UIComponentCard>

            <UIComponentCard title="Russia Vector Map" id="russia_vector_map">
                <JsVectorMap id="russia-vector-map" height={360} options={russiaMap}/>
            </UIComponentCard>

            <UIComponentCard title="Iraq Vector Map" id="iraq_vector_map">
                <JsVectorMap id="iraq-vector-map" height={360} options={iraqMap}/>
            </UIComponentCard>

            <UIComponentCard title="Spain Vector Map" id="spain_vector_map">
                <JsVectorMap id="spain-vector-map" height={360} options={spainMap}/>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
