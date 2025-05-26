<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Input, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Example'
        },
        {
            id: 'size',
            title: 'Input Sizing'
        },
        {
            id: 'disabled',
            title: 'Disabled Input'
        },
        {
            id: 'readonly',
            title: 'Readonly Input'
        },
        {
            id: 'datalists',
            title: 'Datalists input'
        },
        {
            id: 'select',
            title: 'Select input'
        }
    ]

    const options = [
        {value: '1', text: 1},
        {value: '2', text: 2},
        {value: '3', text: 3},
        {value: '4', text: 4},
        {value: '5', text: 5}
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Basic Element" subTitle="Form"/>

    <Row>
        <Col xl="9">

            <UIComponentCard id="basic" title="Basic Example">
                <div class="mb-3">
                    <label for="simpleinput" class="form-label">Text</label>
                    <Input type="text" id="simpleinput" class="form-control"/>
                </div>

                <div class="mb-3">
                    <label for="example-email" class="form-label">Email</label>
                    <Input type="email" id="example-email" name="example-email" class="form-control"
                           placeholder="email@example.com"/>
                </div>

                <div class="mb-3">
                    <label for="example-password" class="form-label">Password</label>
                    <Input type="password" id="example-password" class="form-control" value="password"/>
                </div>

                <div class="mb-3">
                    <label for="example-palaceholder" class="form-label">Placeholder</label>
                    <Input type="text" id="example-palaceholder" class="form-control" placeholder="placeholder"/>
                </div>

                <div class="mb-3">
                    <label for="example-textarea" class="form-label">Text area</label>
                    <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                </div>
            </UIComponentCard>

            <UIComponentCard id="size" title="Input Sizing">
                <div class="mt-3">
                    <Row>
                        <Col lg="6">
                            <div class="d-flex flex-column gap-2">
                                <Input bsSize="lg" type="text" placeholder="Lg"/>
                                <Input bsSize="md" type="text" placeholder="Md"/>
                                <Input bsSize="sm" type="text" placeholder="Sm"/>
                            </div>
                        </Col>
                    </Row>
                </div>
            </UIComponentCard>

            <UIComponentCard id="disabled" title="Disabled Input">
                <Row>
                    <Col lg="6">
                        <div class="d-flex flex-column gap-2">
                            <Input type="text" placeholder="Disabled input" disabled/>
                            <Input type="text" placeholder="Disabled readonly input" disabled readonly/>
                        </div>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="readonly" title="Readonly Input">
                <Row>
                    <Col lg="6">
                        <div class="d-flex flex-column gap-2">
                            <Input type="text" placeholder="Readonly input here..." readonly/>
                            <Input plaintext type="text" readonly id="staticEmail"
                                   value="email@example.com"/>
                        </div>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="datalists" title="Datalists input">
                <Row>
                    <Col lg="6">
                        <div>
                            <label for="exampleDataList" class="form-label">Datalist example</label>
                            <Input list="datalistOptions" id="exampleDataList"
                                   placeholder="Type to search..."/>
                            <datalist id="datalistOptions">
                                <option value="San Francisco"></option>
                                <option value="New York"></option>
                                <option value="Seattle"></option>
                                <option value="Los Angeles"></option>
                                <option value="Chicago"></option>
                            </datalist>
                        </div>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="select" title="Select">
                <Row>
                    <Col lg="6">
                        <div class="mb-3">
                            <label for="example-select" class="form-label">Default Input Select</label>
                            <Input type="select" id="example-select">
                                {#each options as option}
                                    <option value={option.value}>{option.text}</option>
                                {/each}
                            </Input>
                        </div>

                        <div class="mb-3">
                            <label for="example-select" class="form-label">Dark Input Select</label>
                            <Input type="select" id="example-select" theme="dark">
                                {#each options as option}
                                    <option value={option.value}>{option.text}</option>
                                {/each}
                            </Input>
                        </div>
                    </Col>
                </Row>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>
