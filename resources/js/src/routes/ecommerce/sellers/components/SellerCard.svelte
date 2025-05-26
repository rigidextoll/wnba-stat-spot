<script lang="ts">
    import type {SellerType} from "./types";
    import {Card, CardBody, Dropdown, DropdownItem, DropdownMenu, DropdownToggle} from "@sveltestrap/sveltestrap";

    export let seller: SellerType
</script>

<Card>
    <CardBody>

        <Dropdown size="lg" color="link" class="float-end">
            <DropdownToggle tag="a" color="link" class="text-dark p-0">
                <i class="bx bx-dots-vertical-rounded fs-18 mb-1"></i>
            </DropdownToggle>

            <DropdownMenu>
                <DropdownItem href="#"><i class="bx bx-phone-call me-2"></i>Direct Call</DropdownItem>
                <DropdownItem href="#"><i class="bx bx-envelope-open me-2"></i>E mail</DropdownItem>
                <DropdownItem href="#"><i class="bx bxl-linkedin me-2"></i>Linkedin</DropdownItem>
            </DropdownMenu>
        </Dropdown>

        <div class="text-center mb-3">
            <a href={"#"}>
                <img src={seller.image} alt="avatar-1"
                     class="img-fluid img-thumbnail avatar-xxl rounded-circle avatar-border"/>
            </a>
        </div>
        <div class="text-center">
            <h4 class="mb-4 fw-bold">
                {seller.name}
            </h4>
        </div>
        <div class="mt-1 border-bottom">
            <p class="float-end mb-1">
                {seller.storeName}
            </p>
            <p class="mb-1">Store Name</p>
        </div>
        <div class="mt-1 mb-2 border-bottom">
            <p class="float-end mb-1">
                {seller.products}
            </p>
            <p class="mb-1">Products</p>
        </div>
        <a href={"#"} class="btn btn-soft-primary w-100">View All Detail</a>
    </CardBody>
</Card>