# Laravel CRUD Basic - Gestión de Productos

Este proyecto es una aplicación web básica desarrollada como parte del segundo año de **Desarrollo de Aplicaciones Web (DAW)** en el IES Celia Viñas. Se trata de un sistema CRUD (Create, Read, Update, Delete) que permite gestionar un inventario de productos de forma eficiente.

## Descripción
La aplicación permite realizar las operaciones fundamentales de gestión de datos sobre una base de datos MariaDB/MySQL. Ha sido diseñada siguiendo el patrón arquitectónico **MVC (Modelo-Vista-Controlador)**, asegurando un código limpio y escalable.

**Funcionalidades principales:**
* Listado dinámico de productos.
* Creación y edición de registros mediante formularios validados.
* Eliminación de registros con confirmación.
* Interfaz responsiva.

## Tecnologías y Stack
* **Framework:** Laravel 10.x
* **Lenguaje:** PHP 8.x
* **Base de Datos:** MySQL / MariaDB
* **Frontend:** Blade Templating Engine & Bootstrap 5
* **Gestor de dependencias:** Composer

## Instalación y Configuración

Sigue estos pasos para ejecutar el proyecto en tu entorno local:

1. **Clonar el repositorio:**
```bash
   git clone [https://github.com/clover81/Laravel-CRUD-basic.git](https://github.com/clover81/Laravel-CRUD-basic.git)
   cd Laravel-CRUD-basic

Instalar dependencias de PHP:

composer install
Configurar el entorno:

Copia el archivo de ejemplo: cp .env.example .env

Genera la clave de la aplicación: php artisan key:generate

Configura tus credenciales de base de datos en el archivo .env.

Ejecutar migraciones:

php artisan migrate
Lanzar el servidor:

php artisan serve
Visita: http://localhost:8000


Desarrollado por [Alejandro/Clover81] - Estudiante de 2º DAW en IES Celia Viñas.
