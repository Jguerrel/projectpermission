<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'serialnumber',
        'ram',
        'photo',
        'datedevicepurchase',
        'devicecomment',
        'typedevice_id',
        'branch_office_id',
        'employee_id',
        'disktype_id',
        'ipaddress_id',
        'carmodel_id',
        'brand_id',
        'diskstorage_id',
        'microsoftoffice_id',
        'operatingsystem_id',
        'status',
        'anydesknumber'
    ];

    public function typedevice()
    {
        return $this->belongsTo(Typedevice::class);
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
    public function carmodel()
    {
        return $this->belongsTo(CarModel::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function microsoftoffice()
    {
        return $this->belongsTo(Microsoftoffice::class);
    }
    public function operatingsystem()
    {
        return $this->belongsTo(OperatingSystem::class);
    }
    public function diskstorage()
    {
        return $this->belongsTo(Diskstorage::class);
    }
}
