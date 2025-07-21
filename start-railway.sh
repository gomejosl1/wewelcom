#!/bin/bash

echo "📌 Configurando Laravel para producción en Railway..."

# Crear .env con valores fijos para asegurar que funcione
cat > .env << EOL
APP_NAME=Laravel
APP_ENV=production
APP_KEY=base64:Q4ofZuWPkwzp1dLYUXZyaDcwWLcSEl5HYJNtsLdViCU=
APP_DEBUG=false
APP_URL=https://wewelcom-production.up.railway.app

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql.railway.internal
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=mRPFItrbSmEtbdDFPAAAnQMvPmlRTVVf

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
EOL

# Asegurarse de que el archivo .env existe y tiene los permisos correctos
chmod 644 .env

# Permisos correctos
chmod -R 775 storage bootstrap/cache

# Limpiar y optimizar
php artisan config:clear
php artisan cache:clear
php artisan optimize

# Generar documentación con Scribe (fuerza HTTPS)
php artisan vendor:publish --tag=scribe-assets --force
php artisan scribe:generate

# Corregir URL en los archivos generados por Scribe para Try It Out
echo "Corrigiendo URLs en archivos generados por Scribe..."

# Reemplazar en archivos JavaScript (con diferentes formatos de escape)
find public/vendor/scribe -name "*.js" -type f -exec sed -i 's|https\\:\\/\\/localhost\\:8000|https\\:\\/\\/wewelcom-production.up.railway.app|g' {} \;
find public/vendor/scribe -name "*.js" -type f -exec sed -i 's|http\\:\\/\\/localhost\\:8000|https\\:\\/\\/wewelcom-production.up.railway.app|g' {} \;
find public/vendor/scribe -name "*.js" -type f -exec sed -i 's|https://localhost:8000|https://wewelcom-production.up.railway.app|g' {} \;
find public/vendor/scribe -name "*.js" -type f -exec sed -i 's|http://localhost:8000|https://wewelcom-production.up.railway.app|g' {} \;
find public/vendor/scribe -name "*.js" -type f -exec sed -i 's|localhost:8000|wewelcom-production.up.railway.app|g' {} \;

# Reemplazar en archivos HTML y PHP
find resources/views/scribe -name "*.blade.php" -type f -exec sed -i 's|https://localhost:8000|https://wewelcom-production.up.railway.app|g' {} \;
find resources/views/scribe -name "*.blade.php" -type f -exec sed -i 's|http://localhost:8000|https://wewelcom-production.up.railway.app|g' {} \;
find resources/views/scribe -name "*.blade.php" -type f -exec sed -i 's|localhost:8000|wewelcom-production.up.railway.app|g' {} \;
find public/docs -name "*.html" -type f -exec sed -i 's|https://localhost:8000|https://wewelcom-production.up.railway.app|g' {} \;
find public/docs -name "*.html" -type f -exec sed -i 's|http://localhost:8000|https://wewelcom-production.up.railway.app|g' {} \;
find public/docs -name "*.html" -type f -exec sed -i 's|localhost:8000|wewelcom-production.up.railway.app|g' {} \;

# Reemplazar en archivos JSON
find public/docs -name "*.json" -type f -exec sed -i 's|https://localhost:8000|https://wewelcom-production.up.railway.app|g' {} \;
find public/docs -name "*.json" -type f -exec sed -i 's|http://localhost:8000|https://wewelcom-production.up.railway.app|g' {} \;
find public/docs -name "*.json" -type f -exec sed -i 's|localhost:8000|wewelcom-production.up.railway.app|g' {} \;

# Migraciones y seeders
php artisan migrate --force
php artisan db:seed --force

# Iniciar el servidor (desarrollo) 
# 👉 Mejor cambiamos esto luego a Nginx, pero por ahora mantenemos php artisan serve
exec php artisan serve --host=0.0.0.0 --port=8000
