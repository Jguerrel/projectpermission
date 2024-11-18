<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class CarModel extends Model
{
    use HasFactory,HasRoles ;
    protected $table = 'carmodels';

    protected $fillable = [
        'name',
        'brand_id',
        'status',

    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
