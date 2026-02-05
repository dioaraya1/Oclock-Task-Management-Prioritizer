# backend/Dockerfile
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev \
    zip unzip curl libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring gd zip

# Enable Apache mods
RUN a2enmod rewrite headers

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy PHP application
WORKDIR /var/www/html
COPY . .

# Install PHP dependencies (jika ada)
# COPY composer.json composer.lock ./
# RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Create .env file from template
RUN cp .env.example .env

EXPOSE 80
CMD ["apache2-foreground"]