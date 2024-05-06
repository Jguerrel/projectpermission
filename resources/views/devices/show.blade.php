@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ver Dispositivo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Dispositivo</a></li>
                    <li class="breadcrumb-item active">Ver Dispositivo</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-start">
                    Información de Dispositivo
                </div>
                <div class="float-end">
                    <a href="{{ route('devices.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Numero de Serie:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->serialnumber }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Marca:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->brand }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Modelo:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->model }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Sistema Operativo:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->OS }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Tamaño de disco:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->disco }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Ram:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->ram }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>photo:</strong></label>
                        <img src="{{asset($device->photo) }}" class="img-thumbnail" style ='width:10%;' alt="Foto">
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Comentarios:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->devicecomment }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Office:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->office }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Compañia:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->branch->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Sucursal:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->branch_office->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Colaborador:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->employee->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Tipos de Dispositivo:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                        {{ $device->typedevice->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Tipos de Disco:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $device->disktype->name }}
                            <!-- @php
                                dump($device);
                            @endphp -->
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
