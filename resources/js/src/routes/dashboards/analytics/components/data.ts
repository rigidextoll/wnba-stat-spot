import type {ApexChartType, StatisticCardType} from "$lib/types";
import type {SessionByBrowserType, SessionType, TopPagesTableType} from "./types";
import type {ApexOptions} from "apexcharts";


export const statistics: StatisticCardType[] = [
    {
        icon: 'iconamoon:eye-duotone',
        variant: 'primary',
        title: 'Page View',
        statistic: 13647
    },
    {
        icon: 'iconamoon:link-external-duotone',
        variant: 'success',
        title: 'Clicks',
        statistic: 9526
    },
    {
        icon: 'iconamoon:trend-up-bold',
        variant: 'danger',
        title: 'Conversions',
        statistic: 65.2,
        suffix: '%'
    },
    {
        icon: 'iconamoon:profile-circle-duotone',
        variant: 'warning',
        title: 'New Users',
        statistic: 9.5,
        suffix: 'k'
    },
]

export const conversionsChartOptions: ApexOptions = {
    chart: {
        height: 292,
        type: 'radialBar',
    },
    plotOptions: {
        radialBar: {
            startAngle: -135,
            endAngle: 135,
            dataLabels: {
                name: {
                    fontSize: '14px',
                    color: "undefined",
                    offsetY: 100
                },
                value: {
                    offsetY: 55,
                    fontSize: '20px',
                    color: undefined,
                    formatter: function (val:number) {
                        return val + "%";
                    }
                }
            },
            track: {
                background: "rgba(170,184,197, 0.2)",
                margin: 0
            },
        }
    },
    fill: {
        gradient: {
            shade: 'dark',
            shadeIntensity: 0.2,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 65, 91]
        },
    },
    stroke: {
        dashArray: 4
    },
    colors: ["#7f56da", "#22c55e"],
    series: [65.2],
    labels: ['Returning Customer'],
    responsive: [{
        breakpoint: 380,
        options: {
            chart: {
                height: 180
            }
        }
    }],
    grid: {
        padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        }
    }
}


export const performanceChartOptions: ApexOptions = {
    series: [{
        name: "Page Views",
        type: "bar",
        data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67],
    },
        {
            name: "Clicks",
            type: "area",
            data: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 12, 35],
        },
    ],
    chart: {
        height: 313,
        type: "line",
        toolbar: {
            show: false,
        },
    },
    stroke: {
        dashArray: [0, 0],
        width: [0, 2],
        curve: 'smooth'
    },
    fill: {
        opacity: [1, 1],
        type: ['solid', 'gradient'],
        gradient: {
            type: "vertical",
            inverseColors: false,
            opacityFrom: 0.5,
            opacityTo: 0,
            stops: [0, 90]
        },
    },
    markers: {
        size: [0, 0],
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
            top: 0,
            right: -2,
            bottom: 0,
            left: 10,
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
        y: [{
            formatter: function (y: number) {
                if (typeof y !== "undefined") {
                    return y.toFixed(1) + "k";
                }
                return y;
            },
        },
            {
                formatter: function (y: number) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(1) + "k";
                    }
                    return y;
                },
            },
        ],
    },
}


export const worldMapOptions = {
    map: 'world',
    selector: '#world-map-markers',
    zoomOnScroll: true,
    zoomButtons: false,
    markersSelectable: true,
    markers: [
        {name: "Canada", coords: [56.1304, -106.3468]},
        {name: "Brazil", coords: [-14.2350, -51.9253]},
        {name: "Russia", coords: [61, 105]},
        {name: "China", coords: [35.8617, 104.1954]},
        {name: "United States", coords: [37.0902, -95.7129]}
    ],
    markerStyle: {
        initial: {fill: "#7f56da"},
        selected: {fill: "#22c55e"}
    },
    labels: {
        markers: {
            render: (marker: any) => marker.name
        }
    },
    regionStyle: {
        initial: {
            fill: 'rgba(169,183,197, 0.3)',
            fillOpacity: 1,
        },
    },
}

export const totalSessions: number = 800

export const sessionData: SessionType[] = [
    {
        country: {name: 'United States', icon: 'circle-flags:us'},
        variant: 'secondary',
        sessions: 659,
        suffix: 'k'
    },
    {
        country: {name: 'Russia', icon: 'circle-flags:ru'},
        variant: 'info',
        sessions: 485,
        suffix: 'k'
    },
    {
        country: {name: 'China', icon: 'circle-flags:cn'},
        variant: 'warning',
        sessions: 355,
        suffix: 'k'
    },
    {
        country: {name: 'Canada', icon: 'circle-flags:ca'},
        variant: 'success',
        sessions: 204,
        suffix: 'k'
    },
    {
        country: {name: 'Brazil', icon: 'circle-flags:br'},
        variant: 'primary',
        sessions: 107,
        suffix: 'k'
    },
]

export const sessionByBrowserData: SessionByBrowserType[] = [
    {
        browser: 'Chrome',
        session: {percent: 62.5, data: 5.06}
    },
    {
        browser: 'Firefox',
        session: {percent: 12.3, data: 1.5}
    },
    {
        browser: 'Safari',
        session: {percent: 9.86, data: 1.03}
    },
    {
        browser: 'Brave',
        session: {percent: 3.15, data: 0.3}
    },
    {
        browser: 'Opera',
        session: {percent: 3.01, data: 1.58}
    },
    {
        browser: 'Falkon',
        session: {percent: 2.8, data: 0.01}
    },
    {
        browser: 'Other',
        session: {percent: 6.38, data: 3.6}
    },
]

export const topPagesTableData: TopPagesTableType = {
    header: ['Page Path', 'Page Views', 'Avg Time on Page', 'Exit Rate'],
    body: [
        {
            pagePath: 'reback/dashboard.html',
            pageViews: 4265,
            avgTimeOnPage: '09m:45s',
            exitRate: 20.4
        },
        {
            pagePath: 'reback/chat.html',
            pageViews: 2584,
            avgTimeOnPage: '05m:02s',
            exitRate: 12.25
        },
        {
            pagePath: 'reback/auth-login.html',
            pageViews: 3369,
            avgTimeOnPage: '04m:25s',
            exitRate: 5.2
        },
        {
            pagePath: 'reback/email.html',
            pageViews: 985,
            avgTimeOnPage: '02m:03s',
            exitRate: 64.2
        },
        {
            pagePath: 'reback/social.html',
            pageViews: 653,
            avgTimeOnPage: '15m:56s',
            exitRate: 2.4
        },
    ]
}