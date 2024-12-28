# Utiliser l'image PHP officielle avec FPM
FROM php:8.2-fpm

# Installer les dépendances
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zlib1g-dev

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers de l'application
WORKDIR /var/www
COPY . .

# Installer les dépendances PHP et Node.js
RUN composer install --no-dev --optimize-autoloader
RUN yarn install && yarn run prod

# Donner les permissions correctes
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Exposer plusieurs ports
EXPOSE 9000 5200

# Démarrer PHP-FPM et le websocket
CMD ["php-fpm"]
