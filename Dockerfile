# Imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update &&     apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    nodejs npm && \
    docker-php-ext-install pdo pdo_mysql zip

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar archivos al directorio de Apache
COPY . /var/www/html/

# Establecer el working directory
WORKDIR /var/www/html/

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Instalar dependencias PHP
RUN composer install

# Instalar dependencias Node.js y compilar assets si usás Gulp
RUN npm install && npm run build || true

# Dar permisos adecuados (opcional)
RUN chown -R www-data:www-data /var/www/html

# Exponer puerto 80
EXPOSE 80