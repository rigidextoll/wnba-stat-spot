import { describe, it, expect, vi, beforeEach } from 'vitest';
import { render, screen, fireEvent, waitFor } from '@testing-library/svelte';
import GlobalSearch from '../GlobalSearch.svelte';
import './setup';

// Mock the API client
vi.mock('$lib/api/client', () => ({
    api: {
        players: {
            getAll: vi.fn(() => Promise.resolve({
                data: [
                    {
                        id: 1,
                        athlete_display_name: 'Test Player 1',
                        athlete_position_name: 'Guard',
                        athlete_headshot_href: 'https://example.com/player1.jpg',
                        team_name: 'Test Team'
                    },
                    {
                        id: 2,
                        athlete_display_name: 'Another Player',
                        athlete_position_name: 'Forward',
                        athlete_headshot_href: null,
                        team_name: 'Another Team'
                    }
                ]
            }))
        },
        teams: {
            getAll: vi.fn(() => Promise.resolve({
                data: [
                    {
                        id: 1,
                        team_display_name: 'Test Team',
                        team_location: 'Test City',
                        team_id: 'TEST'
                    }
                ]
            }))
        }
    }
}));

// Mock debounce helper
vi.mock('$lib/helpers/others', () => ({
    debounce: vi.fn((fn) => fn)
}));

describe('GlobalSearch', () => {
    beforeEach(() => {
        vi.clearAllMocks();
    });

    it('renders search input with placeholder', () => {
        render(GlobalSearch);
        
        const input = screen.getByPlaceholderText('Search players, teams, or stats...');
        expect(input).toBeInTheDocument();
    });

    it('shows loading spinner when searching', async () => {
        render(GlobalSearch);
        
        const input = screen.getByPlaceholderText('Search players, teams, or stats...');
        
        await fireEvent.input(input, { target: { value: 'test' } });
        
        // Should show loading spinner briefly
        expect(screen.queryByRole('status')).toBeInTheDocument();
    });

    it('displays search results when typing', async () => {
        render(GlobalSearch);
        
        const input = screen.getByPlaceholderText('Search players, teams, or stats...');
        
        await fireEvent.input(input, { target: { value: 'test' } });
        
        await waitFor(() => {
            expect(screen.getByText('Test Player 1')).toBeInTheDocument();
        });
    });

    it('shows no results when search term is too short', async () => {
        render(GlobalSearch);
        
        const input = screen.getByPlaceholderText('Search players, teams, or stats...');
        
        await fireEvent.input(input, { target: { value: 't' } });
        
        // Should not show dropdown for single character
        expect(screen.queryByText('Test Player 1')).not.toBeInTheDocument();
    });

    it('handles keyboard navigation', async () => {
        render(GlobalSearch);
        
        const input = screen.getByPlaceholderText('Search players, teams, or stats...');
        
        await fireEvent.input(input, { target: { value: 'test' } });
        
        await waitFor(() => {
            expect(screen.getByText('Test Player 1')).toBeInTheDocument();
        });
        
        // Test arrow down key
        await fireEvent.keyDown(input, { key: 'ArrowDown' });
        
        // Test enter key
        await fireEvent.keyDown(input, { key: 'Enter' });
        
        // Should trigger selection
        expect(input.value).toBe('');
    });

    it('handles escape key to close dropdown', async () => {
        render(GlobalSearch);
        
        const input = screen.getByPlaceholderText('Search players, teams, or stats...');
        
        await fireEvent.input(input, { target: { value: 'test' } });
        
        await waitFor(() => {
            expect(screen.getByText('Test Player 1')).toBeInTheDocument();
        });
        
        await fireEvent.keyDown(input, { key: 'Escape' });
        
        // Dropdown should close
        expect(screen.queryByText('Test Player 1')).not.toBeInTheDocument();
    });

    it('displays player metadata correctly', async () => {
        render(GlobalSearch);
        
        const input = screen.getByPlaceholderText('Search players, teams, or stats...');
        
        await fireEvent.input(input, { target: { value: 'test' } });
        
        await waitFor(() => {
            expect(screen.getByText('Test Player 1')).toBeInTheDocument();
            expect(screen.getByText('Guard')).toBeInTheDocument();
        });
    });

    it('handles API errors gracefully', async () => {
        // Mock API to throw error
        const { api } = await import('$lib/api/client');
        vi.mocked(api.players.getAll).mockRejectedValueOnce(new Error('API Error'));
        
        render(GlobalSearch);
        
        const input = screen.getByPlaceholderText('Search players, teams, or stats...');
        
        await fireEvent.input(input, { target: { value: 'test' } });
        
        // Should not crash and should not show results
        await waitFor(() => {
            expect(screen.queryByText('Test Player 1')).not.toBeInTheDocument();
        });
    });

    it('emits select event when result is clicked', async () => {
        const component = render(GlobalSearch);
        let selectedResult = null;
        
        component.component.$on('select', (event) => {
            selectedResult = event.detail;
        });
        
        const input = screen.getByPlaceholderText('Search players, teams, or stats...');
        
        await fireEvent.input(input, { target: { value: 'test' } });
        
        await waitFor(() => {
            expect(screen.getByText('Test Player 1')).toBeInTheDocument();
        });
        
        const resultButton = screen.getByText('Test Player 1').closest('button');
        await fireEvent.click(resultButton);
        
        expect(selectedResult).toBeTruthy();
        expect(selectedResult.title).toBe('Test Player 1');
    });

    it('shows filters when showFilters prop is true', () => {
        render(GlobalSearch, { showFilters: true });
        
        expect(screen.getByLabelText('All')).toBeInTheDocument();
        expect(screen.getByLabelText('Players')).toBeInTheDocument();
        expect(screen.getByLabelText('Teams')).toBeInTheDocument();
    });

    it('limits results to maxResults prop', async () => {
        render(GlobalSearch, { maxResults: 1 });
        
        const input = screen.getByPlaceholderText('Search players, teams, or stats...');
        
        await fireEvent.input(input, { target: { value: 'test' } });
        
        await waitFor(() => {
            expect(screen.getByText('Test Player 1')).toBeInTheDocument();
            expect(screen.queryByText('Another Player')).not.toBeInTheDocument();
        });
    });
});