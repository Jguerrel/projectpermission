<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // public function employees()
    // {
    //     return $this->hasMany(Employee::class);
    // }
    // public function Devices()
    // {
    //     return $this->hasMany(Device::class);
    // }
}
