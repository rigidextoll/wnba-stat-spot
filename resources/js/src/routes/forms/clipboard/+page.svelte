<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Button, Col, Input, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import {copyText} from 'svelte-copy';

    let inputEle = 'name@example.com'
    let textareaEle = 'Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga.'

    const doCopy = (text: string, e: any) => {
        copyText(text)
        let prevText = e.srcElement.innerText
        e.srcElement.innerText = 'Copied!'
        setTimeout(() => {
            e.srcElement.innerText = prevText
        }, 3000)
    }

    const anchorNavigation = [
        {
            id: 'copy-from-element',
            title: 'Copy text from another element'
        },
        {
            id: 'copy-from-textarea',
            title: 'Copy text from textarea'
        },
        {
            id: 'copy-from-attribute',
            title: 'Copy text from attribute'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Clipboard" subTitle="Form"/>

    <Row>
        <Col xl="9">

            <UIComponentCard id="copy-from-element" title="Copy text from another element">
                <Row>
                    <Col lg="6">
                        <div class="input-group">
                            <Input id="clipboard_example" type="email" placeholder="name@example.com"
                                   bind:value={inputEle}/>
                            <Button color="primary" class="btn-copy-clipboard"
                                    on:click={(event) => doCopy(inputEle,event)}>Copy
                            </Button>
                        </div>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="copy-from-textarea" title="Copy text from textarea">
                <Row>
                    <Col lg="6">
                        <div class="d-flex gap-2 align-items-start">
                            <Input id="clipboard_example" type="textarea" cols="{62}" rows="{6}"
                                   bind:value={textareaEle}/>
                            <Button color="primary"
                                    on:click={(event) => doCopy(textareaEle,event)}>Copy
                            </Button>
                        </div>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="copy-from-attribute" title="Copy text from attribute">
                <Row>
                    <Col lg="6">
                        <Button color="primary"
                                on:click={(event) => doCopy(`Just because you can doesn't mean you should — clipboard.js`,event)}>
                            Copy to clipboard
                        </Button>
                    </Col>
                </Row>
            </UIComponentCard>

        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
