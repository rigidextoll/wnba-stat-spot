<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Button, Col, Row, Tooltip} from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'direction',
            title: 'Direction'
        },
        {
            id: 'color_tooltip',
            title: 'Color Tooltip'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Tooltips" subTitle="Base UI"/>
    <Row>
        <Col xl="9">
            <UIComponentCard title="Tooltip Direction" id="direction"
                             caption="Four options are available: top, right, bottom, and left aligned.">
                <div class="d-flex flex-wrap gap-2">

                    <Button color="primary" id="tooltip-top"> Tooltip on top</Button>
                    <Tooltip target="tooltip-top" placement="top">
                        Tooltip on top
                    </Tooltip>

                    <Button color="primary" id="tooltip-right"> Tooltip on right</Button>
                    <Tooltip target="tooltip-right" placement="right">
                        Tooltip on right
                    </Tooltip>

                    <Button color="primary" id="tooltip-bottom"> Tooltip on bottom</Button>
                    <Tooltip target="tooltip-bottom" placement="bottom">
                        Tooltip on bottom
                    </Tooltip>

                    <Button color="primary" id="tooltip-left"> Tooltip on left</Button>
                    <Tooltip target="tooltip-left" placement="left">
                        Tooltip on left
                    </Tooltip>
                </div>
            </UIComponentCard>

            <UIComponentCard title="Color Tooltip" id="color_tooltip">
                <div class="d-flex flex-wrap gap-1 mt-3">
                    <Button color="primary" id="tooltip1"> Primary tooltip</Button>
                    <Tooltip target="tooltip1" class="primary-tooltip" placement="top">
                        This top tooltip is themed via CSS variables.
                    </Tooltip>

                    <Button color="danger" id="tooltip2"> Danger tooltip</Button>
                    <Tooltip target="tooltip2" class="danger-tooltip" placement="top">
                        This top tooltip is themed via CSS variables.
                    </Tooltip>

                    <Button color="info" id="tooltip3"> Info tooltip</Button>
                    <Tooltip target="tooltip3" class="info-tooltip" placement="top">
                        This top tooltip is themed via CSS variables.
                    </Tooltip>

                    <Button color="success" id="tooltip4"> Success tooltip</Button>
                    <Tooltip target="tooltip4" class="success-tooltip" placement="top">
                        This top tooltip is themed via CSS variables.
                    </Tooltip>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>