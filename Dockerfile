FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

RUN mkdir -p /var/www/html/database
RUN touch /var/www/html/database/database.sqlite
RUN chmod -R 777 /var/www/html/database

EXPOSE 9000
CMD ["php-fpm"]
