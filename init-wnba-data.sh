#!/bin/bash

echo "🚀 Initializing WNBA Stat Spot..."

# Check if containers are running
if ! docker-compose ps | grep -q "Up"; then
    echo "❌ Containers are not running. Please start them first with: docker-compose up -d"
    exit 1
fi

# Wait for database to be ready
echo "⏳ Waiting for database connection..."
until docker exec wnba-stat-spot-laravel.test-1 php artisan migrate:status > /dev/null 2>&1; do
    echo "Database not ready, waiting..."
    sleep 2
done

echo "✅ Database connection established"

# Import WNBA data (includes migration step)
echo "📊 Importing WNBA data and setting up database..."
docker exec wnba-stat-spot-laravel.test-1 php artisan app:import-wnba-data

echo "🎉 WNBA Stat Spot is ready!"
echo "💡 You can now access the application at http://localhost"
