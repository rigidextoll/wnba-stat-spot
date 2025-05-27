# Queue Troubleshooting Guide

## 🚨 Queue Worker Issues

If you're seeing queue worker restart loops in your Render logs like:
```
WARN exited: laravel-queue (exit status 1; not expected)
INFO spawned: 'laravel-queue' with pid 212
INFO success: laravel-queue entered RUNNING state
```

This guide will help you diagnose and fix the issue.

## 🔍 Quick Diagnosis

### 1. Check Queue Health
```bash
# In your deployed container
php artisan queue:health-check --verbose
```

### 2. Monitor Queue Status
```bash
# Run the interactive monitoring script
/usr/local/bin/monitor-queue.sh
```

### 3. Check Logs
```bash
# Queue worker logs
tail -f /tmp/laravel-queue.log

# Supervisord logs
tail -f /tmp/supervisord.log

# Laravel application logs
tail -f storage/logs/laravel.log
```

## 🛠️ Common Issues & Fixes

### Issue 1: SQLite Configuration Error (MOST COMMON)
**Symptoms:** 
```
Database file at path [/var/www/html/database/database.sqlite] does not exist
```

**Root Cause:** Laravel is defaulting to SQLite instead of PostgreSQL

**Fix:**
```bash
# Run the database configuration fixer
php artisan db:fix-config --force

# Or manually check configuration
php artisan queue:health-check --verbose
```

**What was fixed:**
- Changed default database connection from `sqlite` to `pgsql` in config files
- Updated queue batching and failed job configurations
- Added better error detection and debugging

### Issue 2: Database Connection Problems
**Symptoms:** Queue worker exits immediately with database connection errors

**Fix:**
- The new queue worker script waits for database connectivity
- Check database environment variables in Render dashboard
- Verify PostgreSQL service is running

### Issue 3: Missing Queue Tables
**Symptoms:** Queue worker can't find `jobs`, `failed_jobs`, or `job_batches` tables

**Fix:**
```bash
# Run migrations
php artisan migrate --force

# Or specifically create queue tables
php artisan queue:table
php artisan queue:failed-table
php artisan queue:batches-table
php artisan migrate --force
```

### Issue 4: Memory Issues
**Symptoms:** Queue worker exits due to memory exhaustion

**Fix:**
- The updated job configuration reduces memory usage
- Heavy jobs now have memory limits and timeouts
- Queue worker restarts after processing 100 jobs

### Issue 5: Long-Running Jobs
**Symptoms:** Queue worker times out on heavy prediction jobs

**Fix:**
- Prediction test jobs now have 30-minute timeout (reduced from 1 hour)
- Better error handling and memory management
- Jobs are chunked to prevent overwhelming the system

## 🔧 New Improvements

### Robust Queue Worker
- **Smart Database Waiting:** Waits up to 2 minutes for database connectivity
- **Table Verification:** Ensures all required queue tables exist
- **Graceful Restart:** Processes up to 100 jobs before restarting
- **Memory Management:** 512MB memory limit with monitoring
- **Better Logging:** Verbose output for debugging

### Health Monitoring
- **Health Check Command:** `php artisan queue:health-check`
- **Interactive Monitor:** `/usr/local/bin/monitor-queue.sh`
- **Automatic Diagnostics:** Runs health checks on startup

### Job Optimization
- **Reduced Timeouts:** 30 minutes instead of 1 hour
- **Memory Limits:** 1GB limit for heavy jobs
- **Better Error Handling:** Failed job logging and recovery
- **Backoff Strategy:** Progressive delays on retries

## 📊 Monitoring Commands

### Check Queue Status
```bash
# Basic health check
php artisan queue:health-check

# Detailed health check
php artisan queue:health-check --verbose

# Fix database configuration issues
php artisan db:fix-config --force

# Check pending jobs
php artisan queue:monitor

# List failed jobs
php artisan queue:failed
```

### Restart Queue Worker
```bash
# Restart via supervisord
supervisorctl restart laravel-queue

# Or restart all queue processes
php artisan queue:restart
```

### Clear Stuck Jobs
```bash
# Clear all pending jobs
php artisan queue:clear

# Retry failed jobs
php artisan queue:retry all

# Flush failed jobs
php artisan queue:flush
```

## 🚀 Deployment Notes

### Environment Variables
Ensure these are set in your Render environment:
```
QUEUE_CONNECTION=database
DB_CONNECTION=pgsql
DB_HOST=<your-db-host>
DB_PORT=5432
DB_DATABASE=<your-db-name>
DB_USERNAME=<your-db-user>
DB_PASSWORD=<your-db-password>
```

### Render Configuration
The `render.yaml` should include:
```yaml
envVars:
  - key: QUEUE_CONNECTION
    value: database
  - key: CACHE_DRIVER
    value: database
  - key: SESSION_DRIVER
    value: database
```

## 🆘 Emergency Procedures

### If Queue Worker Won't Start
1. Check database connectivity: `php artisan migrate:status`
2. Run migrations: `php artisan migrate --force`
3. Clear cache: `php artisan cache:clear`
4. Restart supervisord: `supervisorctl restart all`

### If Jobs Are Stuck
1. Clear queue: `php artisan queue:clear`
2. Restart worker: `php artisan queue:restart`
3. Check for failed jobs: `php artisan queue:failed`

### If Memory Issues Persist
1. Reduce job batch sizes in the code
2. Increase memory limits in PHP configuration
3. Consider splitting large jobs into smaller chunks

## 📞 Getting Help

If issues persist:
1. Run full diagnostic: `/usr/local/bin/monitor-queue.sh` → option 7
2. Check all log files in `/tmp/` directory
3. Verify database connectivity and table structure
4. Review recent deployments for configuration changes

The new queue system is much more robust and should handle most common issues automatically. The monitoring tools will help you quickly identify and resolve any remaining problems. 
