@extends('adminlte::page')

@section('content_header')
    <h1>Ver Permiso</h1>
@stop

@section('content')


<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="float-left">
                    Informacion de Permiso
                </div>
                <div class="float-right">
                    <a href="{{ route('permissions.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Nombre:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $permission->name }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-right text-left"><strong>Guard Name:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $permission->guard_name }}
                        </div>
                    </div>


                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
