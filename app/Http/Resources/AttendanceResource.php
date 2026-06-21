<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'attendance_date' => $this->attendance_date?->format('Y-m-d'),
            'check_in' => $this->check_in?->format('Y-m-d H:i:s'),
            'check_out' => $this->check_out?->format('Y-m-d H:i:s'),
            'working_minutes' => $this->working_minutes,
            'late_minutes' => $this->late_minutes,
            'status' => $this->status,
            'employee' => [
                'id' => $this->employee?->id,
                'name' => $this->employee?->name,
                'employee_number' => $this->employee?->employee_number,
            ],
        ];
    }
}
