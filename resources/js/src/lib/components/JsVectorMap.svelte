<script lang="ts">
    import {onMount} from "svelte";

    export let id: string
    export let height: number
    export let options: object
    export let customClass: string = ''

    onMount(async () => {
        await import('jsvectormap')
        await import('jsvectormap/dist/maps/world')
        await import('jsvectormap/dist/maps/world-merc')
        await import('jsvectormap/dist/maps/russia')
        await import('jsvectormap/dist/maps/canada')
        await import('jsvectormap/dist/maps/iraq')
        await import('jsvectormap/dist/maps/italy')
        await import('jsvectormap/dist/maps/spain')


        new (window as any)["jsVectorMap"]({...options});
    })
</script>

<div id={id} style="width: 100%; height: {height}px" class={customClass}></div>