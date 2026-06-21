<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsAdmin(): void
    {
        $user = User::factory()->create([
            'role' => 'admin'
        ]);

        Sanctum::actingAs($user);
    }

    private function createEmployee(): Employee
    {
        $department = Department::factory()->create();
        $position = Position::factory()->create();

        return Employee::factory()->create([
            'department_id' => $department->id,
            'position_id' => $position->id,
        ]);
    }

    public function test_admin_can_check_in_employee()
    {
        $this->actingAsAdmin();

        $employee = $this->createEmployee();

        $response = $this->postJson('/api/attendances/checkin', [
            'employee_id' => $employee->id
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('attendances', [
            'employee_id' => $employee->id,
        ]);
    }

    public function test_employee_cannot_check_in_twice()
    {
        $this->actingAsAdmin();

        $employee = $this->createEmployee();

        $this->postJson('/api/attendances/checkin', [
            'employee_id' => $employee->id
        ]);

        $response = $this->postJson('/api/attendances/checkin', [
            'employee_id' => $employee->id
        ]);

        $response->assertStatus(400);
    }

    public function test_admin_can_check_out_employee()
    {
        $this->actingAsAdmin();

        $employee = $this->createEmployee();

        $this->postJson('/api/attendances/checkin', [
            'employee_id' => $employee->id
        ]);

        $response = $this->postJson('/api/attendances/checkout', [
            'employee_id' => $employee->id
        ]);

        $response->assertStatus(200);
    }

    public function test_employee_cannot_check_out_before_check_in()
    {
        $this->actingAsAdmin();

        $employee = $this->createEmployee();

        $response = $this->postJson('/api/attendances/checkout', [
            'employee_id' => $employee->id
        ]);

        $response->assertStatus(400);
    }
}
