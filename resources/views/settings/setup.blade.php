@extends('adminlte::page')

@section('title', 'Configuración del sistema')

@section('content_header')
    <h1><i class="fas fa-cogs"></i> Configuración del sistema</h1>
@stop

@section('content')

@if (session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fas fa-check-circle"></i> {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('settings.update') }}" method="POST">
    @csrf
    @method('PUT')

    {{-- ───────────── Google SSO ───────────── --}}
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fab fa-google"></i> Login con Google (SSO)</h3>
        </div>
        <div class="card-body">

            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                En <a href="https://console.cloud.google.com/apis/credentials" target="_blank">Google Cloud Console</a>
                crea un <b>ID de cliente de OAuth (Aplicación web)</b> y usa esta URI de redirección autorizada:
                <br>
                <code id="cbUrl">{{ $callbackUrl }}</code>
                <button type="button" class="btn btn-xs btn-default ml-2" onclick="copyCb()"><i class="fas fa-copy"></i> Copiar</button>
            </div>

            <div class="form-group">
                <label>Client ID</label>
                <input type="text" name="google_client_id" class="form-control"
                       value="{{ old('google_client_id', $settings['google_client_id']) }}"
                       placeholder="xxxxx.apps.googleusercontent.com">
            </div>

            <div class="form-group">
                <label>Client Secret</label>
                <input type="password" name="google_client_secret" class="form-control"
                       placeholder="{{ $settings['google_client_secret'] ? '•••••••• (guardado — déjalo vacío para conservarlo)' : 'GOCSPX-...' }}">
                <small class="text-muted">Se guarda cifrado. Déjalo vacío para no cambiarlo.</small>
            </div>

            <div class="form-group">
                <label>URI de redirección</label>
                <input type="text" name="google_redirect" class="form-control"
                       value="{{ old('google_redirect', $settings['google_redirect']) }}">
            </div>

            <div class="form-group">
                <label>Dominios autorizados</label>
                <input type="text" name="google_allowed_domains" class="form-control"
                       value="{{ old('google_allowed_domains', $settings['google_allowed_domains']) }}"
                       placeholder="bahiamotors.com,geelypanama.com,zeekrpanama.com">
                <small class="text-muted">Separados por coma. Solo correos de estos dominios podrán iniciar sesión con Google.</small>
            </div>

            <hr>
            <a href="{{ route('google.redirect', ['test' => 1]) }}" class="btn btn-outline-primary">
                <i class="fab fa-google"></i> Probar conexión OAuth
            </a>
            <small class="text-muted d-block mt-1">
                <b>Guarda primero</b> el Client ID y Secret. La prueba hace el flujo real con Google
                pero <b>no inicia sesión</b>: solo verifica que las credenciales y el dominio funcionen.
            </small>
        </div>
    </div>

    {{-- ───────────── Correo SMTP ───────────── --}}
    <div class="card card-warning card-outline">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-envelope"></i> Correo (SMTP)</h3>
        </div>
        <div class="card-body">

            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                Para Google Workspace SMTP Relay usa <code>smtp-relay.gmail.com</code>, puerto <code>587</code>, cifrado <b>TLS</b>,
                y autoriza la IP del servidor en la consola de administración de Workspace.
            </div>

            <div class="row">
                <div class="form-group col-md-8">
                    <label>Servidor SMTP (host)</label>
                    <input type="text" name="mail_host" class="form-control"
                           value="{{ old('mail_host', $settings['mail_host']) }}"
                           placeholder="smtp-relay.gmail.com">
                </div>
                <div class="form-group col-md-4">
                    <label>Puerto</label>
                    <input type="number" name="mail_port" class="form-control"
                           value="{{ old('mail_port', $settings['mail_port']) }}" placeholder="587">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Usuario (opcional en relay)</label>
                    <input type="text" name="mail_username" class="form-control"
                           value="{{ old('mail_username', $settings['mail_username']) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Contraseña / App Password</label>
                    <input type="password" name="mail_password" class="form-control"
                           placeholder="{{ $settings['mail_password'] ? '•••••••• (guardado — déjalo vacío para conservarlo)' : '' }}">
                    <small class="text-muted">Se guarda cifrado. Déjalo vacío para no cambiarlo.</small>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label>Cifrado</label>
                    <select name="mail_encryption" class="form-control">
                        @php($enc = old('mail_encryption', $settings['mail_encryption']))
                        <option value="tls"  {{ $enc == 'tls' ? 'selected' : '' }}>TLS</option>
                        <option value="ssl"  {{ $enc == 'ssl' ? 'selected' : '' }}>SSL</option>
                        <option value="none" {{ ($enc === null || $enc === '' || $enc == 'none') ? 'selected' : '' }}>Ninguno</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Remitente (from address)</label>
                    <input type="email" name="mail_from_address" class="form-control"
                           value="{{ old('mail_from_address', $settings['mail_from_address']) }}"
                           placeholder="no-reply@bahiamotors.com">
                </div>
                <div class="form-group col-md-4">
                    <label>Nombre del remitente</label>
                    <input type="text" name="mail_from_name" class="form-control"
                           value="{{ old('mail_from_name', $settings['mail_from_name']) }}"
                           placeholder="Bahia Motors">
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar configuración</button>
    </div>
</form>

{{-- Probar correo (formulario aparte) --}}
<form action="{{ route('settings.testmail') }}" method="POST" class="mb-5">
    @csrf
    <button type="submit" class="btn btn-outline-secondary">
        <i class="fas fa-paper-plane"></i> Enviar correo de prueba a {{ auth()->user()->email }}
    </button>
    <small class="text-muted d-block mt-1">Guarda primero la configuración, luego prueba el envío.</small>
</form>

@stop

@section('js')
<script>
function copyCb() {
    const txt = document.getElementById('cbUrl').innerText;
    navigator.clipboard.writeText(txt);
}
</script>
@stop
