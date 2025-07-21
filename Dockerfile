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
echo "APP_NAME=\"Laravel\"" > .env\n\
echo "APP_ENV=\"local\"" >> .env\n\
echo "APP_KEY=\"base64:Q4ofZuWPkwzp1dLYUXZyaDcwWLcSEl5HYJNtsLdViCU=\"" >> .env\n\
echo "APP_DEBUG=\"true\"" >> .env\n\
echo "APP_URL=\"https://wewelcom-production.up.railway.app/\"" >> .env\n\
echo "LOG_CHANNEL=\"single\"" >> .env\n\
echo "LOG_DEPRECATIONS_CHANNEL=\"null\"" >> .env\n\
echo "LOG_LEVEL=\"debug\"" >> .env\n\
echo "DB_CONNECTION=\"mysql\"" >> .env\n\
echo "DB_HOST=\"mysql.railway.internal\"" >> .env\n\
echo "DB_PORT=\"3306\"" >> .env\n\
echo "DB_DATABASE=\"railway\"" >> .env\n\
echo "DB_USERNAME=\"root\"" >> .env\n\
echo "DB_PASSWORD=\"mRPFItrbSmEtbdDFPAAAnQMvPmlRTVVf\"" >> .env\n\
echo "BROADCAST_DRIVER=\"log\"" >> .env\n\
echo "CACHE_DRIVER=\"file\"" >> .env\n\
echo "FILESYSTEM_DISK=\"local\"" >> .env\n\
echo "QUEUE_CONNECTION=\"sync\"" >> .env\n\
echo "SESSION_DRIVER=\"file\"" >> .env\n\
echo "SESSION_LIFETIME=\"120\"" >> .env\n\
php artisan migrate --force\n\
php artisan serve --host=0.0.0.0 --port=8000\n\
' > /var/www/start.sh && chmod +x /var/www/start.sh

EXPOSE 8000

CMD ["/var/www/start.sh"]
