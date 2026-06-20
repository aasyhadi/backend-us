<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'department_id' => Department::inRandomOrder()->first()?->id,
            'position_id' => Position::inRandomOrder()->first()?->id,

            'employee_number' => 'EMP' . $this->faker->unique()->numberBetween(1000, 9999),

            'name' => $this->faker->name(),

            'email' => $this->faker->unique()->safeEmail(),

            'phone' => $this->faker->phoneNumber(),

            'join_date' => $this->faker->date(),

            'salary' => $this->faker->numberBetween(
                4000000,
                25000000
            ),

            'status' => $this->faker->randomElement([
                'active',
                'inactive'
            ])
        ];
    }
}
