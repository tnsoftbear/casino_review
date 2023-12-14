#FROM bitnami/php-fpm:latest AS php-fpm
FROM php:8.3-fpm-bullseye AS php-fpm

ENV TZ=UTC \
  # locale
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

RUN apt-get update && \
    apt-get install --no-install-recommends -y \
        vim \
        lsof \
        # for gd
        zlib1g-dev \
        libpng-dev \
        libjpeg-dev \
        # for mbstring
        libonig-dev

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install -j$(nproc) \
    gd \
    mbstring

#COPY ./php-fpm.d/* /usr/local/etc/php-fpm.d/

COPY ./conf.d/* /opt/bitnami/php/etc/conf.d/

WORKDIR /workspace