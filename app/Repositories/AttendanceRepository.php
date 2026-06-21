<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Attendance;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function checkIn(int $employeeId)
    {
        $todayAttendance = Attendance::where('employee_id', $employeeId)
            ->whereDate('attendance_date', today())
            ->first();

        if ($todayAttendance) {
            throw new \Exception('Employee already checked in today');
        }

        $now = now();

        $officeStart = Carbon::today()->setTime(8, 0);

        $lateMinutes = $now->gt($officeStart)
            ? $officeStart->diffInMinutes($now)
            : 0;

        return Attendance::create([
            'employee_id' => $employeeId,
            'attendance_date' => today(),
            'check_in' => $now,
            'late_minutes' => $lateMinutes,
            'status' => $lateMinutes > 0 ? 'late' : 'present'
        ]);
    }

    public function checkOut(int $employeeId)
    {
        $attendance = Attendance::where('employee_id', $employeeId)
            ->whereDate('attendance_date', today())
            ->first();

        if (! $attendance) {
            throw new \Exception('Employee has not checked in today');
        }

        if ($attendance->check_out) {
            throw new \Exception('Employee already checked out today');
        }

        $attendance->check_out = now();

        $attendance->working_minutes = $attendance->check_in
            ->diffInMinutes($attendance->check_out);

        $attendance->save();

        return $attendance;
    }

    public function getReport(array $filters = [])
    {
        return Attendance::with('employee')
            ->latest()
            ->paginate(10);
    }
}
