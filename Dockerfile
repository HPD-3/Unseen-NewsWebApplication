FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader

FROM php:8.2-cli
WORKDIR /app

# Required PHP extensions for Laravel + MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copy application and Composer dependencies
COPY . /app
COPY --from=vendor /app/vendor /app/vendor

# Railway injects PORT at runtime; default to 8080 for local Docker runs
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t public"]
