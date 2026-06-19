<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:ver-configuracion']);
    }

    /**
     * Pantalla de configuracion (Setup): Google SSO + Correo SMTP.
     */
    public function edit()
    {
        $settings = [
            // Google SSO
            'google_client_id'       => Setting::get('google_client_id', config('services.google.client_id')),
            'google_client_secret'   => Setting::get('google_client_secret', config('services.google.client_secret')),
            'google_redirect'        => Setting::get('google_redirect', config('services.google.redirect') ?: url('/auth/google/callback')),
            'google_allowed_domains' => Setting::get('google_allowed_domains', implode(',', (array) config('services.google.allowed_domains', []))),
            // Correo
            'mail_host'         => Setting::get('mail_host', config('mail.mailers.smtp.host')),
            'mail_port'         => Setting::get('mail_port', config('mail.mailers.smtp.port')),
            'mail_username'     => Setting::get('mail_username', config('mail.mailers.smtp.username')),
            'mail_password'     => Setting::get('mail_password', config('mail.mailers.smtp.password')),
            'mail_encryption'   => Setting::get('mail_encryption', config('mail.mailers.smtp.encryption')),
            'mail_from_address' => Setting::get('mail_from_address', config('mail.from.address')),
            'mail_from_name'    => Setting::get('mail_from_name', config('mail.from.name')),
        ];

        $callbackUrl = url('/auth/google/callback');

        return view('settings.setup', compact('settings', 'callbackUrl'));
    }

    /**
     * Guarda la configuracion.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'google_client_id'       => ['nullable', 'string', 'max:255'],
            'google_client_secret'   => ['nullable', 'string', 'max:255'],
            'google_redirect'        => ['nullable', 'url', 'max:255'],
            'google_allowed_domains' => ['nullable', 'string', 'max:1000'],
            'mail_host'         => ['nullable', 'string', 'max:255'],
            'mail_port'         => ['nullable', 'integer', 'min:1', 'max:65535'],
            'mail_username'     => ['nullable', 'string', 'max:255'],
            'mail_password'     => ['nullable', 'string', 'max:255'],
            'mail_encryption'   => ['nullable', 'in:tls,ssl,none'],
            'mail_from_address' => ['nullable', 'email', 'max:255'],
            'mail_from_name'    => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($data as $key => $value) {
            // No sobreescribir secretos con vacio (permite dejar el campo en blanco
            // para conservar el valor ya guardado).
            if (in_array($key, Setting::ENCRYPTED_KEYS, true) && ($value === null || $value === '')) {
                continue;
            }

            $value = $value === 'none' ? null : $value;
            Setting::set($key, $value);
        }

        return redirect()->route('settings.edit')
            ->with('status', 'Configuracion guardada correctamente.');
    }

    /**
     * Envia un correo de prueba al usuario autenticado para validar el SMTP.
     */
    public function testMail(Request $request)
    {
        $to = $request->user()->email;

        try {
            Mail::raw(
                'Este es un correo de prueba enviado desde la pantalla de configuracion del sistema. Si lo recibes, el SMTP esta configurado correctamente.',
                function ($message) use ($to) {
                    $message->to($to)->subject('Correo de prueba - Configuracion SMTP');
                }
            );
        } catch (\Throwable $e) {
            return back()->withErrors(['mail' => 'Error al enviar: ' . $e->getMessage()]);
        }

        return back()->with('status', "Correo de prueba enviado a {$to}. Revisa tu bandeja.");
    }
}
