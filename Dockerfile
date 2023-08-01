FROM php:7.4-apache

LABEL maintainer="getlaminas.org" \
    org.label-schema.docker.dockerfile="/Dockerfile" \
    org.label-schema.name="Laminas MVC Skeleton" \
    org.label-schema.url="https://docs.getlaminas.org/mvc/" \
    org.label-schema.vcs-url="https://github.com/laminas/laminas-mvc-skeleton"

## Update package information
RUN apt-get update

## Configure Apache
RUN a2enmod rewrite \
    && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
    && mv /var/www/html /var/www/public

## Install Composer
RUN curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

###
## PHP Extensisons
###

# Install xdebug
RUN pecl install xdebug-2.9.2 \
    && docker-php-ext-enable xdebug \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.profiler_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler=\"dbgp\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.profiler_output_dir=/tmp/snapshots" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_log=/var/www/html/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.max_nesting_level=250" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.profiler_enable_trigger=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apt-get update && apt-get install -y \
    libssl-dev \
    libcurl4-openssl-dev \
    libicu-dev \
    libzip-dev \
    pkg-config \
    wget \
    git \
    unzip \
    php*-mysql \
    php*-xdebug \
    libxml2-dev \
    zlib1g-dev \
    libpng-dev \
    libgmp-dev \
&& rm -rf /var/lib/apt/lists/*
###
## Optional PHP extensions 
###

RUN docker-php-ext-configure intl \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql  \
    && docker-php-ext-install intl  \
    && docker-php-ext-install soap  \
    && docker-php-ext-install zip \
    && docker-php-ext-install gd \
    && docker-php-ext-install gmp

## mbstring for i18n string support
# RUN docker-php-ext-install mbstring

###
## Some laminas/laminas-db supported PDO extensions
###

## MySQL PDO support
# RUN docker-php-ext-install pdo_mysql

## PostgreSQL PDO support
# RUN apt-get install --yes libpq-dev \
#     && docker-php-ext-install pdo_pgsql

###
## laminas/laminas-cache supported extensions
###

## APCU
# RUN pecl install apcu \
#     && docker-php-ext-enable apcu

## Memcached
# RUN apt-get install --yes libmemcached-dev \
#     && pecl install memcached \
#     && docker-php-ext-enable memcached

## MongoDB
# RUN pecl install mongodb \
#     && docker-php-ext-enable mongodb

## Redis support.  igbinary and libzstd-dev are only needed based on 
## redis pecl options
# RUN pecl install igbinary \
#     && docker-php-ext-enable igbinary \
#     && apt-get install --yes libzstd-dev \
#     && pecl install redis \
#     && docker-php-ext-enable redis


WORKDIR /var/www
