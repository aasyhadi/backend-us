<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\LeaveRequestController;
use App\Http\Controllers\Api\PayrollController;
use App\Http\Controllers\Api\ActivityLogController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin,hr')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/dashboard/analytics', [DashboardController::class, 'analytics']);
        Route::get('/dashboard/charts', [DashboardController::class, 'charts']);
        Route::get('/activity-logs', [ActivityLogController::class, 'index']);

        Route::get('/employees/export', [EmployeeController::class, 'export']);
        Route::post('/employees/import', [EmployeeController::class, 'import']);
        Route::post('/employees/{id}/photo', [EmployeeController::class, 'uploadPhoto']);

        Route::apiResource('departments', DepartmentController::class);
        Route::apiResource('positions', PositionController::class);
        Route::apiResource('employees', EmployeeController::class);

        Route::post('/attendances/checkin', [AttendanceController::class, 'checkIn']);
        Route::post('/attendances/checkout', [AttendanceController::class, 'checkOut']);
        Route::get('/attendances/report', [AttendanceController::class, 'report']);

        Route::get('/leaves', [LeaveRequestController::class, 'index']);
        Route::post('/leaves/request', [LeaveRequestController::class, 'store']);
        Route::post('/leaves/{id}/approve', [LeaveRequestController::class, 'approve']);
        Route::post('/leaves/{id}/reject', [LeaveRequestController::class, 'reject']);

        Route::post('/payrolls/generate', [PayrollController::class, 'generate']);
        Route::get('/payrolls', [PayrollController::class, 'index']);
        Route::get('/payrolls/{id}/slip', [PayrollController::class, 'slip']);
        Route::get('/payrolls/{id}', [PayrollController::class, 'show']);
    });
});
