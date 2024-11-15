## Preparación
Para poder correr el proyecto debe tener instalado los siguientes programas:
- PHP
- Composer
- Node
- Mysql(opcional)
## Instalación
Una vez clonado el proyecto debe instalar las librerías necesarias, para esto debe ejecutar los siguiente comandos:
```
composer install
npm install
```
## Puesta en marcha
### Configuración
Primeramente se debe crear el archivo `.env`, se puede basar en el archivo `.env.example`, solo realizando una copia del mismo y renombrándolo.
Los parámetros que se deben configurar son:
```
DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD
APP_URL
```
Una vez terminada la configuración del archivo .env, se debe ejecutar el siguiente comando:

```
php artisan key:generate
```
### Migración de la base de datos
Para ejecutar la migración se debe ejecutar el siguiente comando
```
php artisan migrate
```
### Inicio del proyecto
Para iniciar el proyecto puede ejecutar el siguiente comando:
```
composer run dev
```
### Swagger
El proyecto cuenta con swagger integrado, para poder acceder puede ingresar a la siguiente dirección:
```
http://localhost:8000/api/documentation
```