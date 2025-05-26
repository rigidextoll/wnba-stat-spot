import { browser } from '$app/environment';

const API_URL = browser ? 'http://localhost:80/api' : '';

interface ApiResponse<T> {
    data: T;
    message: string;
}

interface Team {
    id: number;
    team_id: string;
    team_name: string;
    team_location: string;
    team_abbreviation: string;
    team_display_name: string;
    team_uid: string;
    team_slug: string | null;
    team_logo: string;
    team_color: string;
    team_alternate_color: string;
    created_at: string;
    updated_at: string;
}

interface Player {
    id: number;
    athlete_id: string;
    athlete_display_name: string;
    athlete_short_name: string;
    athlete_jersey: string | null;
    athlete_headshot_href: string | null;
    athlete_position_name: string | null;
    athlete_position_abbreviation: string | null;
    created_at: string;
    updated_at: string;
    player_games?: PlayerGame[];
}

interface PlayerGame {
    id: number;
    game_id: number;
    player_id: number;
    team_id: number;
    minutes: string | null;
    field_goals_made: number;
    field_goals_attempted: number;
    three_point_field_goals_made: number;
    three_point_field_goals_attempted: number;
    free_throws_made: number;
    free_throws_attempted: number;
    offensive_rebounds: number;
    defensive_rebounds: number;
    rebounds: number;
    assists: number;
    steals: number;
    blocks: number;
    turnovers: number;
    fouls: number;
    plus_minus: number;
    points: number;
    starter: boolean;
    ejected: boolean;
    did_not_play: boolean;
    reason: string | null;
    active: boolean;
    team?: Team;
    game?: Game;
}

interface Game {
    id: number;
    game_id: string;
    season: string;
    season_type: string;
    game_date: string;
    game_date_time: string;
    venue_id: string | null;
    venue_name: string | null;
    venue_city: string | null;
    venue_state: string | null;
    venue_country: string | null;
    venue_capacity: number | null;
    venue_surface: string | null;
    venue_indoor: boolean | null;
    status_id: string | null;
    status_name: string | null;
    status_type: string | null;
    status_abbreviation: string | null;
    created_at: string;
    updated_at: string;
}

interface Stats extends PlayerGame {
    player?: Player;
    team?: Team;
    game?: Game;
}

export async function fetchApi<T>(endpoint: string, options: RequestInit = {}): Promise<T> {
    if (!browser) {
        throw new Error('API calls can only be made in the browser');
    }

    const response = await fetch(`${API_URL}${endpoint}`, {
        ...options,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            ...options.headers,
        },
        credentials: 'include',
    });

    if (!response.ok) {
        throw new Error(`API Error: ${response.statusText}`);
    }

    return response.json();
}

export const api = {
    teams: {
        getAll: () => fetchApi<ApiResponse<Team[]>>('/teams'),
    },
    players: {
        getAll: () => fetchApi<ApiResponse<Player[]>>('/players'),
        getById: (id: string) => fetchApi<ApiResponse<Player>>(`/players/${id}`),
    },
    games: {
        getAll: () => fetchApi<ApiResponse<Game[]>>('/games'),
    },
    stats: {
        getAll: () => fetchApi<ApiResponse<Stats[]>>('/stats'),
    },
};
