@extends('adminlte::page')

@section('content_header')
    <h1>Ver Sucursal</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    Información de Direccion IP
                </div>
                <div class="float-right">
                    <a href="{{ route('ipaddresses.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>IP:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $ipaddress->ip }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left"><strong>Sucursal:</strong></label>
                        <div class="col-md-6 pt-2">
                            {{ $ipaddress->branch_office->name }}
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
