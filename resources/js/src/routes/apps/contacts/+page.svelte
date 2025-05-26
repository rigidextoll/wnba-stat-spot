<script lang="ts">
    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import ContactCard from "./components/ContactCard.svelte";
    import {contactData} from "./components/data";
</script>

<DefaultLayout>
    <PageBreadcrumb title="Contacts" subTitle="Apps"/>
    <Row class="row-cols-1 row-cols-md-2 row-cols-xl-4 gx-3">
        {#each contactData as contact}
            <Col>
                <ContactCard contact={contact}/>
            </Col>
        {/each}
    </Row>
</DefaultLayout>