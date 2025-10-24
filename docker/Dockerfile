FROM php:8.2-apache

# Installation des extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql zip

# Activation du module Apache rewrite
RUN a2enmod rewrite

# Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# DocumentRoot reste à la racine du projet (comme Hostinger)
# Permettre .htaccess (AllowOverride All)
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html