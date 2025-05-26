<script lang="ts">
    import {Container, Row, Col} from '@sveltestrap/sveltestrap';
    import Icon from "@iconify/svelte";
    import {developedBy, developedByLink, currentYear} from "$lib/helpers/constants";
</script>

<footer class="footer">
    <Container fluid>
        <Row>
            <Col class="text-center">
                {currentYear}
                &copy; Reback. Crafted by
                <Icon icon="iconamoon:heart-duotone" class="fs-18 align-middle text-danger"/>
                <a href={developedByLink} class="fw-bold footer-text" target="_blank">{developedBy}</a>
            </Col>
        </Row>
    </Container>
</footer>