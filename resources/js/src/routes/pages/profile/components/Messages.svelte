<script lang="ts">
    import PersonalInfo from "./PersonalInfo.svelte";
    import Followers from "./Followers.svelte";
    import {Card, CardBody, CardHeader, CardTitle, Col, Row} from "@sveltestrap/sveltestrap";
    import Projects from "./Projects.svelte";
    import {messagesData} from "./data";
</script>

<Col xxl="8">
    <Row>
        <PersonalInfo/>
        <Followers/>
    </Row>
    <Projects/>
    <Row>
        <Col>
            <Card>
                <CardHeader class="d-flex align-items-center">
                    <CardTitle>Messages</CardTitle>
                    <div class="ms-auto">
                        <a href={"#"} class="text-primary"
                        >Export
                            <i class="bx bx-export ms-1"></i>
                        </a>
                    </div>
                </CardHeader>
                <CardBody>
                    <ul class="list-unstyled mb-0">
                        {#each messagesData as item, idx}
                            <li class={!idx ? 'pb-3 border-bottom' : messagesData.length - 1 === idx ? 'pt-3' : 'py-3 border-bottom'}>
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <img src={item.avatar} alt="avatar-2" class="avatar-md rounded-circle"/>
                                    <div class="d-block">
                                        <h5 class="fs-15 mt-0 mb-1">
                                            {item.name}
                                        </h5>
                                        <p class="text-muted fs-13 text-break mb-0">
                                            {item.content}
                                        </p>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <p class="text-muted mb-0">
                                            {item.time}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        {/each}
                    </ul>
                </CardBody>
            </Card>
        </Col>
    </Row>
</Col>