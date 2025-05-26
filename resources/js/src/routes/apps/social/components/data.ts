const avatar1 = '/images/users/avatar-1.jpg'
const avatar2 = '/images/users/avatar-2.jpg'
const avatar3 = '/images/users/avatar-3.jpg'
const avatar4 = '/images/users/avatar-4.jpg'
const avatar5 = '/images/users/avatar-5.jpg'
const avatar6 = '/images/users/avatar-6.jpg'
const avatar7 = '/images/users/avatar-7.jpg'
const avatar8 = '/images/users/avatar-8.jpg'
const avatar9 = '/images/users/avatar-9.jpg'
const avatar11 = '/images/users/avatar-11.jpg'
const avatar12 = '/images/users/avatar-12.jpg'

const group1 = '/images/app-social/group-1.jpg'
const group2 = '/images/app-social/group-2.jpg'
const group3 = '/images/app-social/group-3.jpg'
const group4 = '/images/app-social/group-4.jpg'
const group5 = '/images/app-social/group-5.jpg'
const group6 = '/images/app-social/group-6.jpg'
const group7 = '/images/app-social/group-7.jpg'
const group8 = '/images/app-social/group-8.jpg'
const group9 = '/images/app-social/group-9.jpg'

const favorite1 = '/images/app-social/favorite-1.jpg'
const favorite2 = '/images/app-social/favorite-2.jpg'
const favorite3 = '/images/app-social/favorite-3.jpg'
const favorite4 = '/images/app-social/favorite-4.jpg'

const post2 = '/images/app-social/post-2.jpg'
const post3 = '/images/app-social/post-3.jpg'
const post4 = '/images/app-social/post-4.jpg'
import type {EventListType, FriendsRequestListType, GroupType, MemoriesType, SavedPostType} from "./types";

export const friendsRequestList: FriendsRequestListType[] = [
    {
        name: 'Victoria P. Miller',
        avatar: avatar5,
        mutualFriends: 'no mutual friends'
    },
    {
        name: 'Dallas C. Payne',
        avatar: avatar6,
        mutualFriends: '856 mutual friends'
    },
    {
        name: 'Florence A. Lopez',
        avatar: avatar7,
        mutualFriends: '52 mutual friends'
    },
    {name: 'Gail A. Nix', avatar: avatar8, mutualFriends: '12 mutual friends'},
    {
        name: 'Lynne J. Petty',
        avatar: avatar9,
        mutualFriends: 'no mutual friends'
    }
]

export const friendsRequests: FriendsRequestListType[] = [
    {
        name: 'Sharlene H. Smith',
        avatar: avatar1,
        mutualFriends: '114 mutual friends'
    },
    {
        name: 'Heriberto M. Ritchey',
        avatar: avatar2,
        mutualFriends: '256 mutual friends'
    },
    {
        name: 'Ruthie R. Harris',
        avatar: avatar3,
        mutualFriends: '93 mutual friends'
    },
    {
        name: 'Victoria P. Miller',
        avatar: avatar5,
        mutualFriends: 'no mutual friends'
    },
    {
        name: 'Dallas C. Payne',
        avatar: avatar6,
        mutualFriends: '856 mutual friends'
    },
    {
        name: 'Florence A. Lopez',
        avatar: avatar7,
        mutualFriends: '52 mutual friends'
    },
    {name: 'Gail A. Nix', avatar: avatar8, mutualFriends: '12 mutual friends'},
    {
        name: 'Lynne J. Petty',
        avatar: avatar9,
        mutualFriends: 'no mutual friends'
    },
    {
        name: 'Tonya J. Hill',
        avatar: avatar11,
        mutualFriends: '69 mutual friends'
    },
    {
        name: 'James A. Briggs',
        avatar: avatar12,
        mutualFriends: '22 mutual friends'
    }
]

export const pendingFriendsRequests: FriendsRequestListType[] = [
    {
        name: 'Tonya J. Hill',
        avatar: avatar11,
        mutualFriends: '69 mutual friends'
    },
    {
        name: 'James A. Briggs',
        avatar: avatar12,
        mutualFriends: '22 mutual friends'
    }
]

export const eventList: EventListType[] = [
    {
        name: 'Musical Event : Des Moines',
        image: group2,
        date: 'Fri 22 - 26 oct, 2024',
        location: '4436 Southern Avenue, Iowa-50309'
    },
    {
        name: 'Antisocial Darwinism : Evansville',
        image: group5,
        date: 'Fri 22 - 26 oct, 2024',
        location: '1265 Lucy Lane, Indiana-47710'
    },
    {
        name: 'Balls of the Bull Festival : Dallas',
        image: group6,
        date: 'Fri 22 - 26 oct, 2024',
        location: '1422 Liberty Street, Texas-75204'
    },
    {
        name: 'Belch Blanket Babylon : LA Follette',
        image: group7,
        date: 'Fri 22 - 26 oct, 2024',
        location: '2542 Cedar Street, Tennessee-37766'
    }
]

export const groupList: GroupType[] = [
    {
        image: group7,
        title: 'UI / UX Design',
        caption: "Some quick example text to build on the card title and make up the bulk of the card's content."
    },
    {
        image: group8,
        title: 'Travelling The World',
        caption: "Some quick example text to build on the card title and make up the bulk of the card's content."
    },
    {
        image: group9,
        title: 'Music Circle',
        caption: "Some quick example text to build on the card title and make up the bulk of the card's content."
    }
]

export const friendsGroup: GroupType[] = [
    {
        image: group1,
        title: 'Interior Design & Architech',
        caption: "Some quick example text to build on the card title and make up the bulk of the card's content."
    },
    {
        image: group2,
        title: 'Event Management',
        caption: "Some quick example text to build on the card title and make up the bulk of the card's content."
    },
    {
        image: group5,
        title: 'Commercial University, Daryaganj, Delhi.',
        caption: "Some quick example text to build on the card title and make up the bulk of the card's content."
    },
    {
        image: group6,
        title: 'Tourist Place of Potland',
        caption: "Some quick example text to build on the card title and make up the bulk of the card's content."
    }
]

export const suggestedGroup: GroupType[] = [
    {
        image: group3,
        title: 'Promote Your Business',
        caption: "Some quick example text to build on the card title and make up the bulk of the card's content."
    },
    {
        image: group4,
        title: 'The Greasy Mullets',
        caption: "Some quick example text to build on the card title and make up the bulk of the card's content."
    }
]

export const joinedGroup: GroupType[] = [
    {image: group6, title: 'Tourist Place of Portland', member: '2K+ members'},
    {image: group7, title: 'UI / UX Design', member: '1.4K members'},
    {image: group8, title: 'Travelling The World', member: '23M members'},
    {image: group9, title: 'Music Circle', member: '26K members'}
]

export const memoriesData: MemoriesType[] = [
    {
        avatar: avatar3,
        title: 'UI / UX Design Tutorial – Wireframe, Mockup & Design in Figma',
        timeStamp: '1 days ago',
        views: '9.5k',
        comments: '4.02k',
        link: 'https://www.youtube.com/embed/c9Wg6Cb_YlU'
    },
    {
        avatar: avatar4,
        title: 'Tour the Harvard Law School Library',
        timeStamp: '1 days ago',
        views: '91.2k',
        comments: '8.6k',
        link: 'https://www.youtube.com/embed/CXkjHLBr_y0'
    },
    {
        avatar: avatar5,
        title: 'How to Chair a Meeting Well - Part 1',
        timeStamp: '3 days ago',
        views: '854',
        comments: '102',
        link: 'https://www.youtube.com/embed/IJ_LDIlYnjw'
    },
    {
        avatar: avatar5,
        title: 'Travelling through North East India',
        timeStamp: '3 days ago',
        views: '3.8k',
        comments: '663',
        link: 'https://www.youtube.com/embed/ehmsJLZlCZ0'
    }
]

export const savedPosts: SavedPostType[] = [
    {
        title: '2 Photos',
        postBy: ' Sharlene H. Smith',
        avatar: avatar1,
        imgs: [post2, post3],
        views: '1.5k',
        comments: '521'
    },
    {
        title: '1 Photos',
        postBy: 'Victoria P. Miller',
        avatar: avatar5,
        imgs: [post4],
        views: '1.05k',
        comments: '895'
    },
    {
        title: 'Thought of the Day',
        postBy: 'Dallas C. Payne',
        avatar: avatar4,
        textContent: '“Not only must we be good, but we must also be good for something.”',
        views: '6.3k',
        comments: '2.2k'
    },
    {
        title: 'Video',
        postBy: 'Florence A. Lopez',
        avatar: avatar2,
        videoContent: 'https://www.youtube.com/embed/i8KnCFq4Sw0',
        views: '3.5k',
        comments: '521'
    },
    {
        title: 'Bernadette',
        avatar: favorite1,
        desc: ['Cant go wrong with Bernadette Clothes', 'Affordable Price and Top Quality', 'COD Available, 10 days return policy'],
        hashTags: ['Clothes', 'Trendy', 'Shirts'],
        imageContent: favorite1,
        views: '1.5k',
        comments: '521',
        timestamp: '5 hours ago'
    },
    {
        title: 'Vanessa Mall',
        avatar: favorite2,
        desc: ['Cant go wrong with Vanessa Mall', 'Affordable Price and Top Quality', 'COD Available, no return policy'],
        hashTags: ['Grocery', 'HomeMaterial', 'Foods', 'Market'],
        imageContent: favorite2,
        views: '1.3k',
        comments: '451',
        timestamp: '5 hours ago'
    },
    {
        title: 'Bat Cave, North Carolina.',
        avatar: favorite3,
        desc: ['Land of elves in Norse mythology.', 'The "otherworld" of Welsh mythology.', 'The city in which King Arthur reigned.'],
        hashTags: ['Travelling', 'Nature'],
        imageContent: favorite3,
        views: '1.2k',
        comments: '256',
        timestamp: '5 hours ago'
    },
    {
        title: 'Eternal Library',
        avatar: favorite4,
        desc: ['Academic Library.', 'Special Library.', 'Public Library.'],
        hashTags: ['LoveReading', 'Book'],
        imageContent: favorite4,
        views: '1k',
        comments: '345',
        timestamp: '5 hours ago'
    }
]
