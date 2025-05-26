import type {MenuItemType} from "$lib/types/menu";

export const MENU_ITEMS: MenuItemType[] = [
    {
        key: 'wnba',
        label: 'WNBA',
        isTitle: true,
    },
    {
        key: 'dashboard',
        icon: 'iconamoon:home-duotone',
        label: 'Dashboard',
        url: '/',
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
        key: 'data-management',
        label: 'DATA MANAGEMENT',
        isTitle: true,
    },
    {
        key: 'data-import',
        icon: 'iconamoon:cloud-download-duotone',
        label: 'Data Import',
        children: [
            {
                key: 'import-teams',
                label: 'Import Teams',
                url: '/data/import/teams',
                parentKey: 'data-import',
            },
            {
                key: 'import-players',
                label: 'Import Players',
                url: '/data/import/players',
                parentKey: 'data-import',
            },
            {
                key: 'import-games',
                label: 'Import Games',
                url: '/data/import/games',
                parentKey: 'data-import',
            },
            {
                key: 'import-plays',
                label: 'Import Plays',
                url: '/data/import/plays',
                parentKey: 'data-import',
            },
        ],
    },
    {
        key: 'analytics',
        label: 'ANALYTICS',
        isTitle: true,
    },
    {
        key: 'reports',
        icon: 'iconamoon:file-document-duotone',
        label: 'Reports',
        children: [
            {
                key: 'team-reports',
                label: 'Team Reports',
                url: '/reports/teams',
                parentKey: 'reports',
            },
            {
                key: 'player-reports',
                label: 'Player Reports',
                url: '/reports/players',
                parentKey: 'reports',
            },
            {
                key: 'game-reports',
                label: 'Game Reports',
                url: '/reports/games',
                parentKey: 'reports',
            },
        ],
    },
    {
        key: 'advanced-stats',
        icon: 'iconamoon:3d-duotone',
        label: 'Advanced Stats',
        children: [
            {
                key: 'efficiency-ratings',
                label: 'Efficiency Ratings',
                url: '/advanced/efficiency',
                parentKey: 'advanced-stats',
            },
            {
                key: 'shot-charts',
                label: 'Shot Charts',
                url: '/advanced/shot-charts',
                parentKey: 'advanced-stats',
            },
            {
                key: 'play-analysis',
                label: 'Play Analysis',
                url: '/advanced/play-analysis',
                parentKey: 'advanced-stats',
            },
        ],
    },
];
