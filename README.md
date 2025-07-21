# API RESTful de Restaurantes con Laravel

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Descripción

Este proyecto es una API RESTful para gestionar restaurantes, desarrollada con Laravel 10 y MySQL. La API permite realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) sobre restaurantes, con autenticación mediante API Key y documentación automática con Scribe.

## Características

- Operaciones CRUD completas para restaurantes
- Autenticación mediante API Key en header `X-API-KEY`
- Documentación automática con Scribe
- Frontend sencillo con Vue.js para consumir la API
- Containerización con Docker
- Validación de datos y manejo de errores

## Requisitos

- Docker y Docker Compose (recomendado)
- O alternativamente: PHP 8.1+, Composer y MySQL

## Instalación Rápida con Docker

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/gomejosl1/wewelcom.git
   cd wewelcom
   ```

2. Ejecutar el script de inicio (hace todo automáticamente):
   ```bash
   chmod +x docker-compose/scripts/start.sh
   ./docker-compose/scripts/start.sh
   ```

El script realiza automáticamente las siguientes acciones:
- Configura los permisos necesarios
- Inicia los contenedores Docker
- Instala dependencias de Composer
- Genera la clave de la aplicación
- Ejecuta migraciones y seeders
- Genera la documentación con Scribe

## Instalación Manual (sin Docker)

1. Clonar el repositorio y configurar:
   ```bash
   git clone https://github.com/gomejosl1/wewelcom.git
   cd wewelcom
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

2. Configurar la base de datos en el archivo `.env` y luego:
   ```bash
   php artisan migrate --seed
   php artisan scribe:generate
   php artisan serve
   ```

## Acceso a la Aplicación

- **API y Documentación**: http://localhost:8000/docs
- **Frontend**: http://localhost:8000/frontend

## Autenticación

Para obtener una API Key, utiliza uno de estos endpoints:

1. Registro de nuevo usuario:
   ```
   POST /api/auth/register
   {
     "name": "Tu Nombre",
     "email": "tu@email.com",
     "password": "tu_contraseña",
     "password_confirmation": "tu_contraseña"
   }
   ```

2. Inicio de sesión:
   ```
   POST /api/auth/login
   {
     "email": "admin@example.com",
     "password": "password"
   }
   ```

Usa la API Key recibida en el header `X-API-KEY` para las operaciones que requieren autenticación.

## Estructura del Proyecto

- `app/Http/Controllers/API`: Controladores de la API
- `app/Models`: Modelos de la aplicación
- `.scribe`: Archivos de configuración y ejemplos para la documentación con Scribe
- `database/migrations`: Migraciones de la base de datos
- `database/seeders`: Seeders para poblar la base de datos
- `routes/api.php`: Rutas de la API
- `frontend`: Interfaz de usuario para consumir la API

## Despliegue en Railway

Para desplegar esta aplicación en Railway, sigue estos pasos:

1. Crea una cuenta en [Railway](https://railway.app/) si aún no tienes una

2. Instala la CLI de Railway:
   ```bash
   npm i -g @railway/cli
   ```

3. Inicia sesión en Railway desde la terminal:
   ```bash
   railway login
   ```

4. Crea un nuevo proyecto en Railway:
   ```bash
   railway init
   ```

5. Configura las variables de entorno necesarias en el panel de Railway:
   - `APP_KEY`: Genera una con `php artisan key:generate --show`
   - `APP_ENV`: production
   - `APP_DEBUG`: false
   - `DB_CONNECTION`: mysql
   - `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`: Railway los proporciona automáticamente

6. Despliega la aplicación:
   ```bash
   railway up
   ```

7. Una vez desplegada, puedes acceder a la URL proporcionada por Railway

## Licencia

Este proyecto está licenciado bajo la [Licencia MIT](https://opensource.org/licenses/MIT).
