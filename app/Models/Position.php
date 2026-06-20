<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Position extends Model
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
