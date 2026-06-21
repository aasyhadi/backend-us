<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {

            $table->id();

            $table->foreignId('employee_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('attendance_date');

            $table->datetime('check_in')->nullable();

            $table->datetime('check_out')->nullable();

            $table->integer('working_minutes')
                ->default(0);

            $table->integer('late_minutes')
                ->default(0);

            $table->enum('status', [
                'present',
                'late',
                'absent'
            ])->default('present');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
