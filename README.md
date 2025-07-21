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

- PHP 8.1 o superior
- Composer
- MySQL
- Docker y Docker Compose (opcional)

## Instalación

### Instalación Local

1. Clonar el repositorio:
   ```bash
   git clone <url-del-repositorio>
   cd wewelcom
   ```

2. Instalar dependencias:
   ```bash
   composer install
   ```

3. Configurar el archivo .env:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configurar la base de datos en el archivo .env

5. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Generar documentación con Scribe:
   ```bash
   php artisan scribe:generate
   ```

7. Iniciar el servidor:
   ```bash
   php artisan serve
   ```

### Instalación con Docker

1. Clonar el repositorio:
   ```bash
   git clone <url-del-repositorio>
   cd wewelcom
   ```

2. Configurar el archivo .env:
   ```bash
   cp .env.example .env
   ```

3. Iniciar los contenedores Docker:
   ```bash
   chmod +x docker-compose/scripts/start.sh
   ./docker-compose/scripts/start.sh
   ```

## Uso

### Documentación de la API

La documentación de la API está disponible en:

- Instalación local: http://localhost:8000/api/documentation
- Instalación con Docker: http://localhost:8000/api/documentation

### Frontend

El frontend está disponible en:

- Instalación local: http://localhost:8000/frontend
- Instalación con Docker: http://localhost:8000/frontend

### Autenticación

Para autenticarte y obtener una API Key:

1. Registra un nuevo usuario:
   ```
   POST /api/auth/register
   {
     "name": "Tu Nombre",
     "email": "tu@email.com",
     "password": "tu_contraseña",
     "password_confirmation": "tu_contraseña"
   }
   ```

2. O inicia sesión si ya tienes una cuenta:
   ```
   POST /api/auth/login
   {
     "email": "tu@email.com",
     "password": "tu_contraseña"
   }
   ```

3. Usa la API Key recibida en el header `X-API-KEY` para las operaciones que requieren autenticación.

## Estructura del Proyecto

- `app/Http/Controllers/API`: Controladores de la API
- `app/Models`: Modelos de la aplicación
- `.scribe`: Archivos de configuración y ejemplos para la documentación con Scribe
- `database/migrations`: Migraciones de la base de datos
- `database/seeders`: Seeders para poblar la base de datos
- `routes/api.php`: Rutas de la API
- `frontend`: Interfaz de usuario para consumir la API

## Licencia

Este proyecto está licenciado bajo la [Licencia MIT](https://opensource.org/licenses/MIT).
