<script lang="ts">
    import 'simplebar'
    import Icon from '@iconify/svelte';
    import {
        layout, setLeftSideBarSize, setTheme
    } from "$lib/stores/layout";
    import {
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle
    } from '@sveltestrap/sveltestrap';

    const avatar1 = "/images/users/avatar-1.jpg"

    import {toggleDocumentAttribute} from "$lib/helpers/layout";
    import RightSideBar from "$lib/layouts/components/RightSideBar.svelte";

    let currentTheme: 'light' | 'dark';
    let currentTopBarColor: 'light' | 'dark';
    let currentLeftSideBarColor: 'light' | 'dark';
    let currentLeftSideBarSize: 'sm-hover-active' | 'sm-hover' | 'hidden' | 'condensed' | 'default';

    $: {
        const {theme, topBarColor, leftSideBarColor, leftSideBarSize} = $layout;
        currentTheme = theme;
        currentTopBarColor = topBarColor;
        currentLeftSideBarColor = leftSideBarColor;
        currentLeftSideBarSize = leftSideBarSize;
    }

    let isRightSideBarOpen: boolean = false

    const toggleTheme = () => {
        if (currentTheme === 'light') {
            return setTheme('dark')
        }
        return setTheme('light')
    }

    const toggleLeftSideBar = () => {
        if (currentLeftSideBarSize === 'default') {
            return setLeftSideBarSize('condensed')
        }
        if (currentLeftSideBarSize === 'condensed') {
            return setLeftSideBarSize('default')
        }
        toggleDocumentAttribute('class', 'sidebar-enable')
        showBackdrop()
    }

    const showBackdrop = () => {
        let backdrop = document.createElement('div') as HTMLDivElement;
        if (backdrop) {
            backdrop.classList.add("offcanvas-backdrop", "fade", "show")
            document.body.appendChild(backdrop);
            document.body.style.overflow = "hidden";
            if (window.innerWidth > 1040) {
                document.body.style.paddingRight = "15px";
            }

            backdrop.addEventListener('click', function (e) {
                toggleDocumentAttribute('class', '')
                document.body.removeChild(backdrop);
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            })
        }
    }

    const profileMenuItems = [
        {
            key: 'advanced',
            label: 'Advanced Analytics',
            icon: 'bx-brain',
            url: '/advanced'
        },
        {
            key: 'prop-scanner',
            label: 'Prop Scanner',
            icon: 'bx-radar',
            url: '/advanced/prop-scanner'
        },
        {
            key: 'predictions',
            label: 'Predictions',
            icon: 'bx-crystal-ball',
            url: '/reports/predictions'
        }
    ];
</script>


<header class="topbar">
    <div class="container-xxl">
        <div class="navbar-header">
            <div class="d-flex align-items-center gap-2">

                <div class="topbar-item">
                    <button type="button" class="button-toggle-menu" on:click={toggleLeftSideBar}>
                        <Icon icon="iconamoon:menu-burger-horizontal"
                              class="fs-22"

                        />
                    </button>
                </div>
                <!-- <form class="app-search d-none d-md-block me-auto">
                    <div class="position-relative">
                        <input
                                type="search"
                                class="form-control"
                                placeholder="Search players, teams, stats..."
                                autocomplete="off"
                                value=""
                        />
                        <Icon icon="iconamoon:search-duotone"
                              class="search-widget-icon"
                        />
                    </div>
                </form> -->
            </div>

            <div class="d-flex align-items-center gap-1">

                <!-- Theme Toggle (Light/Dark) -->
                <div class="topbar-item me-1">
                    <button
                            type="button"
                            class="topbar-button"
                            on:click={toggleTheme}
                    >
                        <Icon
                                icon="iconamoon:mode-dark-duotone"
                                class="fs-24 align-middle"
                        />
                    </button>
                </div>

                <!-- Theme Setting -->
                <div class="topbar-item">
                    <button type="button" class="topbar-button"
                            on:click={() => isRightSideBarOpen = !isRightSideBarOpen}>
                        <Icon icon="iconamoon:settings-duotone"
                              class="fs-24 align-middle"/>
                    </button>
                </div>

                <!-- Profile -->
                <Dropdown nav class="topbar-item">
                    <DropdownToggle nav>
                        <a href="null" type="button"
                           class="topbar-button">
                              <span class="d-flex align-items-center">
                                <img class="rounded-circle"
                                     width="32"
                                     src={avatar1}
                                     alt=""
                                />
                              </span>
                        </a>
                    </DropdownToggle>

                    <DropdownMenu class="dropdown-menu dropdown-menu-end">

                        <DropdownItem header>WNBA Analytics</DropdownItem>

                        {#each profileMenuItems as item}
                            <DropdownItem href={item.url}>
                                <i class={`bx text-muted fs-18 align-middle me-1 ${item.icon}`}></i>
                                <span class="align-middle">{item.label}</span>
                            </DropdownItem>
                        {/each}

                        <DropdownItem divider class="my-1"/>

                        <DropdownItem href="/reports">
                            <i class="bx bx-file fs-18 align-middle me-1"></i>
                            <span class="align-middle">All Reports</span>
                        </DropdownItem>

                    </DropdownMenu>
                </Dropdown>
            </div>
        </div>
    </div>
</header>

<RightSideBar {isRightSideBarOpen}/>
