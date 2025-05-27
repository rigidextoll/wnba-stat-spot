import type {MenuItemType} from "$lib/types/menu";

export const MENU_ITEMS: MenuItemType[] = [
    {
        key: 'wnba',
        label: 'WNBA ANALYTICS',
        isTitle: true,
    },
    {
        key: 'dashboard',
        icon: 'iconamoon:home-duotone',
        label: 'Dashboard',
        url: '/',
    },
    {
        key: 'data-overview',
        label: 'DATA',
        isTitle: true,
    },
    {
        key: 'teams',
        icon: 'iconamoon:users-duotone',
        label: 'Teams',
        url: '/teams',
    },
    {
        key: 'players',
        icon: 'iconamoon:user-duotone',
        label: 'Players',
        url: '/players',
    },
    {
        key: 'games',
        icon: 'iconamoon:game-duotone',
        label: 'Games',
        url: '/games',
    },
    {
        key: 'stats',
        icon: 'iconamoon:chart-duotone',
        label: 'Statistics',
        url: '/stats',
    },
    {
        key: 'analytics-reports',
        label: 'ANALYTICS',
        isTitle: true,
    },
    {
        key: 'predictions',
        icon: 'iconamoon:crystal-ball-duotone',
        label: 'Prediction Engine',
        url: '/reports/predictions',
    },
    {
        key: 'prop-scanner',
        icon: 'iconamoon:radar-duotone',
        label: 'Prop Scanner',
        url: '/advanced/prop-scanner',
    },
    {
        key: 'reports',
        icon: 'iconamoon:file-document-duotone',
        label: 'Reports',
        children: [
            {
                key: 'player-reports',
                label: 'Player Reports',
                url: '/reports/players',
                parentKey: 'reports',
            },
            {
                key: 'team-reports',
                label: 'Team Reports',
                url: '/reports/teams',
                parentKey: 'reports',
            },
            {
                key: 'model-validation-reports',
                label: 'Model Validation',
                url: '/reports/analytics',
                parentKey: 'reports',
            },
        ],
    },
    {
        key: 'advanced-tools',
        label: 'ADVANCED',
        isTitle: true,
    },
    {
        key: 'advanced',
        icon: 'iconamoon:3d-duotone',
        label: 'Advanced Analytics',
        children: [
            {
                key: 'advanced-overview',
                label: 'Analytics Overview',
                url: '/advanced',
                parentKey: 'advanced',
            },
            {
                key: 'monte-carlo',
                label: 'Monte Carlo Simulations',
                url: '/advanced/monte-carlo',
                parentKey: 'advanced',
            },
            {
                key: 'model-validation',
                label: 'Model Validation',
                url: '/advanced/model-validation',
                parentKey: 'advanced',
            },
            {
                key: 'prediction-testing',
                label: 'Historical Testing',
                url: '/advanced/prediction-testing',
                parentKey: 'advanced',
            },
            {
                key: 'betting-analytics',
                label: 'Betting Analytics',
                url: '/advanced/betting-analytics',
                parentKey: 'advanced',
            },
            {
                key: 'data-quality',
                label: 'Data Quality',
                url: '/advanced/data-quality',
                parentKey: 'advanced',
            },
        ],
    },
    {
        key: 'methodology',
        icon: 'iconamoon:book-duotone',
        label: 'Methodology',
        children: [
            {
                key: 'methodology-overview',
                label: 'Overview',
                url: '/methodology',
                parentKey: 'methodology',
            },
            {
                key: 'prop-analysis',
                label: 'Prop Betting Analysis',
                url: '/methodology/prop-analysis',
                parentKey: 'methodology',
            },
            {
                key: 'monte-carlo-methodology',
                label: 'Monte Carlo Simulations',
                url: '/methodology/monte-carlo',
                parentKey: 'methodology',
            },
        ],
    },
];

