import type {HelpType} from "./types";

const help1 = '/images/app-calendar/help-1.png'
const help2 = '/images/app-calendar/help-2.png'
const help3 = '/images/app-calendar/help-3.png'
const help4 = '/images/app-calendar/help-4.png'
const help5 = '/images/app-calendar/help-5.png'
const help6 = '/images/app-calendar/help-6.png'

export const helpData: HelpType[] = [
    {
        image: help1,
        title: 'Getting Started',
        description: 'Learn the basics, connect your calendar and discover features that will make scheduling easier.'
    },
    {
        image: help2,
        title: 'Availability',
        description: 'Determine when you would like to be scheduled and explore our advanced availability options.'
    },
    {
        image: help3,
        title: 'Customize Event Types',
        description: 'Tailor your invitee experience and ensure you’re collecting the information you need when they book.'
    },
    {
        image: help4,
        title: 'Embed Option',
        description: 'Discover options for adding Calendly to your website, ensuring your visitors schedule at the height of their interest.'
    },
    {
        image: help5,
        title: 'Team Scheduling',
        description: 'Find out how to configure multi-user scheduling.'
    },
    {
        image: help6,
        title: 'Integration',
        description: 'Connect the tools in your workflow directly to Calendly, or learn about what we’ve built to streamline your scheduling.'
    }
]
