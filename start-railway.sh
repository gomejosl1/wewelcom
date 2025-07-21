#!/bin/bash

# Establecer permisos de almacenamiento
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Instalar dependencias
composer install --no-interaction --prefer-dist --optimize-autoloader

# Generar clave de la aplicación si no existe
php artisan key:generate --force

# Ejecutar migraciones y seeders
php artisan migrate --force
php artisan db:seed --force

# Generar documentación con Scribe
php artisan scribe:generate

# Iniciar el servidor
php artisan serve --host=0.0.0.0 --port=$PORT
