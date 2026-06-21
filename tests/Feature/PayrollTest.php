<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PayrollTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsAdmin(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
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
            'salary' => 10000000,
        ]);
    }

    public function test_admin_can_generate_payroll()
    {
        $this->actingAsAdmin();

        $employee = $this->createEmployee();

        $response = $this->postJson('/api/payrolls/generate', [
            'employee_id' => $employee->id,
            'period' => '2026-06',
            'allowance' => 500000,
            'deduction' => 250000,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('payrolls', [
            'employee_id' => $employee->id,
            'period' => '2026-06',
            'net_salary' => 10250000,
        ]);
    }

    public function test_admin_can_view_payroll_list()
    {
        $this->actingAsAdmin();

        $response = $this->getJson('/api/payrolls');

        $response->assertStatus(200);
    }

    public function test_guest_cannot_generate_payroll()
    {
        $employee = $this->createEmployee();

        $response = $this->postJson('/api/payrolls/generate', [
            'employee_id' => $employee->id,
            'period' => '2026-06',
            'allowance' => 500000,
            'deduction' => 250000,
        ]);

        $response->assertStatus(401);
    }
}
