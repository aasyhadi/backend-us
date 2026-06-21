<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employee;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Department;
use App\Models\Position;

class EmployeePhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_photo()
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'role' => 'admin'
        ]);

        Sanctum::actingAs($user);

        $department = Department::factory()->create();
        $position = Position::factory()->create();

        $employee = Employee::factory()->create([
            'department_id' => $department->id,
            'position_id' => $position->id,
        ]);

        $file = UploadedFile::fake()
            ->image('photo.jpg');

        $response = $this->post(
            "/api/employees/{$employee->id}/photo",
            [
                'photo' => $file
            ]
        );

        $response->assertStatus(200);

        Storage::disk('public')
            ->assertExists(
                $employee->fresh()->photo
            );
    }
}
