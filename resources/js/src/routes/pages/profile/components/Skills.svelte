<script lang="ts">
    import {Card, CardBody, CardHeader, CardTitle, Col, Progress, Row} from "@sveltestrap/sveltestrap";
    import {skillData} from "./data";
</script>

<Card>
    <CardHeader>
        <CardTitle>Skill</CardTitle>
    </CardHeader>
    <CardBody>
        <Row>
            <Col>
                {#each skillData as item,idx}
                    <p class="fs-15 mb-1 float-end">{item.progressValue}%</p>
                    <p class="fs-15 mb-1">
                        {item.title}
                    </p>
                    <Progress value={item.progressValue} striped animated
                              class="progress-sm {skillData.length - 1 === idx ? 'mb-2' : 'mb-3'}"/>
                {/each}
            </Col>
        </Row>
    </CardBody>
</Card>