<script lang="ts">

    import DefaultLayout from "$lib/layouts/DefaultLayout.svelte";
    import PageBreadcrumb from "$lib/components/PageBreadcrumb.svelte";
    import UIComponentCard from "$lib/components/UIComponentCard.svelte";
    import AnchorNavigation from "$lib/components/AnchorNavigation.svelte";
    import {Col, Row, TabContent, TabPane} from "@sveltestrap/sveltestrap";

    const anchorNavigation = [
        {
            id: 'default',
            title: 'Nav Tabs'
        },
        {
            id: 'nav-pills',
            title: 'Nav Pills'
        },
        {
            id: 'tabs-vertical',
            title: 'Tabs Vertical'
        },
        {
            id: 'tabs-disabled',
            title: 'Disabled'
        },
    ]
</script>

<DefaultLayout>
    <PageBreadcrumb title="Nav Tabs" subTitle="Base UI"/>

    <Row>
        <Col xl="9">
            <UIComponentCard title="Nav Tabs" id="default">
                <TabContent class="text-muted p-0">
                    <TabPane tabId="home" tab="Home">
                        <p class="mt-2">
                            Sed ut perspiciatis unde omnis
                            iste natus error sit voluptatem
                            accusantium doloremque
                            laudantium, totam rem aperiam,
                            eaque ipsa quae ab illo
                            inventore veritatis et quasi
                            architecto beatae vitae dicta
                            sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit
                            aspernatur aut odit aut fugit,
                            sed quia consequuntur magni
                            dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque
                            porro quisquam est, qui dolorem
                            ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed
                            quia non numquam eius modi
                            tempora incidunt ut labore et
                            dolore magnam aliquam quaerat
                            voluptatem?
                        </p>
                    </TabPane>
                    <TabPane active
                             tabId="profile" tab="Profile">
                        <p class="mt-2">
                            Li Europan lingues es membres
                            del sam familie. Lor separat
                            existentie es un myth. Por
                            scientie, musica, sport etc,
                            litot Europa usa li sam
                            vocabular. Li lingues differe
                            solmen in li grammatica, li
                            pronunciation e li plu commun
                            vocabules. Omnicos directe al
                            desirabilite de un nov lingua
                            franca: On refusa continuar
                            payar custosi traductores. At
                            solmen va esser necessi far
                            uniform grammatica,
                            pronunciation e plu sommun
                            paroles. Ma quande lingues
                            coalesce, li grammatica del
                            resultant lingue es plu simplic
                            e regulari quam ti del
                            coalescent lingues. Li nov
                            lingua franca va esser plu
                            simplic e regulari quam li
                            existent Europan lingues.
                        </p>
                    </TabPane>
                    <TabPane tabId="messages" tab="Messages">
                        <p class="mt-2">
                            Sed ut perspiciatis unde omnis
                            iste natus error sit voluptatem
                            accusantium doloremque
                            laudantium, totam rem aperiam,
                            eaque ipsa quae ab illo
                            inventore veritatis et quasi
                            architecto beatae vitae dicta
                            sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit
                            aspernatur aut odit aut fugit,
                            sed quia consequuntur magni
                            dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque
                            porro quisquam est, qui dolorem
                            ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed
                            quia non numquam eius modi
                            tempora incidunt ut labore et
                            dolore magnam aliquam quaerat
                            voluptatem?
                        </p>
                    </TabPane>
                </TabContent>
            </UIComponentCard>

            <UIComponentCard title="Nav Pills" id="nav-pills">
                <TabContent pills class="text-muted p-0">
                    <TabPane tabId="home" tab="Home">
                        <p class="mt-2">
                            Sed ut perspiciatis unde omnis
                            iste natus error sit voluptatem
                            accusantium doloremque
                            laudantium, totam rem aperiam,
                            eaque ipsa quae ab illo
                            inventore veritatis et quasi
                            architecto beatae vitae dicta
                            sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit
                            aspernatur aut odit aut fugit,
                            sed quia consequuntur magni
                            dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque
                            porro quisquam est, qui dolorem
                            ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed
                            quia non numquam eius modi
                            tempora incidunt ut labore et
                            dolore magnam aliquam quaerat
                            voluptatem?
                        </p>
                    </TabPane>
                    <TabPane active
                             tabId="profile" tab="Profile">
                        <p class="mt-2">
                            Li Europan lingues es membres
                            del sam familie. Lor separat
                            existentie es un myth. Por
                            scientie, musica, sport etc,
                            litot Europa usa li sam
                            vocabular. Li lingues differe
                            solmen in li grammatica, li
                            pronunciation e li plu commun
                            vocabules. Omnicos directe al
                            desirabilite de un nov lingua
                            franca: On refusa continuar
                            payar custosi traductores. At
                            solmen va esser necessi far
                            uniform grammatica,
                            pronunciation e plu sommun
                            paroles. Ma quande lingues
                            coalesce, li grammatica del
                            resultant lingue es plu simplic
                            e regulari quam ti del
                            coalescent lingues. Li nov
                            lingua franca va esser plu
                            simplic e regulari quam li
                            existent Europan lingues.
                        </p>
                    </TabPane>
                    <TabPane tabId="messages" tab="Messages">
                        <p class="mt-2">
                            Sed ut perspiciatis unde omnis
                            iste natus error sit voluptatem
                            accusantium doloremque
                            laudantium, totam rem aperiam,
                            eaque ipsa quae ab illo
                            inventore veritatis et quasi
                            architecto beatae vitae dicta
                            sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit
                            aspernatur aut odit aut fugit,
                            sed quia consequuntur magni
                            dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque
                            porro quisquam est, qui dolorem
                            ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed
                            quia non numquam eius modi
                            tempora incidunt ut labore et
                            dolore magnam aliquam quaerat
                            voluptatem?
                        </p>
                    </TabPane>
                </TabContent>
            </UIComponentCard>

            <UIComponentCard title="Tabs Vertical" id="tabs-vertical">
                <TabContent vertical pills class="text-muted p-0">
                    <TabPane tabId="home" tab="Home">
                        <p class="mt-2">
                            Sed ut perspiciatis unde omnis
                            iste natus error sit voluptatem
                            accusantium doloremque
                            laudantium, totam rem aperiam,
                            eaque ipsa quae ab illo
                            inventore veritatis et quasi
                            architecto beatae vitae dicta
                            sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit
                            aspernatur aut odit aut fugit,
                            sed quia consequuntur magni
                            dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque
                            porro quisquam est, qui dolorem
                            ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed
                            quia non numquam eius modi
                            tempora incidunt ut labore et
                            dolore magnam aliquam quaerat
                            voluptatem?
                        </p>
                    </TabPane>
                    <TabPane active
                             tabId="profile" tab="Profile">
                        <p class="mt-2">
                            Li Europan lingues es membres
                            del sam familie. Lor separat
                            existentie es un myth. Por
                            scientie, musica, sport etc,
                            litot Europa usa li sam
                            vocabular. Li lingues differe
                            solmen in li grammatica, li
                            pronunciation e li plu commun
                            vocabules. Omnicos directe al
                            desirabilite de un nov lingua
                            franca: On refusa continuar
                            payar custosi traductores. At
                            solmen va esser necessi far
                            uniform grammatica,
                            pronunciation e plu sommun
                            paroles. Ma quande lingues
                            coalesce, li grammatica del
                            resultant lingue es plu simplic
                            e regulari quam ti del
                            coalescent lingues. Li nov
                            lingua franca va esser plu
                            simplic e regulari quam li
                            existent Europan lingues.
                        </p>
                    </TabPane>
                    <TabPane tabId="messages" tab="Messages">
                        <p class="mt-2">
                            Sed ut perspiciatis unde omnis
                            iste natus error sit voluptatem
                            accusantium doloremque
                            laudantium, totam rem aperiam,
                            eaque ipsa quae ab illo
                            inventore veritatis et quasi
                            architecto beatae vitae dicta
                            sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit
                            aspernatur aut odit aut fugit,
                            sed quia consequuntur magni
                            dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque
                            porro quisquam est, qui dolorem
                            ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed
                            quia non numquam eius modi
                            tempora incidunt ut labore et
                            dolore magnam aliquam quaerat
                            voluptatem?
                        </p>
                    </TabPane>
                </TabContent>
            </UIComponentCard>

            <UIComponentCard title="Disabled" id="tabs-disabled">
                <TabContent class="text-muted p-0">
                    <TabPane tabId="home" tab="Home">
                        <p class="mt-2">
                            Sed ut perspiciatis unde omnis
                            iste natus error sit voluptatem
                            accusantium doloremque
                            laudantium, totam rem aperiam,
                            eaque ipsa quae ab illo
                            inventore veritatis et quasi
                            architecto beatae vitae dicta
                            sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit
                            aspernatur aut odit aut fugit,
                            sed quia consequuntur magni
                            dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque
                            porro quisquam est, qui dolorem
                            ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed
                            quia non numquam eius modi
                            tempora incidunt ut labore et
                            dolore magnam aliquam quaerat
                            voluptatem?
                        </p>
                    </TabPane>
                    <TabPane active
                             tabId="profile" tab="Profile">
                        <p class="mt-2">
                            Li Europan lingues es membres
                            del sam familie. Lor separat
                            existentie es un myth. Por
                            scientie, musica, sport etc,
                            litot Europa usa li sam
                            vocabular. Li lingues differe
                            solmen in li grammatica, li
                            pronunciation e li plu commun
                            vocabules. Omnicos directe al
                            desirabilite de un nov lingua
                            franca: On refusa continuar
                            payar custosi traductores. At
                            solmen va esser necessi far
                            uniform grammatica,
                            pronunciation e plu sommun
                            paroles. Ma quande lingues
                            coalesce, li grammatica del
                            resultant lingue es plu simplic
                            e regulari quam ti del
                            coalescent lingues. Li nov
                            lingua franca va esser plu
                            simplic e regulari quam li
                            existent Europan lingues.
                        </p>
                    </TabPane>
                    <TabPane tabId="messages" tab="Messages" disabled>
                        <p class="mt-2">
                            Sed ut perspiciatis unde omnis
                            iste natus error sit voluptatem
                            accusantium doloremque
                            laudantium, totam rem aperiam,
                            eaque ipsa quae ab illo
                            inventore veritatis et quasi
                            architecto beatae vitae dicta
                            sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit
                            aspernatur aut odit aut fugit,
                            sed quia consequuntur magni
                            dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque
                            porro quisquam est, qui dolorem
                            ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed
                            quia non numquam eius modi
                            tempora incidunt ut labore et
                            dolore magnam aliquam quaerat
                            voluptatem?
                        </p>
                    </TabPane>
                </TabContent>
            </UIComponentCard>
        </Col>

        <Col xl="3">
            <AnchorNavigation elements={anchorNavigation}/>
        </Col>
    </Row>
</DefaultLayout>