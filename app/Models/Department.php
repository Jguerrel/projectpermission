<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Department extends Model
{
    use HasFactory,HasRoles ;

    protected $fillable = [
        'name',
        'lastname'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
