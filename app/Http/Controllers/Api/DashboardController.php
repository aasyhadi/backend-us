<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\Payroll;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponseTrait;

class DashboardController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        return $this->successResponse(
            'Dashboard retrieved successfully',
            [
                'total_departments' => Department::count(),
                'total_positions' => Position::count(),
                'total_employees' => Employee::count(),
                'active_employees' => Employee::where('status', 'active')->count(),
                'inactive_employees' => Employee::where('status', 'inactive')->count(),
            ]
        );
    }

    public function analytics()
    {
        $today = today();
        $currentPeriod = now()->format('Y-m');

        return $this->successResponse(
            'Dashboard analytics retrieved successfully',
            [
                'total_employees' => Employee::count(),

                'present_today' => Attendance::whereDate('attendance_date', $today)
                    ->whereIn('status', ['present', 'late'])
                    ->count(),

                'late_today' => Attendance::whereDate('attendance_date', $today)
                    ->where('status', 'late')
                    ->count(),

                'on_leave' => LeaveRequest::where('status', 'approved')
                    ->whereDate('start_date', '<=', $today)
                    ->whereDate('end_date', '>=', $today)
                    ->count(),

                'payroll_this_month' => Payroll::where('period', $currentPeriod)
                    ->sum('net_salary'),
            ]
        );
    }

    public function charts()
    {
        return $this->successResponse(
            'Dashboard chart data retrieved successfully',
            [
                'employees_by_department' => Employee::select(
                        'departments.name as department',
                        DB::raw('COUNT(employees.id) as total')
                    )
                    ->join('departments', 'employees.department_id', '=', 'departments.id')
                    ->groupBy('departments.name')
                    ->get(),

                'employees_by_position' => Employee::select(
                        'positions.name as position',
                        DB::raw('COUNT(employees.id) as total')
                    )
                    ->join('positions', 'employees.position_id', '=', 'positions.id')
                    ->groupBy('positions.name')
                    ->get(),

                'attendance_summary' => Attendance::select(
                        'status',
                        DB::raw('COUNT(*) as total')
                    )
                    ->groupBy('status')
                    ->get(),

                'payroll_summary' => Payroll::select(
                        'period',
                        DB::raw('SUM(net_salary) as total')
                    )
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get(),
            ]
        );
    }
}
