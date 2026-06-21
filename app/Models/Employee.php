<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Department;
use App\Models\Position;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'position_id',
        'employee_number',
        'name',
        'email',
        'phone',
        'join_date',
        'salary',
        'status',
        'photo'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function attendances()
    {
        return $this->hasMany(
            Attendance::class
        );
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
