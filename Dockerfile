FROM php:8.2-cli

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files first (for cache)
COPY composer.json composer.lock ./

RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --optimize-autoloader --prefer-dist

# Then copy rest of app
COPY . .

CMD php artisan migrate --force && php -S 0.0.0.0:${PORT} -t public