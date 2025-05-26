<script lang="ts">
    import LogoBox from "$lib/components/LogoBox.svelte";
    import AppMenu from "$lib/components/AppMenu/index.svelte"
    import Icon from "@iconify/svelte";
    import {getMenuItems} from "$lib/helpers/menu";
    import 'simplebar'
    import {layout, setLeftSideBarSize} from "$lib/stores/layout";
  import { onMount } from "svelte";

    let currentLeftSideBarSize: 'sm-hover-active' | 'sm-hover' | 'hidden' | 'condensed' | 'default';

    layout.subscribe(value => {
        currentLeftSideBarSize = value.leftSideBarSize
    });

    const toggleMenuSize = () => {
        if (currentLeftSideBarSize === 'sm-hover-active') return setLeftSideBarSize('sm-hover')
        return setLeftSideBarSize('sm-hover-active')
    }

    const adjustLayout = () => {
        if(window.innerWidth <= 1140){
                return setLeftSideBarSize('hidden')
            }else{
                return setLeftSideBarSize(currentLeftSideBarSize === 'hidden' ? 'sm-hover-active' : currentLeftSideBarSize)
            }
    }

    onMount(() => {
        adjustLayout()
        window.addEventListener('resize', adjustLayout)

        return () => {
            window.removeEventListener('resize', adjustLayout)
        }
    })
</script>

<div class="main-nav">
    <LogoBox/>

    <button type="button" class="button-sm-hover" on:click={toggleMenuSize}>
        <Icon icon="iconamoon:arrow-left-4-square-duotone"
              class="button-sm-hover-icon fs-10 mt-2 me-1" style="height: 24px; width: 24px"/>
    </button>

    <div data-simplebar class="scrollbar">
        <AppMenu menuItems={getMenuItems()}/>
    </div>
</div>
