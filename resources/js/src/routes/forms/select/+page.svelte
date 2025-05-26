<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import ChoicesSelect from "$lib/components/ChoicesSelect.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row} from "@sveltestrap/sveltestrap";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import ChoicesInput from "$lib/components/ChoicesInput.svelte";

    const anchorNavigation = [
        {
            id: 'basic',
            title: 'Basic Example'
        },
        {
            id: 'options-group',
            title: 'Option Groups Example'
        },
        {
            id: 'options-add-no-search',
            title: 'Options added via config with no search'
        },
        {
            id: 'options-add-no-sorting',
            title: 'Options added via config with no sorting'
        },
        {
            id: 'multiple-select',
            title: 'Multiple select input'
        },
        {
            id: 'multiple-select-remove',
            title: 'Multiple select With remove button input '
        },
        {
            id: 'multiple-groups',
            title: 'Multiple select With Option groups '
        },
        {
            id: 'text-input',
            title: 'Text inputs'
        },
        {
            id: 'unique-values',
            title: 'Text inputs in Unique values only, no pasting'
        }
    ]

    const basicSelected = ''
    const optionGrpSelected = ''
    const noSearchSelected = 'Zero'
    const noSortingSelected = 'Madrid'
    const multipleSelected = 'choice-1'
    const multipleWithRemoveSelected = 'choice-3'
    const multipleWithOptionGrpSelected = ''

    const options1 = [
        {value: '', text: 'This is a placeholder'},
        {value: 'choice-1', text: 'Choice 1'},
        {value: 'choice-2', text: 'Choice 2'},
        {value: 'choice-3', text: 'Choice 3'},
        {value: 'choice-4', text: 'Choice 4'}
    ]

    const options2 = [
        {value: 'Zero', text: 'Zero'},
        {value: 'One', text: 'One'},
        {value: 'Two', text: 'Two'},
        {value: 'Three', text: 'Three'},
        {value: 'Four', text: 'Four'},
        {value: 'Five', text: 'Five'},
        {value: 'Six', text: 'Six'}
    ]

    const options3 = [
        {value: 'Madrid', text: 'Madrid'},
        {value: 'Toronto', text: 'Toronto'},
        {value: 'Vancouver', text: 'Vancouver'},
        {value: 'London', text: 'London'},
        {value: 'Manchester', text: 'Manchester'},
        {value: 'Liverpool', text: 'Liverpool'},
        {value: 'Paris', text: 'Paris'},
        {value: 'Malaga', text: 'Malaga'},
        {value: 'Washington', text: 'Washington'},
        {value: 'Lyon', text: 'Lyon'},
        {value: 'Marseille', text: 'Marseille'},
        {value: 'Hamburg', text: 'Hamburg'},
        {value: 'Munich', text: 'Munich'},
        {value: 'Madrid', text: 'Madrid'},
        {value: 'Barcelona', text: 'Barcelona'},
        {value: 'Berlin', text: 'Berlin'},
        {value: 'Montreal', text: 'Montreal'},
        {value: 'New York', text: 'New York'},
        {value: 'Michigan', text: 'Michigan'}
    ]

    const options4 = [
        {value: 'choice-1', text: 'Choice 1'},
        {value: 'choice-2', text: 'Choice 2'},
        {value: 'choice-3', text: 'Choice 3'},
        {value: 'choice-4', text: 'Choice 4'}
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Form Select" subTitle="Form"/>
    <Row>
        <Col xl="9">

            <UIComponentCard id="basic" title="Basic Example">
                <Row>
                    <Col lg="6">
                        <ChoicesSelect id="choices-single-default">
                            {#each options1 as option}
                                <option value={option.value}>
                                    {option.text}
                                </option>
                            {/each}
                        </ChoicesSelect>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="options-group" title="Option Groups Example">
                <Row>
                    <Col lg="6">
                        <ChoicesSelect id="choices-single-groups" label="Option Groups">
                            <option value="">Choose a city</option>
                            <optgroup label="UK">
                                <option value="London">London</option>
                                <option value="Manchester">Manchester</option>
                                <option value="Liverpool">Liverpool</option>
                            </optgroup>
                            <optgroup label="FR">
                                <option value="Paris">Paris</option>
                                <option value="Lyon">Lyon</option>
                                <option value="Marseille">Marseille</option>
                            </optgroup>
                            <optgroup label="DE" disabled>
                                <option value="Hamburg">Hamburg</option>
                                <option value="Munich">Munich</option>
                                <option value="Berlin">Berlin</option>
                            </optgroup>
                            <optgroup label="US">
                                <option value="New York">New York</option>
                                <option value="Washington" disabled>Washington</option>
                                <option value="Michigan">Michigan</option>
                            </optgroup>
                            <optgroup label="SP">
                                <option value="Madrid">Madrid</option>
                                <option value="Barcelona">Barcelona</option>
                                <option value="Malaga">Malaga</option>
                            </optgroup>
                            <optgroup label="CA">
                                <option value="Montreal">Montreal</option>
                                <option value="Toronto">Toronto</option>
                                <option value="Vancouver">Vancouver</option>
                            </optgroup>
                        </ChoicesSelect>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="options-add-no-search" title="Options added via config with no search">
                <Row>
                    <Col lg="6">
                        <ChoicesSelect id="choices-single-no-search" choiceOptions={{searchEnabled: false}}>
                            {#each options2 as option}
                                <option value={option.value}>
                                    {option.text}
                                </option>
                            {/each}
                        </ChoicesSelect>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="options-add-no-sorting" title="Options added via config with no sorting">
                <Row>
                    <Col lg="6">
                        <ChoicesSelect id="choices-single-no-sorting"
                                       choiceOptions={{shouldSort: false, shouldSortItems: false}}>
                            {#each options3 as option}
                                <option value={option.value}>
                                    {option.text}
                                </option>
                            {/each}
                        </ChoicesSelect>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="multiple-select" title="Multiple select input">
                <Row>
                    <Col lg="6">
                        <ChoicesSelect id="choices-multiple-default" multiple={true}>
                            {#each options4 as option}
                                <option value={option.value}>
                                    {option.text}
                                </option>
                            {/each}
                        </ChoicesSelect>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="multiple-select" title="Multiple select With remove button input">
                <Row>
                    <Col lg="6">
                        <ChoicesSelect id="choices-multiple-remove-button"
                                       choiceOptions={{removeItemButton: true}} multiple={true}>
                            {#each options4 as option}
                                <option value={option.value}>
                                    {option.text}
                                </option>
                            {/each}
                        </ChoicesSelect>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="multiple-groups" title="Multiple select With Option groups">
                <Row>
                    <Col lg="6">
                        <ChoicesSelect id="choices-multiple-groups" multiple={true}>
                            <optgroup label="UK">
                                <option value="London">London</option>
                                <option value="Manchester">Manchester</option>
                                <option value="Liverpool">Liverpool</option>
                            </optgroup>
                            <optgroup label="FR">
                                <option value="Paris">Paris</option>
                                <option value="Lyon">Lyon</option>
                                <option value="Marseille">Marseille</option>
                            </optgroup>
                            <optgroup label="DE" disabled>
                                <option value="Hamburg">Hamburg</option>
                                <option value="Munich">Munich</option>
                                <option value="Berlin">Berlin</option>
                            </optgroup>
                            <optgroup label="US">
                                <option value="New York">New York</option>
                                <option value="Washington" disabled>Washington</option>
                                <option value="Michigan">Michigan</option>
                            </optgroup>
                            <optgroup label="SP">
                                <option value="Madrid">Madrid</option>
                                <option value="Barcelona">Barcelona</option>
                                <option value="Malaga">Malaga</option>
                            </optgroup>
                            <optgroup label="CA">
                                <option value="Montreal">Montreal</option>
                                <option value="Toronto">Toronto</option>
                                <option value="Vancouver">Vancouver</option>
                            </optgroup>
                        </ChoicesSelect>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="text-input" title="Text inputs">
                <Row>
                    <Col lg="6">
                        <ChoicesInput id="choices-text-remove-button" label="Set limit values with remove button"
                                      choiceOptions={{removeItemButton: true, maxItemCount: 3}}/>
                    </Col>
                </Row>
            </UIComponentCard>

            <UIComponentCard id="unique-values" title="Text inputs in Unique values only, no pasting">
                <Row>
                    <Col lg="6">
                        <ChoicesInput id="choices-text-unique-values" label="Unique values only, no pasting"
                                      value="Project-A, Project-B"
                                      choiceOptions={{duplicateItemsAllowed: false, paste: false}}/>
                    </Col>
                </Row>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>