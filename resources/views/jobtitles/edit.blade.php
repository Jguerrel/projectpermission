
@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Cargo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Cargo</a></li>
                    <li class="breadcrumb-item active">Editar Cargo</li>
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
                        Editar Cargo
                    </div>
                    <div class="float-end">
                        <a href="{{ route('jobtitles.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('jobtitles.update', $jobtitle->id) }}" method="post">
                    @csrf
                    @method("PUT")

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $jobtitle->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="status" class="col-md-4 col-form-label text-md-end text-start">Estado</label>
                             <div class="col-md-6">
                             <input type="hidden" name="status" value="0">
                             <input type="checkbox" class="@error('status') is-invalid @enderror" name="status" id='status' value="1" {{ $jobtitle->status ? 'checked' : '' }} />
                                @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                           <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Actualizar Cargo">
                        </div>
                </form>
                </div>
        </div>
    </div>
</div>
@endsection
