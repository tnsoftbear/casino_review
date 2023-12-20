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

RUN mkdir -p ${COMPOSER_HOME} && \
    apt-get update && \
    apt-get install --no-install-recommends -y \
        locales \
        vim \
        git \
        curl \
        zip \
        unzip \
        # for gd
        zlib1g-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        # for mbstring
        libonig-dev && \
        # Setup locales
        locale-gen en_US.UTF-8 && \
        localedef -f UTF-8 -i en_US en_US.UTF-8 && \
        # Configure PHP extensions
        docker-php-ext-configure gd --with-freetype --with-jpeg && \
        # Install PHP extensions
        docker-php-ext-install -j$(nproc) \
            gd \
            mbstring

# ------------ development --------------

FROM base AS dev

COPY ./infra/docker/phpfpm/php.dev.ini /usr/local/etc/php/php.ini

# ------------ development-xdebug --------------

FROM dev AS dev-xdebug

RUN <<EOF
  pecl install xdebug
  docker-php-ext-enable xdebug
EOF

COPY ./infra/docker/phpfpm/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# ------------ deploy --------------

FROM base AS deploy

COPY ./infra/docker/phpfpm/php.deploy.ini /usr/local/etc/php/php.ini

COPY ./workspace /workspace

RUN <<EOF
  composer install -q -n --no-ansi --no-dev --no-scripts --no-progress --prefer-dist
  chmod -R 777 storage bootstrap/cache
  php artisan optimize:clear
  php artisan optimize
  apt-get clean
  rm -rf /var/lib/apt/lists/*
EOF

RUN chown -R www-data:www-data /workspace ${COMPOSER_HOME}

USER www-data
