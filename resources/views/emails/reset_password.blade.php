<!DOCTYPE html>
<html>
<head>
    <title>Cambiar Contraseña</title>
    <style>
        /* Agrega tus estilos aquí si es necesario */
    </style>
</head>
<body>
    <h1>Hola, {{ $user->name }}</h1>
    <p>Recibiste este correo porque se solicitó un restablecimiento de contraseña para tu cuenta.</p>
    <p>Por favor, haz clic en el siguiente enlace para restablecer tu contraseña:</p>
    <a href="{{ $resetUrl }}">Restablecer contraseña</a>
    <p>Si no solicitaste este cambio, puedes ignorar este correo.</p>
    <p>Gracias,</p>
    <p>El equipo de {{ config('app.name') }}</p>
</body>
</html>

