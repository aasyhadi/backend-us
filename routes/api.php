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
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('role:admin,hr')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::apiResource('departments', DepartmentController::class);
        Route::apiResource('positions', PositionController::class);
        Route::get('/employees/export', [EmployeeController::class, 'export']);
        Route::post('/employees/import', [EmployeeController::class, 'import']);
        Route::apiResource('employees', EmployeeController::class);
        Route::post(
            '/employees/{id}/photo',
            [EmployeeController::class, 'uploadPhoto']
        );
    });
});
