<script lang="ts">
    import Icon from '@iconify/svelte';
    import MenuItem from "$lib/components/AppMenu/MenuItem.svelte";
    import MenuItemWithChildren from "$lib/components/AppMenu/MenuItemWithChildren.svelte"
    import type {SubMenus} from "$lib/types/menu";
    import {Collapse} from "@sveltestrap/sveltestrap";
    import {menuItemActive} from "$lib/components/AppMenu/menuActivation";
    import {page} from '$app/stores';
    import { layout } from '$lib/stores/layout';


    const currentRoute = $page.url.pathname

    export let item: SubMenus['item'];
    export let className: SubMenus['className'];
    export let subMenuClassName: SubMenus['subMenuClassName'];
    export const linkClassName: SubMenus['linkClassName'] = '';

    let isOpen = menuItemActive(item.key, currentRoute) ?? false;

    let currentLeftSideBarSize: 'sm-hover-active' | 'sm-hover' | 'hidden' | 'condensed' | 'default';

    $: {
        const {leftSideBarSize} = $layout;
        currentLeftSideBarSize = leftSideBarSize;
    }

    const toggleMenu = () => {
        isOpen = !isOpen;
    };

    const handleKeydown = (event: KeyboardEvent) => {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            toggleMenu();
        }
    };
</script>

<li class="{className}">
    <button
        type="button"
        class={`nav-link menu-arrow ${menuItemActive(item.key, currentRoute) && 'active'}`}
        on:click={toggleMenu}
        on:keydown={handleKeydown}
        aria-expanded={isOpen}
        aria-controls={item.key}
    >
        {#if item.icon}
          <span class="nav-icon">
            <Icon icon={item.icon}/>
          </span>
        {/if}

        <span class="nav-text">{item.label}</span>

        {#if item.badge}
            <span class="badge badge-pill text-end bg-{item.badge.variant}">{item.badge.text}</span>
        {/if}
    </button>
    <Collapse {isOpen} id={item.key} class={currentLeftSideBarSize === 'sm-hover' || currentLeftSideBarSize === 'condensed' ? 'collapse':''} >
        <ul class="{subMenuClassName}">
            {#each item.children || [] as link (link.key)}
                {#if link.children}
                    <MenuItemWithChildren item={link} className="sub-nav-item"
                                          subMenuClassName="nav sub-navbar-nav"
                                          linkClassName="nav-link"/>
                {:else}
                    <MenuItem item={link} className="sub-nav-item" linkClassName="sub-nav-link"/>
                {/if}
            {/each}
        </ul>
    </Collapse>
</li>
