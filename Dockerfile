FROM php:8.5-cli AS base

RUN apt-get update && \
    apt-get install -y unzip libzip-dev libpng-dev libonig-dev libxml2-dev default-mysql-client && \
    docker-php-ext-install pdo_mysql mysqli && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

FROM base AS dependencies
WORKDIR /deps

COPY composer.json ./
RUN composer install --no-dev --optimize-autoloader

FROM oven/bun:alpine AS builder
WORKDIR /build

COPY package.json bun.lock ./
RUN bun ci

COPY resources ./resources
COPY vite.config.ts ./vite.config.ts
RUN bun run build

FROM base AS runner
WORKDIR /app

COPY --from=dependencies /deps/vendor ./vendor
COPY --from=builder /build/public/build ./public/build
COPY app ./app
COPY public ./public
COPY resources/views ./resources/views
COPY src ./src

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
