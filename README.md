# HRIS API Laravel

Backend REST API untuk sistem HRIS menggunakan Laravel, MySQL, Sanctum, dan RBAC.

## Features

- Authentication (Laravel Sanctum)
- Role Based Access Control
- Employee Management
- Department Management
- Position Management
- Search & Filtering
- Pagination
- Employee Photo Upload
- Excel Export
- API Documentation (Scribe)
- Feature Testing

## Tech Stack

- Laravel 12
- Sanctum
- MySQL
- Maatwebsite Excel
- Scribe
- Postman
- Navicat

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
