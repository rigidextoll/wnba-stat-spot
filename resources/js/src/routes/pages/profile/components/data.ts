import type {FollowersType, MessageType, ProjectType, SkillType} from "./types";

const avatar1 = '/images/users/avatar-1.jpg'
const avatar2 = '/images/users/avatar-2.jpg'
const avatar3 = '/images/users/avatar-3.jpg'
const avatar4 = '/images/users/avatar-4.jpg'
const avatar5 = '/images/users/avatar-5.jpg'
const avatar6 = '/images/users/avatar-6.jpg'
const avatar7 = '/images/users/avatar-7.jpg'
const avatar8 = '/images/users/avatar-8.jpg'

export const skillData: SkillType[] = [
    {
        title: 'MongoDB',
        progressValue: 82
    },
    {
        title: 'WordPress',
        progressValue: 55
    },
    {
        title: 'UX Researcher',
        progressValue: 68
    },
    {
        title: 'SQL',
        progressValue: 37
    }
]

export const projectData: ProjectType[] = [
    {
        icon: 'iconamoon:pen-duotone',
        iconColor: 'primary',
        title: 'UI/UX Figma Design',
        days: 10,
        file: 13,
        task: '8/12',
        progressValue: 59,
        progressVariant: 'primary',
        team: 20,
        teamMembers: [avatar4, avatar5, avatar3, avatar6]
    },
    {
        icon: 'iconamoon:file-document-duotone',
        iconColor: 'warning',
        title: 'Multipurpose Template',
        days: 15,
        file: 8,
        progressValue: 78,
        progressVariant: 'warning',
        team: 12,
        task: '15/20',
        teamMembers: [avatar5, avatar7, avatar8, avatar1]
    }
]

export const messagesData: MessageType[] = [
    {
        avatar: avatar2,
        name: 'Kelly Winsler',
        content: "Hello! I just got your assignment, everything's alright, excellent of you!",
        time: '4.24 PM'
    },
    {
        avatar: avatar3,
        name: 'Mary R. Olson',
        content: 'Hey! Okay, thank you for letting me know. See you!',
        time: '3.21 PM'
    },
    {
        avatar: avatar4,
        name: 'Andre J. Stricker',
        content: "Hello! I just got your assignment, everything's alright, exce",
        time: '5.12 AM'
    },
    {
        avatar: avatar5,
        name: 'Amy R. Whitaker',
        content: 'Hello! You asked me for some extra excercises to train CO. Here you are, like I promissed.',
        time: '12.03 AM'
    },
    {
        avatar: avatar6,
        name: 'Alice R. Owens',
        content: 'Hey! Okay, thank you for letting me know. See you!',
        time: '1.23 PM'
    },
    {
        avatar: avatar7,
        name: 'Marcel M. McCall',
        content: 'Hey! Okay, thank you for letting me know. See you!',
        time: '8.32 AM'
    }
]

export const followersData: FollowersType[] = [
    {
        avatar: avatar6,
        name: 'Hilda B. Brid',
        email: 'hildabbridges@teleworm.us'
    },
    {
        avatar: avatar2,
        name: 'Kevin M. Bacon',
        email: 'kevinmbacon@dayrep.com'
    },
    {
        avatar: avatar3,
        name: 'Sherrie W. Torres',
        email: 'sherriewtorres@dayrep.com'
    },
    {
        avatar: avatar4,
        name: 'David R. Willi',
        email: 'davidrwill@teleworm.us'
    },
    {
        avatar: avatar7,
        name: 'Daryl V. Donn',
        email: 'darylvdonnellan@teleworm.us'
    },
    {
        avatar: avatar5,
        name: 'Risa H. Cuevas',
        email: 'risahcuevas@jourrapide.com'
    }
]
