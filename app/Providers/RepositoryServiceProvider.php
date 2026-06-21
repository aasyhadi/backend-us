<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\EmployeeRepository;
use App\Repositories\AttendanceRepository;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use App\Repositories\LeaveRequestRepository;
use App\Repositories\Interfaces\LeaveRequestRepositoryInterface;
use App\Repositories\PayrollRepository;
use App\Repositories\Interfaces\PayrollRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );

        $this->app->bind(
            AttendanceRepositoryInterface::class,
            AttendanceRepository::class
        );

        $this->app->bind(
            LeaveRequestRepositoryInterface::class,
            LeaveRequestRepository::class
        );

        $this->app->bind(
            PayrollRepositoryInterface::class,
            PayrollRepository::class
        );
    }
}
