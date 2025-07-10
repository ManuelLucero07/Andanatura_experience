FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update && \
    apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    nodejs npm && \
    docker-php-ext-install pdo pdo_mysql zip

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar archivos del proyecto
COPY . /var/www/html/

# Cambiar el DocumentRoot a /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Set working dir
WORKDIR /var/www/html

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Instalar dependencias PHP
RUN composer install

# Instalar dependencias Node + Gulp
RUN npm install && npm run build || true

EXPOSE 80
