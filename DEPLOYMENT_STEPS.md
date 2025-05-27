# 🚀 Deploy WNBA Stat Spot to Render

## Step 1: Push to GitHub

1. **Create a new repository on GitHub:**
   - Go to [github.com/new](https://github.com/new)
   - Repository name: `wnba-stat-spot`
   - Make it **Public**
   - Don't initialize with README (we already have files)
   - Click "Create repository"

2. **Add GitHub remote and push:**
   ```bash
   git remote add origin https://github.com/YOUR_USERNAME/wnba-stat-spot.git
   git branch -M main
   git push -u origin main
   ```

## Step 2: Deploy on Render

1. **Go to [render.com](https://render.com) and sign up/login**

2. **Create PostgreSQL Database FIRST:**
   - Click "New +" → "PostgreSQL"
   - **Name:** `wnba-database`
   - **Database Name:** `wnba_stat_spot`
   - **User:** `wnba_user`
   - Click "Create Database"
   - **Wait for database to be fully ready before proceeding**

3. **Create a new Web Service:**
   - Click "New +" → "Web Service"
   - Connect your GitHub account
   - Select your `wnba-stat-spot` repository
   - Click "Connect"

4. **Configure the service:**
   - **Name:** `wnba-stat-spot`
   - **Runtime:** `Docker`
   - **Region:** `Oregon (US West)` or `Ohio (US East)`
   - **Branch:** `main`
   - **Dockerfile Path:** `./Dockerfile`

5. **Environment Variables (Auto-configured via render.yaml):**
   The `render.yaml` file automatically configures all necessary environment variables including:
   ```
   PORT=80
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=[auto-generated]
   DB_CONNECTION=pgsql
   DB_HOST=[auto-linked from database]
   DB_PORT=[auto-linked from database]
   DB_DATABASE=[auto-linked from database]
   DB_USERNAME=[auto-linked from database]
   DB_PASSWORD=[auto-linked from database]
   ```

6. **Deploy:**
   - Click "Create Web Service"
   - Render will use the `render.yaml` configuration automatically
   - Wait for deployment (5-10 minutes)
   - Your app will be available at: `https://wnba-stat-spot.onrender.com`

## Step 3: Verify Deployment

1. **Check Health Endpoint:**
   - Visit: `https://wnba-stat-spot.onrender.com/health`
   - Should return: `{"status":"ok","timestamp":"...","app":"WNBA Stat Spot","version":"1.0.0"}`

2. **Check Application:**
   - Visit: `https://wnba-stat-spot.onrender.com`
   - Verify the dashboard loads properly

## 🎉 Your app is now live!

### Deployment Improvements:
- ✅ **Fixed port binding issues** - App now properly binds to Render's assigned port
- ✅ **Improved database connection handling** - 60-second timeout with graceful fallback
- ✅ **Better error handling** - Application starts even if some steps fail
- ✅ **Health check endpoint** - Easy deployment verification
- ✅ **Automatic configuration** - render.yaml handles all environment variables

### Free Tier Limits:
- ✅ **750 hours/month** (enough for 24/7)
- ✅ **Free PostgreSQL database**
- ✅ **Custom domain support**
- ✅ **Automatic HTTPS**
- ✅ **Auto-deploy on git push**

### Features Available:
- 🏀 **WNBA Teams & Players Data**
- 📊 **Advanced Analytics Dashboard**
- 🎯 **Prediction Engine**
- 🔍 **Prop Scanner**
- 📈 **Monte Carlo Simulations**
- 🧪 **Historical Testing**
- 📱 **Responsive Design**

### Troubleshooting:

#### Database Connection Issues:
- **Symptom:** "Database not ready, waiting..." loops
- **Solution:** Ensure database is created and running before web service
- **New Fix:** Startup script now has 60-second timeout and continues even if database isn't ready

#### Port Binding Issues:
- **Symptom:** "No open ports detected"
- **Solution:** Added `PORT=80` environment variable and dynamic nginx configuration
- **New Fix:** Nginx configuration is now processed at startup to use correct port

#### Build Issues:
- Check the build logs in Render dashboard
- Ensure all dependencies are properly specified
- The Dockerfile handles both PHP/Laravel backend and Node.js/SvelteKit frontend

#### Application Startup:
The startup script now handles:
- ✅ Dynamic nginx port configuration
- ✅ Database connection with timeout
- ✅ Laravel optimizations with error handling
- ✅ WNBA data import (only if database available)
- ✅ Service startup (nginx, php-fpm, SvelteKit, queue worker)

### Manual Debugging:
If you need to check logs or run commands:
1. Go to Render dashboard
2. Select your service
3. Click "Shell" tab
4. Run diagnostic commands:
   ```bash
   # Check if services are running
   ps aux
   
   # Check nginx configuration
   nginx -t
   
   # Check database connection
   php artisan migrate:status
   
   # Check application health
   curl localhost:80/health
   ```
