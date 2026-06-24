@extends('adminlte::page')

@section('content_header')
    <h1>Sucursal</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="float-left">
                    Editar Direccion IP
                </div>
                <div class="float-right">
                    <a href="{{ route('ipaddresses.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('ipaddresses.update', $ipaddress->id) }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-left">IP</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('ip') is-invalid @enderror" required id="ip" name="ip" value="{{ $ipaddress->ip }}">
                                 @if ($errors->has('ip'))
                                        <span class="text-danger">{{ $errors->first('ip')}}</span>
                                    @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-left">Sucursal</label>
                            <div class="col-md-6">
                            <select class="form-control js-example-basic-single select2 @error('branchoffices') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="branches" id="branch_id" name="branch_office_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($branch_offices  as $branch_office)
                                         <option value="{{ $branch_office->id }}"  {{ $ipaddress->branch_office->id == $branch_office->id ? 'selected' : '' }}>
                                               {{ $branch_office->name }}
                                        </option>

                                        @endforeach
                                   </select>
                        </div>
                      </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Actualizar">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
