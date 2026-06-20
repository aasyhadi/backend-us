<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    private function employeePayload(
        Department $department,
        Position $position,
        array $overrides = []
    ): array {
        return array_merge([
            'department_id' => $department->id,
            'position_id' => $position->id,
            'employee_number' => 'EMP-' . (string) Str::uuid(),
            'name' => fake()->name(),
            'email' => (string) Str::uuid() . '@mail.com',
            'phone' => '08123456789',
            'join_date' => now()->toDateString(),
            'salary' => 10000000,
            'status' => 'active',
        ], $overrides);
    }

    public function test_admin_can_create_employee()
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        Sanctum::actingAs($user);

        $department = Department::factory()->create();
        $position = Position::factory()->create();

        $response = $this->postJson(
            '/api/employees',
            $this->employeePayload($department, $position)
        );

        $response->assertStatus(201);

        $this->assertDatabaseHas('employees', [
            'department_id' => $department->id,
            'position_id' => $position->id,
        ]);
    }

    public function test_employee_requires_name()
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        Sanctum::actingAs($user);

        $department = Department::factory()->create();
        $position = Position::factory()->create();

        $payload = $this->employeePayload($department, $position);
        unset($payload['name']);

        $response = $this->postJson('/api/employees', $payload);

        $response->assertStatus(422);
    }

    public function test_guest_cannot_create_employee()
    {
        $department = Department::factory()->create();
        $position = Position::factory()->create();

        $response = $this->postJson(
            '/api/employees',
            $this->employeePayload($department, $position)
        );

        $response->assertStatus(401);
    }

    public function test_employee_role_cannot_create_employee()
    {
        $user = User::factory()->create([
            'role' => 'employee',
        ]);

        Sanctum::actingAs($user);

        $department = Department::factory()->create();
        $position = Position::factory()->create();

        $response = $this->postJson(
            '/api/employees',
            $this->employeePayload($department, $position)
        );

        $response->assertStatus(403);
    }
}
