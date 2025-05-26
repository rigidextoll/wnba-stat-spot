export type FriendsRequestListType = {
  name: string
  avatar: string
  mutualFriends: string
}

export type EventListType = {
  name: string
  image: string
  date: string
  location: string
}

export type GroupType = {
  image: string
  title: string
  caption?: string
  member?: string
}

export type MemoriesType = {
  avatar: string
  title: string
  timeStamp: string
  views: string
  comments: string
  link: string
}

export type SavedPostType = {
  title: string
  avatar: string
  desc?: string[]
  hashTags?: string[]
  imageContent?: string
  views: string
  comments: string
  timestamp?: string
  postBy?: string
  imgs?: string[]
  textContent?: string
  videoContent?: string
}
