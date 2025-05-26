<script lang="ts">
    import {createEventDispatcher, onMount} from "svelte";
    import {Input, type InputType} from "@sveltestrap/sveltestrap";

    export let type: InputType = 'text'
    export let placeholder: string
    export let id: string
    export let value: string = ''
    export let options: object = {}

    const dispatch = createEventDispatcher()

    const handleChange = () => {
        dispatch('input', {state: value});
    }

    onMount(async () => {
        const flatpickr = (await import('flatpickr')).default
        const ele = document.getElementById(id)
        if (ele) {
            flatpickr(ele, {...options, defaultDate: value})
        }
    })
</script>

<Input type={type} id={id} placeholder={placeholder} bind:value on:input={handleChange}/>