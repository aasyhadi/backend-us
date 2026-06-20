<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        Position::create([
            'name' => 'Backend Developer',
            'code' => 'BEDEV',
            'description' => 'Laravel Backend Developer'
        ]);

        Position::create([
            'name' => 'Frontend Developer',
            'code' => 'FEDEV',
            'description' => 'React Frontend Developer'
        ]);

        Position::create([
            'name' => 'HR Officer',
            'code' => 'HROFC',
            'description' => 'Human Resource Officer'
        ]);
    }
}
