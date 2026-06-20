<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employeeId = $this->route('employee')?->id ?? $this->route('employee');

        return [
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'employee_number' => [
                'required',
                Rule::unique('employees', 'employee_number')->ignore($employeeId)
            ],
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($employeeId)
            ],
            'phone' => 'nullable|string',
            'join_date' => 'required|date',
            'salary' => 'nullable|numeric',
            'status' => 'nullable|in:active,inactive'
        ];
    }
}
