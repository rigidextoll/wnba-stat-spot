<script lang="ts">
    import {Button, Card, CardBody, CardHeader, CardTitle, FormGroup, Input} from "@sveltestrap/sveltestrap";

    const options = [
        {text: 'Review system logs for any reported errors', value: '1'},
        {text: 'Conduct user testing to identify potential bugs', value: '2'},
        {text: 'Gather feedback from stakeholders', value: '3'},
        {text: 'Prioritize bugs based on severity and impact', value: '4'},
        {text: 'Investigate and analyze the root cause of each bug', value: '5'},
        {text: 'Develop and implement fixes for the identified bugs', value: '6'},
        {text: 'Complete any recurring tasks', value: '7'},
        {text: 'Check emails and respond', value: '8'},
        {text: 'Review schedule for the day', value: '9'},
        {text: 'Daily stand-up meeting', value: '10'}
    ]
</script>

<Card>
    <CardHeader class="d-flex justify-content-between align-items-center">
        <CardTitle>My Tasks</CardTitle>
        <div>
            <Button size="sm" color="primary">
                <i class="bx bx-plus me-1"></i>Create Task
            </Button>
        </div>
    </CardHeader>

    <CardBody class="p-0 pb-3 ps-2">
        <div data-simplebar style="max-height: 386px; padding: 1rem;">
            {#each options as option, idx (option.value)}
                <div class="form-todo {idx !== 0 && idx !== options.length - 1 ? 'my-3' : ''}">
                    <Input type="checkbox" bsSize="md" value={option.value} class="rounded-circle fs-14"
                           label={option.text}/>
                </div>
            {/each}
        </div>
    </CardBody>
</Card>