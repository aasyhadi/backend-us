<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Services\AttendanceService;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class AttendanceController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private AttendanceService $attendanceService
    ) {}

    public function checkIn(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id'
        ]);

        try {

            $attendance = $this->attendanceService->checkIn(
                $request->employee_id
            );

            return $this->successResponse(
                'Check in successfully',
                new AttendanceResource(
                    $attendance->load('employee')
                ),
                201
            );

        } catch (\Exception $e) {

            return $this->errorResponse(
                $e->getMessage(),
                400
            );

        }
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id'
        ]);

        try {

            $attendance = $this->attendanceService->checkOut(
                $request->employee_id
            );

            return $this->successResponse(
                'Check out successfully',
                new AttendanceResource(
                    $attendance->load('employee')
                )
            );

        } catch (\Exception $e) {

            return $this->errorResponse(
                $e->getMessage(),
                400
            );

        }
    }

    public function report()
    {
        $attendances = $this->attendanceService->report();

        return $this->successResponse(
            'Attendance report retrieved successfully',
            AttendanceResource::collection($attendances),
            200,
            [
                'current_page' => $attendances->currentPage(),
                'last_page' => $attendances->lastPage(),
                'per_page' => $attendances->perPage(),
                'total' => $attendances->total(),
            ]
        );
    }
}
