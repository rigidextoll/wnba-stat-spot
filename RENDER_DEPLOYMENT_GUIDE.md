# 🚀 WNBA Stat Spot - Render Deployment Guide

This guide will help you deploy your WNBA Analytics application to Render using the configured `render.yaml` file.

## 📋 Prerequisites

1. **Render Account**: Sign up at [render.com](https://render.com)
2. **GitHub Repository**: Your code should be in a GitHub repository
3. **The Odds API Key**: Sign up at [the-odds-api.com](https://the-odds-api.com) for sports data

## 🏗️ Architecture Overview

Your application will be deployed as:
- **Web Service**: Laravel backend + SvelteKit frontend (combined container)
- **PostgreSQL Database**: Render's managed PostgreSQL service
- **Redis Service**: Render's managed Redis service for caching and queues

## 🚀 Deployment Steps

### 1. Connect Your Repository

1. Go to your [Render Dashboard](https://dashboard.render.com)
2. Click **"New +"** → **"Blueprint"**
3. Connect your GitHub repository
4. Render will automatically detect your `render.yaml` file

### 2. Configure Environment Variables

After the initial deployment, you'll need to set these environment variables in the Render Dashboard:

#### Required Manual Configuration:
```bash
# The Odds API (Get from https://the-odds-api.com)
THE_ODDS_API_KEY=your_api_key_here

# Optional: Set in production if you have specific requirements
APP_KEY=base64:your_generated_key_here  # Render will auto-generate if not set
```

#### How to Set Environment Variables:
1. Go to your **Web Service** in Render Dashboard
2. Click **"Environment"** tab
3. Add the environment variables listed above
4. Click **"Save Changes"**

### 3. Deploy Services

The `render.yaml` will automatically create:

#### 🌐 Web Service: `wnba-stat-spot`
- **Plan**: Starter ($7/month)
- **Features**: 
  - Auto-deployed Laravel + SvelteKit application
  - Health checks enabled
  - SSL certificate included
  - Custom domain support

#### 🗄️ Database: `wnba-stat-spot-db`
- **Type**: PostgreSQL
- **Plan**: Starter (1GB storage, $7/month)
- **Features**:
  - Automated backups
  - Connection pooling
  - SSL connections

#### ⚡ Redis: `wnba-redis`
- **Plan**: Starter (25MB, $7/month)
- **Features**:
  - Used for caching, sessions, and queue jobs
  - LRU eviction policy

### 4. Initial Data Setup

After successful deployment:

1. **Run Migrations**:
   - Go to your web service dashboard
   - Click **"Shell"** tab
   - Run: `php artisan migrate --force`

2. **Import WNBA Data**:
   ```bash
   php artisan app:import-wnba-data --force
   ```

3. **Test Scheduled Tasks**:
   ```bash
   php artisan schedule:list
   php artisan queue:work --timeout=60 --tries=3
   ```

## 🔧 Configuration Details

### Database Configuration
- **Engine**: PostgreSQL 15+
- **Connection**: Automatically configured via `render.yaml`
- **SSL**: Enabled by default
- **Backups**: Daily automated backups included

### Redis Configuration
- **Memory**: 25MB (Starter plan)
- **Eviction**: LRU (Least Recently Used)
- **Purpose**: Caching, sessions, and job queues
- **Connection**: Automatically configured

### Web Service Configuration
- **Runtime**: Docker (multi-stage build)
- **Port**: 80 (automatically set)
- **Health Check**: `/` endpoint
- **SSL**: Free SSL certificate included
- **Domain**: `your-app-name.onrender.com`

## 🌍 Custom Domain Setup

1. In your web service dashboard, go to **"Settings"**
2. Scroll to **"Custom Domains"**
3. Click **"Add Custom Domain"**
4. Follow the DNS configuration instructions

## 📊 Monitoring & Logs

### Application Logs
- Go to your web service dashboard
- Click **"Logs"** tab to view real-time logs
- Use filters to focus on specific log levels

### Database Monitoring
- Database dashboard shows connection count, storage usage
- Query performance metrics available

### Redis Monitoring
- Memory usage and key count tracking
- Connection monitoring

## 🔄 Scheduled Tasks

Your application includes scheduled tasks that will run automatically:

```php
// Defined in routes/console.php
Schedule::command('app:import-wnba-data --force')
    ->dailyAt('02:00')
    ->description('Import WNBA data daily');

Schedule::command('queue:health-check')
    ->everyThirtyMinutes();
```

### Setting Up Cron Jobs on Render

Add this to your Dockerfile (already included):
```dockerfile
# Add cron job for Laravel scheduler
RUN echo "* * * * * cd /var/www/html && php artisan schedule:run >> /var/log/cron.log 2>&1" | crontab -
```

## 🚨 Troubleshooting

### Common Issues

#### 1. **Build Failures**
```bash
# Check build logs in Render Dashboard
# Common causes:
- Missing environment variables
- Dependency installation issues
- Docker build context problems
```

#### 2. **Database Connection Issues**
```bash
# Check environment variables are set correctly
# Verify database service is running
# Check connection string format
```

#### 3. **Redis Connection Issues**
```bash
# Verify Redis service is running
# Check Redis environment variables
# Test connection: php artisan tinker → Cache::put('test', 'value')
```

#### 4. **Queue Jobs Not Processing**
```bash
# Check queue configuration in environment
# Verify Redis is working
# Check supervisor/queue worker logs
```

### Debug Commands

```bash
# Check application status
php artisan about

# Test database connection
php artisan migrate:status

# Test cache (Redis)
php artisan cache:clear
php artisan tinker
>>> Cache::put('test', 'working')
>>> Cache::get('test')

# Check queue status
php artisan queue:health-check

# View application logs
tail -f storage/logs/laravel.log
```

## 📈 Scaling Options

### Vertical Scaling (Upgrade Plans)
- **Web Service**: Starter → Standard → Pro
- **Database**: More storage and compute power
- **Redis**: Larger memory allocation

### Horizontal Scaling
- Add multiple web service instances
- Use Render's load balancing
- Scale background job processing

## 💰 Cost Breakdown (Starter Plans)

- **Web Service**: $7/month
- **PostgreSQL**: $7/month  
- **Redis**: $7/month
- **Total**: ~$21/month

## 🔐 Security Best Practices

1. **Environment Variables**: Never commit secrets to Git
2. **SSL**: Always enabled on Render
3. **Database**: Use connection pooling and SSL
4. **API Keys**: Rotate The Odds API key regularly
5. **Monitoring**: Set up alerts for service health

## 📞 Support

- **Render Support**: [render.com/support](https://render.com/support)
- **Documentation**: [render.com/docs](https://render.com/docs)
- **Community**: [community.render.com](https://community.render.com)

---

## 🎉 Post-Deployment Checklist

- [ ] All services are running (Web, Database, Redis)
- [ ] Environment variables are configured
- [ ] Database migrations completed
- [ ] WNBA data imported successfully
- [ ] Scheduled tasks are working
- [ ] Queue workers are processing jobs
- [ ] Application is accessible via provided URL
- [ ] SSL certificate is active
- [ ] Monitoring and logging configured

**Your WNBA Analytics application should now be live! 🏀📊** 
