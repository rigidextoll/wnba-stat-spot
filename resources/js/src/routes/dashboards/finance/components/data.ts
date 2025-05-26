import type {ApexChartType, StatisticCardType} from "$lib/types";
import {currency} from "$lib/helpers/constants";
import type {RevenueSourceTableType, TransactionsTableType} from "./types";
import {getDateAndTime} from "$lib/helpers/others";
import type {ApexOptions} from "apexcharts";


const avatar2 = "/images/users/avatar-2.jpg"
const avatar4 = "/images/users/avatar-4.jpg"
const avatar5 = "/images/users/avatar-5.jpg"
const avatar6 = "/images/users/avatar-6.jpg"
const avatar10 = "/images/users/avatar-10.jpg"


export const statistics: StatisticCardType[] = [
    {
        title: 'Wallet Balance',
        statistic: 55.6,
        growth: 8.72,
        prefix: currency,
        suffix: 'k',
        icon: 'iconamoon:credit-card-duotone',
        variant: 'info'
    },
    {
        title: 'Total Income',
        statistic: 75.09,
        growth: 7.36,
        prefix: currency,
        suffix: 'k',
        icon: 'iconamoon:store-duotone',
        variant: 'primary'
    },
    {
        title: 'Total Expenses',
        statistic: 62.8,
        growth: -5.62,
        prefix: currency,
        suffix: 'k',
        icon: 'iconamoon:3d-duotone',
        variant: 'success'
    },
    {
        title: 'Investments',
        statistic: 6.4,
        growth: 2.53,
        prefix: currency,
        suffix: 'k',
        icon: 'iconamoon:3d-duotone',
        variant: 'warning'
    },
]

export const revenueCartOptions: ApexOptions = {
    series: [{
        name: "Revenue",
        type: "area",
        data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67],
    },
        {
            name: "Expenses",
            type: "line",
            data: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 12, 35],
        },
    ],
    chart: {
        height: 280,
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
            //   shadeIntensity: 1,
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
        tickAmount: 4,
        labels: {
            formatter: function (val: number) {
                return val + "k";
            },
            offsetX: -15
        },
        axisBorder: {
            show: false,
        }
    },
    grid: {
        show: true,
        strokeDashArray: 3,
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
            top: -10,
            right: -2,
            bottom: -10,
            left: -5,
        },
    },
    legend: {
        show: false
    },
    colors: ["#7f56da", "#22c55e"],
    tooltip: {
        shared: true,
        y: [{
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
            },
        ],
    },
}

export const transactionsTableData: TransactionsTableType = {
    header: ['Name', 'Description', 'Amount', 'Timestamp', 'Status'],
    body: [
        {
            user: {name: 'Adam M', avatar: avatar6},
            description: 'Licensing Revenue',
            amount: 750,
            timestamp: getDateAndTime('20 Apr, 2024 10:31:23 am'),
            status: 'success'
        },
        {
            user: {name: 'Alexa Newsome', avatar: avatar2},
            description: 'Invoice #1001',
            amount: -90.99,
            timestamp: getDateAndTime('18 Apr, 2024 06:22:09 pm'),
            status: 'cancelled'
        },
        {
            user: {name: 'Shelly Dorey', avatar: avatar10},
            description: 'Custom Software Development',
            amount: 500,
            timestamp: getDateAndTime('16 Apr, 2024 05:09:58 pm'),
            status: 'success'
        },
        {
            user: {name: ' Fredrick Arnett', avatar: avatar5},
            description: 'Envato Payout - Collaboration',
            amount: 1250.96,
            timestamp: getDateAndTime('16 Apr, 2024 10:21:25 am'),
            status: 'on-hold'
        },
        {
            user: {name: 'Barbara Frink', avatar: avatar4},
            description: 'Personal Payment',
            amount: -90.99,
            timestamp: getDateAndTime('12 Apr, 2024 06:22:09 pm'),
            status: 'failed'
        },
        {
            user: {name: 'Adam M', avatar: avatar6},
            description: 'Licensing Revenue',
            amount: 750,
            timestamp: getDateAndTime('20 Apr, 2024 10:31:23 am'),
            status: 'success'
        },
        {
            user: {name: 'Alexa Newsome', avatar: avatar2},
            description: 'Invoice #1001',
            amount: -90.99,
            timestamp: getDateAndTime('18 Apr, 2024 06:22:09 pm'),
            status: 'cancelled'
        },
        {
            user: {name: 'Shelly Dorey', avatar: avatar10},
            description: 'Custom Software Development',
            amount: 500,
            timestamp: getDateAndTime('16 Apr, 2024 05:09:58 pm'),
            status: 'success'
        },
        {
            user: {name: ' Fredrick Arnett', avatar: avatar5},
            description: 'Envato Payout - Collaboration',
            amount: 1250.96,
            timestamp: getDateAndTime('16 Apr, 2024 10:21:25 am'),
            status: 'on-hold'
        },
        {
            user: {name: 'Barbara Frink', avatar: avatar4},
            description: 'Personal Payment',
            amount: -90.99,
            timestamp: getDateAndTime('12 Apr, 2024 06:22:09 pm'),
            status: 'failed'
        },
        {
            user: {name: 'Adam M', avatar: avatar6},
            description: 'Licensing Revenue',
            amount: 750,
            timestamp: getDateAndTime('20 Apr, 2024 10:31:23 am'),
            status: 'success'
        },
        {
            user: {name: 'Alexa Newsome', avatar: avatar2},
            description: 'Invoice #1001',
            amount: -90.99,
            timestamp: getDateAndTime('18 Apr, 2024 06:22:09 pm'),
            status: 'cancelled'
        },
        {
            user: {name: 'Shelly Dorey', avatar: avatar10},
            description: 'Custom Software Development',
            amount: 500,
            timestamp: getDateAndTime('16 Apr, 2024 05:09:58 pm'),
            status: 'success'
        },
        {
            user: {name: ' Fredrick Arnett', avatar: avatar5},
            description: 'Envato Payout - Collaboration',
            amount: 1250.96,
            timestamp: getDateAndTime('16 Apr, 2024 10:21:25 am'),
            status: 'on-hold'
        },
        {
            user: {name: 'Barbara Frink', avatar: avatar4},
            description: 'Personal Payment',
            amount: -90.99,
            timestamp: getDateAndTime('12 Apr, 2024 06:22:09 pm'),
            status: 'failed'
        },
    ]
}

export const expensesChartOptions: ApexOptions = {
    series: [{
        name: "2024",
        data: [2.7, 2.2, 1.3, 2.5, 1, 2.5, 1.2, 1.2, 2.7, 1, 3.6, 2.1,],
    },
        {
            name: "2023",
            data: [-2.3, -1.9, -1, -2.1, -1.3, -2.2, -1.1, -2.3, -2.8, -1.1, -2.5, -1.5,],
        },
    ],
    chart: {
        toolbar: {
            show: false,
        },
        type: "bar",
        fontFamily: "inherit",
        foreColor: "#ADB0BB",
        height: 280,
        stacked: true,
        offsetX: -15,
    },
    colors: ["var(--bs-primary)", "var(--bs-info)"],
    plotOptions: {
        bar: {
            horizontal: false,
            barHeight: "80%",
            columnWidth: "25%",
            borderRadius: 3,
            borderRadiusApplication: "end",
            borderRadiusWhenStacked: "all",
        },
    },
    dataLabels: {
        enabled: false,
    },
    legend: {
        show: false,
    },
    grid: {
        show: true,
        strokeDashArray: 3,
        padding: {
            top: -10,
            right: 0,
            bottom: -10,
            left: 0
        },
        borderColor: "rgba(0,0,0,0.05)",
        xaxis: {
            lines: {
                show: true,
            },
        },
        yaxis: {
            lines: {
                show: false,
            },
        },
    },
    yaxis: {
        tickAmount: 4,
        labels: {
            formatter: function (val: number) {
                return val + "k";
            }
        },
    },
    xaxis: {
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
        categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "July",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ],
    },
}

export const revenueSourceChartOptions: ApexOptions = {
    chart: {
        height: 205,
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
                size: '70%',
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
    series: [140, 125, 85],
    labels: ["Online", "Offline", "Direct"],
    colors: ["var(--bs-primary)", "var(--bs-info)", "var(--bs-light)"],
    dataLabels: {
        enabled: false
    }
}

export const revenueSourceTableData: RevenueSourceTableType = {
    header: ['Sources', 'Revenue', 'Perc.'],
    body: [
        {
            source: 'Online',
            revenue: currency + '187,232',
            percent: {data: 48.63, growth: 2.5}
        },
        {
            source: 'Offline',
            revenue: currency + '126,874',
            percent: {data: 36.08, growth: 8.5}
        },
        {
            source: 'Direct',
            revenue: currency + '90,127',
            percent: {data: 23.41, growth: -10.98}
        },
    ]
}