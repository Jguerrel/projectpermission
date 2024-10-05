<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class BranchOffice extends Model
{
    use HasFactory,HasRoles ;

    protected $fillable = [
        'name',
        'status',

    ];

    public function Devices()
    {
        return $this->hasMany(Device::class);
    }
    public function Ipaddress()
    {
        return $this->hasMany(Ipaddress::class);
    }
}
