<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeesImport implements
    ToModel,
    WithHeadingRow,
    WithValidation
{
    public function model(array $row)
    {
        return new Employee([
            'department_id' => $row['department_id'],
            'position_id' => $row['position_id'],
            'employee_number' => $row['employee_number'],
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'join_date' => $row['join_date'],
            'salary' => $row['salary'],
            'status' => $row['status'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.department_id' => 'required|exists:departments,id',
            '*.position_id' => 'required|exists:positions,id',
            '*.employee_number' => 'required|unique:employees,employee_number',
            '*.email' => 'required|email|unique:employees,email',
            '*.name' => 'required'
        ];
    }
}
