# 🚀 HRIS API Laravel

Backend REST API Human Resource Information System (HRIS) menggunakan Laravel 12 dengan arsitektur Repository Pattern dan Service Layer.

![Laravel](https://img.shields.io/badge/Laravel-12-red)
![PHP](https://img.shields.io/badge/PHP-8.3-blue)
![MySQL](https://img.shields.io/badge/MySQL-8-orange)
![Tests](https://img.shields.io/badge/Tests-17%20Passed-success)

---

# 📋 Overview

Project ini merupakan backend HRIS (Human Resource Information System) yang mencakup:

* Authentication & Authorization
* Employee Management
* Department Management
* Position Management
* Attendance Management
* Leave Request Management
* Payroll Management
* Dashboard Analytics
* Activity Logging
* Excel Import/Export
* Payroll PDF Slip
* API Documentation
* Automated Testing

---

# 🏗️ Architecture

Project menggunakan Clean Architecture sederhana:

```text
Controller
    ↓
Service Layer
    ↓
Repository Layer
    ↓
Model (Eloquent)
```

Pattern yang digunakan:

* Repository Pattern
* Service Layer Pattern
* Dependency Injection
* Form Request Validation
* API Resource
* API Response Trait
* Global Exception Handler

---

# ⚙️ Tech Stack

## Backend

* Laravel 12
* PHP 8.3
* MySQL 8

## Authentication

* Laravel Sanctum

## Packages

* maatwebsite/excel
* barryvdh/laravel-dompdf
* dedoc/scramble

## Tools

* Postman
* Git
* GitHub
* Navicat

---

# 📦 Features

## Authentication

| Feature                | Status |
| ---------------------- | ------ |
| Register               | ✅      |
| Login                  | ✅      |
| Logout                 | ✅      |
| Current User           | ✅      |
| Sanctum Authentication | ✅      |
| RBAC                   | ✅      |

---

## Department Management

| Feature           | Status |
| ----------------- | ------ |
| Create Department | ✅      |
| Update Department | ✅      |
| Delete Department | ✅      |
| Detail Department | ✅      |
| Department List   | ✅      |

---

## Position Management

| Feature         | Status |
| --------------- | ------ |
| Create Position | ✅      |
| Update Position | ✅      |
| Delete Position | ✅      |
| Detail Position | ✅      |
| Position List   | ✅      |

---

## Employee Management

| Feature         | Status |
| --------------- | ------ |
| Create Employee | ✅      |
| Update Employee | ✅      |
| Delete Employee | ✅      |
| Employee Detail | ✅      |
| Employee List   | ✅      |
| Search          | ✅      |
| Filter          | ✅      |
| Pagination      | ✅      |
| Upload Photo    | ✅      |
| Excel Export    | ✅      |
| Excel Import    | ✅      |

---

## Attendance Management

| Feature           | Status |
| ----------------- | ------ |
| Check In          | ✅      |
| Check Out         | ✅      |
| Late Detection    | ✅      |
| Working Minutes   | ✅      |
| Attendance Report | ✅      |

---

## Leave Management

| Feature              | Status |
| -------------------- | ------ |
| Create Leave Request | ✅      |
| Approve Leave        | ✅      |
| Reject Leave         | ✅      |
| Leave List           | ✅      |

---

## Payroll Management

| Feature          | Status |
| ---------------- | ------ |
| Generate Payroll | ✅      |
| Payroll List     | ✅      |
| Payroll Detail   | ✅      |
| Payroll PDF Slip | ✅      |

---

## Dashboard

| Feature    | Status |
| ---------- | ------ |
| Summary    | ✅      |
| Analytics  | ✅      |
| Charts API | ✅      |

---

## Activity Log

| Feature                | Status |
| ---------------------- | ------ |
| Audit Trail            | ✅      |
| Payroll Logging        | ✅      |
| User Activity Tracking | ✅      |

---

# 🛠 Installation

Clone repository:

```bash
git clone https://github.com/USERNAME/hris-api.git

cd hris-api
```

Install dependency:

```bash
composer install
```

Copy environment:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Setup database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hris_api
DB_USERNAME=root
DB_PASSWORD=
```

Run migration:

```bash
php artisan migrate
```

Run seeder:

```bash
php artisan db:seed
```

Create storage link:

```bash
php artisan storage:link
```

Start application:

```bash
php artisan serve
```

---

# 📚 API Documentation

Generate otomatis menggunakan Scramble.

Buka:

```text
http://127.0.0.1:8000/docs/api
```

---

# 🧪 Testing

Menjalankan seluruh test:

```bash
php artisan test
```

Hasil terakhir:

```text
PASS Tests\Unit\ExampleTest

PASS Tests\Feature\AttendanceTest
PASS Tests\Feature\EmployeePhotoTest
PASS Tests\Feature\EmployeeTest
PASS Tests\Feature\LeaveRequestTest
PASS Tests\Feature\PayrollTest

Tests: 17 passed
Assertions: 24
```

---

# 📂 Main Endpoints

## Auth

```http
POST /api/register
POST /api/login
POST /api/logout
GET  /api/me
```

## Departments

```http
GET    /api/departments
POST   /api/departments
GET    /api/departments/{id}
PUT    /api/departments/{id}
DELETE /api/departments/{id}
```

## Positions

```http
GET    /api/positions
POST   /api/positions
GET    /api/positions/{id}
PUT    /api/positions/{id}
DELETE /api/positions/{id}
```

## Employees

```http
GET    /api/employees
POST   /api/employees
GET    /api/employees/{id}
PUT    /api/employees/{id}
DELETE /api/employees/{id}

GET    /api/employees/export
POST   /api/employees/import
POST   /api/employees/{id}/photo
```

## Attendance

```http
POST /api/attendances/checkin
POST /api/attendances/checkout
GET  /api/attendances/report
```

## Leave Request

```http
GET  /api/leaves
POST /api/leaves
POST /api/leaves/{id}/approve
POST /api/leaves/{id}/reject
```

## Payroll

```http
GET  /api/payrolls
POST /api/payrolls/generate
GET  /api/payrolls/{id}
GET  /api/payrolls/{id}/slip
```

## Dashboard

```http
GET /api/dashboard
GET /api/dashboard/analytics
GET /api/dashboard/charts
```

## Activity Logs

```http
GET /api/activity-logs
```

---

# 🎯 Learning Outcomes

Project ini digunakan untuk mempelajari:

* Laravel 12
* REST API Development
* Repository Pattern
* Service Layer
* Sanctum Authentication
* Role Based Access Control
* Excel Import Export
* PDF Generation
* Activity Logging
* Automated Testing
* Clean Code Architecture

---

# 📈 Current Progress

```text
Laravel Fundamentals     ██████████ 100%
REST API                 ██████████ 100%
Repository Pattern       ██████████ 100%
Service Layer            ██████████ 100%
Authentication           ██████████ 100%
Excel Import Export      ██████████ 100%
Attendance               ██████████ 100%
Leave Management         ██████████ 100%
Payroll                  ██████████ 100%
Testing                  ██████████ 100%
Docker                   ░░░░░░░░░░ 0%
CI/CD                    ░░░░░░░░░░ 0%
```

---

# 👨‍💻 Author

Ahmad Asyhadi
HRIS API Portfolio Project

Built with Laravel 12, MySQL, Sanctum, Repository Pattern, Service Layer, Feature Testing and Clean Architecture.
