<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class ApiClient extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = ['name', 'client_id', 'client_secret', 'is_active'];

    protected $hidden = ['client_secret'];

    /** Sanctum usa getAuthPassword() para comparar el hash */
    public function getAuthPassword(): string
    {
        return $this->client_secret;
    }

    /** El campo que identifica al cliente (equivale a "email" en usuarios web) */
    public function getAuthIdentifierName(): string
    {
        return 'client_id';
    }
}
