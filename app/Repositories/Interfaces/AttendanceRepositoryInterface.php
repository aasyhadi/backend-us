<?php

namespace App\Repositories\Interfaces;

interface AttendanceRepositoryInterface
{
    public function checkIn(
        int $employeeId
    );

    public function checkOut(
        int $employeeId
    );

    public function getReport(
        array $filters = []
    );
}
