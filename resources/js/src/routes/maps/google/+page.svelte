<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import {lightMapStyles, darkMapStyles} from "./data.js";
    import {onMount} from "svelte";
    import {Loader, type LoaderOptions} from "google-maps";

    onMount(async () => {

        const loaderOptions: LoaderOptions = {};
        const loader = new Loader('AIzaSyAOVYRIgupAurZup5y1PRh8Ismb1A3lLao', loaderOptions);
        const google = await loader.load();

        const center = {lat: -12.043333, lng: -77.028333,}


        const basic = document.getElementById('gmaps-basic')
        if (basic) {
            const map = new google.maps.Map(basic, {
                center: center, zoom: 8
            });
        }


        const markerEl = document.getElementById('gmaps-markers')
        if (markerEl) {
            const map = new google.maps.Map(markerEl, {
                center: center, zoom: 8
            });
            const marker = new google.maps.Marker({
                position: center,
                map: map,
                title: 'Hello!'
            });
        }

        const panoramaEl = document.getElementById('panorama')
        if (panoramaEl) {
            const panorama = new google.maps.StreetViewPanorama(
                panoramaEl, {
                    position: center,
                });
        }

        const mapType = document.getElementById('gmaps-types')
        if (mapType) {
            const map = new google.maps.Map(mapType, {
                center: center,
                zoom: 14,
                mapTypeControlOptions: {
                    mapTypeIds: ["roadmap", "satellite", "hybrid", "terrain", "osm", "cloudmade"]
                }
            });

            // Add the OpenStreetMap custom map type
            map.mapTypes.set("osm", new google.maps.ImageMapType({
                getTileUrl: function (coord, zoom) {
                    return "http://tile.openstreetmap.org/" + zoom + "/" + coord.x + "/" + coord.y + ".png";
                },
                tileSize: new google.maps.Size(256, 256),
                name: "OpenStreetMap",
                maxZoom: 18
            }));

            // Add the CloudMade custom map type
            map.mapTypes.set("cloudmade", new google.maps.ImageMapType({
                getTileUrl: function (coord, zoom) {
                    return "http://b.tile.cloudmade.com/8ee2a50541944fb9bcedded5165f09d9/1/256/" + zoom + "/" + coord.x + "/" + coord.y + ".png";
                },
                tileSize: new google.maps.Size(256, 256),
                name: "CloudMade",
                maxZoom: 18
            }));

            // Set the initial map type to OpenStreetMap
            map.setMapTypeId("osm");
        }


        const mapLight = document.getElementById('ultra-light')
        if (mapLight) {
            const map = new google.maps.Map(mapLight, {
                center: center,
                zoom: 14,
                //@ts-ignore
                styles: lightMapStyles
            });
        }

        const mapDark = document.getElementById('dark-view')
        if (mapDark) {
            const map = new google.maps.Map(mapDark, {
                center: center,
                zoom: 14,
                //@ts-ignore
                styles: darkMapStyles
            });
        }
    })

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic'
        },
        {
            id: 'google_map',
            title: 'Markers Google Map'
        },
        {
            id: 'street_view',
            title: 'Street View Panoramas Google Map'
        },
        {
            id: 'map_types',
            title: 'Google Map Types'
        },
        {
            id: 'ultra_light',
            title: 'Ultra Light With Labels'
        },
        {
            id: 'dark-view',
            title: 'Dark'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Google Maps" subTitle="Maps"/>

    <Row>
        <Col xl="9">

            <UIComponentCard id="basic" title="Basic Example">
                <div id="gmaps-basic" class="gmaps"></div>
            </UIComponentCard>

            <UIComponentCard id="google_map" title="Markers Google Map">
                <div id="gmaps-markers" class="gmaps"></div>
            </UIComponentCard>

            <UIComponentCard id="street_view" title="Street View Panoramas Google Map">
                <div id="panorama" class="gmaps"></div>
            </UIComponentCard>

            <UIComponentCard id="map_types" title="Google Map Types">
                <div id="gmaps-types" class="gmaps"></div>
            </UIComponentCard>

            <UIComponentCard id="ultra_light" title="Ultra Light With Labels">
                <div id="ultra-light" class="gmaps"></div>
            </UIComponentCard>

            <UIComponentCard id="dark_view" title="Dark">
                <div id="dark-view" class="gmaps"></div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>