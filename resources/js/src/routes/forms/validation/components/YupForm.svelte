<script lang="ts">
    import {boolean, type InferType, object, string} from 'yup'
    import {Button, Form, Input, Col, InputGroup, InputGroupText} from "@sveltestrap/sveltestrap";

    let error = ''
    const yupSchema = object({
        isAgree: boolean().required('Please agree with our terms'),
        zip: string().min(6, 'Must be at least 6 characters').required('Zip code is Required'),
        state: string().required('State is Required'),
        city: string().required('City is Required'),
        username: string().required('Username is Required'),
        lastName: string().required('Last name is Required'),
        firstName: string().required('First name is Required')
    })
    type Schema = InferType<typeof yupSchema>
    const yupState = {
        firstName: undefined,
        lastName: undefined,
        username: undefined,
        city: undefined,
        state: undefined,
        zip: undefined,
        isAgree: undefined
    }
    const handleYupSubmit = async (event: Event) => {
        try {
            yupSchema
                .validate(yupState).then((res) => {
                error = ''
            }).catch((e) => {
                error = e.message
            })
        } catch (e) {
        }
    }
</script>


<form class="row g-3" on:submit|preventDefault={handleYupSubmit}>
    {#if (error.length > 0)}
        <div class="text-danger">{error}</div>
    {/if}
    <Col md="4">
        <label for="" class="form-label">First name</label>
        <Input type="text" bind:value={yupState.firstName}/>
    </Col>

    <Col md="4">
        <label for="" class="form-label">Last name</label>
        <Input type="text" bind:value={yupState.lastName}/>
    </Col>

    <Col md="4">
        <label for="" class="form-label">Username</label>
        <InputGroup>
            <InputGroupText>@</InputGroupText>
            <Input type="text" bind:value={yupState.username}/>
        </InputGroup>
    </Col>

    <Col md="6">
        <label for="" class="form-label">City</label>
        <Input type="text" bind:value={yupState.city}/>
    </Col>

    <Col md="3">
        <label for="" class="form-label">State</label>
        <Input type="select" bind:value={yupState.state}>
            <option selected disabled value="">Choose...</option>
            <option>...</option>
        </Input>
    </Col>

    <Col md="3">
        <label for="" class="form-label">Zip</label>
        <Input bind:value={yupState.zip} type="text"/>
    </Col>

    <Col xs="12">
        <Input type="checkbox" bind:checked={yupState.isAgree} label="Agree to terms and conditions"/>
    </Col>

    <Col xs="12">
        <Button color="primary" type="submit"> Submit form</Button>
    </Col>
</form>