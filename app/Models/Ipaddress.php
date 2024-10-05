<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipaddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'branch_office_id',
        'status'

    ];
    public function branch_office()
    {
        return $this->belongsTo(BranchOffice::class);
    }

    public function device()
    {
        return $this->hasOne(Device::class);
    }
}
