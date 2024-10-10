@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sucursal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Direccion IP</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card car-info">
            <div class="card-header">
                <div class="float-start">
                    Editar Direccion IP
                </div>
                <div class="float-end">
                    <a href="{{ route('ipaddresses.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('ipaddresses.update', $ipaddress->id) }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">IP</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('ip') is-invalid @enderror" id="ip" name="ip" value="{{ $ipaddress->ip }}">
                                @if ($errors->has('ip'))
                                    <span class="text-danger">{{ $errors->first('ip') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Sucursal</label>
                            <div class="col-md-6">
                            <select class="form-control js-example-basic-single select2 @error('branchoffices') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="branches" id="branch_id" name="branch_id">
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
