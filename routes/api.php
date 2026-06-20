<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\DashboardController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin,hr')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/employees/export', [EmployeeController::class, 'export']);
        Route::post('/employees/import', [EmployeeController::class, 'import']);
        Route::post('/employees/{id}/photo', [EmployeeController::class, 'uploadPhoto']);

        Route::apiResource('departments', DepartmentController::class);
        Route::apiResource('positions', PositionController::class);
        Route::apiResource('employees', EmployeeController::class);
    });
});
