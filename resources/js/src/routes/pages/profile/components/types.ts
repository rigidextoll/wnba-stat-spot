import type {Color} from "@sveltestrap/sveltestrap";

export type SkillType = {
    title: string
    progressValue: number
}

export type ProjectType = {
    icon: string
    iconColor: string
    title: string
    days: number
    file: number
    task: string
    progressValue: number
    progressVariant: Color | undefined
    team: number
    teamMembers: string[]
}

export type MessageType = {
    avatar: string
    name: string
    content: string
    time: string
}

export type FollowersType = {
    avatar: string
    name: string
    email: string
}
