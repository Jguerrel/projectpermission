<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class OperatingSystem extends Model
{
    use HasFactory,HasRoles ;
    protected $table = 'operatingsystems';

    protected $fillable = [
        'name',
        'status',
    ];

    public function Devices()
    {
        return $this->hasMany(Device::class);
    }
}
