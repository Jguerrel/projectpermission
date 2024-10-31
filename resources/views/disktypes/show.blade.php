@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ver Tipos de Discos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Tipos de Discos</a></li>
                    <li class="breadcrumb-item active">Ver Tipos de Discos</li>
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
                    Información de Tipos de Discos
                </div>
                <div class="float-end">
                    <a href="{{ route('disktypes.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Nombre:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $disktype->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-md-4 col-form-label text-md-end text-start"><strong>Estado:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            @if ($disktype->status)
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
@endsection
