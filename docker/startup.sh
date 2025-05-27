#!/bin/bash

echo "🚀 Starting WNBA Stat Spot application..."

# Wait for database to be ready
echo "⏳ Waiting for database connection..."
until php artisan migrate:status > /dev/null 2>&1; do
    echo "Database not ready, waiting..."
    sleep 2
done

echo "✅ Database connection established"

# Import WNBA data (includes migrations)
echo "📊 Setting up database and importing WNBA data..."
php artisan app:import-wnba-data

echo "🎉 WNBA Stat Spot is ready!"

# Start the main application
exec "$@"
