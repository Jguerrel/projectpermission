@extends('adminlte::page')

@section('content_header')
    <h1>Ver Cuenta</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    Información de Cuenta
                </div>
                <div class="float-right">
                    <a href="{{ route('accounts.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Nombre:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $account->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Contraseña:</strong></label>
                        <div class="col-md-6 pt-2">
                            <span class="acct-pass" id="showPass" data-pass="{{ $account->password }}">••••••••</span>
                            <button type="button" class="btn btn-sm btn-link p-0 ml-1" id="showPassBtn" title="Mostrar/ocultar">
                                <i class="fas fa-eye" id="showPassIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Link:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $account->link }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Descripcion:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $account->description }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-md-4 col-form-label text-md-right text-left"><strong>Estado:</strong></label>
                        <div class="col-md-6 pt-2">
                            @if ($account->status)
                                <span class="text-success">Activo</span> <!-- O puedes usar un ícono -->
                            @else
                                <span class="text-danger">Inactivo</span> <!-- O puedes usar un ícono -->
                            @endif

                       </div>
                   </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.getElementById('showPassBtn').addEventListener('click', function () {
        var span = document.getElementById('showPass');
        var icon = document.getElementById('showPassIcon');
        if (span.dataset.shown === '1') {
            span.textContent = '••••••••';
            span.dataset.shown = '0';
            icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye');
        } else {
            span.textContent = span.getAttribute('data-pass');
            span.dataset.shown = '1';
            icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash');
        }
    });
</script>
@stop
