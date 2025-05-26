<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Input, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";

    const anchorNavigation = [
        {
            id: 'checkbox-basic',
            title: 'Checkbox'
        },
        {
            id: 'inline-checkbox',
            title: 'Inline Checkbox'
        },
        {
            id: 'disabled-checkbox',
            title: 'Disabled Checkbox'
        },
        {
            id: 'colors-checkbox',
            title: 'Colors Checkbox'
        },
        {
            id: 'radio-basic',
            title: 'Radio'
        },
        {
            id: 'inline-radio',
            title: 'Inline Radio'
        },
        {
            id: 'disabled-radio',
            title: 'Disabled Radio'
        },
        {
            id: 'colors-radio',
            title: 'Colors Radio'
        },
        {
            id: 'switch-basic',
            title: 'Switch'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Checkbox & Radio" subTitle="Forms"/>

    <Row>
        <Col xl="9">
            <UIComponentCard id="checkbox-basic" title="Checkbox">
                <Input type="checkbox" id="customCheck1" label="Check this custom checkbox"/>
                <Input type="checkbox" id="customCheck2" label="Check this custom checkbox"/>
            </UIComponentCard>

            <UIComponentCard id="inline-checkbox" title="Inline Checkbox">
                <div class="form-check-inline">
                    <Input type="checkbox" id="customCheck3" label="Check this custom checkbox"/>
                </div>
                <div class="form-check-inline">
                    <Input type="checkbox" id="customCheck4" label="Check this custom checkbox"/>
                </div>
            </UIComponentCard>

            <UIComponentCard id="disabled-checkbox" title="Disabled Checkbox">
                <div class="form-check-inline">
                    <Input type="checkbox" id="customCheck5" disabled checked label="Check this custom checkbox"/>
                </div>
                <div class="form-check-inline">
                    <Input type="checkbox" id="customCheck6" disabled label="Check this custom checkbox"/>
                </div>
            </UIComponentCard>

            <UIComponentCard id="colors-checkbox" title="Colors Checkbox">
                <div class="mb-2">
                    <Input type="checkbox" id="customCheckcolor1" checked label="Default Checkbox"/>
                </div>
                <div class="form-checkbox-success mb-2">
                    <Input type="checkbox" id="customCheckcolor2" checked label="Success Checkbox"/>
                </div>
                <div class="form-checkbox-info mb-2">
                    <Input type="checkbox" id="customCheckcolor3" checked label="Info Checkbox"/>
                </div>
                <div class="form-checkbox-secondary mb-2">
                    <Input type="checkbox" id="customCheckcolor6" checked label="Secondary Checkbox"/>
                </div>
                <div class="form-checkbox-warning mb-2">
                    <Input type="checkbox" id="customCheckcolor4" checked label="Warning Checkbox"/>
                </div>
                <div class="form-checkbox-danger mb-2">
                    <Input type="checkbox" id="customCheckcolor5" checked label="Danger Checkbox"/>
                </div>
                <div class="form-checkbox-dark">
                    <Input type="checkbox" id="customCheckcolor7" checked label="Dark Checkbox"/>
                </div>
            </UIComponentCard>

            <UIComponentCard id="radio-basic" title="Radio">
                <Input type="radio" name="flexRadioDefault" id="flexRadioDefault1" label="Default radio"/>
                <Input type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked
                       label="Default checked radio"/>
            </UIComponentCard>

            <UIComponentCard id="inline-radio" title="Inline Radio">
                <div class="form-check-inline">
                    <Input type="radio" name="flexRadioDefaultInline" id="flexRadioDefault3" label="Default radio"/>
                </div>
                <div class="form-check-inline">
                    <Input type="radio" name="flexRadioDefaultInline" id="flexRadioDefault4" label="Default radio"/>
                </div>
            </UIComponentCard>

            <UIComponentCard id="disabled-radio" title="Disabled Radio">
                <div class="form-check-inline">
                    <Input type="radio" name="flexRadioDefaultDisabled" id="flexRadioDefault5" label="Default radio"
                           disabled/>
                </div>
                <div class="form-check-inline">
                    <Input type="radio" name="flexRadioDefaultDisabled" id="flexRadioDefault6" label="Default radio"
                           disabled/>
                </div>
            </UIComponentCard>

            <UIComponentCard id="colors-radio" title="Colors Radio">
                <div class="mb-2">
                    <Input type="radio" id="customRadiocolor1" name="customRadiocolor1"
                           checked label="Default Radio "/>
                </div>
                <div class="form-radio-success mb-2">
                    <Input type="radio" id="customRadiocolor2" name="customRadiocolor2"
                           checked label="Success Radio "/>
                </div>
                <div class="form-radio-info mb-2">
                    <Input type="radio" id="customRadiocolor3" name="customRadiocolor3"
                           checked label="Info Radio "/>
                </div>
                <div class="form-radio-secondary mb-2">
                    <Input type="radio" id="customRadiocolor6" name="customRadiocolor6"
                           checked label="Secondary Radio "/>
                </div>
                <div class="form-radio-warning mb-2">
                    <Input type="radio" id="customRadiocolor4" name="customRadiocolor4"
                           checked label="Warning Radio "/>
                </div>
                <div class="form-radio-danger mb-2">
                    <Input type="radio" id="customRadiocolor5" name="customRadiocolor5"
                           checked label="Danger Radio "/>
                </div>
                <div class="form-radio-dark">
                    <Input type="radio" id="customRadiocolor7" name="customRadiocolor7"
                           checked label="Dark Radio "/>
                </div>
            </UIComponentCard>

            <UIComponentCard id="switch-basic" title="Switch">
                <Input type="switch" label="Default switch checkbox input"/>
                <Input type="switch" checked label="Checked switch checkbox input"/>
                <Input type="switch" disabled label="Disabled switch checkbox input"/>
                <Input type="switch" checked disabled label="Disabled checked switch checkbox input"/>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>