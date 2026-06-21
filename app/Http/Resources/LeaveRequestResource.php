<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'employee' => [
                'id' => $this->employee?->id,
                'name' => $this->employee?->name,
                'employee_number' => $this->employee?->employee_number,
            ],

            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'total_days' => $this->total_days,
            'reason' => $this->reason,
            'status' => $this->status,
        ];
    }
}
