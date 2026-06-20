<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_number' => $this->employee_number,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'join_date' => $this->join_date,
            'salary' => $this->salary,
            'status' => $this->status,
            'photo' => $this->photo,
            'photo_url' => $this->photo
                ? asset('storage/' . $this->photo)
                : null,
            'department' => [
                'id' => $this->department?->id,
                'name' => $this->department?->name,
            ],

            'position' => [
                'id' => $this->position?->id,
                'name' => $this->position?->name,
            ],
        ];
    }
}
