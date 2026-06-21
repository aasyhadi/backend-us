<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayrollResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'period' => $this->period,
            'basic_salary' => $this->basic_salary,
            'allowance' => $this->allowance,
            'deduction' => $this->deduction,
            'net_salary' => $this->net_salary,
            'employee' => [
                'id' => $this->employee?->id,
                'name' => $this->employee?->name,
                'employee_number' => $this->employee?->employee_number,
            ],
        ];
    }
}
