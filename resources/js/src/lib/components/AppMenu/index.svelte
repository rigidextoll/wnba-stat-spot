<script lang="ts">
    import type {MenuItemType} from "$lib/types/menu";
    import MenuItemWithChildren from "$lib/components/AppMenu/MenuItemWithChildren.svelte";
    import MenuItem from "$lib/components/AppMenu/MenuItem.svelte";
    import {layout} from "$lib/stores/layout";
    import {menuItemActive} from "$lib/components/AppMenu/menuActivation";

    export let menuItems: Array<MenuItemType>
</script>

<ul class="navbar-nav">
    {#each menuItems || [] as item}

        {#if (item.isTitle)}
            <li class="menu-title">{item.label}</li>

        {:else }
            {#if (item.children)}
                <MenuItemWithChildren item={item} className='nav-item' linkClassName='nav-link'
                                      subMenuClassName='nav sub-navbar-nav'/>
            {:else}
                <MenuItem item={item} linkClassName="nav-link" className="nav-item"/>
            {/if}
        {/if}
    {/each}
</ul>