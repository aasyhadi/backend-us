<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\Interfaces\PayrollRepositoryInterface;

class PayrollService
{
    public function __construct(
        private PayrollRepositoryInterface $repository
    ) {}

    public function getAll(array $filters = [])
    {
        return $this->repository->getAll($filters);
    }

    public function getById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function generate(array $data)
    {
        $employee = Employee::findOrFail($data['employee_id']);

        $basicSalary = $employee->salary ?? 0;
        $allowance = $data['allowance'] ?? 0;
        $deduction = $data['deduction'] ?? 0;

        $netSalary = $basicSalary + $allowance - $deduction;

        return $this->repository->create([
            'employee_id' => $employee->id,
            'period' => $data['period'],
            'basic_salary' => $basicSalary,
            'allowance' => $allowance,
            'deduction' => $deduction,
            'net_salary' => $netSalary,
        ]);
    }

    public function getPayroll(int $id)
    {
        return $this->repository
            ->findById($id);
    }
}
