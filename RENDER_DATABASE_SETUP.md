# 🗄️ Render Database Setup Guide

## 🚨 Current Issue
Your application is trying to connect to PostgreSQL but getting "Connection refused" because the database service isn't properly configured in Render.

## 🎯 Solution: Create Database Service

### Step 1: Create PostgreSQL Database in Render

1. **Go to Render Dashboard**
   - Visit https://dashboard.render.com
   - Click "New +" button
   - Select "PostgreSQL"

2. **Configure Database Settings**
   ```
   Name: wnba_database
   Database: wnba_stat_spot
   User: wnba_user
   Region: Same as your web service (recommended)
   PostgreSQL Version: 15 (or latest)
   Plan: Free (for development) or Starter (for production)
   ```

3. **Important: Use Exact Names**
   - Database service name MUST be `wnba_database` (matches render.yaml)
   - Database name MUST be `wnba_stat_spot`
   - User MUST be `wnba_user`

### Step 2: Verify Connection in render.yaml

Your `render.yaml` is already correctly configured:
```yaml
databases:
  - name: wnba_database          # ✅ Matches service name
    databaseName: wnba_stat_spot # ✅ Matches database name
    user: wnba_user              # ✅ Matches user name

envVars:
  - key: DB_HOST
    fromDatabase:
      name: wnba_database        # ✅ References correct service
      property: host
  # ... other DB variables
```

### Step 3: Redeploy Your Application

After creating the database:
1. Go to your web service in Render
2. Click "Manual Deploy" → "Deploy latest commit"
3. Wait for deployment to complete

### Step 4: Verify Connection

Once deployed, check the logs:
```bash
# Look for these success messages:
✅ Database connection established
✅ Queue tables verified
🚀 Starting queue worker with optimized settings...
```

## 🔍 Troubleshooting

### If Database Service Already Exists

1. **Check Service Name**
   - Go to your database service in Render
   - Verify the name is exactly `wnba_database`
   - If different, either rename it or update render.yaml

2. **Check Database Details**
   - Database name should be `wnba_stat_spot`
   - User should be `wnba_user`
   - If different, update render.yaml to match

3. **Check Environment Variables**
   - Go to your web service → Environment tab
   - Verify these are populated:
     - `DB_HOST` (should be external hostname)
     - `DB_PORT` (should be 5432)
     - `DB_DATABASE` (should be wnba_stat_spot)
     - `DB_USERNAME` (should be wnba_user)
     - `DB_PASSWORD` (should be auto-generated)

### If Environment Variables Are Empty

This means the database service isn't linked properly:
1. Check that database service name matches exactly
2. Redeploy the web service
3. Wait for Render to populate the variables automatically

### Manual Environment Variable Setup (Last Resort)

If automatic linking doesn't work:
1. Go to your database service in Render
2. Copy the connection details
3. Manually add them to your web service environment:
   ```
   DB_CONNECTION=pgsql
   DB_HOST=<your-db-host>
   DB_PORT=5432
   DB_DATABASE=wnba_stat_spot
   DB_USERNAME=wnba_user
   DB_PASSWORD=<your-db-password>
   ```

## 🎉 Success Indicators

After proper setup, you should see:
- ✅ No more "Connection refused" errors
- ✅ Queue worker stays running
- ✅ Database migrations complete successfully
- ✅ Application loads without database errors

## 💡 Pro Tips

1. **Free Tier Limitations**
   - Render free PostgreSQL has connection limits
   - Consider upgrading to Starter plan for production

2. **Database Persistence**
   - Free tier databases may be deleted after 90 days of inactivity
   - Starter plan databases are persistent

3. **Backup Strategy**
   - Render provides automatic backups on paid plans
   - Consider setting up regular data exports for free tier

## 🆘 Still Having Issues?

Run these diagnostic commands in your deployed container:
```bash
# Check database configuration
php artisan db:fix-config --verbose

# Check queue health
php artisan queue:health-check --verbose

# Monitor queue worker logs
tail -f /tmp/laravel-queue.log
``` 
