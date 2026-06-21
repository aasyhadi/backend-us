<?php

namespace App\Repositories;

use App\Models\Payroll;
use App\Repositories\Interfaces\PayrollRepositoryInterface;

class PayrollRepository implements PayrollRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        return Payroll::with('employee')
            ->latest()
            ->paginate(10);
    }

    public function findById(int $id)
    {
        return Payroll::with('employee')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Payroll::create($data);
    }
}
