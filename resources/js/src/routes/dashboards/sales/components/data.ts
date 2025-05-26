import type {ApexOptions} from "apexcharts";

const avatar2 = "/images/users/avatar-2.jpg";
const avatar3 = "/images/users/avatar-3.jpg";
const avatar4 = "/images/users/avatar-4.jpg";
const avatar5 = "/images/users/avatar-5.jpg";
const avatar6 = "/images/users/avatar-6.jpg";

const product1 = "/images/products/product-1(1).png"
const product2 = "/images/products/product-1(2).png"
const product4 = "/images/products/product-4.png"
const product5 = "/images/products/product-5.png"
const product6 = "/images/products/product-6.png"

import type {ApexChartType, StatisticCardType} from "$lib/types";

import type {
    NewAccountTableType,
    RecentOrdersTableType,
    RecentTransactionsTableType,
    SalesByCategoryTableType
} from "./types";

import {currency} from "$lib/helpers/constants";

export const statistics: StatisticCardType[] = [
    {
        icon: 'iconamoon:shopping-card-add-duotone',
        statistic: 59.6,
        prefix: currency,
        suffix: 'k',
        title: 'Total Sales',
        growth: 8.72,
        variant: 'info',
        background: {icon: 'bx bx-doughnut-chart'}
    },
    {
        icon: 'iconamoon:link-external-duotone',
        statistic: 24.03,
        prefix: currency,
        suffix: 'k',
        title: 'Total Expenses',
        growth: -3.28,
        variant: 'success',
        background: {icon: 'bx bx-bar-chart-alt-2'}
    },
    {
        icon: 'iconamoon:store-duotone',
        statistic: 48.7,
        prefix: currency,
        suffix: 'k',
        title: 'Investments',
        growth: -5.69,
        variant: 'purple',
        background: {icon: 'bx bx-building-house'}
    },
    {
        icon: 'iconamoon:gift-duotone',
        statistic: 11.3,
        prefix: currency,
        suffix: 'k',
        title: 'Profit',
        growth: 10.58,
        variant: 'orange',
        background: {icon: 'bx bx-bowl-hot'}
    },
    {
        icon: 'iconamoon:certificate-badge-duotone',
        statistic: 5.06,
        prefix: currency,
        suffix: 'k',
        title: 'Savings',
        growth: 8.72,
        variant: 'warning',
        background: {icon: 'bx bx-cricket-ball'}
    },
]

export const overviewChartOptions: ApexOptions = {
    series: [{
        name: "Revenue",
        type: "area",
        data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67],
    },
        {
            name: "Orders",
            type: "line",
            data: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 12, 35],
        },
    ],
    chart: {
        height: 369,
        type: "line",
        toolbar: {
            show: false,
        },
    },
    stroke: {
        dashArray: [0, 8],
        width: [2, 2],
        curve: 'smooth'
    },
    fill: {
        opacity: [1, 1],
        type: ['gradient', 'solid'],
        gradient: {
            type: "vertical",
            inverseColors: false,
            opacityFrom: 0.5,
            opacityTo: 0,
            stops: [0, 70]
        },
    },
    markers: {
        size: [0, 0, 0],
        strokeWidth: 2,
        hover: {
            size: 4,
        },
    },
    xaxis: {
        categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ],
        axisTicks: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
    },
    yaxis: {
        min: 0,
        labels: {
            formatter: function (val: number) {
                return val + "k";
            },
        },
        axisBorder: {
            show: false,
        }
    },
    grid: {
        show: true,
        xaxis: {
            lines: {
                show: false,
            },
        },
        yaxis: {
            lines: {
                show: true,
            },
        },
        padding: {
            top: 0,
            right: -2,
            bottom: 15,
            left: 15,
        },
    },
    legend: {
        show: true,
        horizontalAlign: "center",
        offsetX: 0,
        offsetY: 5,
        markers: {
            width: 9,
            height: 9,
            radius: 6,
        },
        itemMargin: {
            horizontal: 10,
            vertical: 0,
        },
    },
    plotOptions: {
        bar: {
            columnWidth: "30%",
            barHeight: "70%",
            borderRadius: 3,
        },
    },
    colors: ["#7f56da", "#22c55e"],
    tooltip: {
        shared: true,
        y: [
            {
                formatter: function (y: number) {
                    if (typeof y !== "undefined") {
                        return "$" + y.toFixed(2) + "k";
                    }
                    return y;
                },
            },
            {
                formatter: function (y: number) {
                    if (typeof y !== "undefined") {
                        return "$" + y.toFixed(2) + "k";
                    }
                    return y;
                },
            }
        ],
    },
}

export const salesByCategoryChartOptions: ApexOptions = {
    chart: {
        height: 250,
        type: 'donut',
    },
    legend: {
        show: false,
        position: 'bottom',
        horizontalAlign: "center",
        offsetX: 0,
        offsetY: -5,
        markers: {
            width: 9,
            height: 9,
            radius: 6,
        },
        itemMargin: {
            horizontal: 10,
            vertical: 0,
        },
    },
    stroke: {
        width: 0
    },
    plotOptions: {
        pie: {
            donut: {
                size: '80%',
                labels: {
                    show: true,
                    total: {
                        showAlways: true,
                        show: true
                    }
                }
            }
        }
    },
    series: [140, 125, 85, 60],
    labels: ["Electronics", "Grocery", "Clothing", "Other"],
    colors: ["#f9b931", "#ff86c8", "#4ecac2", "#7f56da"],
    dataLabels: {
        enabled: false
    }
}

export const salesByCategoryTableData: SalesByCategoryTableType = {
    header: ['Category', 'Orders', 'Perc.'],
    body: [
        {
            category: 'Grocery',
            orders: '187,232',
            percent: {data: 48.63, growth: 2.5}
        },
        {
            category: 'Electronics',
            orders: '126,874',
            percent: {data: 36.08, growth: 8.5}
        },
        {
            category: 'others',
            orders: '90,127',
            percent: {data: 23.41, growth: -10.98}
        },
    ]
}

export const newAccountsTableData: NewAccountTableType = {
    header: ['ID', 'Date', 'User', 'Account', 'Username'],
    body: [
        {
            id: '#US523',
            date: '24 April, 2024',
            user: {avatar: avatar2, name: 'Dan Adrick'},
            account: 'verified',
            username: '@omions'
        },
        {
            id: '#US652',
            date: '24 April, 2024',
            user: {avatar: avatar3, name: 'Daniel Olsen'},
            account: 'verified',
            username: '@alliates'
        },
        {
            id: '#US862',
            date: '20 April, 2024',
            user: {avatar: avatar4, name: 'Jack Roldan'},
            account: 'pending',
            username: '@griys'
        },
        {
            id: '#US756',
            date: '18 April, 2024',
            user: {avatar: avatar5, name: 'Betty Cox'},
            account: 'verified',
            username: '@reffon'
        },
        {
            id: '#US420',
            date: '18 April, 2024',
            user: {avatar: avatar6, name: 'Carlos Johnson'},
            account: 'blocked',
            username: '@bebo'
        },
    ]
}

export const recentTransactionsTableData: RecentTransactionsTableType = {
    header: ['ID', 'Date', 'Amount', 'Status', 'Description'],
    body: [
        {
            id: '#98521',
            date: '24 April, 2024',
            amount: currency + 120.55,
            status: 'cr',
            description: 'Commissions'
        },
        {
            id: '#20158',
            date: '24 April, 2024',
            amount: currency + 9.68,
            status: 'cr',
            description: 'Affiliates'
        },
        {
            id: '#36589',
            date: '20 April, 2024',
            amount: currency + 105.22,
            status: 'dr',
            description: 'Grocery'
        },
        {
            id: '#95362',
            date: '18 April, 2024',
            amount: currency + 80.59,
            status: 'cr',
            description: 'Refunds'
        },
        {
            id: '#75214',
            date: '18 April, 2024',
            amount: currency + 750.95,
            status: 'dr',
            description: 'Bill Payments'
        }
    ]
}

export const recentOrdersTableData: RecentOrdersTableType = {
    header: ['Order ID.', 'Date', 'Product', 'Customer Name', 'Email ID', 'Phone No.', 'Address', 'Payment Type', 'Status'],
    body: [
        {
            id: '#RB5625',
            url: '',
            date: '29 April 2024',
            product: {image: product1},
            customer: {
                name: 'Anna M. Hines',
                email: 'anna.hines@mail.com',
                phoneNo: '(+1)-555-1564-261',
                address: 'Burr Ridge/Illinois',
                url: ''
            },
            paymentType: 'Credit Card',
            status: 'completed'
        },
        {
            id: '#RB9652',
            url: '',
            date: '25 April 2024',
            product: {image: product4},
            customer: {
                name: 'Judith H. Fritsche',
                email: 'judith.fritsche.com',
                phoneNo: '(+57)-305-5579-759',
                address: 'SULLIVAN/Kentucky',
                url: ''
            },
            paymentType: 'Credit Card',
            status: 'completed'
        },
        {
            id: '#RB5984',
            url: '',
            date: '25 April 2024',
            product: {image: product5},
            customer: {
                name: 'Peter T. Smith',
                email: 'peter.smith@mail.com',
                phoneNo: '(+33)-655-5187-93',
                address: 'Yreka/California',
                url: ''
            },
            paymentType: 'Pay Pal',
            status: 'completed'
        },
        {
            id: '#RB3625',
            url: '',
            date: '21 April 2024',
            product: {image: product6},
            customer: {
                name: 'Emmanuel J. Delcid',
                email: 'emmanuel.delicid@mail.com',
                phoneNo: '(+30)-693-5553-637',
                address: 'Atlanta/Georgia',
                url: ''
            },
            paymentType: 'Pay Pal',
            status: 'processing'
        },
        {
            id: '#RB8652',
            url: '',
            date: '18 April 2024',
            product: {image: product2},
            customer: {
                name: 'William J. Cook',
                email: 'william.cook@mail.com',
                phoneNo: '(+91)-855-5446-150',
                address: 'Rosenberg/Texas',
                url: ''
            },
            paymentType: 'Credit Card',
            status: 'processing'
        },
        {
            id: '#RB5625',
            url: '',
            date: '29 April 2024',
            product: {image: product1},
            customer: {
                name: 'Anna M. Hines',
                email: 'anna.hines@mail.com',
                phoneNo: '(+1)-555-1564-261',
                address: 'Burr Ridge/Illinois',
                url: ''
            },
            paymentType: 'Credit Card',
            status: 'completed'
        },
        {
            id: '#RB9652',
            url: '',
            date: '25 April 2024',
            product: {image: product4},
            customer: {
                name: 'Judith H. Fritsche',
                email: 'judith.fritsche.com',
                phoneNo: '(+57)-305-5579-759',
                address: 'SULLIVAN/Kentucky',
                url: ''
            },
            paymentType: 'Credit Card',
            status: 'completed'
        },
        {
            id: '#RB5984',
            url: '',
            date: '25 April 2024',
            product: {image: product5},
            customer: {
                name: 'Peter T. Smith',
                email: 'peter.smith@mail.com',
                phoneNo: '(+33)-655-5187-93',
                address: 'Yreka/California',
                url: ''
            },
            paymentType: 'Pay Pal',
            status: 'completed'
        },
        {
            id: '#RB3625',
            url: '',
            date: '21 April 2024',
            product: {image: product6},
            customer: {
                name: 'Emmanuel J. Delcid',
                email: 'emmanuel.delicid@mail.com',
                phoneNo: '(+30)-693-5553-637',
                address: 'Atlanta/Georgia',
                url: ''
            },
            paymentType: 'Pay Pal',
            status: 'processing'
        },
        {
            id: '#RB8652',
            url: '',
            date: '18 April 2024',
            product: {image: product2},
            customer: {
                name: 'William J. Cook',
                email: 'william.cook@mail.com',
                phoneNo: '(+91)-855-5446-150',
                address: 'Rosenberg/Texas',
                url: ''
            },
            paymentType: 'Credit Card',
            status: 'processing'
        },
        {
            id: '#RB5625',
            url: '',
            date: '29 April 2024',
            product: {image: product1},
            customer: {
                name: 'Anna M. Hines',
                email: 'anna.hines@mail.com',
                phoneNo: '(+1)-555-1564-261',
                address: 'Burr Ridge/Illinois',
                url: ''
            },
            paymentType: 'Credit Card',
            status: 'completed'
        },
        {
            id: '#RB9652',
            url: '',
            date: '25 April 2024',
            product: {image: product4},
            customer: {
                name: 'Judith H. Fritsche',
                email: 'judith.fritsche.com',
                phoneNo: '(+57)-305-5579-759',
                address: 'SULLIVAN/Kentucky',
                url: ''
            },
            paymentType: 'Credit Card',
            status: 'completed'
        },
        {
            id: '#RB5984',
            url: '',
            date: '25 April 2024',
            product: {image: product5},
            customer: {
                name: 'Peter T. Smith',
                email: 'peter.smith@mail.com',
                phoneNo: '(+33)-655-5187-93',
                address: 'Yreka/California',
                url: ''
            },
            paymentType: 'Pay Pal',
            status: 'completed'
        },
        {
            id: '#RB3625',
            url: '',
            date: '21 April 2024',
            product: {image: product6},
            customer: {
                name: 'Emmanuel J. Delcid',
                email: 'emmanuel.delicid@mail.com',
                phoneNo: '(+30)-693-5553-637',
                address: 'Atlanta/Georgia',
                url: ''
            },
            paymentType: 'Pay Pal',
            status: 'processing'
        },
        {
            id: '#RB8652',
            url: '',
            date: '18 April 2024',
            product: {image: product2},
            customer: {
                name: 'William J. Cook',
                email: 'william.cook@mail.com',
                phoneNo: '(+91)-855-5446-150',
                address: 'Rosenberg/Texas',
                url: ''
            },
            paymentType: 'Credit Card',
            status: 'processing'
        },
    ]
}