FROM php:8.2-fpm

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip netcat-openbsd

# Installation des extensions PHP
RUN docker-php-ext-install pdo pdo_pgsql zip

# Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . .

# Copier le script d’entrée
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Point d’entrée du conteneur
ENTRYPOINT ["/entrypoint.sh"]
