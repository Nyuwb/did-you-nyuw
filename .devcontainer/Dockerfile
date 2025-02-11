ARG ALPINE_VERSION
ARG PHP_VERSION

########################
# Base PHP container
########################
FROM php:${PHP_VERSION}-alpine${ALPINE_VERSION} AS base-php

# Defining app path
WORKDIR /app

# Package installation
RUN apk update && \
    apk add --no-cache \
        bash \
        curl-dev \
        icu-dev \
        libzip-dev \
        linux-headers \
        zip \
        zlib-dev \
        unzip

# PHP extensions
RUN docker-php-ext-install -j$(nproc) \
        bcmath \
        curl \
        intl \
        zip

########################
# Development container
########################
FROM base-php AS dev-php

ARG XDEBUG_VERSION

RUN apk add --no-cache \
        build-base \
        ca-certificates \
        git \
        ${PHPIZE_DEPS}

# Xdebug installation
RUN pecl install xdebug-${XDEBUG_VERSION} && \
    docker-php-ext-enable xdebug

# Configuring PHP and his modules
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
    printf "\n[xdebug]\nxdebug.start_with_request=trigger" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
