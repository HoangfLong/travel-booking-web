<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Install all the dependencies using composer
```bash
composer install
```
## Copy the example env file and make the required configuration changes in the .env file
```bash
cp .env.example .env
```
## Cập nhật file .env với thông tin phù hợp 
```env
APP_NAME="Tên ứng dụng"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tên_database
DB_USERNAME=tên_user
DB_PASSWORD=mật_khẩu
```
## Tạo khóa ứng dụng
```bash
php artisan key:generate
```
## Database migrations
```bash
php artisan migrate
```
## Start the local development server
```bash
php artisan serve
```