# Imagen base de PHP con soporte para Laravel
FROM php:8.2-fpm

# Actualizar e instalar dependencias necesarias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    chromium \
    chromium-driver

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www

# Limpiar el directorio de trabajo y clonar el repositorio
RUN rm -rf /var/www/* && git clone https://github.com/yordiortiz09/PruebasAPI ./

# Instalar dependencias del proyecto
RUN composer install --no-interaction --prefer-dist

# Limpieza y optimización de Laravel
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan view:clear

# Establecer el entorno de pruebas
ENV APP_ENV=testing
ENV COMPOSER_ALLOW_SUPERUSER=1

# Ejecutar migraciones antes de las pruebas
RUN php artisan migrate --force

# Comando por defecto para ejecutar pruebas
CMD ["composer", "run", "test-all"]
