<script lang="ts">

    import TopBar from "$lib/layouts/components/TopBar.svelte";
    import Footer from "$lib/layouts/components/Footer.svelte";
    import LeftSideBar from "$lib/layouts/components/LeftSideBar.svelte";
</script>


<div class="wrapper">
    <TopBar/>
    <LeftSideBar/>
    <div class="page-content">

        <div class="container-xxl">
            <slot/>
        </div>

        <Footer/>
    </div>

</div>