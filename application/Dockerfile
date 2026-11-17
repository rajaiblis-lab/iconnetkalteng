# syntax=docker/dockerfile:1

# --- Stage 1: Base PHP image with required extensions ---
FROM php:8.2-apache AS base

# Install system dependencies and PHP extensions
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        zip \
        unzip \
        git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set recommended PHP.ini settings
COPY --link php.ini /usr/local/etc/php/

# --- Stage 2: Copy application code ---
FROM base AS app

# Create a non-root user and group
RUN addgroup --system appgroup && adduser --system --ingroup appgroup appuser

# Set working directory
WORKDIR /var/www/html

# Copy application code (excluding .git, .env, etc. via .dockerignore)
COPY --link . /var/www/html/

# Set permissions for Apache and appuser
RUN chown -R www-data:appgroup /var/www/html \
    && chmod -R 755 /var/www/html

# Switch to non-root user
USER appuser

# Expose HTTP port
EXPOSE 80

# Set entrypoint to Apache in foreground
CMD ["apache2-foreground"]

# --- Notes ---
# - Ensure you have a php.ini file in the build context (./application/php.ini) for custom PHP settings.
# - Use a .dockerignore file to exclude .git, .env, lock files, and IDE configs from the build context.
# - Pass secrets and environment variables at runtime, not in the image.