<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Col, Form, Input, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import Icon from "@iconify/svelte";
    import {onMount} from "svelte";


    const dummyAvatar = '/images/users/dummy-avatar.jpg'

    const countryOptions = [
        {value: 'United States', text: 'United States'},
        {value: 'Canada', text: 'Canada'},
        {value: 'Australia', text: 'Australia'},
        {value: 'Germany', text: 'Germany'},
        {value: 'Bangladesh', text: 'Bangladesh'},
        {value: 'China', text: 'China'},
        {value: 'Argentina', text: 'Argentina'},
        {value: 'Bharat', text: 'Bharat'},
        {value: 'Afghanistan', text: 'Afghanistan'},
        {value: 'France', text: 'France'},
        {value: 'Brazil', text: 'Brazil'},
        {value: 'Belgium', text: 'Belgium'},
        {value: 'Colombia', text: 'Colombia'},
        {value: 'Albania', text: 'Albania'}
    ]

    onMount(async () => {
        const Wizard = (await import('./wizard')).default
        new Wizard('#horizontalwizard');
        new Wizard('#verticalwizard');
    })
</script>

<DefaultLayout>
    <PageBreadcrumb title="Wizard" subTitle="Form"/>

    <Row>
        <Col xs="12">
            <UIComponentCard id="basic-wizard" title="Horizontal Wizard">
                <Form>
                    <div id="horizontalwizard">
                        <ul class="nav nav-pills nav-justified icon-wizard form-wizard-header bg-light p-1"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <a
                                        href="#basictab1"
                                        data-bs-toggle="tab"
                                        data-toggle="tab"
                                        class="nav-link rounded-0 py-2 active"
                                        aria-selected="true"
                                        role="tab">
                                    <Icon icon="iconamoon:profile-circle-duotone" class="fs-26"></Icon>
                                    Account </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a
                                        href="#basictab2"
                                        data-bs-toggle="tab"
                                        data-toggle="tab"
                                        class="nav-link rounded-0 py-2"
                                        aria-selected="false"
                                        role="tab"
                                        tabindex="-1">
                                    <Icon icon="iconamoon:profile-duotone" class="fs-26"></Icon>
                                    Profile </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a
                                        href="#basictab3"
                                        data-bs-toggle="tab"
                                        data-toggle="tab"
                                        class="nav-link rounded-0 py-2"
                                        aria-selected="false"
                                        tabindex="-1"
                                        role="tab">
                                    <Icon icon="iconamoon:link-fill" class="fs-26"></Icon>
                                    Social Links </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a
                                        href="#basictab4"
                                        data-bs-toggle="tab"
                                        data-toggle="tab"
                                        class="nav-link rounded-0 py-2"
                                        aria-selected="false"
                                        tabindex="-1"
                                        role="tab">
                                    <Icon icon="iconamoon:check-circle-1-duotone" class="fs-26"></Icon>
                                    Finish </a>
                            </li>

                        </ul>

                        <div class="tab-content mb-0">
                            <div
                                    class="tab-pane active show"
                                    id="basictab1"
                                    role="tabpanel">
                                <h4
                                        class="fs-16 fw-semibold mb-1">
                                    Account Information
                                </h4>
                                <p class="text-muted">
                                    Setup your account
                                    information
                                </p>

                                <Row>
                                    <Col lg="6">
                                        <div class="mb-3">
                                            <label for="basicUser" class="form-label">User Name</label>
                                            <Input id="basicUser" type="text" placeholder="Enter User Name"/>
                                        </div>
                                    </Col>

                                    <Col lg="6">
                                        <div class="mb-3">
                                            <label for="basicEmail" class="form-label">Email</label>
                                            <Input id="basicEmail" type="email" placeholder="Enter your email"/>
                                        </div>
                                    </Col>

                                    <Col lg="6">
                                        <div class="mb-3">
                                            <label for="basicPassworda" class="form-label">Password</label>
                                            <Input id="basicPassworda" type="text" placeholder="Enter Password"/>
                                        </div>
                                    </Col>

                                    <Col lg="6">
                                        <div class="mb-3">
                                            <label for="basicConfirmPassword" class="form-label">Confirm
                                                Password</label>
                                            <Input id="basicConfirmPassword" type="text"
                                                   placeholder="Confirm a Password"/>
                                        </div>
                                    </Col>

                                </Row>

                            </div>


                            <div class="tab-pane" id="basictab2" role="tabpanel">
                                <h4 class="fs-16 fw-semibold mb-1">
                                    Profile Information
                                </h4>
                                <p class="text-muted">
                                    Setup your profile
                                    information
                                </p>

                                <Row>
                                    <Col xs="12">
                                        <div class="avatar-lg mb-3">
                                            <div class="avatar-title bg-body rounded-circle border border-3 border-dashed-light position-relative">
                                                <label for="imageInput" class="position-absolute end-0 bottom-0">
                                                    <div class="avatar-xs cursor-pointer">
                                                        <span class="avatar-title bg-light text-dark rounded-circle"><i
                                                                class="bx bx-camera"></i></span>
                                                    </div>
                                                </label>
                                                <input class="hidden" type="file" id="imageInput" accept="image/*"/>
                                                <img
                                                        id="preview"
                                                        src={dummyAvatar}
                                                        alt="Preview Image"
                                                        class="rounded-circle img-fluid"
                                                />
                                            </div>
                                        </div>

                                        <Row>
                                            <Col md="6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="basicFname">First Name</label>
                                                    <Input type="text" id="basicFname" placeholder="Chris"
                                                    />
                                                </div>
                                            </Col>

                                            <Col md="6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="basicLname">Last Name</label>
                                                    <Input type="text" id="basicLname" placeholder="Keller"/>
                                                </div>
                                            </Col>

                                            <Col md="6">
                                                <div
                                                        class="mb-3"
                                                >
                                                    <label
                                                            class="form-label"
                                                            for="basicMnumber"
                                                    >Number</label
                                                    >
                                                    <Input
                                                            type="number"
                                                            id="basicMnumber"
                                                            placeholder="Mobile Number"
                                                    />
                                                </div>
                                            </Col>

                                            <Col md="6"
                                            >
                                                <div
                                                        class="mb-3"
                                                >
                                                    <label
                                                            class="form-label"
                                                            for="basicCountry"
                                                    >Country</label
                                                    >
                                                    <Input type="select"
                                                           id="basicCountry"

                                                    >
                                                        <option
                                                                value="United States"
                                                        >
                                                            United
                                                            States
                                                        </option>
                                                        <option
                                                                value="Canada"
                                                        >
                                                            Canada
                                                        </option>
                                                        <option
                                                                value="Australia"
                                                        >
                                                            Australia
                                                        </option>
                                                        <option
                                                                value="Germany"
                                                        >
                                                            Germany
                                                        </option>
                                                        <option
                                                                value="Bangladesh"
                                                        >
                                                            Bangladesh
                                                        </option>
                                                        <option
                                                                value="China"
                                                        >
                                                            China
                                                        </option>
                                                        <option
                                                                value="Argentina"
                                                        >
                                                            Argentina
                                                        </option>
                                                        <option
                                                                value="Bharat"
                                                        >
                                                            Bharat
                                                        </option>
                                                        <option
                                                                value="Afghanistan"
                                                        >
                                                            Afghanistan
                                                        </option>
                                                        <option
                                                                value="France"
                                                        >
                                                            France
                                                        </option>
                                                        <option
                                                                value="Brazil"
                                                        >
                                                            Brazil
                                                        </option>
                                                        <option
                                                                value="Belgium"
                                                        >
                                                            Belgium
                                                        </option>
                                                        <option
                                                                value="Colombia"
                                                        >
                                                            Colombia
                                                        </option>
                                                        <option
                                                                value="Albania"
                                                        >
                                                            Albania
                                                        </option>
                                                    </Input>
                                                </div>
                                            </Col>

                                        </Row>

                                    </Col>

                                </Row>

                            </div>


                            <div
                                    class="tab-pane"
                                    id="basictab3"
                                    role="tabpanel"
                            >
                                <h4
                                        class="fs-16 fw-semibold mb-1"
                                >
                                    Social Media Links
                                </h4>
                                <p class="text-muted">
                                    Fill your social
                                    media links
                                </p>

                                <Row>
                                    <Col lg="6">
                                        <div
                                                class="mb-3"
                                        >
                                            <label
                                                    for="basicGitLink"
                                                    class="form-label"
                                            >GitHub</label
                                            >
                                            <Input
                                                    id="basicGitLink"
                                                    type="text"
                                                    placeholder="GitHub Link"
                                            />
                                        </div>
                                    </Col>

                                    <Col lg="6">
                                        <div
                                                class="mb-3"
                                        >
                                            <label
                                                    for="basicGoogleLink"
                                                    class="form-label"
                                            >Google</label
                                            >
                                            <Input
                                                    id="basicGoogleLink"
                                                    type="text"
                                                    placeholder="Google Link"
                                            />
                                        </div>
                                    </Col>

                                    <Col lg="6">
                                        <div
                                                class="mb-3"
                                        >
                                            <label
                                                    for="basicInstagramLink"
                                                    class="form-label"
                                            >Instagram</label
                                            >
                                            <Input
                                                    id="basicInstagramLink"
                                                    type="text"
                                                    placeholder="Instagram Link"
                                            />
                                        </div>
                                    </Col>

                                    <Col lg="6">
                                        <div
                                                class="mb-3"
                                        >
                                            <label
                                                    for="basicSkypeLink"
                                                    class="form-label"
                                            >Skype</label
                                            >
                                            <Input
                                                    id="basicSkypeLink"
                                                    type="text"
                                                    placeholder="Skype Link"
                                            />
                                        </div>
                                    </Col>

                                </Row>

                            </div>


                            <div
                                    class="tab-pane"
                                    id="basictab4"
                                    role="tabpanel"
                            >
                                <Row>
                                    <Col xs="12">
                                        <div
                                                class="text-center"
                                        >
                                            <div
                                                    class="avatar-md mx-auto mb-3"
                                            >
                                                <div
                                                        class="avatar-title bg-primary bg-opacity-10 text-primary rounded-circle"
                                                >
                                                    <Icon
                                                            icon="iconamoon:like-duotone"
                                                            class="fs-36"
                                                    ></Icon>
                                                </div>
                                            </div>
                                            <h3
                                                    class="mt-0"
                                            >
                                                Finished
                                                !
                                            </h3>

                                            <p
                                                    class="w-75 mb-2 mx-auto"
                                            >
                                                Filled
                                                Data
                                                Successfully.
                                            </p>

                                            <div
                                                    class="mb-3"
                                            >
                                                <div
                                                        class="form-check d-inline-block"
                                                >
                                                    <Input
                                                            type="checkbox"
                                                            class="form-check-input"
                                                            id="customCheck1"
                                                    />
                                                    <label
                                                            class="form-check-label"
                                                            for="customCheck1"
                                                    >I
                                                        agree
                                                        with
                                                        the
                                                        Terms
                                                        and
                                                        Conditions</label
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </Col>

                                </Row>

                            </div>


                            <div
                                    class="d-flex flex-wrap align-items-center wizard justify-content-between gap-3 mt-3"
                            >
                                <div class="first">
                                    <a
                                            href={"#"}
                                            class="btn btn-soft-primary"
                                    >
                                        First
                                    </a>
                                </div>
                                <div
                                        class="d-flex gap-2"
                                >
                                    <div
                                            class="previous"
                                    >
                                        <a
                                                href={"#"}
                                                class="btn btn-primary disabled"
                                        >
                                            <i
                                                    class="bx bx-left-arrow-alt me-2"
                                            ></i
                                            >Back To
                                            Previous
                                        </a>
                                    </div>
                                    <div class="next">
                                        <a
                                                href={"#"}
                                                class="btn btn-primary"
                                        >
                                            Next Step<i
                                                class="bx bx-right-arrow-alt ms-2"
                                        ></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="last">
                                    <a
                                            href={"#"}
                                            class="btn btn-soft-primary"
                                    >
                                        Finish
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </Form>
            </UIComponentCard>

            <UIComponentCard id="vertical-wizard" title="Vertical Wizard">
                <form id="verticalwizard">
                    <Row>
                        <Col lg="3">
                            <ul
                                    class="nav nav-pills nav-justified flex-column icon-wizard form-wizard-header bg-light p-1"
                                    role="tablist"
                            >
                                <li
                                        class="nav-item"
                                        role="presentation"
                                >
                                    <a
                                            href="#basictabHorizontal1"
                                            data-bs-toggle="tab"
                                            data-toggle="tab"
                                            class="nav-link rounded-0 py-2 active"
                                            aria-selected="true"
                                            role="tab"
                                    >
                                        <Icon
                                                icon="iconamoon:profile-circle-duotone"
                                                class="fs-26"
                                        ></Icon>
                                        Account </a
                                    >
                                </li>

                                <li
                                        class="nav-item"
                                        role="presentation"
                                >
                                    <a
                                            href="#basictabHorizontal2"
                                            data-bs-toggle="tab"
                                            data-toggle="tab"
                                            class="nav-link rounded-0 py-2"
                                            aria-selected="false"
                                            role="tab"
                                            tabindex="-1"
                                    >
                                        <Icon
                                                icon="iconamoon:profile-duotone"
                                                class="fs-26"
                                        ></Icon>
                                        Profile </a
                                    >
                                </li>

                                <li
                                        class="nav-item"
                                        role="presentation"
                                >
                                    <a
                                            href="#basictabHorizontal3"
                                            data-bs-toggle="tab"
                                            data-toggle="tab"
                                            class="nav-link rounded-0 py-2"
                                            aria-selected="false"
                                            tabindex="-1"
                                            role="tab"
                                    >
                                        <Icon
                                                icon="iconamoon:link-fill"
                                                class="fs-26"
                                        ></Icon>
                                        Social Links </a
                                    >
                                </li>

                                <li
                                        class="nav-item"
                                        role="presentation"
                                >
                                    <a
                                            href="#basictabHorizontal4"
                                            data-bs-toggle="tab"
                                            data-toggle="tab"
                                            class="nav-link rounded-0 py-2"
                                            aria-selected="false"
                                            tabindex="-1"
                                            role="tab"
                                    >
                                        <Icon
                                                icon="iconamoon:check-circle-1-duotone"
                                                class="fs-26"
                                        ></Icon>
                                        Finish </a
                                    >
                                </li>

                            </ul>
                        </Col>

                        <Col lg="9">
                            <div
                                    class="tab-content mb-0"
                            >
                                <div
                                        class="tab-pane active show"
                                        id="basictabHorizontal1"
                                        role="tabpanel"
                                >
                                    <h4
                                            class="fs-16 fw-semibold mb-1"
                                    >
                                        Account
                                        Information
                                    </h4>
                                    <p
                                            class="text-muted"
                                    >
                                        Setup your
                                        account
                                        information
                                    </p>

                                    <Row>
                                        <Col lg="6">
                                            <div
                                                    class="mb-3"
                                            >
                                                <label
                                                        for="basicUser2"
                                                        class="form-label"
                                                >User
                                                    Name</label
                                                >
                                                <Input
                                                        id="basicUser2"
                                                        type="text"
                                                        placeholder="Enter User Name"
                                                />
                                            </div>
                                        </Col>

                                        <Col lg="6">
                                            <div
                                                    class="mb-3"
                                            >
                                                <label
                                                        for="basicEmail2"
                                                        class="form-label"
                                                >Email</label
                                                >
                                                <Input
                                                        id="basicEmail2"
                                                        type="email"
                                                        placeholder="Enter your email"
                                                />
                                            </div>
                                        </Col>

                                        <Col lg="6">
                                            <div
                                                    class="mb-3"
                                            >
                                                <label
                                                        for="basicPassworda2"
                                                        class="form-label"
                                                >Password</label
                                                >
                                                <Input
                                                        id="basicPassworda2"
                                                        type="text"
                                                        placeholder="Enter Password"
                                                />
                                            </div>
                                        </Col>

                                        <Col lg="6">
                                            <div
                                                    class="mb-3"
                                            >
                                                <label
                                                        for="basicConfirmPassword2"
                                                        class="form-label"
                                                >Confirm
                                                    Password</label
                                                >
                                                <Input
                                                        id="basicConfirmPassword2"
                                                        type="text"
                                                        placeholder="Confirm a Password"
                                                />
                                            </div>
                                        </Col>

                                    </Row>

                                </div>


                                <div
                                        class="tab-pane"
                                        id="basictabHorizontal2"
                                        role="tabpanel"
                                >
                                    <h4
                                            class="fs-16 fw-semibold mb-1"
                                    >
                                        Profile
                                        Information
                                    </h4>
                                    <p
                                            class="text-muted"
                                    >
                                        Setup your
                                        profile
                                        information
                                    </p>

                                    <Row>
                                        <Col xs="12"
                                        >
                                            <div
                                                    class="avatar-lg mb-3"
                                            >
                                                <div
                                                        class="avatar-title bg-body rounded-circle border border-3 border-dashed-light position-relative"
                                                >
                                                    <label
                                                            for="imageInput"
                                                            class="position-absolute end-0 bottom-0"
                                                    >
                                                        <div
                                                                class="avatar-xs cursor-pointer"
                                                        >
                                                                                    <span
                                                                                            class="avatar-title bg-light text-dark rounded-circle"
                                                                                    ><i
                                                                                            class="bx bx-camera"
                                                                                    ></i
                                                                                    ></span>
                                                        </div>
                                                    </label>
                                                    <input
                                                            class="hidden"
                                                            type="file"
                                                            id="imageInput"
                                                            accept="image/*"
                                                    />

                                                    <img id="preview" src={dummyAvatar} alt="Preview Image"
                                                         class="rounded-circle img-fluid"/>
                                                </div>
                                            </div>

                                            <Row
                                            >
                                                <Col md="6">
                                                    <div
                                                            class="mb-3"
                                                    >
                                                        <label
                                                                class="form-label"
                                                                for="basicFname2"
                                                        >First
                                                            Name</label
                                                        >
                                                        <Input
                                                                type="text"
                                                                id="basicFname2"
                                                                placeholder="Chris"
                                                        />
                                                    </div>
                                                </Col>

                                                <Col md="6">
                                                    <div
                                                            class="mb-3"
                                                    >
                                                        <label
                                                                class="form-label"
                                                                for="basicLname2"
                                                        >Last
                                                            Name</label
                                                        >
                                                        <Input
                                                                type="text"
                                                                id="basicLname2"
                                                                placeholder="Keller"
                                                        />
                                                    </div>
                                                </Col>

                                                <Col md="6">
                                                    <div
                                                            class="mb-3"
                                                    >
                                                        <label
                                                                class="form-label"
                                                                for="basicMnumber2"
                                                        >Number</label
                                                        >
                                                        <Input
                                                                type="number"
                                                                id="basicMnumber2"
                                                                placeholder="Mobile Number"
                                                        />
                                                    </div>
                                                </Col>

                                                <Col md="6">
                                                    <div
                                                            class="mb-3"
                                                    >
                                                        <label
                                                                class="form-label"
                                                                for="basicCountry2"
                                                        >Country</label
                                                        >
                                                        <Input type="select"
                                                               id="basicCountry2"

                                                        >
                                                            <option
                                                                    value="United States"
                                                            >
                                                                United
                                                                States
                                                            </option>
                                                            <option
                                                                    value="Canada"
                                                            >
                                                                Canada
                                                            </option>
                                                            <option
                                                                    value="Australia"
                                                            >
                                                                Australia
                                                            </option>
                                                            <option
                                                                    value="Germany"
                                                            >
                                                                Germany
                                                            </option>
                                                            <option
                                                                    value="Bangladesh"
                                                            >
                                                                Bangladesh
                                                            </option>
                                                            <option
                                                                    value="China"
                                                            >
                                                                China
                                                            </option>
                                                            <option
                                                                    value="Argentina"
                                                            >
                                                                Argentina
                                                            </option>
                                                            <option
                                                                    value="Bharat"
                                                            >
                                                                Bharat
                                                            </option>
                                                            <option
                                                                    value="Afghanistan"
                                                            >
                                                                Afghanistan
                                                            </option>
                                                            <option
                                                                    value="France"
                                                            >
                                                                France
                                                            </option>
                                                            <option
                                                                    value="Brazil"
                                                            >
                                                                Brazil
                                                            </option>
                                                            <option
                                                                    value="Belgium"
                                                            >
                                                                Belgium
                                                            </option>
                                                            <option
                                                                    value="Colombia"
                                                            >
                                                                Colombia
                                                            </option>
                                                            <option
                                                                    value="Albania"
                                                            >
                                                                Albania
                                                            </option>
                                                        </Input>
                                                    </div>
                                                </Col>

                                            </Row>

                                        </Col>

                                    </Row>

                                </div>


                                <div
                                        class="tab-pane"
                                        id="basictabHorizontal3"
                                        role="tabpanel"
                                >
                                    <h4
                                            class="fs-16 fw-semibold mb-1"
                                    >
                                        Social Media
                                        Links
                                    </h4>
                                    <p
                                            class="text-muted"
                                    >
                                        Fill your social
                                        media links
                                    </p>

                                    <Row>
                                        <Col lg="6">
                                            <div
                                                    class="mb-3"
                                            >
                                                <label
                                                        for="basicGitLink2"
                                                        class="form-label"
                                                >GitHub</label
                                                >
                                                <Input
                                                        id="basicGitLink2"
                                                        type="text"
                                                        placeholder="GitHub Link"
                                                />
                                            </div>
                                        </Col>

                                        <Col lg="6">
                                            <div
                                                    class="mb-3"
                                            >
                                                <label
                                                        for="basicGoogleLink2"
                                                        class="form-label"
                                                >Google</label
                                                >
                                                <Input
                                                        id="basicGoogleLink2"
                                                        type="text"
                                                        placeholder="Google Link"
                                                />
                                            </div>
                                        </Col>

                                        <Col lg="6">
                                            <div
                                                    class="mb-3"
                                            >
                                                <label
                                                        for="basicInstagramLink3"
                                                        class="form-label"
                                                >Instagram</label
                                                >
                                                <Input
                                                        id="basicInstagramLink3"
                                                        type="text"
                                                        placeholder="Instagram Link"
                                                />
                                            </div>
                                        </Col>

                                        <Col lg="6">
                                            <div
                                                    class="mb-3"
                                            >
                                                <label
                                                        for="basicSkypeLink4"
                                                        class="form-label"
                                                >Skype</label
                                                >
                                                <Input
                                                        id="basicSkypeLink4"
                                                        type="text"
                                                        placeholder="Skype Link"
                                                />
                                            </div>
                                        </Col>

                                    </Row>

                                </div>


                                <div
                                        class="tab-pane"
                                        id="basictabHorizontal4"
                                        role="tabpanel"
                                >
                                    <Row>
                                        <Col xs="12">
                                            <div
                                                    class="text-center"
                                            >
                                                <div
                                                        class="avatar-md mx-auto mb-3"
                                                >
                                                    <div
                                                            class="avatar-title bg-primary bg-opacity-10 text-primary rounded-circle"
                                                    >
                                                        <Icon
                                                                icon="iconamoon:like-duotone"
                                                                class="fs-36"
                                                        ></Icon>
                                                    </div>
                                                </div>
                                                <h3
                                                        class="mt-0"
                                                >
                                                    Finished
                                                    !
                                                </h3>

                                                <p
                                                        class="w-75 mb-2 mx-auto"
                                                >
                                                    Filled
                                                    Data
                                                    Successfully.
                                                </p>

                                                <div
                                                        class="mb-3"
                                                >
                                                    <div
                                                            class="form-check d-inline-block"
                                                    >
                                                        <Input
                                                                type="checkbox"
                                                                class="form-check-input"
                                                                id="customCheck2"
                                                        />
                                                        <label
                                                                class="form-check-label"
                                                                for="customCheck2"
                                                        >I
                                                            agree
                                                            with
                                                            the
                                                            Terms
                                                            and
                                                            Conditions</label
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </Col>

                                    </Row>

                                </div>


                                <div
                                        class="d-flex flex-wrap align-items-center wizard justify-content-between gap-3 mt-3"
                                >
                                    <div class="first">
                                        <a
                                                href={"#"}
                                                class="btn btn-soft-primary"
                                        >
                                            First
                                        </a>
                                    </div>
                                    <div
                                            class="d-flex gap-2"
                                    >
                                        <div
                                                class="previous"
                                        >
                                            <a
                                                    href={"#"}
                                                    class="btn btn-primary disabled"
                                            >
                                                <i
                                                        class="bx bx-left-arrow-alt me-2"
                                                ></i
                                                >Back To
                                                Previous
                                            </a>
                                        </div>
                                        <div
                                                class="next"
                                        >
                                            <a
                                                    href={"#"}
                                                    class="btn btn-primary"
                                            >
                                                Next
                                                Step<i
                                                    class="bx bx-right-arrow-alt ms-2"
                                            ></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="last">
                                        <a
                                                href={"#"}
                                                class="btn btn-soft-primary"
                                        >
                                            Finish
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </Col>
                    </Row>
                </form>
            </UIComponentCard>
        </Col>
    </Row>
</DefaultLayout>