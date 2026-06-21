<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use App\Models\LeaveRequest;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeaveRequestTest extends TestCase
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
        ]);
    }

    public function test_admin_can_create_leave_request()
    {
        $this->actingAsAdmin();

        $employee = $this->createEmployee();

        $response = $this->postJson('/api/leaves/request', [
            'employee_id' => $employee->id,
            'start_date' => now()->addDay()->toDateString(),
            'end_date' => now()->addDays(3)->toDateString(),
            'reason' => 'Family matters',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('leave_requests', [
            'employee_id' => $employee->id,
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_approve_leave_request()
    {
        $this->actingAsAdmin();

        $employee = $this->createEmployee();

        $leave = LeaveRequest::factory()->create([
            'employee_id' => $employee->id,
            'status' => 'pending',
        ]);

        $response = $this->postJson("/api/leaves/{$leave->id}/approve");

        $response->assertStatus(200);

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leave->id,
            'status' => 'approved',
        ]);
    }

    public function test_admin_can_reject_leave_request()
    {
        $this->actingAsAdmin();

        $employee = $this->createEmployee();

        $leave = LeaveRequest::factory()->create([
            'employee_id' => $employee->id,
            'status' => 'pending',
        ]);

        $response = $this->postJson("/api/leaves/{$leave->id}/reject");

        $response->assertStatus(200);

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leave->id,
            'status' => 'rejected',
        ]);
    }
}
