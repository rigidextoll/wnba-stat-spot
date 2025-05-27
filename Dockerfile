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

# Create symlinks for PHP
RUN ln -sf /usr/bin/php82 /usr/bin/php

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy application code
COPY . .

# Copy built frontend assets (SvelteKit Node.js build)
COPY --from=frontend-builder /app/frontend/build ./frontend-build
COPY --from=frontend-builder /app/frontend/package*.json ./frontend-build/

# Install frontend production dependencies
WORKDIR /var/www/html/frontend-build
RUN npm ci --only=production

# Back to main directory
WORKDIR /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copy nginx configuration
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Copy supervisor configuration
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy startup script
COPY docker/startup.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80

CMD ["/usr/local/bin/start.sh"]
