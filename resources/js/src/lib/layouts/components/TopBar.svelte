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

    import {categories, notifications, profileMenuItems} from "$lib/layouts/components/data";
    import {toggleDocumentAttribute} from "$lib/helpers/layout";
    import RightSideBar from "$lib/layouts/components/RightSideBar.svelte";
    import ActivityOffcanvas from "$lib/layouts/components/ActivityOffcanvas.svelte";

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
    let isActivityOpen: boolean = false

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
        // console.log(currentLeftSideBarSize)
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

                <form class="app-search d-none d-md-block me-auto">
                    <div class="position-relative">
                        <input
                                type="search"
                                class="form-control"
                                placeholder="Search..."
                                autocomplete="off"
                                value=""
                        />
                        <Icon icon="iconamoon:search-duotone"
                              class="search-widget-icon"
                        />
                    </div>
                </form>
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

                <!-- Category -->
                <Dropdown nav class="topbar-item d-none d-lg-flex me-1">
                    <DropdownToggle nav color="">
                        <Icon icon="iconamoon:apps" class="fs-24 align-middle"/>
                    </DropdownToggle>
                    <DropdownMenu end>
                        {#each categories as item}
                            <DropdownItem class="dropdown-item py-2" href="null">
                                <img src={item.image} class="avatar-xs" alt="Github"/>
                                <span class="ms-2">{item.name}:
                                    <span class="fw-medium">{item.username}</span></span>
                            </DropdownItem>
                        {/each}
                    </DropdownMenu>
                </Dropdown>

                <!-- Notification -->
                <Dropdown nav class="topbar-item">
                    <DropdownToggle nav>
                        <button type="button" class="topbar-button position-relative">
                            <Icon
                                    icon="iconamoon:notification-duotone"
                                    class="fs-24 align-middle"/>
                            <span class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">3<span
                                    class="visually-hidden">unread messages</span></span>
                        </button>
                    </DropdownToggle>

                    <DropdownMenu end class="dropdown-menu py-0 dropdown-lg dropdown-menu-end">
                        <div
                                class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold">
                                        Notifications
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="null"
                                       class="text-dark text-decoration-underline">
                                        <small>Clear All</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 280px">

                            {#each notifications as item}
                                <DropdownItem
                                        class="py-3 border-bottom text-wrap">

                                    <div class="d-flex">

                                        <div class="flex-shrink-0">
                                            {#if item.user?.avatar}
                                                <img src={item.user.avatar}
                                                     class="img-fluid me-2 avatar-sm rounded-circle"
                                                     alt="avatar-1"/>
                                            {:else if item.icon}
                                                <div class="avatar-sm me-2">
                                                     <span class="avatar-title bg-soft-warning text-warning fs-20 rounded-circle">
                                                       <Icon icon={item.icon}/>
                                                     </span>
                                                </div>

                                            {:else if item.user?.name }
                                                <div class="avatar-sm me-2">
                                                    <span class="avatar-title bg-soft-info text-info fs-20 rounded-circle">
                                                      {item.user.name.slice(0, 1)}
                                                    </span>
                                                </div>
                                            {/if}
                                        </div>

                                        <div class="flex-grow-1">
                                            {#if item.user?.name}
                                                <p class="mb-0 fw-semibold">
                                                    {item.user.name}
                                                </p>
                                            {/if}
                                            {#if item.title}
                                                <p class="mb-0 fw-semibold text-wrap">
                                                    {item.title}
                                                </p>
                                            {/if}
                                            {#if item.message}
                                                <p class="mb-0 text-wrap">
                                                    {item.message}
                                                </p>
                                            {/if}
                                            {#if item.content}
                                                <p class="mb-0 text-wrap">
                                                    {item.content}
                                                </p>
                                            {/if}
                                        </div>

                                    </div>
                                </DropdownItem>
                            {/each}
                        </div>
                        <div class="text-center py-3">
                            <a href="null" class="btn btn-primary btn-sm">
                                View All Notification
                                <i class="bx bx-right-arrow-alt ms-1"></i></a>
                        </div>
                    </DropdownMenu>
                </Dropdown>

                <!-- Theme Setting -->
                <div class="topbar-item">
                    <button type="button" class="topbar-button"
                            on:click={() => isRightSideBarOpen = !isRightSideBarOpen}>
                        <Icon icon="iconamoon:settings-duotone"
                              class="fs-24 align-middle"/>
                    </button>
                </div>

                <!-- Activity -->
                <div class="topbar-item d-none d-md-flex">
                    <button type="button" class="topbar-button" on:click={() => isActivityOpen = !isActivityOpen}>
                        <Icon icon="iconamoon:history-duotone" class="fs-24 align-middle"/>
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

                        <DropdownItem header>Welcome Gaston!</DropdownItem>

                        {#each profileMenuItems as item}
                            <DropdownItem href={item.url}>
                                <i class={`bx text-muted fs-18 align-middle me-1 ${item.icon}`}></i>
                                <span class="align-middle">{item.label}</span>
                            </DropdownItem>
                        {/each}

                        <DropdownItem divider class="my-1"/>

                        <DropdownItem class="text-danger"
                                      href="/auth/sign-in">
                            <i class="bx bx-log-out fs-18 align-middle me-1"></i>
                            <span class="align-middle">Logout</span>
                        </DropdownItem>

                    </DropdownMenu>
                </Dropdown>
            </div>
        </div>
    </div>
</header>

<RightSideBar {isRightSideBarOpen}/>

<ActivityOffcanvas {isActivityOpen}/>
