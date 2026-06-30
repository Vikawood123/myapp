FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# СОЗДАНИЕ БАЗЫ ДАННЫХ И МИГРАЦИИ
RUN mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chmod -R 777 /var/www/html/database \
    && php artisan migrate --force --no-interaction \
    && php artisan db:seed --force --no-interaction || true

ENV PORT=8000

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
