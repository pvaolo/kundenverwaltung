# syntax=docker/dockerfile:1

FROM composer:lts as deps

WORKDIR /app

COPY . .

RUN --mount=type=cache,target=/tmp/cache \
    composer install --no-dev --no-interaction

FROM php:8.2-apache as final

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=deps /app /var/www/html

USER www-data
