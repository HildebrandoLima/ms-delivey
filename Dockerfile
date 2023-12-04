FROM php:8.1-fpm

ARG user=hill

RUN apt-get update && apt-get install -y \
    git \
    curl \
    ftp \
    imagick \
    json \
    mysqli \
    mysqlnd \
    openssl \
    PDO \
    pdo_mysql \
    pdo_sqlite \
    redis \
    session \
    sqlite3 \
    xml \
    zip \
    zlib

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u 1000 -d /home/$user $user

RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN  usermod -aG root $user

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

WORKDIR /var/www

RUN chmod -R 777 /var/www

COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

USER root
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache
USER $user
