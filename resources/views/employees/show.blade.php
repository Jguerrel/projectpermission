@extends('adminlte::page')

@section('content_header')
    <h1>Ver Colaborador</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    Información de Colaborador
                </div>
                <div class="float-right">
                    <a href="{{ route('employees.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Nombre:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $employee->name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="department_id" class="col-md-4 col-form-label text-md-right text-left"><strong>Departamento:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $employee->department?->name ?? 'N/D' }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jobtitle_id" class="col-md-4 col-form-label text-md-right text-left"><strong>Cargo:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $employee->jobtitle?->name ?? 'N/D' }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="usrcod" class="col-md-4 col-form-label text-md-right text-left"><strong>Usuario:</strong></label>
                        <div class="col-md-6 pt-2">
                             {{ $employee->usrcod }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="photo" class="col-md-4 col-form-label text-md-right text-left"><strong>Foto:</strong></label>
                        <div class="col-md-6">
                            @if ($employee->photo)
                                <img src="{{ asset($employee->photo) }}" class="img-thumbnail" style="max-width:200px;" alt="Foto del colaborador">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-md-4 col-form-label text-md-right text-left"><strong>Estado:</strong></label>
                        <div class="col-md-6 pt-2">
                            @if ($employee->status)
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
