<script lang="ts">
    import type {MemberType} from "./types";
    import {Card, CardBody, Tooltip} from "@sveltestrap/sveltestrap";

    export let item: MemberType
</script>

<Card>
    <CardBody>
        <div class="d-flex align-items-center gap-2">
            <div class="avatar-md">
                <img src={item.avatar} alt="" class="img-fluid rounded-circle border border-light border-3"/>
            </div>
            <div class="">
                <a href={"#"} class="text-reset fw-semibold fs-16">{item.name}</a>
                <p class="fs-13 mb-0">
                    {item.email}
                </p>
            </div>
        </div>
        <div class="d-flex gap-2 mt-3">
            <a href={"#"}
               class="btn btn-soft-primary avatar-sm fs-20 d-inline-flex align-items-center justify-content-center p-0"
               id="tooltip1{item.id}">
                <i class="bx bxl-facebook"></i>
                <Tooltip target="tooltip1{item.id}" class="primary-tooltip" placement="bottom">
                    Facebook
                </Tooltip>
            </a>
            <a href={"#"}
               class="btn btn-soft-danger avatar-sm fs-20 d-inline-flex align-items-center justify-content-center p-0"
               id="tooltip2{item.id}">
                <i class="bx bxl-instagram-alt"></i>
                <Tooltip target="tooltip2{item.id}" class="danger-tooltip" placement="bottom">
                    Instagram
                </Tooltip>
            </a>
            <a href={"#"}
               class="btn btn-soft-info avatar-sm fs-20 d-inline-flex align-items-center justify-content-center p-0"
               id="tooltip3{item.id}">
                <i class="bx bxl-twitter"></i>
                <Tooltip target="tooltip3{item.id}" class="info-tooltip" placement="bottom">
                    Twitter
                </Tooltip>
            </a>
            <a href={"#"}
               class="btn btn-soft-primary avatar-sm fs-20 d-inline-flex align-items-center justify-content-center p-0"
               id="tooltip4{item.id}">
                <i class="bx bxl-linkedin"></i>
                <Tooltip target="tooltip4{item.id}" class="primary-tooltip" placement="bottom">
                    Linkedin
                </Tooltip>
            </a>
        </div>
    </CardBody>
</Card>