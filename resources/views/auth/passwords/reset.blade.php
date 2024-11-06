@extends('adminlte::auth.passwords.reset')

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div>
        <label for="email">E-Mail Address</label>
        <input type="email" name="email" value="{{ old('email', $email) }}" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <label for="password-confirm">Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div>

    <div>
        <button type="submit">Reset Password</button>
    </div>
</form>
