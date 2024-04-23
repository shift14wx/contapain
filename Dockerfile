FROM php:7.4-fpm as base

# Arguments defined in docker-compose.yml
ARG user
ARG uid

RUN rm /var/lib/apt/lists/* -vrf && \
    apt-get clean && apt-get update

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libssl-dev \
    zlib1g-dev \
    libicu-dev \
    g++ \
    make \
    cmake \
    libuv1-dev \
    libgmp-dev \
    uuid-dev \
    libzip-dev \
    libpq-dev

# Clear cache
RUN apt-get autoclean -y && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install zip intl pdo_mysql mbstring exif pcntl bcmath gd && \
    echo extension=bcmath.so > /usr/local/etc/php/conf.d/docker-php-ext-bcmath.ini && \
        pecl install uuid && \
        echo extension=uuid.so > /usr/local/etc/php/conf.d/uuid.ini

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql

# Memcached
RUN apt-get update && apt-get install -y libz-dev libmemcached-dev
RUN pecl install memcached
RUN echo extension=memcached.so >> /usr/local/etc/php/conf.d/memcached.ini

RUN apt-get update && apt-get install -y
RUN docker-php-ext-install opcache && \
    docker-php-ext-enable opcache

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www
#CMD ["composer", "update", "--ignore-platform-reqs"]

FROM base as prod

FROM base as dev
# Install xdebug
RUN pecl install xdebug-3.1.5 \
    && docker-php-ext-enable xdebug
CMD ["php", "artisan", "migrate"]
CMD ["php", "artisan", "db:seed"]
FROM base as test
CMD ["vendor/bin/phpunit"]

USER $user
