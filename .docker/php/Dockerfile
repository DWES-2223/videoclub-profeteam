FROM php:8.1-fpm

#Environment variables to configure php

ENV PHP_POST_MAX_SIZE 10M
ENV PHP_VERSION 8.1

RUN apt-get update

RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer