FROM php:8.2-fpm

# Instalar dependências
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip curl git \
    libpng-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl mysqli

# Instalar composer (última versão)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html