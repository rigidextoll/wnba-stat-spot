<script lang="ts">

    import {Col, Form, Input, Row} from "@sveltestrap/sveltestrap";
    import ChoicesSelect from "$lib/components/ChoicesSelect.svelte";
    import QuillEditor from "$lib/components/QuillEditor.svelte";


    const toolbar = [
        [{font: []}, {size: []}],
        ["bold", "italic", "underline", "strike"],
        [{color: []}, {background: []}],
        [{script: "super"}, {script: "sub"}],
        [{header: [false, 1, 2, 3, 4, 5, 6]}, "blockquote", "code-block"],
        [{list: "ordered"}, {list: "bullet"}, {indent: "-1"}, {indent: "+1"}],
        ["direction", {align: []}],
        ["link", "image", "video"],
        ["clean"],
    ];

    const inlineStackedOptions = [
        {text: 'Online', value: 'online'},
        {text: 'Offline', value: 'offline'},
        {text: 'Draft', value: 'draft'},
    ];


    const options = {
        theme: 'snow',
        modules: {
            toolbar: [
                [{font: []}, {size: []}],
                ["bold", "italic", "underline", "strike"],
                [{color: []}, {background: []}],
                [{script: "super"}, {script: "sub"}],
                [{header: [false, 1, 2, 3, 4, 5, 6]}, "blockquote", "code-block"],
                [{list: "ordered"}, {list: "bullet"}, {indent: "-1"}, {indent: "+1"}],
                ["direction", {align: []}],
                ["link", "image", "video"],
                ["clean"],
            ]
        },
    }
</script>

<Form id="generalDetailForm">
    <Row>
        <Col lg="6">
            <div class="mb-3">
                <label class="form-label" for="productName">Product Name</label>
                <Input type="text" id="productName" placeholder="Enter Product Name"/>
            </div>
        </Col>
        <Col lg="6">
            <div class="mb-3">
                <label class="form-label" for="referenceName">Reference</label>
                <Input type="text" id="referenceName" placeholder="Enter Reference Name"/>
            </div>
        </Col>
    </Row>
    <Row>
        <Col lg="12">
            <div class="mb-3">
                <label class="form-label" for="description">Product Description</label>
                <QuillEditor id="description" options={options} height={195}>
                    <h5>
                        <span class="ql-size-large">
                            Describe Your Product Description...
                        </span>
                    </h5>
                </QuillEditor>
            </div>
        </Col>
        <Col lg="6">
            <div class="mb-3">
                <label for="productSummary" class="form-label">Product Summary</label>
                <Input type="textarea" id="productSummary" rows={5}/>
            </div>
        </Col>
        <Col lg="6">
            <div class="mb-3">
                <ChoicesSelect id="categories" label="Categories">
                    <optgroup label="">
                        <option value="select">Select</option>
                    </optgroup>
                    <optgroup label="Shopping">
                        <option value="shopping1">Shopping 1
                        </option>
                        <option value="shopping2">Shopping 2
                        </option>
                        <option value="shopping3">Shopping 3
                        </option>
                        <option value="shopping4">Shopping 4
                        </option>
                    </optgroup>
                    <optgroup label="CRM">
                        <option value="CRM1">CRM 1
                        </option>
                        <option value="CRM2">CRM 2
                        </option>
                    </optgroup>
                </ChoicesSelect>

            </div>
            <div class="mb-3">
                <label class="form-label" for="price">Price</label>
                <Input type="text" id="price" placeholder="Enter amount"/>
            </div>
        </Col>
    </Row>
    <div class="mb-3">
        <label class="form-label" for="">Status</label><br/>
        {#each inlineStackedOptions as option}
            <Input type="radio" value={option.value} label={option.text}/>
        {/each}
    </div>
    <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <Input type="textarea" class="form-control" id="comment" rows={3}></Input>
    </div>
</Form>