<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Dashboard retrieved successfully',
            'data' => [
                'total_departments' => Department::count(),
                'total_positions' => Position::count(),
                'total_employees' => Employee::count(),
                'active_employees' => Employee::where('status', 'active')->count(),
                'inactive_employees' => Employee::where('status', 'inactive')->count(),
            ]
        ]);
    }
}
