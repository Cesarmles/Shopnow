# ShopNow

ShopNow es una aplicación web desarrollada en PHP que permite gestionar productos y ventas en un entorno de tienda en línea. Este proyecto tiene como objetivo proporcionar una solución sencilla y efectiva para la administración de un sistema de ventas.

## Características

- Gestión de productos: Añadir, editar y eliminar productos.
- Gestión de ventas: Registrar y consultar ventas realizadas.
- Panel de administración: Controla y supervisa el estado de los productos y ventas.

## Requisitos

- Servidor web (Apache o similar)
- PHP 7.4 o superior
- MySQL o MariaDB
- Composer (para manejar dependencias)

## Instalación

1. **Clonar el repositorio**

   ```bash
   git clone https://github.com/tu_usuario/shopnow.git
Instalar las dependencias

Navega al directorio del proyecto e instala las dependencias usando Composer:

bash
Copiar código
cd shopnow
composer install
Configurar el entorno

Copia el archivo de configuración de ejemplo y edítalo para ajustar los detalles de tu base de datos:

bash
Copiar código
cp .env.example .env
Luego abre el archivo .env y configura los parámetros de conexión a la base de datos.

Crear la base de datos

Ejecuta las migraciones para crear las tablas necesarias en la base de datos:

bash
Copiar código
php artisan migrate
Iniciar el servidor local

Si estás utilizando PHP integrado para pruebas locales, puedes iniciar el servidor con el siguiente comando:

bash
Copiar código
php -S localhost:8000 -t public
Alternativamente, si estás utilizando un servidor web como Apache, asegúrate de que la configuración de tu servidor apunte al directorio public del proyecto.

Uso
Accede a la aplicación a través de tu navegador web en http://localhost:8000 (o el puerto que hayas configurado). Puedes comenzar a gestionar tus productos y ventas desde el panel de administración.

Contribuciones
Las contribuciones son bienvenidas. Si deseas contribuir al proyecto, por favor sigue estos pasos:

Fork del repositorio
Crear una rama para tu funcionalidad o corrección de errores
Hacer commit de tus cambios y realizar un pull request
Licencia
Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.