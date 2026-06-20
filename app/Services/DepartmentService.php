<?php

namespace App\Services;

use App\Models\Department;
use App\Repositories\DepartmentRepository;

class DepartmentService
{
    public function __construct(
        protected DepartmentRepository $departmentRepository
    ) {}

    public function getAll()
    {
        return $this->departmentRepository->getAll();
    }

    public function create(array $data): Department
    {
        return $this->departmentRepository->create($data);
    }

    public function update(Department $department, array $data): Department
    {
        return $this->departmentRepository->update($department, $data);
    }

    public function delete(Department $department): bool
    {
        return $this->departmentRepository->delete($department);
    }
}
