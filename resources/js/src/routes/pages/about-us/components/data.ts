import type {MemberType, ServiceType} from "./types";

const avatar1 = '/images/users/avatar-1.jpg'
const avatar2 = '/images/users/avatar-2.jpg'
const avatar3 = '/images/users/avatar-3.jpg'
const avatar4 = '/images/users/avatar-4.jpg'

export const serviceData: ServiceType[] = [
    {
        icon: 'bxl-react',
        variant: 'bg-primary',
        title: 'Creative React Bootstrap Admin',
        description: 'Introducing our Creative React Bootstrap Admin, a dynamic solution merging versatility with sleek design. Unlock seamless management and intuitive user experiences with our innovative toolkit.'
    },
    {
        icon: 'bxl-bootstrap',
        variant: 'bg-purple',
        title: 'Bootstrap Saas Admin',
        description: "Introducing our Bootstrap SaaS Admin, a cutting-edge platform tailored for streamlined management. Harness the power of Bootstrap's robust framework infused with SaaS capabilities for scalable solutions."
    },
    {
        icon: 'bxl-vuejs',
        variant: 'bg-cyan',
        title: 'VueJS Client Project',
        description: 'Introducing our VueJS Client Project, a dynamic and responsive web application powered by Vue.js. Seamlessly blending functionality with elegance, this project delivers an immersive user experience.'
    },
    {
        icon: 'bxl-html5',
        variant: 'bg-danger',
        title: 'Pure Html Css Landing',
        description: 'Introducing our Pure HTML CSS Landing, a minimalist yet impactful landing page solution. Crafted with precision using HTML and CSS, it embodies simplicity and elegance.'
    },
    {
        icon: 'bxl-nodejs',
        variant: 'bg-green',
        title: 'Nodejs Backend Project',
        description: 'Introducing our Node.js Backend Project, a robust and scalable solution for powering your applications. Leveraging the power of Node.js, we deliver efficient and high-performance backend systems.'
    }
]

export const teamData: MemberType[] = [
    {
        id: 1,
        avatar: avatar1,
        name: 'Willie T. Anderson',
        email: 'willieandr@armyspy.com'
    },
    {
        id: 2,
        avatar: avatar2,
        name: 'Harold J. Hurley',
        email: 'haroldlhurly@armyspy.com'
    },
    {
        id: 3,
        avatar: avatar3,
        name: 'Harold Hurley',
        email: 'snadraaimon@armyspy.com'
    },
    {
        id: 4,
        avatar: avatar4,
        name: 'Richard Lewis',
        email: 'richaaedllewis@armyspy.com'
    }
]
