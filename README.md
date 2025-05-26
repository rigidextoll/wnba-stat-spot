# 🏀 WNBA Stat Spot

**Your ultimate destination for WNBA statistics, analytics, and insights**

A comprehensive web application built with Laravel and SvelteKit that provides detailed statistics for WNBA teams, players, games, and performance analytics.

## ✨ Features

### 📊 **Comprehensive Statistics**
- **Teams Dashboard** - Complete team profiles with logos, locations, and performance data
- **Player Analytics** - Individual player statistics with season averages and game logs
- **Game Center** - Detailed game information with venues, schedules, and results
- **Performance Metrics** - Top performances and sortable statistics tables

### 🎯 **Key Capabilities**
- **Real-time Data** - Live statistics from WNBA games and seasons
- **Advanced Search** - Filter players, teams, and games with powerful search functionality
- **Responsive Design** - Beautiful, mobile-friendly interface built with Bootstrap
- **Player Profiles** - Detailed individual player pages with career statistics
- **Season Averages** - PPG, RPG, APG, and advanced metrics
- **Game Logs** - Complete game-by-game performance tracking

## 🛠️ Technology Stack

- **Backend**: Laravel 12.x with PHP 8.2+
- **Frontend**: SvelteKit with TypeScript
- **Database**: MySQL with Eloquent ORM
- **Styling**: Bootstrap 5.3.3 + Custom SCSS
- **Icons**: Font Awesome
- **Data Processing**: League CSV for robust data import
- **Containerization**: Docker with Docker Compose

## 🚀 Quick Start

### Prerequisites
- Docker and Docker Compose
- Git

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd wnba-stat-spot
   ```

2. **Start the application**
   ```bash
   docker-compose up -d
   ```

3. **Import WNBA data**
   ```bash
   docker-compose exec laravel.test php artisan app:import-wnba-data
   ```

4. **Access the application**
   - Frontend: http://localhost:5173
   - Backend API: http://localhost:80/api

## 📱 Application Structure

### API Endpoints
- `GET /api/teams` - All WNBA teams
- `GET /api/players` - All players with statistics
- `GET /api/players/{id}` - Individual player details
- `GET /api/games` - Game schedules and results
- `GET /api/stats` - Top performance statistics

### Frontend Routes
- `/teams` - Teams overview page
- `/players` - Players listing with search
- `/players/{id}` - Individual player profile
- `/games` - Games schedule and results
- `/stats` - Statistics leaderboards

## 📊 Data Features

### Player Statistics
- Points, Rebounds, Assists per game
- Field Goal, 3-Point, Free Throw percentages
- Steals, Blocks, Turnovers
- Plus/Minus ratings
- Game-by-game performance logs

### Team Information
- Complete team profiles with branding
- Season records and standings
- Player rosters
- Game schedules

### Game Data
- Venue information and capacity
- Game dates and times
- Season and playoff games
- Box scores and statistics

## 🔧 Development

### Backend Development
```bash
# Run Laravel commands
docker-compose exec laravel.test php artisan <command>

# Run tests
docker-compose exec laravel.test php artisan test

# Check logs
docker-compose logs laravel.test
```

### Frontend Development
```bash
# Frontend logs
docker-compose logs frontend

# Restart frontend
docker-compose restart frontend
```

## 📈 Data Import

The application includes a robust data import system that handles:
- Team information and branding
- Player profiles and statistics
- Game schedules and results
- Box score data with comprehensive statistics

```bash
# Import all WNBA data
docker-compose exec laravel.test php artisan app:import-wnba-data

# Test data service
docker-compose exec laravel.test php artisan app:test-wnba-data-service
```

## 🎨 UI/UX Features

- **Modern Admin Dashboard** - Professional interface with sidebar navigation
- **Responsive Grid Layouts** - Optimized for desktop and mobile
- **Search & Filter** - Real-time search across all data types
- **Loading States** - Smooth loading indicators and error handling
- **Professional Styling** - Consistent design with WNBA branding

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

---

**Built with ❤️ for WNBA fans and basketball analytics enthusiasts**
