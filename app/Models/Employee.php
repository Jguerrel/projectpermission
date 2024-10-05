<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = [
        'name',
        'department_id',
        'jobtitle_id',
        'photo',
        'usrcod',
        'status'
    ];


    public function jobtitle()
    {
        return $this->belongsTo(Jobtitle::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function devices()
    {
        return $this->hasMany(Device::class);
    }

}
