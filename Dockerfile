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
RUN echo '#!/bin/bash' > /var/www/start.sh && \
    echo '' >> /var/www/start.sh && \
    echo '# Generar archivo .env con variables de entorno' >> /var/www/start.sh && \
    echo 'cat > .env << EOL' >> /var/www/start.sh && \
    echo 'APP_NAME=Laravel' >> /var/www/start.sh && \
    echo 'APP_ENV=production' >> /var/www/start.sh && \
    echo 'APP_KEY=base64:Q4ofZuWPkwzp1dLYUXZyaDcwWLcSEl5HYJNtsLdViCU=' >> /var/www/start.sh && \
    echo 'APP_DEBUG=false' >> /var/www/start.sh && \
    echo 'APP_URL=https://wewelcom-production.up.railway.app/' >> /var/www/start.sh && \
    echo 'LOG_CHANNEL=stack' >> /var/www/start.sh && \
    echo 'LOG_DEPRECATIONS_CHANNEL=null' >> /var/www/start.sh && \
    echo 'LOG_LEVEL=debug' >> /var/www/start.sh && \
    echo 'DB_CONNECTION=mysql' >> /var/www/start.sh && \
    echo 'DB_HOST=mysql.railway.internal' >> /var/www/start.sh && \
    echo 'DB_PORT=3306' >> /var/www/start.sh && \
    echo 'DB_DATABASE=railway' >> /var/www/start.sh && \
    echo 'DB_USERNAME=root' >> /var/www/start.sh && \
    echo 'DB_PASSWORD=mRPFItrbSmEtbdDFPAAAnQMvPmlRTVVf' >> /var/www/start.sh && \
    echo 'BROADCAST_DRIVER=log' >> /var/www/start.sh && \
    echo 'CACHE_DRIVER=file' >> /var/www/start.sh && \
    echo 'FILESYSTEM_DISK=local' >> /var/www/start.sh && \
    echo 'QUEUE_CONNECTION=sync' >> /var/www/start.sh && \
    echo 'SESSION_DRIVER=file' >> /var/www/start.sh && \
    echo 'SESSION_LIFETIME=120' >> /var/www/start.sh && \
    echo 'EOL' >> /var/www/start.sh && \
    echo '' >> /var/www/start.sh && \
    echo '# Limpiar caché de configuración' >> /var/www/start.sh && \
    echo 'php artisan config:clear' >> /var/www/start.sh && \
    echo 'php artisan cache:clear' >> /var/www/start.sh && \
    echo '' >> /var/www/start.sh && \
    echo '# Publicar assets estáticos y regenerar documentación' >> /var/www/start.sh && \
    echo 'php artisan vendor:publish --tag=scribe-assets --force' >> /var/www/start.sh && \
    echo 'php artisan scribe:generate' >> /var/www/start.sh && \
    echo 'php artisan storage:link' >> /var/www/start.sh && \
    echo '' >> /var/www/start.sh && \
    echo '# Optimizar la aplicación' >> /var/www/start.sh && \
    echo 'php artisan optimize' >> /var/www/start.sh && \
    echo '' >> /var/www/start.sh && \
    echo '# Ejecutar migraciones y seeders' >> /var/www/start.sh && \
    echo 'php artisan migrate --force' >> /var/www/start.sh && \
    echo 'php artisan db:seed --force' >> /var/www/start.sh && \
    echo '' >> /var/www/start.sh && \
    echo '# Iniciar el servidor' >> /var/www/start.sh && \
    echo 'exec php artisan serve --host=0.0.0.0 --port=8000' >> /var/www/start.sh && \
    chmod +x /var/www/start.sh

EXPOSE 8000

CMD ["/var/www/start.sh"]
