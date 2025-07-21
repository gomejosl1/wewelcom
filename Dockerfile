FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Crear un script para generar el .env y arrancar la aplicación
RUN echo '#!/bin/bash\n\
# Generar archivo .env con variables de entorno\n\
cat > .env << EOL\n\
APP_NAME=Laravel\n\
APP_ENV=production\n\
APP_KEY=base64:Q4ofZuWPkwzp1dLYUXZyaDcwWLcSEl5HYJNtsLdViCU=\n\
APP_DEBUG=false\n\
APP_URL=https://wewelcom-production.up.railway.app/\n\
LOG_CHANNEL=stack\n\
LOG_DEPRECATIONS_CHANNEL=null\n\
LOG_LEVEL=debug\n\
DB_CONNECTION=mysql\n\
DB_HOST=mysql.railway.internal\n\
DB_PORT=3306\n\
DB_DATABASE=railway\n\
DB_USERNAME=root\n\
DB_PASSWORD=mRPFItrbSmEtbdDFPAAAnQMvPmlRTVVf\n\
BROADCAST_DRIVER=log\n\
CACHE_DRIVER=file\n\
FILESYSTEM_DISK=local\n\
QUEUE_CONNECTION=sync\n\
SESSION_DRIVER=file\n\
SESSION_LIFETIME=120\n\
EOL\n\
\n\
# Limpiar caché de configuración\n\
php artisan config:clear\n\
php artisan cache:clear\n\
\n\
# Publicar assets estáticos\n\
php artisan vendor:publish --tag=scribe-assets --force\n\
php artisan storage:link\n\
\n\
# Optimizar la aplicación\n\
php artisan optimize\n\
\n\
# Ejecutar migraciones\n\
php artisan migrate --force\n\
\n\
# Iniciar el servidor\n\
exec php artisan serve --host=0.0.0.0 --port=8000\n\
' > /var/www/start.sh && chmod +x /var/www/start.sh

EXPOSE 8000

CMD ["/var/www/start.sh"]
