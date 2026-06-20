<?php

namespace App\Services;

use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeService
{
    public function __construct(
        private EmployeeRepositoryInterface $repository
    ) {}

    public function getEmployees(array $filters = [])
    {
        return $this->repository->getAll($filters);
    }

    public function createEmployee(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateEmployee(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function getEmployeeById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function deleteEmployee(int $id)
    {
        return $this->repository->delete($id);
    }


    public function importEmployees($file)
    {
        try {

            Excel::import(
                new EmployeesImport(),
                $file
            );

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }

}
