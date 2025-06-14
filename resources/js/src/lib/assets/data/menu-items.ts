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

    // AI/ML PREDICTIONS - Main section
    {
        key: 'predictions-section',
        label: 'AI PREDICTIONS',
        isTitle: true,
    },
    {
        key: 'predictions',
        icon: 'iconamoon:crystal-ball-duotone',
        label: 'Prediction Engine',
        url: '/reports/predictions',
    },
    {
        key: 'todays-props',
        icon: 'iconamoon:fire-duotone',
        label: 'Today\'s Best Props',
        url: '/reports/todays-props',
    },
    {
        key: 'prop-scanner',
        icon: 'iconamoon:radar-duotone',
        label: 'Prop Scanner',
        url: '/advanced/prop-scanner',
    },
    {
        key: 'live-odds',
        icon: 'iconamoon:lightning-duotone',
        label: 'Live Odds',
        url: '/advanced/live-odds',
    },

    // DATA SOURCES
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

    // ANALYTICS & REPORTS
    {
        key: 'analytics-reports',
        label: 'ANALYTICS',
        isTitle: true,
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
                label: 'Model Performance',
                url: '/reports/analytics',
                parentKey: 'reports',
            },
        ],
    },
    {
        key: 'betting-analytics',
        icon: 'iconamoon:chart-line-duotone',
        label: 'Betting Analytics',
        url: '/advanced/betting-analytics',
    },

    // ADVANCED TOOLS
    {
        key: 'advanced-tools',
        label: 'ADVANCED TOOLS',
        isTitle: true,
    },
    {
        key: 'model-validation',
        icon: 'iconamoon:shield-check-duotone',
        label: 'Model Validation',
        url: '/advanced/model-validation',
    },
    {
        key: 'prediction-testing',
        icon: 'iconamoon:history-duotone',
        label: 'Historical Testing',
        url: '/advanced/prediction-testing',
    },
    {
        key: 'monte-carlo',
        icon: 'iconamoon:dice-duotone',
        label: 'Monte Carlo Sims',
        url: '/advanced/monte-carlo',
    },
    {
        key: 'data-quality',
        icon: 'iconamoon:check-circle-duotone',
        label: 'Data Quality',
        url: '/advanced/data-quality',
    },
    {
        key: 'data-management',
        icon: 'iconamoon:database-duotone',
        label: 'Data Management',
        url: '/advanced/data-management',
    },

    // SYSTEM & DOCUMENTATION
    {
        key: 'system-section',
        label: 'SYSTEM',
        isTitle: true,
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
                label: 'Prop Analysis Methods',
                url: '/methodology/prop-analysis',
                parentKey: 'methodology',
            },
            {
                key: 'monte-carlo-methodology',
                label: 'Monte Carlo Methods',
                url: '/methodology/monte-carlo',
                parentKey: 'methodology',
            },
        ],
    },
    {
        key: 'advanced-overview',
        icon: 'iconamoon:3d-duotone',
        label: 'Advanced Overview',
        url: '/advanced',
    },
];

