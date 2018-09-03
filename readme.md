# fastfit_webmaster
Desarrollo página fastfit

## Instalación
- Correr ```composer install```
- ```cp .env.example .env```
- Abrir archivo ```.env``` y modificar campos de DATABASE por:
```
DB_CONNECTION=pgsql
DB_HOST=152.74.52.250
DB_PORT=5432
DB_DATABASE=Matias
DB_USERNAME=matiasmedina
DB_PASSWORD=Psmlgipxfq1
```
- Correr ```php artisan key:generate```
- Ejecutar las migraciones con ```php artisan migrate```
- Actualizar y/o ejecutar las seeds ```php artisan migrate:refresh --seed```
- Instalar drivers postgresql ```sudo apt-get install php7.1-pgsql```
- En el archivo ```php.ini``` descomentar los extends = *pgsql
# Fast-Time
# Fast-Time
