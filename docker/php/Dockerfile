ARG PHP_VERSION

FROM php:${PHP_VERSION} AS builder

RUN apk update && apk add --no-cache \
    git \
    unzip \
    curl \
    libzip-dev \
    icu-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    autoconf \
    g++ \
    gcc \
    make \
    libc-dev \
    pkgconf \
    re2c \
    libwebp-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        opcache \
        bcmath \
        zip \
        intl \
        pcntl \
        gd

RUN pecl install redis \
    && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

FROM php:${PHP_VERSION} AS php

COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/
COPY --from=builder /usr/local/bin/composer /usr/local/bin/composer

RUN apk update && apk add --no-cache \
    git \
    curl \
    libzip \
    icu-libs \
    libpng \
    libjpeg-turbo \
    freetype \
    libwebp

RUN addgroup -g 1000 appuser \
    && adduser -D -u 1000 -G appuser appuser

WORKDIR /var/www
USER appuser
