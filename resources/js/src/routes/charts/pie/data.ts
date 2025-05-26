import type {ApexOptions} from 'apexcharts'

const small1 = '/images/small/img-1.jpg'
const small2 = '/images/small/img-2.jpg'
const small3 = '/images/small/img-3.jpg'
const small5 = '/images/small/img-5.jpg'

const colors1 = ['#1c84ee', '#7f56da', '#ff6c2f', '#f9b931', '#4ecac2']

export const simplePie: ApexOptions = {
    series: [44, 55, 41, 17, 15],
    chart: {
        height: 320,
        type: 'pie'
    },

    labels: ['Series 1', 'Series 2', 'Series 3', 'Series 4', 'Series 5'],
    colors: colors1,
    legend: {
        show: true,
        position: 'bottom',
        horizontalAlign: 'center',
        // verticalAlign: "middle",
        floating: false,
        fontSize: '14px',
        offsetX: 0,
        offsetY: 7
    },
    responsive: [
        {
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: false
                }
            }
        }
    ]
}

export const simpleDonut: ApexOptions = {
    series: [44, 55, 41, 17, 15],
    chart: {
        height: 320,
        type: 'donut'
    },

    legend: {
        show: true,
        position: 'bottom',
        horizontalAlign: 'center',
        // verticalAlign: 'middle',
        floating: false,
        fontSize: '14px',
        offsetX: 0,
        offsetY: 7
    },
    labels: ['Series 1', 'Series 2', 'Series 3', 'Series 4', 'Series 5'],
    colors: ['#7f56da', '#1c84ee', '#ff6c2f', '#4ecac2', '#f9b931'],
    responsive: [
        {
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: false
                }
            }
        }
    ]
}

export const monochromePie: ApexOptions = {
    series: [25, 15, 44, 55, 41, 17],
    chart: {
        height: 320,
        type: 'pie'
    },
    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
    legend: {
        show: true,
        position: 'bottom',
        horizontalAlign: 'center',
        // verticalAlign: 'middle',
        floating: false,
        fontSize: '14px',
        offsetX: 0,
        offsetY: 7
    },
    theme: {
        monochrome: {
            enabled: true
        }
    },
    responsive: [
        {
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: false
                }
            }
        }
    ]
}

export const gradientDonut: ApexOptions = {
    series: [44, 55, 41, 17, 15],
    chart: {
        height: 320,
        type: 'donut'
    },
    legend: {
        show: true,
        position: 'bottom',
        horizontalAlign: 'center',
        // verticalAlign: "middle",
        floating: false,
        fontSize: '14px',
        offsetX: 0,
        offsetY: 7
    },
    labels: ['Series 1', 'Series 2', 'Series 3', 'Series 4', 'Series 5'],
    colors: colors1,
    responsive: [
        {
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: false
                }
            }
        }
    ],
    fill: {
        type: 'gradient'
    }
}

export const patternedDonut: ApexOptions = {
    series: [44, 55, 41, 17, 15],
    chart: {
        height: 320,
        type: 'donut',
        dropShadow: {
            enabled: true,
            color: '#111',
            top: -1,
            left: 3,
            blur: 3,
            opacity: 0.2
        }
    },
    stroke: {
        show: true,
        width: 2
    },
    colors: ['#7f56da', '#1c84ee', '#ff6c2f', '#4ecac2', '#f9b931'],
    labels: ['Comedy', 'Action', 'SciFi', 'Drama', 'Horror'],
    dataLabels: {
        dropShadow: {
            blur: 3,
            opacity: 0.8
        }
    },
    fill: {
        type: 'pattern',
        opacity: 1,
        pattern: {
            // enabled: true,
            style: ['verticalLines', 'squares', 'horizontalLines', 'circles', 'slantedLines']
        }
    },
    states: {
        hover: {
            // enabled: false
        }
    },
    legend: {
        show: true,
        position: 'bottom',
        horizontalAlign: 'center',
        // verticalAlign: 'middle',
        floating: false,
        fontSize: '14px',
        offsetX: 0,
        offsetY: 7
    },
    responsive: [
        {
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: false
                }
            }
        }
    ]
}

export const imageFill: ApexOptions = {
    series: [44, 33, 54, 45],
    chart: {
        height: 320,
        type: 'pie'
    },
    labels: ['Series 1', 'Series 2', 'Series 3', 'Series 4'],
    colors: ['#39afd1', '#ffbc00', '#3e60d5', '#47ad77'],
    fill: {
        type: 'image',
        opacity: 0.85,
        image: {
            src: [small1, small2, small3, small5],
            width: 25
            // imagedHeight: 25
        }
    },
    stroke: {
        width: 4
    },
    dataLabels: {
        enabled: false
    },
    legend: {
        show: true,
        position: 'bottom',
        horizontalAlign: 'center',
        // verticalAlign: 'middle',
        floating: false,
        fontSize: '14px',
        offsetX: 0,
        offsetY: 7
    },
    responsive: [
        {
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: false
                }
            }
        }
    ]
}
