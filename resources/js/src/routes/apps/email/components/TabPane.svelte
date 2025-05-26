<script lang="ts">

    import type {EmailType} from "./types";
    import MailCard from "./MailCard.svelte";

    export let tab: string
    export let filteredMails: EmailType[]
    export let showTab: string
    export let toggleReadOffcanvas: () => void
</script>

<div class="tab-pane fade {showTab === tab && 'show active'}" id="email-starred">

    {#if tab === 'email-trash'}
        <hr/>
        <div class="text-center mt-2">
            <p class="mb-0">
                Messages that have been in Trash more than 30 days will be automatically deleted.
                <a href={"#"} class="text-primary ms-2">Empty Trash Now</a>
            </p>
        </div>
        <hr class="mb-3"/>

    {:else if tab === 'email-draft'}
        <hr/>
        <div class="text-center mt-2">
            <p class="mb-0">You don't have any saved drafts.</p>
            <p class="mb-0">Saving a draft allows you to keep a message you aren't ready to send yet.</p>
        </div>
        <hr class="mb-0"/>
    {:else}
        <ul class="message-list mb-0">
            {#each filteredMails as mail}
                <MailCard mail={mail} toggleReadOffcanvas="{toggleReadOffcanvas}"/>
            {/each}
        </ul>
    {/if}
</div>