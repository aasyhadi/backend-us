# HRIS API Laravel

Backend REST API untuk sistem HRIS menggunakan Laravel, MySQL, Sanctum, dan RBAC.

## Features

- Authentication
- Role Based Access Control
- Department CRUD
- Position CRUD
- Employee CRUD
- Dashboard API

## Tech Stack

- Laravel
- MySQL
- Laravel Sanctum
- Postman
- Navicat

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
