<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
</head>
<body>
    <h2>Hola, {{ $user->name }}</h2>
    <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
    <a href="{{ $resetUrl }}">Restablecer Contraseña</a>
</body>
</html>
