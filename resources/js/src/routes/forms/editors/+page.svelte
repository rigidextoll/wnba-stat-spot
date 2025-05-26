<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import {onMount} from "svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";

    let editor1: HTMLDivElement
    let editor2: HTMLDivElement

    const toolbar1 = [[{font: []}, {size: []}], ['bold', 'italic', 'underline', 'strike'], [{color: []}, {background: []}], [{script: 'super'}, {script: 'sub'}], [{header: [false, 1, 2, 3, 4, 5, 6]}, 'blockquote', 'code-block'], [{list: 'ordered'}, {list: 'bullet'}, {indent: '-1'}, {indent: '+1'}], ['direction', {align: []}], ['link', 'image', 'video'], ['clean']]
    const toolbar2 = [
        ['bold', 'italic', 'link'],
        [{header: '1'}, {header: '2'}, 'blockquote']
    ]

    onMount(async () => {
        const {default: Quill} = await import("quill");

        let quill1 = new Quill(editor1, {
            modules: {
                'toolbar': toolbar1
            },
            theme: "snow",
        });

        let quill2 = new Quill('#bubble-editor', {
            modules: {
                'toolbar': toolbar2
            },
            theme: 'bubble'
        });
    })
</script>


<DefaultLayout>
    <PageBreadcrumb title="Editors" subTitle="Form"/>

    <Row>
        <Col xl="12">

            <UIComponentCard id="quill-snow-editor" title="Snow Editor">
                <div bind:this={editor1} id="snow-editor" style="height: 300px">
                    <h3>
                        <span class="ql-size-large">Hello World!</span>
                    </h3>
                    <p><br/></p>
                    <h3>
                        This is a simple editable area.
                    </h3>
                    <p><br/></p>
                    <ul>
                        <li>Select a text to reveal the toolbar.</li>
                        <li>Edit rich document on-the-fly, so elastic!</li>
                    </ul>
                    <p><br/></p>
                    <p>End of simple area</p>
                </div>
            </UIComponentCard>

            <UIComponentCard id="quill-bubble-editor" title="Bubble Editor">
                <div bind:this={editor2} id="bubble-editor" style="height: 300px">
                    <h3>
                        <span class="ql-size-large">Hello World!</span>
                    </h3>
                    <p><br/></p>
                    <h3>
                        This is a simple editable area.
                    </h3>
                    <p><br/></p>
                    <ul>
                        <li>Select a text to reveal the toolbar.</li>
                        <li>Edit rich document on-the-fly, so elastic!</li>
                    </ul>
                    <p><br/></p>
                    <p>End of simple area</p>
                </div>
            </UIComponentCard>
        </Col>
    </Row>
</DefaultLayout>