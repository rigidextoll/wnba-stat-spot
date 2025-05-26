import type {IntegrationType} from "./types";

const googleMail = '/images/app-calendar/google-mail.png'
const googleAnalytics = '/images/app-calendar/google-analytics.png'
const googleMeet = '/images/app-calendar/google-meet.png'
const intercom = '/images/app-calendar/intercom.png'
const microsoftOutlook = '/images/app-calendar/microsoft-outlook.png'
const googleChrome = '/images/app-calendar/google-chrome.png'
const hubspot = '/images/app-calendar/hubspot.png'
const stripe = '/images/app-calendar/stripe.png'
const slack = '/images/app-calendar/slack.png'
const salesForce = '/images/app-calendar/sales-force.png'
const webHooks = '/images/app-calendar/web-hooks.png'
const facebook = '/images/app-calendar/facebook.png'
const microsoftTeamConference = '/images/app-calendar/microsoft-team-conference.png'
const zapier = '/images/app-calendar/zapier.png'
const zoom = '/images/app-calendar/zoom.png'

export const integrationData: IntegrationType[] = [
    {
        name: 'Google Mail',
        image: googleMail,
        description: 'You can tap on an upcoming meeting to see the details and join the call.',
        checked: true
    },
    {
        name: 'Google Analytics',
        image: googleAnalytics,
        description: 'You can measure your advertising ROI as well as track your video, applications, social media.',
        checked: false
    },
    {
        name: 'Google Meet',
        image: googleMeet,
        description: 'It is one of two apps that constitute the replacement for Google Hangouts and Google Chat.',
        checked: true
    },
    {
        name: 'Intercom',
        image: intercom,
        description: 'It is the complete customer messaging platform to drive across the entire lifecycle.',
        checked: false
    },
    {
        name: 'Microsoft Outlook',
        image: microsoftOutlook,
        description: 'Schedule an online meeting using Outlook Open Outlook and go to your calendar.',
        checked: true
    },
    {
        name: 'Google Chrome',
        image: googleChrome,
        description: 'Using your browser, share your video, desktop, and presentations with teammates and customers.',
        checked: true
    },
    {
        name: 'HubSpot',
        image: hubspot,
        description: 'Give prospects the power to book meetings with you, and save hours of time on unnecessary emailing.',
        checked: true
    },
    {
        name: 'Stripe',
        image: stripe,
        description: 'Sessions is a free conference for payments leaders, developers, founders, and curious observers.',
        checked: false
    },
    {
        name: 'Slack',
        image: slack,
        description: 'It is the collaboration hub that brings the right people, information and tools together to get work done.',
        checked: false
    },
    {
        name: 'Salesforce',
        image: salesForce,
        description: 'It provides an interface that gives salespeople useful data stored in Salesforce to lead impactful calls.',
        checked: true
    },
    {
        name: 'Web Hooks',
        image: webHooks,
        description: 'Webhooks as a medium to notify third-party applications (consumer applications) about events that occur in a Zoom account.',
        checked: false
    },
    {
        name: 'Facebook',
        image: facebook,
        description: 'Messenger Rooms, allows to create a video meeting and invite their friends to join, even if those people are not Facebook users.',
        checked: true
    },
    {
        name: 'Microsoft Team Conference',
        image: microsoftTeamConference,
        description: 'It automatically include Microsoft Teams conferencing Meetings in Teams include audio, video, and screen sharing.',
        checked: false
    },
    {
        name: 'Zapier',
        image: zapier,
        description: 'Zapier lets you connect Google Meet with thousands of the most popular apps, so you can automate your work and have more time.',
        checked: true
    },
    {
        name: 'Zoom',
        image: zoom,
        description: 'Zoom Cloud Meetings is a proprietary video teleconferencing software program developed by Zoom Video Communications.',
        checked: false
    }
]
