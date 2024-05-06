<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disktype extends Model
{
    use HasFactory;


    protected $fillable = [
        'name'
    ];

    public function Devices()
    {
        return $this->hasMany(Device::class);
    }
}
