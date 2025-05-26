import type {InvoiceDetailType, InvoiceType} from "./types";

const avatar2 = '/images/users/avatar-2.jpg'
const avatar3 = '/images/users/avatar-3.jpg'
const avatar4 = '/images/users/avatar-4.jpg'
const avatar5 = '/images/users/avatar-5.jpg'
const avatar1 = '/images/users/avatar-1.jpg'
const avatar6 = '/images/users/avatar-6.jpg'
const avatar7 = '/images/users/avatar-7.jpg'
const avatar8 = '/images/users/avatar-8.jpg'
const avatar9 = '/images/users/avatar-9.jpg'
const avatar10 = '/images/users/avatar-10.jpg'

export const invoicesData: InvoiceType[] = [
    {
        invoiceNumber: 'RB6985',
        client: {
            name: 'Sean Kemper',
            avatar: avatar2
        },
        issueDate: '2024-04-23T17:09:00',
        dueDate: '2024-04-30',
        amount: 852.25,
        status: 'unpaid',
        paymentMethod: 'PayPal'
    },
    {
        invoiceNumber: 'RB1002',
        client: {
            name: 'Victoria Sullivan',
            avatar: avatar3
        },
        issueDate: '2024-05-14T10:51:00',
        dueDate: '2024-08-25',
        amount: 953.0,
        status: 'send',
        paymentMethod: 'PayPal'
    },
    {
        invoiceNumber: 'RB3652',
        client: {
            name: 'Liam Martinez',
            avatar: avatar4
        },
        issueDate: '2024-04-12T12:09:00',
        dueDate: '2024-04-28',
        amount: 99.0,
        status: 'unpaid',
        paymentMethod: 'Swift Transfer'
    },
    {
        invoiceNumber: 'RB7854',
        client: {
            name: 'Emma Johnson',
            avatar: avatar5
        },
        issueDate: '2024-04-10T22:09:00',
        dueDate: '2024-04-15',
        amount: 1250.0,
        status: 'paid',
        paymentMethod: 'PayPal'
    },
    {
        invoiceNumber: 'RB9521',
        client: {
            name: 'Olivia Thompson',
            avatar: avatar1
        },
        issueDate: '2024-05-22T15:41:00',
        dueDate: '2024-07-05',
        amount: 500.0,
        status: 'send',
        paymentMethod: 'Payoneer'
    },
    {
        invoiceNumber: 'RB9634',
        client: {
            name: 'Noah Garcia',
            avatar: avatar6
        },
        issueDate: '2024-05-18T09:09:00',
        dueDate: '2024-05-30',
        amount: 250.0,
        status: 'paid',
        paymentMethod: 'Bank'
    },
    {
        invoiceNumber: 'RB8520',
        client: {
            name: 'Sophia Davis',
            avatar: avatar7
        },
        issueDate: '2024-04-05T08:50:00',
        dueDate: '2024-04-22',
        amount: 29.0,
        status: 'paid',
        paymentMethod: 'PayPal'
    },
    {
        invoiceNumber: 'RB3590',
        client: {
            name: 'Isabella Lopez',
            avatar: avatar8
        },
        issueDate: '2024-06-15T23:09:00',
        dueDate: '2024-08-01',
        amount: 24.99,
        status: 'send',
        paymentMethod: 'Swift'
    },
    {
        invoiceNumber: 'RB5872',
        client: {
            name: 'Ava Wilson',
            avatar: avatar9
        },
        issueDate: '2024-04-22T17:09:00',
        dueDate: '2024-04-30',
        amount: 1000.0,
        status: 'unpaid',
        paymentMethod: 'Payoneer'
    },
    {
        invoiceNumber: 'RB1158',
        client: {
            name: 'Oliver Lee',
            avatar: avatar10
        },
        issueDate: '2024-04-23T12:09:00',
        dueDate: '2024-04-30',
        amount: 1999.0,
        status: 'unpaid',
        paymentMethod: 'Wise'
    }
]

export const InvoiceDetails: InvoiceDetailType = {
    invoiceNo: '#RB89562',
    customerName: 'Glenn H Smith',
    street: '135 White Cemetery Rd',
    location: 'Perryville, KY, 40468',
    contact: '(304) 584-4345',
    products: [
        {
            name: 'G15 Gaming Laptop',
            qty: 3,
            price: 240.59
        },
        {
            name: 'Sony Alpha ILCE 6000Y 24.3 MP Mirrorless Digital SLR Camera',
            qty: 5,
            price: 135.99
        },
        {
            name: 'Sony Over-Ear Wireless Headphone with Mic',
            qty: 1,
            price: 99.49
        },
        {
            name: 'Adam ROMA USB-C / USB-A 3.1 (2-in-1 Flash Drive) – 128GB',
            qty: 2,
            price: 350.19
        }
    ]
}
