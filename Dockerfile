FROM php:8.2-cli

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD php artisan migrate --force && php -S 0.0.0.0:${PORT} -t public