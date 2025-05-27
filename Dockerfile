# Multi-stage build for production deployment
FROM node:20-alpine AS frontend-builder

# Build frontend
WORKDIR /app/frontend
COPY resources/js/package*.json ./
RUN npm ci
COPY resources/js/ ./
RUN npm run build

# PHP/Laravel backend with Node.js for SvelteKit
FROM node:20-alpine AS backend

# Install PHP and system dependencies
RUN apk add --no-cache \
    php82 \
    php82-fpm \
    php82-pdo \
    php82-pdo_pgsql \
    php82-mbstring \
    php82-exif \
    php82-pcntl \
    php82-bcmath \
    php82-gd \
    php82-session \
    php82-tokenizer \
    php82-xml \
    php82-ctype \
    php82-json \
    php82-fileinfo \
    php82-openssl \
    php82-zip \
    php82-curl \
    php82-dom \
    php82-xmlreader \
    php82-xmlwriter \
    php82-simplexml \
    php82-phar \
    php82-iconv \
    php82-intl \
    php82-posix \
    git \
    curl \
    zip \
    unzip \
    postgresql-dev \
    nginx \
    supervisor \
    oniguruma-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev

# Create symlinks for PHP and set up PHP configuration
RUN ln -sf /usr/bin/php82 /usr/bin/php \
    && ln -sf /usr/sbin/php-fpm82 /usr/sbin/php-fpm

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application code first (needed for artisan)
COPY . .

# Create Laravel directories if they don't exist
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views \
    && mkdir -p bootstrap/cache

# Set PHP memory limit for Composer
ENV COMPOSER_MEMORY_LIMIT=-1

# Install PHP dependencies (skip scripts to avoid artisan issues)
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Run Laravel post-install scripts now that everything is in place
RUN php artisan package:discover --ansi || true

# Copy built frontend assets (SvelteKit Node.js build)
COPY --from=frontend-builder /app/frontend/build ./frontend-build
COPY --from=frontend-builder /app/frontend/package*.json ./frontend-build/

# Install frontend production dependencies
WORKDIR /var/www/html/frontend-build
RUN npm ci --only=production

# Back to main directory
WORKDIR /var/www/html

# Set permissions (use nginx user which already exists)
RUN chown -R nginx:nginx /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy and set up startup script
COPY docker/startup.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh \
    && ls -la /usr/local/bin/start.sh

EXPOSE 80

# Use exec form to avoid shell interpretation issues
CMD ["/usr/local/bin/start.sh"]
