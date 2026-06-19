<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'password',
        'link',
        'description',
        'status'

    ];

    /**
     * El password de la cuenta se cifra en reposo (bóveda de credenciales).
     * Se descifra de forma transparente al leerlo. Depende de APP_KEY.
     */
    protected $casts = [
        'password' => 'encrypted',
    ];

}
