<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uniformlevel extends Model
{
    use HasFactory;

    protected $fillable = ['uniform_id', 'size','existence','departure','stock'];

    public function Uniform()
    {
        return $this->belongsTo(Uniform::class, 'uniform_id');
    }

}
