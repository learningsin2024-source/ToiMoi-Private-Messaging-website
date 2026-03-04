FROM php:8.2-cli

# Install mysqli, zip extensions and git
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install mysqli zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project files first
COPY project/ /app/

# Copy composer files
COPY composer.json composer.lock /app/

# Install PHP dependencies inside /app
RUN composer install --no-dev --optimize-autoloader

EXPOSE ${PORT:-80}

CMD php -S 0.0.0.0:${PORT:-80} -t /app