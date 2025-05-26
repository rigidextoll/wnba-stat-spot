<script lang="ts">
    import SocialSavedCard from "./SocialSavedCard.svelte";
    import {savedPosts} from "./data";
</script>

{#each savedPosts as item}
    <SocialSavedCard item="{item}"/>
{/each}