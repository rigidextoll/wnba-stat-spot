<script lang="ts">
    import type {EmailType} from "./types";
    import {Badge} from "@sveltestrap/sveltestrap";

    export let toggleReadOffcanvas: () => void
    export let mail: EmailType
</script>

<li class="{!mail.isRead ? 'unread':''}">
    <div class="col-mail col-mail-1">
        <div class="checkbox-wrapper-mail">
            <input type="checkbox" id="{mail.id}"/>
            <label for="{mail.id}" class="toggle"></label>
        </div>
        {#if mail.isStarred}
            <span class="star-toggle bx bxs-star text-warning"></span>
        {:else }
            <span class="star-toggle bx bx-star"></span>
        {/if}
        {#if mail.isImportant}
            <span class="bx bxs-tag-alt important-toggle text-warning"></span>
        {:else}
            <span class="bx bx-tag-alt important-toggle"></span>
        {/if}
        <a href={"#"} on:click="{toggleReadOffcanvas}" class="title" role="button">{mail.sender}</a>
    </div>
    <div class="col-mail col-mail-2">
        <a href={"#"} on:click="{toggleReadOffcanvas}" class="subject" role="button">
            {mail.subject} &nbsp;&ndash;&nbsp;
            {#if mail.message}
            <span>
            {mail.message}
            </span>
            {/if}
            {#each mail.attachments ?? [] as attach}
                <Badge color="light" class="border text-dark fw-semibold ms-1">
                    {#if mail.attachType === 'image'}
                        <i class="bx bx-images text-primary me-2"/>
                    {:else if mail.attachType === 'pdf'}
                        <i class="bx bxs-file-pdf text-danger text-primary me-2"/>
                    {:else if mail.attachType === 'doc'}
                        <i class="bx bxs-file-doc text-blue me-2"/>
                    {/if}
                    {attach}
                </Badge>
            {/each}
            {#if (mail.badge)}
                <Badge color="light" class="border text-dark fw-semibold rounded-circle">
                    {mail.badge}
                </Badge>
            {/if}
        </a>
        <div class="date">{mail.date}</div>
    </div>
</li>