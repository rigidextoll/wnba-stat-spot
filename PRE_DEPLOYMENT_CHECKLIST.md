# 📋 Pre-Deployment Checklist for Render

Complete this checklist before deploying to Render to ensure a smooth deployment.

## ✅ Repository Preparation

- [ ] **Code is in GitHub**: Your repository is pushed to GitHub and accessible
- [ ] **Main branch is clean**: All changes are committed and pushed
- [ ] **No sensitive data**: No API keys, passwords, or secrets in the codebase
- [ ] **`.gitignore` is properly configured**: Environment files and sensitive data are ignored

## ✅ Configuration Files

- [ ] **`render.yaml` is present**: ✅ Already configured and updated
- [ ] **`Dockerfile` is present**: ✅ Multi-stage build ready
- [ ] **Docker configuration files exist**:
  - [ ] `docker/nginx.conf`
  - [ ] `docker/supervisord.conf`
  - [ ] `docker/startup.sh`
  - [ ] `docker/queue-worker.sh`

## ✅ Laravel Configuration

- [ ] **Environment configuration**: Check `config/` files for production readiness
- [ ] **Database configuration**: PostgreSQL setup ready
- [ ] **Cache configuration**: Redis cache configured
- [ ] **Queue configuration**: Redis queue configured
- [ ] **Session configuration**: Redis sessions configured

### Laravel Production Settings to Verify:

```php
// config/app.php
'env' => env('APP_ENV', 'production'),
'debug' => (bool) env('APP_DEBUG', false),

// config/database.php - PostgreSQL config should be present
'pgsql' => [
    'driver' => 'pgsql',
    'url' => env('DATABASE_URL'),
    'host' => env('DB_HOST', '127.0.0.1'),
    // ... etc
],

// config/cache.php - Redis should be configured
'redis' => [
    'driver' => 'redis',
    'connection' => 'default',
],

// config/queue.php - Redis queue
'redis' => [
    'driver' => 'redis',
    'connection' => 'default',
    'queue' => env('REDIS_QUEUE', 'default'),
    'retry_after' => 90,
],
```

## ✅ SvelteKit Configuration

- [ ] **Build configuration**: `resources/js/package.json` has correct build scripts
- [ ] **Adapter configuration**: Using `@sveltejs/adapter-node`
- [ ] **Build output**: Verify build creates proper `build/` directory

### SvelteKit Settings to Verify:

```javascript
// resources/js/svelte.config.js
import adapter from '@sveltejs/adapter-node';

export default {
  kit: {
    adapter: adapter({
      out: 'build',
      precompress: false,
      envPrefix: ''
    })
  }
};
```

## ✅ Dependencies Check

### PHP Dependencies (composer.json)
- [ ] **All required packages**: PostgreSQL, Redis drivers included
- [ ] **Production optimized**: `composer install --no-dev --optimize-autoloader`

### Node.js Dependencies (resources/js/package.json)
- [ ] **Build dependencies**: All packages needed for build are present
- [ ] **Production build**: `npm run build` works locally

## ✅ Environment Variables Preparation

### Required for Manual Setup on Render:
- [ ] **The Odds API Key**: Sign up at [the-odds-api.com](https://the-odds-api.com)
  ```
  THE_ODDS_API_KEY=your_actual_api_key_here
  ```

### Auto-configured by render.yaml:
- [ ] Database connection variables (auto-set from PostgreSQL service)
- [ ] Redis connection variables (auto-set from Redis service)  
- [ ] App URL (auto-set from web service)
- [ ] All WNBA configuration variables

## ✅ Database Preparation

- [ ] **Migrations are ready**: All migration files are in `database/migrations/`
- [ ] **Migration testing**: Migrations work with PostgreSQL
- [ ] **Seeders are optional**: Data import handled by `app:import-wnba-data`

### Key Migrations to Verify:
- [ ] `create_wnba_teams_table`
- [ ] `create_wnba_players_table`
- [ ] `create_wnba_games_table`
- [ ] `create_wnba_player_games_table`
- [ ] `create_prediction_test_results_table`
- [ ] `create_cache_table` (for database cache fallback)
- [ ] `create_jobs_table` (for queue jobs)

## ✅ Docker Configuration

### Dockerfile Verification:
- [ ] **Multi-stage build**: Frontend build → Backend setup
- [ ] **PHP extensions**: All required extensions installed
- [ ] **File permissions**: Proper ownership and permissions set
- [ ] **Port configuration**: Uses `PORT` environment variable

### Docker Support Files:
- [ ] **nginx.conf**: Properly configured for production
- [ ] **supervisord.conf**: Manages all services (nginx, php-fpm, node, queue)
- [ ] **startup.sh**: Handles initialization and service startup

## ✅ Performance Optimization

- [ ] **Laravel optimizations**:
  ```bash
  # These run automatically in Dockerfile
  composer install --optimize-autoloader --no-dev
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```

- [ ] **SvelteKit optimizations**:
  ```bash
  # Production build
  npm run build
  ```

## ✅ Security Configuration

- [ ] **APP_KEY generation**: Set to `generateValue: true` in render.yaml
- [ ] **Debug mode**: Set to `false` in production
- [ ] **HTTPS**: Automatically enabled by Render
- [ ] **Database SSL**: Enabled by default on Render PostgreSQL

## ✅ Monitoring & Logging Setup

- [ ] **Laravel logging**: Configured for production
- [ ] **WNBA specific logging**: Configured in environment variables
- [ ] **Error handling**: Production error pages set up

### Log Levels Configured:
```yaml
WNBA_LOGGING_ENABLED: "true"
WNBA_LOG_LEVEL: "info"  
WNBA_LOG_PREDICTIONS: "true"
WNBA_LOG_ANALYTICS: "true"
WNBA_LOG_PERFORMANCE: "true"
```

## ✅ API Integration

- [ ] **The Odds API**: Account created and API key obtained
- [ ] **Rate limiting**: Configured appropriately for your plan
- [ ] **Error handling**: API failures handled gracefully

## ✅ Testing Before Deployment

### Local Testing:
- [ ] **Docker build**: `docker build -t wnba-test .` succeeds
- [ ] **Docker run**: Container starts and serves application
- [ ] **Database connections**: Can connect to PostgreSQL
- [ ] **Redis connections**: Can connect to Redis
- [ ] **Frontend builds**: SvelteKit build completes successfully

### Deployment Testing Plan:
1. [ ] **Initial deployment**: All services start
2. [ ] **Database setup**: Migrations run successfully  
3. [ ] **Data import**: WNBA data imports without errors
4. [ ] **Frontend access**: Application loads in browser
5. [ ] **API functionality**: Backend API endpoints respond
6. [ ] **Queue processing**: Background jobs work

## ✅ Post-Deployment Monitoring

- [ ] **Health checks**: `/` endpoint responds correctly
- [ ] **Service logs**: No critical errors in logs
- [ ] **Database connections**: Connection pool working
- [ ] **Redis connections**: Cache and queue operations working
- [ ] **Background jobs**: Queue workers processing jobs

## 🚀 Ready for Deployment

When all items are checked:

1. **Push to GitHub**: Ensure all changes are committed and pushed
2. **Create Render Blueprint**: Upload `render.yaml` to Render
3. **Configure environment variables**: Set `THE_ODDS_API_KEY`
4. **Deploy services**: Let Render deploy all services
5. **Run initial setup**: Migrations and data import
6. **Monitor deployment**: Watch logs and verify functionality

---

## 🆘 If Something Goes Wrong

### Common Issues and Solutions:

1. **Build failures**: Check Dockerfile and dependencies
2. **Environment variable issues**: Verify all variables are set
3. **Database connection issues**: Check PostgreSQL service status
4. **Redis connection issues**: Check Redis service status
5. **Port binding issues**: Verify supervisord and startup script

### Debug Commands (Run in Render Shell):
```bash
# Check application status
php artisan about

# Test database
php artisan migrate:status

# Test cache/Redis  
php artisan cache:clear
php artisan tinker
>>> Cache::put('test', 'working')

# Check services
ps aux | grep -E "(nginx|php|node)"
supervisorctl status
```

**Remember**: Render provides excellent logging and debugging tools in their dashboard! 📊 
