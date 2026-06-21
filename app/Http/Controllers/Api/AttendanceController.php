<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Services\AttendanceService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
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

            return response()->json([
                'success' => true,
                'message' => 'Check in successfully',
                'data' => $attendance
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);

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

            return response()->json([
                'success' => true,
                'message' => 'Check out successfully',
                'data' => new AttendanceResource(
                    $attendance->load('employee')
                )
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function report()
    {
        $attendances = $this->attendanceService->report();

        return response()->json([
            'success' => true,
            'message' => 'Attendance report retrieved successfully',
            'data' => AttendanceResource::collection($attendances),
            'meta' => [
                'current_page' => $attendances->currentPage(),
                'last_page' => $attendances->lastPage(),
                'per_page' => $attendances->perPage(),
                'total' => $attendances->total(),
            ]
        ]);
    }
}
