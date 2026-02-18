FROM php:7.4-fpm-alpine

RUN apk update && \
    apk upgrade && \
    apk create --no-cache \
            postgresql-dev \
            git \
            unzip \
            zlib-dev \
            libxml2-dev \
            libzip-dev \
            libxslt-dev \
            freetype-dev \
            libjpeg-turbo-dev \
            libpng-dev \
            musl-dev && \
    docker-php-ext-install pdo_pgsql

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    sync && \
    install-php-extensions gd \
      yaml \
      imagick \
      zip \
      intl \
      mysqli \
      pdo_mysql \
      sysvsem \
      mongodb \
      @composer-2

RUN mkdir -p /var/log/php-app/wd.local && \
    chown -R www-data /var/log/php-app/ && \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    echo "error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_USER_DEPRECATED" >> "$PHP_INI_DIR/php.ini" && \
    echo "memory_limit = 256M" > /usr/local/etc/php/conf.d/memory_limit.ini

WORKDIR /var/www/iactions-library