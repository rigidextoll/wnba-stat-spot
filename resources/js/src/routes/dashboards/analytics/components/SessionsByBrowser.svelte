<script lang="ts">

    import {
        Card,
        CardBody,
        CardHeader,
        CardTitle,
        Dropdown, DropdownItem,
        DropdownMenu,
        DropdownToggle
    } from "@sveltestrap/sveltestrap";
    import Icon from "@iconify/svelte";
    import {sessionByBrowserData} from "./data";
</script>

<Card>
    <CardHeader class="d-flex justify-content-between align-items-center border-bottom border-dashed">
        <CardTitle>
            Session By Browser
        </CardTitle>

        <Dropdown>
            <DropdownToggle tag="a" color="link" class="text-dark p-0">
                <Icon
                        icon="iconamoon:menu-kebab-vertical-circle-duotone"
                        class="fs-20 align-middle text-muted"
                />
            </DropdownToggle>
            <DropdownMenu>
                <DropdownItem>Download</DropdownItem>
                <DropdownItem>Export</DropdownItem>
                <DropdownItem>Import</DropdownItem>
            </DropdownMenu>
        </Dropdown>
    </CardHeader>

    <CardBody class="py-2 px-0">
        <div
                class="px-2"
                data-simplebar
                style="height: 270px">

            {#each sessionByBrowserData as item}
                <div class="d-flex justify-content-between align-items-center p-2">
                    <span class="align-middle fw-medium">{item.browser}</span>
                    <span class="fw-semibold text-muted">{item.session.percent}%</span>
                    <span class="fw-semibold text-muted">{item.session.data}k</span>
                </div>
            {/each}
        </div>
    </CardBody>
</Card>