FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

COPY . .
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

FROM node:20-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
COPY --from=vendor /app/vendor ./vendor

RUN npm run build

FROM php:8.3-cli-bookworm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

RUN chmod +x /var/www/html/scripts/*.sh

EXPOSE 8000

CMD ["/var/www/html/scripts/docker-start.sh"]
