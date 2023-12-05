FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    git \
    curl \
    nano \
    libicu-dev \
    libssl-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    locales \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    nginx \
    supervisor \
    gnupg2 \
    unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install yarn, node and PHP extensions
RUN \
    docker-php-ext-install pdo_mysql mbstring zip exif pcntl soap bcmath gd && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd && \
    docker-php-ext-enable soap && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/html

# Change current user to www
USER www

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer