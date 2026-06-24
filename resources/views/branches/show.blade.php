@extends('adminlte::page')

@section('content_header')
    <h1>Ver Compañia</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    Información de Compañia
                </div>
                <div class="float-right">
                    <a href="{{ route('branches.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Nombre:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $branch->name }}
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
