<script lang="ts">
    import {Button, Card, CardBody, CardHeader, CardTitle, FormGroup, Input} from "@sveltestrap/sveltestrap";

    const options = [
        {text: 'Review WNBA game data import logs', value: '1'},
        {text: 'Update player statistics from latest games', value: '2'},
        {text: 'Validate prediction model accuracy', value: '3'},
        {text: 'Check odds API connection status', value: '4'},
        {text: 'Review team analytics dashboard', value: '5'},
        {text: 'Update prop betting recommendations', value: '6'},
        {text: 'Monitor data quality metrics', value: '7'},
        {text: 'Generate weekly analytics reports', value: '8'},
        {text: 'Review system performance metrics', value: '9'},
        {text: 'Update player injury status', value: '10'}
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