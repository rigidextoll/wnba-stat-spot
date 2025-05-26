import type {ApexChartType, StatisticCardType} from "$lib/types";
import {currency} from "$lib/helpers/constants";
import type {FriendRequestType, RecentProjectsSummaryTableType, RecentTransactionType, ScheduleType} from "./types";
import type {ApexOptions} from "apexcharts";

const avatar1 = '/images/users/avatar-1.jpg'
const avatar2 = '/images/users/avatar-2.jpg'
const avatar3 = '/images/users/avatar-3.jpg'
const avatar4 = '/images/users/avatar-4.jpg'
const avatar5 = '/images/users/avatar-5.jpg'
const avatar6 = '/images/users/avatar-6.jpg'
const avatar7 = '/images/users/avatar-7.jpg'
const avatar8 = '/images/users/avatar-8.jpg'
const avatar9 = '/images/users/avatar-9.jpg'


export const statistics1: StatisticCardType[] = [
  {
    icon: 'iconamoon:3d-duotone',
    statistic: 59.6,
    prefix: currency,
    suffix: 'k',
    title: 'Total Sales',
    growth: 8.72,
    variant: 'info',
    background: { icon: 'bx bx-doughnut-chart' }
  },
  {
    icon: 'iconamoon:category-duotone',
    statistic: 24.03,
    prefix: currency,
    suffix: 'k',
    title: 'Total Expenses',
    growth: -3.28,
    variant: 'success',
    background: { icon: 'bx bx-bar-chart-alt-2' }
  },
  {
    icon: 'iconamoon:store-duotone',
    statistic: 48.7,
    prefix: currency,
    suffix: 'k',
    title: 'Investments',
    growth: -5.69,
    variant: 'purple',
    background: { icon: 'bx bx-building-house' }
  },
  {
    icon: 'iconamoon:gift-duotone',
    statistic: 11.3,
    prefix: currency,
    suffix: 'k',
    title: 'Savings',
    growth: 10.58,
    variant: 'orange',
    background: { icon: 'bx bx-bowl-hot' }
  },
  {
    icon: 'iconamoon:certificate-badge-duotone',
    statistic: 5.06,
    prefix: currency,
    suffix: 'k',
    title: 'Profits',
    growth: 2.25,
    variant: 'warning',
    background: { icon: 'bx bx-cricket-ball' }
  }
]

export const statistics2: StatisticCardType[] = [
  {
    icon: 'bx-layer',
    statistic: 13647,
    title: 'Campaign Sent',
    variant: 'primary'
  },
  {
    icon: 'bx-award',
    statistic: 9526,
    title: 'New Leads',
    variant: 'success'
  },
  {
    icon: 'bxs-backpack',
    statistic: 976,
    title: 'Deals',
    variant: 'danger'
  },
  {
    icon: 'bx-dollar-circle',
    statistic: 123,
    prefix: currency,
    title: 'Booked Revenue',
    variant: 'warning'
  }
]

export const statistics3: StatisticCardType[] = [
  {
    icon: 'bx-layer',
    statistic: 13647,
    growth: 2.3,
    title: 'Campaign Sent',
    variant: 'primary'
  },
  {
    icon: 'bx-award',
    statistic: 9526,
    growth: 8.1,
    title: 'New Leads',
    variant: 'success'
  },
  {
    icon: 'bxs-backpack',
    statistic: 976,
    growth: -0.3,
    title: 'Deals',
    variant: 'danger'
  },
  {
    icon: 'bx-dollar-circle',
    statistic: 123,
    growth: -10.6,
    prefix: currency,
    suffix: 'k',
    title: 'Booked Revenue',
    variant: 'warning'
  }
]

export const recentProjectsSummaryTableData: RecentProjectsSummaryTableType = {
  header: ['Project', 'Client', 'Team', 'Deadline', 'Work Progress'],
  body: [
    {
      project: 'Zelogy',
      client: 'Daniel Olsen',
      team: [{ avatar: avatar2 }, { avatar: avatar3 }, { avatar: avatar4 }],
      deadline: '12 April 2024',
      progress: { data: 25, variant: 'primary' }
    },
    {
      project: 'Shiaz',
      client: 'Jack Roldan',
      team: [{ avatar: avatar1 }, { avatar: avatar5 }],
      deadline: '10 April 2024',
      progress: { data: 75, variant: 'success' }
    },
    {
      project: 'Holderick',
      client: 'Betty Cox',
      team: [{ avatar: avatar5 }, { avatar: avatar2 }, { avatar: avatar3 }],
      deadline: '31 March 2024',
      progress: { data: 50, variant: 'warning' }
    },
    {
      project: 'Feyvux',
      client: 'Carlos Johnson',
      team: [{ avatar: avatar3 }, { avatar: avatar7 }, { avatar: avatar6 }],
      deadline: '25 March 2024',
      progress: { data: 95, variant: 'primary' }
    },
    {
      project: 'Xavlox',
      client: 'Lorraine Cox',
      team: [{ avatar: avatar7 }],
      deadline: '22 March 2024',
      progress: { data: 50, variant: 'danger' }
    },
    {
      project: 'Mozacav',
      client: 'Delores Young',
      team: [{ avatar: avatar3 }, { avatar: avatar4 }, { avatar: avatar2 }],
      deadline: '15 March 2024',
      progress: { data: 15, variant: 'primary' }
    }
  ]
}

export const scheduleData: ScheduleType[] = [
  {
    task: 'Setup Github Repository',
    time: { startAt: '09:00', endAt: '10:00' },
    variant: 'primary'
  },
  {
    task: 'Design Review - Reback Admin',
    time: { startAt: '10:00', endAt: '10:30' },
    variant: 'success'
  },
  {
    task: 'Meeting with BD Team',
    time: { startAt: '11:00', endAt: '12:30' },
    variant: 'info'
  },
  {
    task: 'Meeting with Design Studio',
    time: { startAt: '01:00', endAt: '02:00' },
    variant: 'warning'
  }
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

export const friendRequests: FriendRequestType[] = [
  {
    avatar: avatar5,
    name: 'Victoria P. Miller',
    mutualFriends: 0
  },
  {
    avatar: avatar9,
    name: 'Dallas C. Payne',
    mutualFriends: 856
  },
  {
    avatar: avatar8,
    name: 'Florence A. Lopez',
    mutualFriends: 52
  },
  {
    avatar: avatar7,
    name: 'Gail A. Nix',
    mutualFriends: 12
  },
  {
    avatar: avatar6,
    name: 'Lynne J. Petty',
    mutualFriends: 0
  },
  {
    avatar: avatar5,
    name: 'Victoria P. Miller',
    mutualFriends: 0
  },
  {
    avatar: avatar4,
    name: 'Dallas C. Payne',
    mutualFriends: 856
  },
  {
    avatar: avatar3,
    name: 'Florence A. Lopez',
    mutualFriends: 52
  },
  {
    avatar: avatar2,
    name: 'Gail A. Nix',
    mutualFriends: 12
  },
  {
    avatar: avatar1,
    name: 'Lynne J. Petty',
    mutualFriends: 0
  }
]

export const recentTransaction: RecentTransactionType[] = [
  {
    date: '24 April, 2024',
    amount: currency + 120.55,
    status: 'cr',
    description: 'Commissions'
  },
  {
    date: '24 April, 2024',
    amount: currency + 9.68,
    status: 'cr',
    description: 'Affiliates'
  },
  {
    date: '20 April, 2024',
    amount: currency + 105.22,
    status: 'dr',
    description: 'Grocery'
  },
  {
    date: '18 April, 2024',
    amount: currency + 80.59,
    status: 'cr',
    description: 'Refunds'
  },
  {
    date: '18 April, 2024',
    amount: currency + 750.95,
    status: 'dr',
    description: 'Bill Payments'
  },
  {
    date: '17 April, 2024',
    amount: currency + 455.62,
    status: 'dr',
    description: 'Electricity'
  },
  {
    date: '17 April, 2024',
    amount: currency + 102.77,
    status: 'cr',
    description: 'Interest'
  },
  {
    date: '16 April, 2024',
    amount: currency + 79.49,
    status: 'cr',
    description: 'Refunds'
  },
  {
    date: '05 April, 2024',
    amount: currency + 980,
    status: 'dr',
    description: 'Shopping'
  }
]
