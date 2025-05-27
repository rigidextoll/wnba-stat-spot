#!/bin/sh

echo "🚀 Starting WNBA Stat Spot application..."

# Configure nginx with the correct port
echo "🔧 Configuring nginx for port ${PORT:-80}..."
sed "s/PORT_PLACEHOLDER/${PORT:-80}/g" /etc/nginx/nginx.conf > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM to listen on 127.0.0.1:9000
echo "🔧 Configuring PHP-FPM..."
cat > /etc/php82/php-fpm.d/www.conf << 'EOF'
[www]
user = nginx
group = nginx
listen = 127.0.0.1:9000
listen.owner = nginx
listen.group = nginx
listen.mode = 0660
pm = dynamic
pm.max_children = 50
pm.start_servers = 5
pm.min_spare_servers = 5
pm.max_spare_servers = 35
pm.max_requests = 500
catch_workers_output = yes
php_admin_value[error_log] = /tmp/php-fpm-error.log
php_admin_flag[log_errors] = on
EOF

# Test nginx configuration
echo "🔍 Testing nginx configuration..."
nginx -t || {
    echo "❌ Nginx configuration test failed"
    cat /etc/nginx/nginx.conf
    exit 1
}

echo "✅ Nginx configuration is valid"

# Check if SvelteKit build exists
echo "🔍 Checking SvelteKit build..."
if [ -d "/var/www/html/frontend-build" ]; then
    echo "✅ SvelteKit build directory exists"
    ls -la /var/www/html/frontend-build/
    if [ -f "/var/www/html/frontend-build/index.js" ]; then
        echo "✅ SvelteKit index.js found"
    else
        echo "❌ SvelteKit index.js not found"
    fi

    # Check for client assets
    if [ -d "/var/www/html/frontend-build/client" ]; then
        echo "✅ SvelteKit client directory exists"
        ls -la /var/www/html/frontend-build/client/

        if [ -d "/var/www/html/frontend-build/client/_app" ]; then
            echo "✅ SvelteKit _app directory exists"
            ls -la /var/www/html/frontend-build/client/_app/ | head -10
        else
            echo "❌ SvelteKit _app directory not found"
        fi

        if [ -d "/var/www/html/frontend-build/client/immutable" ]; then
            echo "✅ SvelteKit immutable directory exists"
            ls -la /var/www/html/frontend-build/client/immutable/ | head -10
        else
            echo "❌ SvelteKit immutable directory not found"
        fi
    else
        echo "❌ SvelteKit client directory not found"
        echo "Available directories:"
        ls -la /var/www/html/frontend-build/
    fi
else
    echo "❌ SvelteKit build directory not found"
    ls -la /var/www/html/
fi

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

# Test PHP-FPM port
echo "🔍 Testing PHP-FPM port 9000..."
sleep 2
if command -v netstat > /dev/null; then
    netstat -tlnp | grep ":9000" || echo "⚠️  PHP-FPM not listening on port 9000"
elif command -v ss > /dev/null; then
    ss -tlnp | grep ":9000" || echo "⚠️  PHP-FPM not listening on port 9000"
else
    echo "⚠️  Cannot check PHP-FPM port binding"
fi

# Test SvelteKit service
echo "🔍 Testing SvelteKit service..."
sleep 2
if curl -f http://localhost:3000 > /dev/null 2>&1; then
    echo "✅ SvelteKit is responding on port 3000"
else
    echo "⚠️  SvelteKit not responding on port 3000"
    echo "📋 SvelteKit logs:"
    tail -20 /tmp/sveltekit.log 2>/dev/null || echo "No SvelteKit logs found"
fi

# Test Laravel API
echo "🔍 Testing Laravel API..."
if curl -f http://localhost:${PORT:-80}/health > /dev/null 2>&1; then
    echo "✅ Laravel API is responding"
else
    echo "⚠️  Laravel API not responding"
    echo "📋 PHP-FPM logs:"
    tail -20 /tmp/php-fpm.log 2>/dev/null || echo "No PHP-FPM logs found"

    echo "📋 PHP-FPM error logs:"
    tail -20 /tmp/php-fpm-error.log 2>/dev/null || echo "No PHP-FPM error logs found"

    echo "📋 Nginx error logs:"
    tail -20 /tmp/nginx-error.log 2>/dev/null || echo "No nginx error logs found"

    echo "🔍 Testing simple API endpoint:"
    curl -v http://localhost:${PORT:-80}/api/test 2>&1 || echo "Simple API test failed"

    echo "🔍 Testing PHP-FPM directly:"
    if command -v php > /dev/null; then
        echo "PHP version: $(php --version | head -1)"
        echo "Testing basic PHP execution:"
        php -r "echo 'PHP is working\n';" || echo "PHP execution failed"

        echo "Testing Laravel artisan:"
        cd /var/www/html
        php artisan --version || echo "Laravel artisan failed"

        echo "Testing database connection:"
        php artisan migrate:status || echo "Database connection failed"
    else
        echo "PHP not found in PATH"
    fi

    echo "🔍 Checking process status:"
    ps aux | grep -E "(php|nginx)" | grep -v grep || echo "No PHP/nginx processes found"
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

# Give database setup some time before starting queue health check
sleep 10

# Run queue health check in background
(
    sleep 30  # Wait a bit more for everything to settle
    echo "🔍 Running queue health check..."
    php artisan queue:health-check --verbose || echo "⚠️  Queue health check failed, but continuing..."
) &

echo "🎉 WNBA Stat Spot web services are ready!"
echo "🌐 Application is listening on port ${PORT:-80}"

# Wait for supervisord to finish (keeps container running)
wait
