<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'serialnumber',
        'model',
        'brand',
        'ram',
        'photo',
        'OS',
        'disco',
        'datedevicepurchase',
        'devicecomment',
        'office',
        'typedevice_id',
        'branch_office_id',
        'employee_id',
        'disktype_id',
        'ipaddress_id',
        'status'
    ];

    public function typedevice()
    {
        return $this->belongsTo(TypeDevice::class);
    }

    public function branch_office()
    {
        return $this->belongsTo(BranchOffice::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function disktype()
    {
        return $this->belongsTo(Disktype::class);
    }

    public function ipaddress()
    {
        return $this->belongsTo(Ipaddress::class);
    }
}
