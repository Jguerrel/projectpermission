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
        'lastname',
        'branch_id',
        'department_id',
        'jobtitle_id',
        'photo'
    ];


    public function Jobtitle()
    {
        return $this->belongsTo(Jobtitle::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
