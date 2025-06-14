# Utiliser l'image PHP 8.2 avec Apache intégré
FROM php:8.2-apache

# Installer les dépendances système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring zip exif pcntl gd \
    && a2enmod rewrite

# Installer Composer globalement
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application dans le conteneur
COPY . .

# Donner les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache \
    && chmod 777 /var/www/html/database/database.sqlite

# Installer les dépendances PHP via Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Exposer le port 80 d'Apache
EXPOSE 80

# Lancer Apache en mode foreground (obligatoire dans Docker)
CMD ["apache2-foreground"]
