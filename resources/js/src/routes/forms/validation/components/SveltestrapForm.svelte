<script lang="ts">

    import {Button, Col, Form, FormGroup, Input, InputGroup, InputGroupText} from "@sveltestrap/sveltestrap";

    let validated = false;

    const state = {
        firstName: 'Mark',
        lastName: 'Otto',
    }

    //
    // const validateFirstName = computed(() => {
    //     return vbState.firstName.length > 0 && vbState.firstName.length < 15
    // })
    // const validateLastName = computed(() => {
    //     return vbState.lastName.length > 0 && vbState.lastName.length < 15
    // })
    // const validateUserName = computed(() => {
    //     return vbState.username.length > 0 && vbState.username.length < 15
    // })
    // const validateCity = computed(() => {
    //     return vbState.city.length > 0 && vbState.city.length < 15
    // })
    // const validateState = computed(() => {
    //     return vbState.state.length > 0 && vbState.state.length < 15
    // })
    // const validateZip = computed(() => {
    //     return vbState.zip.length > 0 && vbState.zip.length <= 6
    // })
    // const validateAgree = computed(() => {
    //     return vbState.isAgree == true
    // })
</script>

<Form class="row g-3" {validated} on:submit={(e) => e.preventDefault()}>
    <Col md="4">
        <FormGroup>
            <label for="" class="form-label">First name</label>
            <Input type="text" feedback="Looks good!" required bind:value={state.firstName} valid/>
        </FormGroup>
    </Col>

    <Col md="4">
        <FormGroup>
            <label for="" class="form-label">Last name</label>
            <Input type="text" feedback="Looks good!" required bind:value={state.lastName} valid/>
        </FormGroup>
    </Col>

    <Col md="4">
        <FormGroup>
            <label for="" class="form-label">Last name</label>
            <InputGroup>
                <InputGroupText>@</InputGroupText>
                <Input type="text" feedback="Please choose a username." required invalid/>
            </InputGroup>
        </FormGroup>
    </Col>

    <Col md="6">
        <FormGroup>
            <label for="" class="form-label">City</label>
            <Input type="text" feedback="Please provide a valid city." required invalid/>
        </FormGroup>
    </Col>

    <Col md="3">
        <FormGroup>
            <label for="" class="form-label">City</label>
            <Input type="select" feedback="Please select a valid state." required invalid>
                <option selected disabled value="">Choose...</option>
                <option>...</option>
            </Input>
        </FormGroup>
    </Col>

    <Col md="3">
        <FormGroup>
            <label for="" class="form-label">Zip</label>
            <Input type="text" feedback="Please provide a valid zip." required invalid/>
        </FormGroup>
    </Col>

    <Col xs="12">
        <Input type="checkbox" feedback="You must agree before submitting." label="Agree to terms and conditions"
               required invalid/>
    </Col>

    <Col xs="12">
        <Button color="primary" type="submit"> Submit form</Button>
    </Col>
</Form>