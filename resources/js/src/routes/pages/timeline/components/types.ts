export type EventType = {
  side?: string
  title: string
  badge?: string
  description: string
}
export type TimelineType = {
  date: string
  events: EventType[]
}
