const API_URL = 'http://localhost:80/api';

interface ApiResponse<T> {
    data: T;
    message: string;
}

export async function fetchApi<T>(endpoint: string, options: RequestInit = {}): Promise<T> {
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
        getAll: () => fetchApi<ApiResponse<any[]>>('/teams'),
    },
    players: {
        getAll: () => fetchApi<ApiResponse<any[]>>('/players'),
    },
    games: {
        getAll: () => fetchApi<ApiResponse<any[]>>('/games'),
    },
    stats: {
        getAll: () => fetchApi<ApiResponse<any[]>>('/stats'),
    },
};
