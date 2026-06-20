<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        $query = Employee::with(['department', 'position']);

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                ->orWhere('employee_number', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['department_id'])) {
            $query->where('department_id', $filters['department_id']);
        }

        if (!empty($filters['position_id'])) {
            $query->where('position_id', $filters['position_id']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['min_salary'])) {
            $query->where('salary', '>=', $filters['min_salary']);
        }

        if (!empty($filters['max_salary'])) {
            $query->where('salary', '<=', $filters['max_salary']);
        }

        $sort = $filters['sort'] ?? 'created_at';
        $direction = $filters['direction'] ?? 'desc';

        $allowedSorts = ['name', 'email', 'employee_number', 'created_at', 'join_date', 'salary'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $perPage = $filters['per_page'] ?? 10;

        return $query->orderBy($sort, $direction)->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Employee::findOrFail($id);
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function update(int $id, array $data)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($data);

        return $employee;
    }

    public function delete(int $id)
    {
        return Employee::destroy($id);
    }
}
