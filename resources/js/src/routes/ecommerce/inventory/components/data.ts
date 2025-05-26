import type {InventoryType} from "./types";

const product11 = "/images/products/product-1(1).png";
const product2 = "/images/products/product-2.png";
const product3 = "/images/products/product-3.png";
const product4 = "/images/products/product-4.png";
const product5 = "/images/products/product-5.png";

export const inventoryList: InventoryType = {
    header: ['ID', 'Product', 'Condition', 'Location', 'Available', 'Reserved', 'On hand', 'Modified'],
    body: [
        {
            id: '1013',
            product: {
                name: 'G15 Gaming Laptop',
                image: product11,
                addedDate: '12 April 2018',
            },
            condition: 'new',
            location: 'WareHouse 1',
            available: 3521,
            reserved: 6532,
            onHand: 1236,
            modified: '12/03/2021',
        },
        {
            id: '1023',
            product: {
                name: 'Sony Alpha ILCE 6000Y',
                image: product2,
                addedDate: '10 April 2018',
            },
            condition: 'new',
            location: 'WareHouse 2',
            available: 4562,
            reserved: 256,
            onHand: 214,
            modified: '06/04/2021',
        },
        {
            id: '1033',
            product: {
                name: 'Sony Wireless Headphone',
                image: product3,
                addedDate: '25 December 2017',
            },
            condition: 'return',
            location: 'WareHouse 3',
            available: 125,
            reserved: 4512,
            onHand: 412,
            modified: '21/05/2020',
        },
        {
            id: '1043',
            product: {
                name: 'Apple iPad Pro',
                image: product4,
                addedDate: '05 May 2018',
            },
            condition: 'damaged',
            location: 'WareHouse 1',
            available: 4523,
            reserved: 1241,
            onHand: 852,
            modified: '15/03/2021',
        },
        {
            id: '1053',
            product: {
                name: 'Adam ROMA USB-C',
                image: product5,
                addedDate: '31 March 2018',
            },
            condition: 'new',
            location: 'WareHouse 2',
            available: 1475,
            reserved: 2345,
            onHand: 1256,
            modified: '15/10/2020',
        },
    ]
};
