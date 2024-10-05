<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Brand extends Model
{
    use HasFactory,HasRoles ;

    protected $fillable = [
        'name',
        'status',
    ];
}
