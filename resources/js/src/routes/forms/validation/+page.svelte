<script lang="ts">

    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Button, Col, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import YupForm from "./components/YupForm.svelte";
    import SveltestrapForm from "./components/SveltestrapForm.svelte";

    const anchorNavigation = [
        {
            id: 'yup',
            title: 'Yup'
        },
        {
            id: 'sveltestrap',
            title: 'Sveltestrap'
        },
        {
            id: 'supported-elements',
            title: 'Supported Elements'
        }
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Validation" subTitle="Form"/>

    <Row>
        <Col xl="9">
            <UIComponentCard id="yup" title="Yup">
                <YupForm/>
            </UIComponentCard>

            <UIComponentCard id="sveltestrap" title="Sveltestrap">
                <SveltestrapForm/>
            </UIComponentCard>

            <UIComponentCard id="server-side" title="Supported elements">
                <div class="mt-3">
                    <form class="row g-3">
                        <Col md="4">
                            <label for="validationServer01" class="form-label">First name</label>
                            <input type="text" class="form-control is-valid" id="validationServer01" value="Mark"
                                   required/>
                            <div class="valid-feedback">Looks good!</div>
                        </Col>
                        <Col md="4">
                            <label for="validationServer02" class="form-label">Last name</label>
                            <input type="text" class="form-control is-valid" id="validationServer02" value="Otto"
                                   required/>
                            <div class="valid-feedback">Looks good!</div>
                        </Col>
                        <Col md="4">
                            <label for="validationServerUsername" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend3">@</span>
                                <input type="text" class="form-control is-invalid" id="validationServerUsername"
                                       aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback"
                                       required/>
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">Please choose a
                                    username.
                                </div>
                            </div>
                        </Col>
                        <Col md="6">
                            <label for="validationServer03" class="form-label">City</label>
                            <input type="text" class="form-control is-invalid" id="validationServer03"
                                   aria-describedby="validationServer03Feedback" required/>
                            <div id="validationServer03Feedback" class="invalid-feedback">Please provide a valid
                                city.
                            </div>
                        </Col>
                        <Col md="3">
                            <label for="validationServer04" class="form-label">State</label>
                            <select class="form-select is-invalid" id="validationServer04"
                                    aria-describedby="validationServer04Feedback" required>
                                <option selected disabled value="">Choose...</option>
                                <option>...</option>
                            </select>
                            <div id="validationServer04Feedback" class="invalid-feedback">Please select a valid
                                state.
                            </div>
                        </Col>
                        <Col md="3">
                            <label for="validationServer05" class="form-label">Zip</label>
                            <input type="text" class="form-control is-invalid" id="validationServer05"
                                   aria-describedby="validationServer05Feedback" required/>
                            <div id="validationServer05Feedback" class="invalid-feedback">Please provide a valid
                                zip.
                            </div>
                        </Col>
                        <Col xs="12">
                            <div class="form-check">
                                <input class="form-check-input is-invalid" type="checkbox" value=""
                                       id="invalidCheck3" aria-describedby="invalidCheck3Feedback" required/>
                                <label class="form-check-label" for="invalidCheck3"> Agree to terms and
                                    conditions </label>
                                <div id="invalidCheck3Feedback" class="invalid-feedback">You must agree before
                                    submitting.
                                </div>
                            </div>
                        </Col>
                        <Col xs="12">
                            <Button color="primary" type="submit"> Submit form</Button>
                        </Col>
                    </form>
                </div>
            </UIComponentCard>

            <UIComponentCard id="supported-elements" title="Supported elements">
                <div class="mt-3">
                    <form class="was-validated">
                        <div class="mb-3">
                            <label for="validationTextarea" class="form-label">Textarea</label>
                            <textarea class="form-control" id="validationTextarea"
                                      placeholder="Required example textarea" required></textarea>
                            <div class="invalid-feedback">Please enter a message in the textarea.</div>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="validationFormCheck1" required/>
                            <label class="form-check-label" for="validationFormCheck1">Check this checkbox</label>
                            <div class="invalid-feedback">Example invalid feedback text</div>
                        </div>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="validationFormCheck2"
                                   name="radio-stacked" required/>
                            <label class="form-check-label" for="validationFormCheck2">Toggle this radio</label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="radio" class="form-check-input" id="validationFormCheck3"
                                   name="radio-stacked" required/>
                            <label class="form-check-label" for="validationFormCheck3">Or toggle this other
                                radio</label>
                            <div class="invalid-feedback">More example invalid feedback text</div>
                        </div>

                        <div class="mb-3">
                            <select class="form-select" required aria-label="select example">
                                <option value="">Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <div class="invalid-feedback">Example invalid select feedback</div>
                        </div>

                        <div class="mb-3">
                            <input type="file" class="form-control" aria-label="file example" required/>
                            <div class="invalid-feedback">Example invalid form file feedback</div>
                        </div>

                        <div class="mb-3">
                            <Button color="primary" type="submit"> Submit form</Button>
                        </div>
                    </form>
                </div>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>