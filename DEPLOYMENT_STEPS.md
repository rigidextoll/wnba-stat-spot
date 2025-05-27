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

2. **Create a new Web Service:**
   - Click "New +" → "Web Service"
   - Connect your GitHub account
   - Select your `wnba-stat-spot` repository
   - Click "Connect"

3. **Configure the service:**
   - **Name:** `wnba-stat-spot`
   - **Runtime:** `Docker`
   - **Region:** `Oregon (US West)` or `Ohio (US East)`
   - **Branch:** `main`
   - **Dockerfile Path:** `./Dockerfile`

4. **Add Environment Variables:**
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:GENERATE_THIS_IN_RENDER
   DB_CONNECTION=pgsql
   CACHE_DRIVER=database
   QUEUE_CONNECTION=database
   SESSION_DRIVER=database
   ```

5. **Create PostgreSQL Database:**
   - Click "New +" → "PostgreSQL"
   - **Name:** `wnba-database`
   - **Database Name:** `wnba_stat_spot`
   - **User:** `wnba_user`
   - Click "Create Database"

6. **Connect Database to Web Service:**
   - Go back to your web service
   - In Environment Variables, add:
   ```
   DB_HOST=[Internal Database URL from Render]
   DB_PORT=5432
   DB_DATABASE=wnba_stat_spot
   DB_USERNAME=wnba_user
   DB_PASSWORD=[Database Password from Render]
   ```

7. **Deploy:**
   - Click "Create Web Service"
   - Wait for deployment (5-10 minutes)
   - Your app will be available at: `https://wnba-stat-spot.onrender.com`

## Step 3: Generate APP_KEY

1. **After first deployment, go to your service logs**
2. **Find the shell access or use Render's console**
3. **Run:** `php artisan key:generate --show`
4. **Copy the generated key and update the `APP_KEY` environment variable**

## Step 4: Run Migrations

1. **In Render console or logs, run:**
   ```bash
   php artisan migrate --force
   ```

## Step 5: Import WNBA Data

1. **Run the data import command:**
   ```bash
   php artisan app:import-wnba-data
   ```

## 🎉 Your app is now live!

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
- **Build fails?** Check Dockerfile and dependencies
- **Database connection issues?** Verify environment variables
- **App crashes?** Check logs in Render dashboard
- **Need help?** Check the deployment documentation files 
