FROM mcr.microsoft.com/devcontainers/php:8.2

RUN docker-php-ext-install mysqli

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        gnupg2 \
        curl \
        tar \
        unzip \
        zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /usr/src/php/ext/imagick; \
    curl -fsSL https://github.com/Imagick/imagick/archive/refs/tags/3.7.0.tar.gz | tar xvz -C "/usr/src/php/ext/imagick" --strip 1; \
    docker-php-ext-install imagick;

RUN a2enmod rewrite
RUN a2enmod headers
RUN a2enmod status
RUN a2enmod php

COPY src/status.conf      /etc/apache2/mods-available
COPY src/99-local.ini     /etc/php/8.2/apache2/conf.d
COPY src/000-default.conf /etc/apache2/sites-available
