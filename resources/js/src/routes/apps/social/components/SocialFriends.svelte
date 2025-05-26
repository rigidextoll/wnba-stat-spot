<script lang="ts">
    import {friendsRequests, pendingFriendsRequests} from "./data";
    import SocialFriendCard from "./SocialFriendCard.svelte";

    let friendsTab = true
</script>

<ul class="nav nav-pills">
    <li class="nav-item">
        <a href={"#"} class="nav-link px-4 {friendsTab && 'active'}" on:click={()=>friendsTab = !friendsTab}>
            <span>All Friends</span>
        </a>
    </li>
    <li class="nav-item">
        <a href={"#"} class="nav-link px-4 {!friendsTab && 'active'}" on:click={()=>friendsTab = !friendsTab}>
            <span>Pending Requests (2)</span>
        </a>
    </li>
</ul>

<div class="tab-content mt-3 pt-0 text-muted">
    <div class="tab-pane {friendsTab && 'show active'}" id="all">
        {#each friendsRequests as item}
            <SocialFriendCard item="{item}"/>
        {/each}
    </div>

    <div class="tab-pane {!friendsTab && 'show active'}" id="pending">
        {#each pendingFriendsRequests as item}
            <SocialFriendCard item="{item}"/>
        {/each}
    </div>
</div>