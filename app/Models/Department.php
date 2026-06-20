<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Employee;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
