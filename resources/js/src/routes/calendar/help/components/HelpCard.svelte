<script lang="ts">
    import type {HelpType} from "./types";

    export let help: HelpType
</script>

<div class="text-center">
    <img src="{help.image}" alt="help-1" class="img-fluid avatar-md mb-3"/>
    <h4 class="fw-semibold">{help.title}</h4>
    <p class="px-2 px-xl-5">
        {help.description}
    </p>
</div>