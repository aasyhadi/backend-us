<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'employee_number' => 'required|unique:employees,employee_number',
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string',
            'join_date' => 'required|date',
            'salary' => 'nullable|numeric',
            'status' => 'nullable|in:active,inactive'
        ];
    }
}
