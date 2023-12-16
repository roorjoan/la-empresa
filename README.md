# Instalación del Proyecto La Empresa

Este documento proporciona instrucciones paso a paso para instalar un proyecto Laravel que incluye seeders para poblar la base de datos de manera inicial. Además, se ha generado documentación para la API utilizando Laravel Scribe.

## Requisitos Previos

Asegúrate de tener instalados los siguientes requisitos en tu sistema:

-   PHP (versión 8.x)
-   Composer
-   MySQL o cualquier otro sistema de gestión de bases de datos compatible con Laravel

## Pasos de Instalación

1. **Clonar el Repositorio:**

    ```bash
    git clone https://github.com/roorjoan/la-empresa.git
    ```

2. **Instalar Dependencias:**

    ```bash
    cd tuproyecto
    composer install
    ```

3. **Copiar el Archivo de Configuración:**

    ```bash
    cp .env.example .env
    ```

Luego, edita el archivo .env con los detalles de tu base de datos y otras configuraciones necesarias.

4. **Generar Clave de Encriptación:**

    ```bash
    php artisan key:generate
    ```

5. **Migrar la Base de Datos y Poblar la Base de Datos:**

    ```bash
    php artisan migrate --seed
    ```

6. **Iniciar el Servidor de Desarrollo:**

    ```bash
    php artisan serve
    ```

## Acceder a la Documentación de la API

La documentación de la API se ha generado utilizando Laravel Scribe. Puedes acceder a la documentación en http://localhost:8000/docs después de iniciar el servidor de desarrollo.
