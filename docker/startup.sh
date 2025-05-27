#!/bin/sh

echo "🚀 Starting WNBA Stat Spot application..."

# Configure nginx with the correct port
echo "🔧 Configuring nginx for port ${PORT:-80}..."
sed "s/PORT_PLACEHOLDER/${PORT:-80}/g" /etc/nginx/nginx.conf > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/nginx.conf

# Test nginx configuration
echo "🔍 Testing nginx configuration..."
nginx -t || {
    echo "❌ Nginx configuration test failed"
    cat /etc/nginx/nginx.conf
    exit 1
}

echo "✅ Nginx configuration is valid"

# Start supervisord immediately to bind to port
echo "🔧 Starting application services..."
supervisord -c /etc/supervisor/conf.d/supervisord.conf &

# Give services a moment to start
sleep 5

# Check if services are running
echo "📊 Checking service status..."
ps aux | grep -E "(nginx|php-fpm|node)" | grep -v grep || echo "⚠️  Some services may not be running"

# Test if port is bound (use ss if netstat not available)
echo "🔍 Testing port binding..."
if command -v netstat > /dev/null; then
    netstat -tlnp | grep ":${PORT:-80}" || echo "⚠️  Port ${PORT:-80} not bound yet"
elif command -v ss > /dev/null; then
    ss -tlnp | grep ":${PORT:-80}" || echo "⚠️  Port ${PORT:-80} not bound yet"
else
    echo "⚠️  Cannot check port binding (netstat/ss not available)"
fi

# Function to wait for database with timeout (run in background)
wait_for_database() {
    echo "⏳ Waiting for database connection..."
    local max_attempts=30
    local attempt=1

    while [ $attempt -le $max_attempts ]; do
        if php artisan migrate:status > /dev/null 2>&1; then
            echo "✅ Database connection established"

            # Laravel optimizations (with error handling)
            echo "⚡ Optimizing Laravel application..."
            php artisan config:cache || echo "⚠️  Config cache failed, continuing..."
            php artisan route:cache || echo "⚠️  Route cache failed, continuing..."
            php artisan view:cache || echo "⚠️  View cache failed, continuing..."

            # Import WNBA data (includes migrations)
            echo "📊 Setting up database and importing WNBA data..."
            php artisan app:import-wnba-data || echo "⚠️  WNBA data import failed, continuing..."

            echo "🎉 Database setup complete!"
            return 0
        fi

        echo "Database not ready, waiting... (attempt $attempt/$max_attempts)"
        sleep 2
        attempt=$((attempt + 1))
    done

    echo "⚠️  Database connection timeout after $max_attempts attempts"
    echo "🔄 Application will continue running without database features..."
    return 1
}

# Run database setup in background
wait_for_database &

echo "🎉 WNBA Stat Spot web services are ready!"
echo "🌐 Application is listening on port ${PORT:-80}"

# Wait for supervisord to finish (keeps container running)
wait
