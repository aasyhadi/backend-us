<?php

namespace App\Services;

use App\Repositories\Interfaces\AttendanceRepositoryInterface;

class AttendanceService
{
    public function __construct(
        private AttendanceRepositoryInterface $repository
    ) {}

    public function checkIn(
        int $employeeId
    )
    {
        return $this->repository
            ->checkIn($employeeId);
    }

    public function checkOut(
        int $employeeId
    )
    {
        return $this->repository
            ->checkOut($employeeId);
    }

    public function report()
    {
        return $this->repository
            ->getReport();
    }
}
