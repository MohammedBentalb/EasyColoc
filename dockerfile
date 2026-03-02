FROM dunglas/frankenphp:1.4-php8.4

RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    libzip-dev \
    libpng-dev \
    libicu-dev \
    libpq-dev \
    git \
    && rm -rf /var/lib/apt/lists/*

RUN install-php-extensions \
    gd \
    intl \
    zip \
    opcache \
    pdo_pgsql \
    pgsql \
    pcntl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Set Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
EXPOSE 443

# Start FrankenPHP
CMD ["frankenphp", "php-server", "-r", "public/"]