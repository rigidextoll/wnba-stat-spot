<script lang="ts">
    import CreatePost from "./CreatePost.svelte";
    import StoryFeed from "./StoryFeed.svelte";
</script>

<CreatePost/>
<StoryFeed/>

<a href={"#"} class="text-primary d-flex justify-content-center mx-auto mb-3">
    <i class="bx bx-loader-circle spin-icon fs-22 align-middle me-1"></i>
    Loading
</a>