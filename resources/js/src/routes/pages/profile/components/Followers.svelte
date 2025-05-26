<script lang="ts">
    import {Card, CardBody, CardHeader, CardTitle, Col} from "@sveltestrap/sveltestrap";
    import {followersData} from "./data";
</script>

<Col lg="6">
    <Card>
        <CardHeader class="d-flex">
            <CardTitle> Followers</CardTitle>
            <div class="ms-auto">
                <a href={"#"} class="text-primary">View All </a>
            </div>
        </CardHeader>
        <CardBody>
            <ul class="list-group">
                {#each followersData as item,idx}
                    <li class="list-group-item border-0 {!idx ? 'px-0 pt-0 border-bottom' : followersData.length - 1 === idx ? 'px-0 pb-0' : 'border-bottom px-0'}">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <img src={item.avatar} alt="" class="rounded-circle avatar-sm"/>
                            <div class="d-block">
                                <h5 class="mb-1">
                                    {item.name}
                                </h5>
                                <h6 class="mb-0 text-muted">
                                    {item.email}
                                </h6>
                            </div>
                            <div class="ms-auto">
                                <a href={"#"} class="btn btn-soft-secondary btn-sm">Follow</a>
                            </div>
                        </div>
                    </li>
                {/each}
            </ul>
        </CardBody>
    </Card>
</Col>