#!/bin/sh

echo "🔄 Starting Laravel Queue Worker..."

# Change to Laravel directory
cd /var/www/html

# Function to check database connectivity
check_database() {
    echo "🔍 Checking database connection..."
    php artisan migrate:status > /dev/null 2>&1
    return $?
}

# Function to ensure queue tables exist
ensure_queue_tables() {
    echo "📊 Ensuring queue tables exist..."

    # Check if jobs table exists
    if ! php artisan tinker --execute="echo Schema::hasTable('jobs') ? 'exists' : 'missing';" 2>/dev/null | grep -q "exists"; then
        echo "⚠️  Jobs table missing, running migrations..."
        php artisan migrate --force || {
            echo "❌ Migration failed"
            return 1
        }
    fi

    echo "✅ Queue tables verified"
    return 0
}

# Function to clear any stuck jobs
clear_stuck_jobs() {
    echo "🧹 Clearing any stuck jobs..."
    php artisan queue:clear || echo "⚠️  Queue clear failed, continuing..."
    php artisan queue:restart || echo "⚠️  Queue restart failed, continuing..."
}

# Function to optimize Laravel for queue processing
optimize_laravel() {
    echo "⚡ Optimizing Laravel for queue processing..."
    php artisan config:cache || echo "⚠️  Config cache failed, continuing..."
    php artisan route:cache || echo "⚠️  Route cache failed, continuing..."
    php artisan view:cache || echo "⚠️  View cache failed, continuing..."
}

# Wait for database with exponential backoff
echo "⏳ Waiting for database to be ready..."
max_attempts=60
attempt=1
wait_time=2

while [ $attempt -le $max_attempts ]; do
    if check_database; then
        echo "✅ Database connection established on attempt $attempt"
        break
    fi

    if [ $attempt -eq $max_attempts ]; then
        echo "❌ Database connection failed after $max_attempts attempts"
        echo "🔍 Debugging database connection..."
        echo "Environment variables:"
        echo "DB_CONNECTION: ${DB_CONNECTION:-not_set}"
        echo "DB_HOST: ${DB_HOST:-not_set}"
        echo "DB_PORT: ${DB_PORT:-not_set}"
        echo "DB_DATABASE: ${DB_DATABASE:-not_set}"

        echo "🔍 Testing basic connectivity..."
        php artisan tinker --execute="try { DB::connection()->getPdo(); echo 'DB Connected'; } catch(Exception \$e) { echo 'DB Error: ' . \$e->getMessage(); }" || echo "Tinker failed"

        exit 1
    fi

    echo "Database not ready, waiting ${wait_time}s... (attempt $attempt/$max_attempts)"
    sleep $wait_time

    # Exponential backoff, but cap at 10 seconds
    wait_time=$((wait_time < 10 ? wait_time * 2 : 10))
    attempt=$((attempt + 1))
done

# Ensure queue infrastructure is ready
if ! ensure_queue_tables; then
    echo "❌ Failed to ensure queue tables exist"
    exit 1
fi

# Clear any stuck jobs from previous runs
clear_stuck_jobs

# Optimize Laravel
optimize_laravel

# Set memory limit for queue worker
export PHP_MEMORY_LIMIT=512M

echo "🚀 Starting queue worker with optimized settings..."

# Start the queue worker with robust settings
exec php artisan queue:work \
    --verbose \
    --tries=3 \
    --timeout=300 \
    --sleep=3 \
    --max-jobs=100 \
    --max-time=3600 \
    --memory=512 \
    --queue=default \
    --rest=5
