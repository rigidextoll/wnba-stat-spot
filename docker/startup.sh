#!/bin/sh

echo "🚀 Starting WNBA Stat Spot application..."

# Configure nginx with the correct port
echo "🔧 Configuring nginx for port ${PORT:-80}..."
sed "s/PORT_PLACEHOLDER/${PORT:-80}/g" /etc/nginx/nginx.conf > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/nginx.conf

# Function to wait for database with timeout
wait_for_database() {
    echo "⏳ Waiting for database connection..."
    local max_attempts=30
    local attempt=1

    while [ $attempt -le $max_attempts ]; do
        if php artisan migrate:status > /dev/null 2>&1; then
            echo "✅ Database connection established"
            return 0
        fi

        echo "Database not ready, waiting... (attempt $attempt/$max_attempts)"
        sleep 2
        attempt=$((attempt + 1))
    done

    echo "⚠️  Database connection timeout after $max_attempts attempts"
    echo "🔄 Continuing with application startup..."
    return 1
}

# Wait for database (but don't fail if it times out)
wait_for_database

# Laravel optimizations (with error handling)
echo "⚡ Optimizing Laravel application..."
php artisan config:cache || echo "⚠️  Config cache failed, continuing..."
php artisan route:cache || echo "⚠️  Route cache failed, continuing..."
php artisan view:cache || echo "⚠️  View cache failed, continuing..."

# Import WNBA data (includes migrations) - only if database is available
echo "📊 Setting up database and importing WNBA data..."
if php artisan migrate:status > /dev/null 2>&1; then
    php artisan app:import-wnba-data || echo "⚠️  WNBA data import failed, continuing..."
else
    echo "⚠️  Database not available, skipping data import"
fi

echo "🎉 WNBA Stat Spot is ready!"

# Start supervisord to manage nginx and php-fpm
echo "🔧 Starting application services..."
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
