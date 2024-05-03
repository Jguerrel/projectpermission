<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'branch_id'

    ];

    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
}