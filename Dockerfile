FROM php:8.3-apache

# Extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    unzip \
    git \
    curl \
    msmtp \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    intl \
    zip \
    opcache \
    mbstring


# Activation d'Apache modules
RUN a2enmod rewrite

# Installation de Xdebug
RUN pecl install xdebug \
&& docker-php-ext-enable xdebug

# Copie de la config locale de xdebug.ini dans la config de xdebug sur le serveur créé dans le conteneur
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Code source
COPY src/ /var/www/html/

WORKDIR /var/www/html

EXPOSE 80
