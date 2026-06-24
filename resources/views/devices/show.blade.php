@extends('adminlte::page')

@section('content_header')
    <h1>Ver Dispositivo</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    Información de Dispositivo
                </div>
                <div class="float-right">
                    <a href="{{ route('devices.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Numero de Serie:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->serialnumber }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Marca:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->brand?->name ?? 'N/D' }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Modelo:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->carmodel?->name ?? 'N/D' }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Sistema Operativo:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->operatingsystem?->name ?? 'N/D' }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Tamaño de disco:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->diskstorage?->name ?? 'N/D' }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Ram:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->ram }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-4 col-form-label text-md-right text-left"><strong>Foto:</strong></label>
                        <div class="col-md-6">
                            @if ($device->photo)
                                <img src="{{ asset($device->photo) }}" class="img-thumbnail" style="max-width:200px;" alt="Foto del dispositivo">
                            @else
                                <span class="text-muted">N/D</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Comentarios:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->devicecomment }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Office:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->microsoftoffice?->name ?? 'N/D' }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Sucursal:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->branch_office?->name ?? 'N/D' }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>IP:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->ipaddress?->ip ?? 'N/D' }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Colaborador:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->employee?->name ?? 'N/D' }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Tipos de Dispositivo:</strong></label>
                        <div class="col-md-6 pt-2">
                        {{ $device->typedevice?->name ?? 'N/D' }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Factura</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $device->invoicepath }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Comentario</strong></label>
                        <div class="col-md-6 pt-2">{{$device->devicecomment}}</div>
                    </div>

                </div>
        </div>
    </div>
</div>
@endsection
