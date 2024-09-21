<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'

    ];

    // public function Branch()
    // {
    //     return $this->belongsTo(Branch::class);
    // }
    public function Devices()
    {
        return $this->hasMany(Device::class);
    }
    public function Ipaddress()
    {
        return $this->hasMany(Ipaddress::class);
    }
}
