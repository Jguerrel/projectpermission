<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uniform extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function levels()
    {
        return $this->hasMany(Uniformlevel::class, 'uniform_id');
    }
}
