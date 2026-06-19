<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Claves cuyos valores se guardan cifrados en la BD (secretos).
     */
    public const ENCRYPTED_KEYS = [
        'google_client_secret',
        'mail_password',
    ];

    protected static function booted(): void
    {
        // Invalidar cache cuando cambie cualquier setting.
        static::saved(fn () => Cache::forget('app_settings'));
        static::deleted(fn () => Cache::forget('app_settings'));
    }

    /**
     * Devuelve todos los settings como arreglo key => value (descifrando secretos).
     */
    public static function allAsArray(): array
    {
        return Cache::rememberForever('app_settings', function () {
            return static::all()->mapWithKeys(function (Setting $s) {
                return [$s->key => static::decode($s->key, $s->value)];
            })->toArray();
        });
    }

    public static function get(string $key, $default = null)
    {
        $all = static::allAsArray();

        return array_key_exists($key, $all) && $all[$key] !== null && $all[$key] !== ''
            ? $all[$key]
            : $default;
    }

    public static function set(string $key, $value): void
    {
        $stored = in_array($key, self::ENCRYPTED_KEYS, true) && $value !== null && $value !== ''
            ? Crypt::encryptString((string) $value)
            : $value;

        static::updateOrCreate(['key' => $key], ['value' => $stored]);
    }

    /**
     * Descifra el valor si la clave es sensible.
     */
    protected static function decode(string $key, $value)
    {
        if ($value === null || $value === '' || ! in_array($key, self::ENCRYPTED_KEYS, true)) {
            return $value;
        }

        try {
            return Crypt::decryptString($value);
        } catch (\Throwable $e) {
            // Valor no cifrado (ej. migrado a mano) o clave de app cambiada.
            return $value;
        }
    }
}
