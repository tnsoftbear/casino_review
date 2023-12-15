FROM php:8.3-fpm-bullseye AS base

WORKDIR /workspace

ENV TZ=UTC \
  # locale
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get install --no-install-recommends -y \
        locales \
        vim \
        lsof \
        # for gd
        zlib1g-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        # for mbstring
        libonig-dev && \
        # Setup locales
        # sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
        # dpkg-reconfigure --frontend=noninteractive locales && \
        # update-locale LANG=en_US.UTF-8 && \
        locale-gen en_US.UTF-8 && \
        localedef -f UTF-8 -i en_US en_US.UTF-8 && \
        # Configure PHP extensions
        docker-php-ext-configure gd --with-freetype --with-jpeg && \
        # Install PHP extensions
        docker-php-ext-install -j$(nproc) \
            gd \
            mbstring

FROM base AS development

#COPY ./php-fpm.d/* /usr/local/etc/php-fpm.d/

#COPY ./conf.d/* /usr/local/etc/php/conf.d/
COPY ./php.development.ini /usr/local/etc/php/php.ini

FROM development AS development-xdebug

RUN <<EOF
  pecl install xdebug
  docker-php-ext-enable xdebug
EOF

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini