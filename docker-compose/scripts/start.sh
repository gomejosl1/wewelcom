#!/bin/bash

# Crear directorio para scripts
mkdir -p docker-compose/scripts

# Asegurar que el directorio storage tenga los permisos correctos
chmod -R 777 storage bootstrap/cache

# Iniciar los contenedores Docker
docker-compose up -d

# Instalar dependencias de Composer
docker-compose exec app composer install

# Generar clave de aplicación
docker-compose exec app php artisan key:generate

# Ejecutar migraciones y seeders
docker-compose exec app php artisan migrate --seed

# Generar documentación con Scribe
docker-compose exec app php artisan scribe:generate

echo "La API de Restaurantes está disponible en http://localhost:8000"
echo "La documentación de la API está disponible en http://localhost:8000/docs"
