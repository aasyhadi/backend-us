<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::create([
            'name' => 'Information Technology',
            'code' => 'IT',
            'description' => 'IT Department'
        ]);

        Department::create([
            'name' => 'Human Resource',
            'code' => 'HR',
            'description' => 'Human Resource Department'
        ]);

        Department::create([
            'name' => 'Finance',
            'code' => 'FIN',
            'description' => 'Finance Department'
        ]);
    }
}
