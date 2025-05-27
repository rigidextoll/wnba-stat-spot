# Render Database Connection Troubleshooting

## Current Issue: Connection to 127.0.0.1:5432 Failed

Your application is trying to connect to `127.0.0.1:5432` (localhost) instead of your actual Render database. This indicates that the database environment variables are not being properly set.

## Diagnosis Steps

### 1. Check Database Service Status
In your Render dashboard:
1. Go to your database service (`wnba_stat_spot`)
2. Verify it's running and healthy
3. Note the connection details

### 2. Verify Database Service Name
Your `render.yaml` references a database named `wnba_stat_spot`. Ensure:
- Your database service is actually named `wnba_stat_spot` (exactly)
- The database is in the same Render account/team
- The database is in a compatible region

### 3. Check Environment Variable Auto-Population
Render should automatically populate these variables:
- `DB_HOST` - Database hostname
- `DB_PORT` - Database port (usually 5432)
- `DB_DATABASE` - Database name
- `DB_USERNAME` - Database username  
- `DB_PASSWORD` - Database password

## Solutions

### Solution 1: Manual Environment Variable Configuration

If auto-population isn't working, manually set these in your Render web service:

1. Go to your web service settings
2. Add these environment variables:

```
DB_CONNECTION=pgsql
DB_HOST=dpg-d0r0621r0fns73fqmu70-a.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=wnba_stat_spot
DB_USERNAME=wnba_user
DB_PASSWORD=[your-database-password]
```

**Note**: Replace the values with your actual database connection details from the database service page.

### Solution 2: Fix render.yaml Auto-Population

1. Verify your database service name exactly matches what's in `render.yaml`
2. Ensure the database service exists and is running
3. Try redeploying your web service

### Solution 3: Debug Current Environment

Run this command in your Render web service shell:
```bash
php artisan debug:environment
```

This will show you:
- What environment variables are actually set
- What Laravel is using for database configuration
- Connection test results

## Common Issues

### Issue 1: Database Service Name Mismatch
- **Problem**: Database service named differently than in `render.yaml`
- **Solution**: Either rename the database service or update `render.yaml`

### Issue 2: Database Not Ready
- **Problem**: Database service is still starting up
- **Solution**: Wait for database to be fully ready, then redeploy web service

### Issue 3: Region Mismatch
- **Problem**: Database and web service in different regions
- **Solution**: Ensure both services are in the same region

### Issue 4: Permission Issues
- **Problem**: Web service doesn't have access to database
- **Solution**: Ensure both services are in the same Render account/team

## Verification Steps

After implementing a solution:

1. **Check Environment Variables**:
   ```bash
   php artisan debug:environment
   ```

2. **Test Database Connection**:
   ```bash
   php artisan migrate:status
   ```

3. **Check Queue Tables**:
   ```bash
   php artisan queue:health-check --detailed
   ```

4. **Test API Endpoints**:
   ```bash
   curl https://your-app.onrender.com/api/status
   ```

## Expected Results

When working correctly, you should see:
- `DB_HOST` set to your Render database hostname (not 127.0.0.1)
- Successful database connection
- Queue tables created (`jobs`, `failed_jobs`, `job_batches`)
- API endpoints returning data instead of 503 errors

## Getting Help

If issues persist:
1. Check Render dashboard for any service errors
2. Review deployment logs for database connection attempts
3. Verify database service is accessible from web service
4. Contact Render support if auto-population continues to fail

## Current Database Details

Based on previous messages, your database details should be:
- **Hostname**: `dpg-d0r0621r0fns73fqmu70-a.oregon-postgres.render.com`
- **Port**: `5432`
- **Database**: `wnba_stat_spot`
- **Username**: `wnba_user`

Make sure these match what's configured in your Render services. 
