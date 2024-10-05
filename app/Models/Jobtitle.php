<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Jobtitle extends Model
{
    use HasFactory,HasRoles ;

    protected $fillable = [
        'name',
        'status'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function Devices()
    {
        return $this->hasMany(Device::class);
    }
}
