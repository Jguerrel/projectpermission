@extends('adminlte::page')

@section('content_header')
    <h1>Ver Departamento</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    Información de Departamento
                </div>
                <div class="float-right">
                    <a href="{{ route('departments.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Nombre:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $department->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-md-4 col-form-label text-md-right text-left"><strong>Estado:</strong></label>
                        <div class="col-md-6 pt-2">
                            @if ($department->status)
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
