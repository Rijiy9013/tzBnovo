FROM phpdockerio/php:8.2-fpm as base

ARG ENV=development

RUN apt-get update \
    && apt-get -y --no-install-recommends --allow-downgrades install \
    supervisor \
    cron \
    mc \
    nano \
    php8.2-redis \
    libkrb5-dev \
    php-pear \
    curl \
    php8.2-pgsql \
    php8.2-memcached \
    php8.2-mcrypt \
    php8.2-mbstring \
    php8.2-imap \
    php8.2-soap \
    git \
    build-essential \
    libtool \
    autoconf \
    automake \
    pkg-config \
    php8.2-zip \
    unzip \
    php8.2-bcmath \
    libssl-dev \
    php8.2-dev \
    php8.2-gd \
    php8.2-curl \
    php8.2-imagick \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN if [ "$ENV" != "production" ] ; then \
        pecl channel-update pecl.php.net; \
        pecl install xdebug; \
    fi
RUN sed -i "$ a umask 0000" /root/.bashrc
RUN sed -i "$ a umask 000" /root/.bashrc

ADD xdebug.ini /etc/php/8.2/fpm/conf.d/99-xdebug.ini

FROM base as scheduler
WORKDIR /data/www/http

FROM base as prod
WORKDIR /data/www/http
