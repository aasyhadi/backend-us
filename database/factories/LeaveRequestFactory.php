<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaveRequestFactory extends Factory
{
    protected $model = LeaveRequest::class;

    public function definition(): array
    {
        $start = now()->addDays(3);
        $end = now()->addDays(5);

        return [
            'employee_id' => Employee::factory(),
            'start_date' => $start->toDateString(),
            'end_date' => $end->toDateString(),
            'total_days' => 3,
            'reason' => fake()->sentence(),
            'status' => 'pending',
        ];
    }
}
