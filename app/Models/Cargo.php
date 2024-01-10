<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Cargo extends Model
{
    use HasFactory,HasRoles ;

    protected $fillable = [
        'name'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
