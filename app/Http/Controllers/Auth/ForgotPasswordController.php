<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Mail\CustomResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $user = User::where('email', $request->email)->first();

    if ($user) {
        $token = app('auth.password.broker')->createToken($user);

        // Enviar el correo con el nuevo Mailable
        Mail::to($user->email)->send(new CustomResetPasswordMail($user, $token));
    }

    return back()->with('status', 'We have emailed your password reset link!');
}
}
