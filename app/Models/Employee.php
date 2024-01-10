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
        'compania_id',
        'departamento_id',
        'cargo_id'
    ];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function compania()
    {
        return $this->belongsTo(Compania::class);
    }
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

}
