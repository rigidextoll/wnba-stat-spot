<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {
        Button,
        Col,
        Dropdown,
        DropdownItem,
        DropdownMenu,
        DropdownToggle,
        Form,
        Input,
        Row
    } from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'single-button',
            title: 'Single Button Dropdowns'
        },
        {
            id: 'single-button-variant',
            title: 'Single Button Variant Dropdowns'
        },
        {
            id: 'dark-dropdown',
            title: 'Dark Dropdown'
        },
        {
            id: 'direction',
            title: 'Dropdown Direction'
        },
        {
            id: 'menu-items',
            title: 'Dropdown Menu Items'
        },
        {
            id: 'auto-close-behavior',
            title: 'Auto Close Behavior'
        },
        {
            id: 'menu-content',
            title: 'Menu content'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Dropdown" subTitle="Base UI"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="Single Button Dropdowns" id="single-button">
                <div class="d-flex flex-wrap gap-3 mt-3">
                    <Dropdown>
                        <DropdownToggle caret>Dropdown button</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                            <DropdownItem>Something else here</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown>
                        <DropdownToggle tag="a" caret>Dropdown link</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                            <DropdownItem>Something else here</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Single Button Variant Dropdowns" id="single-button-variant">
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <Dropdown>
                        <DropdownToggle color="primary" caret>Primary</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                            <DropdownItem>Something else here</DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem>Separated link</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown>
                        <DropdownToggle color="secondary" caret>Secondary</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                            <DropdownItem>Something else here</DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem>Separated link</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown>
                        <DropdownToggle color="success" caret>Success</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                            <DropdownItem>Something else here</DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem>Separated link</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown>
                        <DropdownToggle color="info" caret>Info</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                            <DropdownItem>Something else here</DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem>Separated link</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Dark Dropdowns" id="dark-dropdown">
                <Dropdown theme="dark">
                    <DropdownToggle color="primary" caret>Dark Dropdown</DropdownToggle>
                    <DropdownMenu>
                        <DropdownItem>Action</DropdownItem>
                        <DropdownItem>Another action</DropdownItem>
                        <DropdownItem>Something else here</DropdownItem>
                        <DropdownItem divider/>
                        <DropdownItem>Separated link</DropdownItem>
                    </DropdownMenu>
                </Dropdown>
            </UIComponentCard>

            <UIComponentCard title="Dropdown Direction" id="direction">
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <Dropdown>
                        <DropdownToggle color="primary" caret>Drop Down</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                            <DropdownItem>Something else here</DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem>Separated link</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown direction="up">
                        <DropdownToggle color="secondary" caret>Drop up</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                            <DropdownItem>Something else here</DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem>Separated link</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown direction="left">
                        <DropdownToggle color="success" caret>Drop Left</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                            <DropdownItem>Something else here</DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem>Separated link</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown direction="right">
                        <DropdownToggle color="info" caret>Drop Right</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                            <DropdownItem>Something else here</DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem>Separated link</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Dropdown Menu Items" id="menu-items">
                <div class="d-flex flex-wrap gap-2 mt-3">

                    <ul class="dropdown-menu show block position-static">
                        <li>
                            <a class="dropdown-item" href={"#"}>Regular link</a>
                        </li>
                        <li>
                            <a class="dropdown-item active" href={"#"} aria-current="true">Active link</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href={"#"}>Another link</a>
                        </li>
                    </ul>

                    <ul class="dropdown-menu show block position-static">
                        <li>
                            <a class="dropdown-item" href={"#"}>Regular link</a>
                        </li>
                        <li>
                            <a class="dropdown-item disabled" href={"#"} aria-current="true">Active link</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href={"#"}>Another link</a>
                        </li>
                    </ul>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Auto close behavior" id="auto-close-behavior"
                             caption="By default, the dropdown menu is closed when clicking inside or outside the dropdown menu. You can use the <code>autoClose</code> option to change this behavior of the dropdown.">
                <div class="d-flex flex-wrap gap-2">

                    <Dropdown autoClose={true}>
                        <DropdownToggle caret>Default dropdown</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Menu item</DropdownItem>
                            <DropdownItem>Menu item</DropdownItem>
                            <DropdownItem>Menu item</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown autoClose="inside">
                        <DropdownToggle caret>Clickable inside</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Menu item</DropdownItem>
                            <DropdownItem>Menu item</DropdownItem>
                            <DropdownItem>Menu item</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown autoClose="outside">
                        <DropdownToggle caret>Clickable outside</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Menu item</DropdownItem>
                            <DropdownItem>Menu item</DropdownItem>
                            <DropdownItem>Menu item</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown autoClose={false}>
                        <DropdownToggle caret>Manual close</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem>Menu item</DropdownItem>
                            <DropdownItem>Menu item</DropdownItem>
                            <DropdownItem>Menu item</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Menu Content" id="menu-content">
                <p>Add a header to label sections of actions in any dropdown menu.</p>
                <p>Separate groups of related menu items with a divider.</p>
                <p>Place any freeform text within a dropdown menu with text and use spacing utilities. Note that you’ll
                    likely need additional sizing styles to constrain the menu width.</p>
                <p>Put a form within a dropdown menu, or make it into a dropdown menu, and use margin or padding
                    utilities to give it the negative space you require.</p>

                <div class="d-flex flex-wrap gap-2">
                    <Dropdown>
                        <DropdownToggle color="primary" caret>Dropdown Header</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem header>Dropdown header</DropdownItem>
                            <DropdownItem>Action</DropdownItem>
                            <DropdownItem>Another action</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown>
                        <DropdownToggle color="info" caret>Dropdown Divider</DropdownToggle>
                        <DropdownMenu>
                            <DropdownItem href={"#"}>Action</DropdownItem>
                            <DropdownItem href={"#"}>Another action</DropdownItem>
                            <DropdownItem href={"#"}>Something else here</DropdownItem>
                            <DropdownItem divider/>
                            <DropdownItem href={"#"}>Separated link</DropdownItem>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown>
                        <DropdownToggle color="secondary" caret>Dropdown Text</DropdownToggle>
                        <DropdownMenu class="dropdown-menu dropdown-lg p-3">
                            <p>Some example text that's free-flowing within the dropdown menu.</p>
                            <p class="mb-0">And this is more example text.</p>
                        </DropdownMenu>
                    </Dropdown>

                    <Dropdown>
                        <DropdownToggle color="success" caret>Dropdown Menu Forms</DropdownToggle>

                        <DropdownMenu>
                            <Form class="dropdown-lg p-3">
                                <div class="mb-3">
                                    <div>
                                        <label class="form-label" for="exampleDropdownFormEmail">Email</label>
                                        <Input type="email" id="exampleDropdownFormEmail"
                                               placeholder="email@example.com"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div>
                                        <label class="form-label" for="exampleDropdownFormPassword">Password</label>
                                        <Input type="password" id="exampleDropdownFormPassword" placeholder="Password"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <Input type="checkbox" label="Remember me"/>
                                </div>
                                <Button type="submit" color="primary"> Sign in</Button>
                            </Form>
                        </DropdownMenu>
                    </Dropdown>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
