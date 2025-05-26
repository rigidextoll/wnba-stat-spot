const product11 = "/images/products/product-1(1).png";
const product2 = "/images/products/product-2.png";
const product3 = "/images/products/product-3.png";
const product4 = "/images/products/product-4.png";
const product5 = "/images/products/product-5.png";
const product6 = "/images/products/product-6.png";
const product12 = "/images/products/product-1(2).png";

import type {ProductTableType} from "./types";

export const products: ProductTableType = {
    header: ['Product Name', 'Category', 'Price', 'Inventory', 'Action'],
    body: [{
        id: 1001,
        product: {
            image: product11,
            name: 'G15 Gaming Laptop',
            caption: 'Power Your Laptop with a Long-Lasting and Fast-Charging Battery.',
        },
        category: 'Computer',
        price: '240.59',
        inventory: 'limited',
    },
        {
            id: 1002,
            product: {
                image: product2,
                name: 'Sony Alpha ILCE 6000Y 24.3 MP Mirrorless Digital SLR Camera',
                caption: 'Capture special moments and portraits to remember and share.',
            },
            category: 'Camera',
            price: '135.99',
            inventory: 'limited',
        },
        {
            id: 1003,
            product: {
                image: product3,
                name: 'Sony Over-Ear Wireless Headphone with Mic',
                caption: "Headphones are a pair of small loudspeaker drivers worn on or around the head over a user's ears.",
            },
            category: 'Headphones',
            price: '99.49',
            inventory: 'in-stock',
        },
        {
            id: 1004,
            product: {
                image: product4,
                name: 'Apple iPad Pro with Apple M1 chip',
                caption: 'The new iPad mini and iPad.',
            },
            category: 'Mobile',
            price: '27.59',
            inventory: 'out-of-stock',
        },
        {
            id: 1005,
            product: {
                image: product5,
                name: 'Adam ROMA USB-C / USB-A 3.1 (2-in-1 Flash Drive) – 128GB',
                caption: 'A USB flash drive is a data storage device that includes flash memory with an integrated USB interface.',
            },
            category: 'Pendrive',
            price: '350.19',
            inventory: 'limited',
        },
        {
            id: 1006,
            product: {
                image: product6,
                name: 'Apple iPHone 13',
                caption: 'The new iPHone 1 and iPad.',
            },
            category: 'Mobile',
            price: '75.59',
            inventory: 'out-of-stock',
        },
        {
            id: 1007,
            product: {
                image: product12,
                name: 'Apple Mac',
                caption: 'Power Your Laptop with a Long-Lasting and Fast-Charging Battery.',
            },
            category: 'Computer',
            price: '350.00',
            inventory: 'limited',
        }]
};
