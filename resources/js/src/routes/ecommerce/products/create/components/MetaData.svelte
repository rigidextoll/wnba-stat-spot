<script lang="ts">
    import {Form, Row, Col, Input} from "@sveltestrap/sveltestrap";
</script>

<Form id="metaDataForm" method="post" action="#">
    <h5 class="mb-3 mt-0">
        Fill all information below
    </h5>
    <Row>
        <Col md="6">
            <div class="mb-3">
                <label for="metaTitle">Meta Title</label>
                <Input type="text" id="metaTitle" placeholder="Enter Meta Title"/>
            </div>
        </Col>
        <Col md="6">
            <div class="mb-3">
                <label for="metaKeywords">Meta Keywords</label>
                <Input type="text" id="metaKeywords" placeholder="Enter Meta Keywords"/>
            </div>
        </Col>
    </Row>
    <div class="mb-3">
        <label for="metaDescription">Meta Description</label>
        <Input type="textarea" id="metaDescription" rows={3}/>
    </div>
</Form>