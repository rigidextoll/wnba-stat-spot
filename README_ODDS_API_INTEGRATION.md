# The Odds API Integration

This document explains how to integrate and use The Odds API for real-time sports betting odds in the WNBA Stat Spot application.

## Overview

The Odds API integration replaces the previous ESPN betting lines with real-time odds from multiple bookmakers. This provides:

- **Real-time odds** from major sportsbooks (DraftKings, FanDuel, BetMGM, etc.)
- **Comprehensive WNBA player props** based on [The Odds API documentation](https://the-odds-api.com/sports-odds-data/betting-markets.html#player-props-api-markets)
- **Live odds updates** with automatic refresh
- **Best odds comparison** across multiple bookmakers
- **Historical odds data** (with paid plans)

## Setup Instructions

### 1. Get Your API Key

1. Visit [The Odds API](https://the-odds-api.com/)
2. Sign up for a free account (500 requests/month)
3. Get your API key from the dashboard

### 2. Configure Your Environment

Add your API key to your `.env` file:

```bash
# The Odds API Configuration
ODDS_API_KEY=your_api_key_here
ODDS_API_BASE_URL=https://api.the-odds-api.com/v4
ODDS_API_TIMEOUT=30
ODDS_API_RETRY_ATTEMPTS=3
ODDS_API_RETRY_DELAY=1000

# Cache Settings
ODDS_CACHE_TTL=300
PROPS_CACHE_TTL=180
EVENTS_CACHE_TTL=600
SPORTS_CACHE_TTL=3600
```

### 3. Restart Your Services

```bash
docker-compose restart laravel.test
```

## WNBA Player Props Implementation

Based on [The Odds API's WNBA player props documentation](https://the-odds-api.com/sports-odds-data/betting-markets.html#player-props-api-markets), we support:

### Core Player Props
- `player_points` - Points (Over/Under)
- `player_rebounds` - Rebounds (Over/Under)
- `player_assists` - Assists (Over/Under)
- `player_threes` - Threes Made (Over/Under)
- `player_steals` - Steals (Over/Under)
- `player_blocks` - Blocks (Over/Under)
- `player_turnovers` - Turnovers (Over/Under)

### Combination Props
- `player_points_rebounds` - Points + Rebounds (Over/Under)
- `player_points_assists` - Points + Assists (Over/Under)
- `player_rebounds_assists` - Rebounds + Assists (Over/Under)
- `player_points_rebounds_assists` - Points + Rebounds + Assists (Over/Under)

### Alternate Lines
- `player_points_alternate` - Alternate Points (Over/Under)
- `player_rebounds_alternate` - Alternate Rebounds (Over/Under)
- `player_assists_alternate` - Alternate Assists (Over/Under)
- `player_threes_alternate` - Alternate Threes (Over/Under)
- And all combination alternate props

## API Endpoints

### Player Props Endpoints

#### Get WNBA Player Props
```http
GET /api/odds/wnba/props
```

**Parameters:**
- `markets` (array|string): Player prop markets to fetch
- `bookmakers` (array|string): Specific bookmakers to include
- `player_name` (string): Filter by player name
- `regions` (string): Region (default: 'us')
- `oddsFormat` (string): Odds format (default: 'american')

**Example:**
```bash
curl "http://localhost/api/odds/wnba/props?markets=player_points,player_rebounds&player_name=Wilson"
```

#### Get Available Player Prop Markets
```http
GET /api/odds/wnba/props/markets
```

Returns all available WNBA player prop markets with descriptions.

#### Get Best Odds for Player Prop
```http
GET /api/odds/wnba/props/best
```

**Parameters:**
- `player_name` (required): Player name
- `stat_type` (required): Stat type (e.g., 'player_points')
- `line` (optional): Specific line value

#### Get Player Props Analysis
```http
GET /api/odds/wnba/props/analysis
```

**Parameters:**
- `player_name` (required): Player name
- `markets` (array|string): Markets to analyze

#### Get Event-Specific Player Props
```http
GET /api/odds/wnba/events/{eventId}/props
```

Get player props for a specific game/event.

### Standard Odds Endpoints

#### Get WNBA Game Odds
```http
GET /api/odds/wnba
```

#### Get WNBA Events
```http
GET /api/odds/wnba/events
```

#### Get Live Odds
```http
GET /api/odds/live
```

#### Get Usage Statistics
```http
GET /api/odds/usage
```

#### Clear Cache
```http
POST /api/odds/clear-cache
```

## Frontend Integration

### Live Odds Page

Visit `http://localhost:4173/advanced/live-odds` to access the live odds interface featuring:

- **Real-time WNBA game odds** from multiple bookmakers
- **Comprehensive player props** with filtering options
- **Best odds highlighting** across sportsbooks
- **Auto-refresh functionality** (30-second intervals)
- **Player name filtering** for quick searches
- **Market selection** for specific prop types

### API Client Usage

```typescript
import { api } from '$lib/api/client';

// Get all WNBA player props
const props = await api.odds.getWnbaPlayerProps({
    markets: ['player_points', 'player_rebounds'],
    player_name: 'Wilson'
});

// Get best odds for specific player
const bestOdds = await api.odds.getBestPlayerPropOdds({
    player_name: 'A\'ja Wilson',
    stat_type: 'player_points',
    line: 22.5
});

// Get comprehensive analysis
const analysis = await api.odds.getPlayerPropsAnalysis({
    player_name: 'A\'ja Wilson',
    markets: ['player_points', 'player_rebounds', 'player_assists']
});
```

## Supported Bookmakers

- **DraftKings** (`draftkings`)
- **FanDuel** (`fanduel`)
- **BetMGM** (`betmgm`)
- **Caesars** (`caesars`)
- **PointsBet** (`pointsbet_us`)
- **Unibet** (`unibet_us`)
- **BetRivers** (`betrivers`)
- **WynnBET** (`wynnbet`)
- **SuperBook** (`superbook`)
- **Barstool Sportsbook** (`barstool`)

## Caching Strategy

The integration uses intelligent caching to optimize API usage:

- **Odds**: 5 minutes (300 seconds)
- **Player Props**: 3 minutes (180 seconds)
- **Events**: 10 minutes (600 seconds)
- **Sports**: 1 hour (3600 seconds)

## Error Handling

The system gracefully handles:
- **API rate limits** with automatic retries
- **Network timeouts** with configurable retry attempts
- **Missing data** with fallback mock data
- **Invalid API keys** with clear error messages

## Usage Monitoring

Track your API usage through:
- **Usage Stats Endpoint**: `/api/odds/usage`
- **Request Counting**: Automatic tracking of daily requests
- **Rate Limit Monitoring**: Alerts when approaching limits

## Integration with Existing Features

### Today's Best Props

The existing "Today's Best Props" feature now uses real odds from The Odds API instead of mock data, providing:
- **Real betting lines** from major sportsbooks
- **Accurate confidence levels** (55-75%)
- **Realistic expected values** (2-7%)
- **Live odds updates**

### Prediction Engine

Player prop predictions now incorporate:
- **Real market lines** as baseline references
- **Bookmaker consensus** for line validation
- **Live odds movements** for market sentiment

## Development Notes

### Configuration

All player prop markets are configured in `config/odds-api.php` based on The Odds API documentation.

### Service Architecture

- **OddsApiService**: Core service for API interactions
- **OddsController**: REST API endpoints
- **Frontend Client**: TypeScript API client with type safety

### Testing

Test the integration with:

```bash
# Test basic connectivity
curl "http://localhost/api/odds/sports"

# Test WNBA player props
curl "http://localhost/api/odds/wnba/props?markets=player_points"

# Test best odds
curl "http://localhost/api/odds/wnba/props/best?player_name=Wilson&stat_type=player_points"
```

## Troubleshooting

### Common Issues

1. **"API key required" error**
   - Ensure `ODDS_API_KEY` is set in `.env`
   - Restart Laravel service after adding key

2. **"No odds available" message**
   - Check if WNBA season is active
   - Verify API key has remaining requests
   - Check The Odds API status page

3. **Slow response times**
   - Increase `ODDS_API_TIMEOUT` value
   - Reduce number of markets requested simultaneously
   - Check cache settings

### Logs

Monitor integration logs:
```bash
docker-compose logs laravel.test | grep "odds"
```

## API Limits

**Free Tier**: 500 requests/month
**Paid Tiers**: Up to 100,000+ requests/month

Monitor usage through the `/api/odds/usage` endpoint to avoid hitting limits.

## References

- [The Odds API Documentation](https://the-odds-api.com/)
- [WNBA Player Props Markets](https://the-odds-api.com/sports-odds-data/betting-markets.html#player-props-api-markets)
- [API Rate Limits](https://the-odds-api.com/liveapi/guides/v4/#rate-limits)
- [Supported Bookmakers](https://the-odds-api.com/liveapi/guides/v4/#bookmakers)

## Conclusion

The Odds API integration provides real-time, accurate betting odds that enhance the prediction system's value. With proper configuration and monitoring, it delivers professional-grade sports betting data for WNBA analytics.

The system is designed to be robust, efficient, and user-friendly, providing both developers and end-users with the tools they need for informed sports betting decisions. 
