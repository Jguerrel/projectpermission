<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleController extends Controller
{
    /**
     * Redirige al consentimiento de Google.
     * Si viene ?test=1 (desde la pantalla de Setup), marca modo prueba:
     * el callback NO inicia sesion, solo reporta si la conexion funciono.
     */
    public function redirect(Request $request)
    {
        if ($request->boolean('test')) {
            session(['google_oauth_test' => true]);
        }

        $driver = Socialite::driver('google')->scopes(['openid', 'profile', 'email']);

        // En modo prueba permitir elegir cuenta para validar comodamente.
        if (session('google_oauth_test')) {
            $driver->with(['prompt' => 'select_account']);
        }

        return $driver->redirect();
    }

    /**
     * Callback de Google. Dos modos:
     *  - Prueba: valida credenciales/dominio y vuelve a Setup con el resultado.
     *  - Normal: valida dominio, busca o crea el usuario e inicia sesion.
     */
    public function callback()
    {
        $isTest = (bool) session()->pull('google_oauth_test', false);

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            if ($isTest) {
                return redirect()->route('settings.edit')
                    ->withErrors(['oauth' => 'Prueba OAuth fallida: ' . $e->getMessage()]);
            }

            return redirect()->route('login')
                ->withErrors(['email' => 'No se pudo autenticar con Google. Intenta de nuevo.']);
        }

        $email   = strtolower((string) $googleUser->getEmail());
        $allowed = $this->domainIsAllowed($email);

        // ───────── Modo prueba: no inicia sesion, solo informa ─────────
        if ($isTest) {
            if ($allowed) {
                return redirect()->route('settings.edit')->with('status',
                    "✅ Conexión OAuth correcta. Autenticado como {$email} (dominio autorizado).");
            }

            return redirect()->route('settings.edit')->withErrors(['oauth' =>
                "OAuth funciona, pero el dominio de «{$email}» NO está en la lista de dominios autorizados. " .
                "Agrégalo si corresponde."]);
        }

        // ───────── Modo normal: login ─────────
        if (! $allowed) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Tu dominio de correo no esta autorizado para iniciar sesion.']);
        }

        // Buscar por google_id o por email (cuenta ya existente con login local).
        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $email)
            ->first();

        if ($user) {
            $user->forceFill([
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
            ])->save();
        } else {
            $user = User::create([
                'name'              => $googleUser->getName() ?: $email,
                'email'             => $email,
                'google_id'         => $googleUser->getId(),
                'avatar'            => $googleUser->getAvatar(),
                'password'          => Hash::make(Str::random(40)),
                'status'            => 1,
                'email_verified_at' => now(),
            ]);
        }

        // Respetar el flag de cuenta activa/inactiva usado por el resto de la app.
        if (isset($user->status) && ! $user->status) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Tu cuenta esta inactiva. Contacta al administrador.']);
        }

        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }

    /**
     * Determina si el dominio del correo esta en la lista autorizada.
     */
    protected function domainIsAllowed(string $email): bool
    {
        $allowed = config('services.google.allowed_domains', []);

        // Si no se configuro ningun dominio, no se permite SSO (fail-safe).
        if (empty($allowed)) {
            return false;
        }

        $domain = Str::after($email, '@');

        return in_array(strtolower($domain), array_map('strtolower', $allowed), true);
    }
}
