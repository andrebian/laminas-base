FROM php:8.2.4-fpm

# Update and install dependencies
RUN apt-get update && apt-get install -y \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    wget \
    git \
    unzip \
    php*-mysql \
    php*-xdebug \
    libxml2-dev \
&& rm -rf /var/lib/apt/lists/*

# Install PHP Exensions
RUN docker-php-ext-install soap \
    && docker-php-ext-install intl \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar arquivo de configuração
COPY php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www
