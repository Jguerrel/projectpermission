@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Colaborador</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Colaborador</li>
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
                    Editar Colaborador
                </div>
                <div class="float-end">
                    <a href="{{ route('employees.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('employees.update', $employee->id) }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $employee->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Apellido</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ $employee->lastname }}">
                                @if ($errors->has('lastname'))
                                    <span class="text-danger">{{ $errors->first('lastname') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Compañia</label>
                            <div class="col-md-6">
                            <select class="form-control js-example-basic-single select2 @error('companias') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="companias" id="compania_id" name="compania_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($companias as $compania)
                                         <option value="{{ $compania->id }}"  {{ $employee->compania->id == $compania->id ? 'selected' : '' }}>
                                               {{ $compania->name }}
                                        </option>

                                        @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Departamento</label>
                            <div class="col-md-6">
                            <select class="form-control js-example-basic-single select2 @error('departamentos') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="departamentos" id="departamento_id" name="departamento_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($departamentos as $departamento)
                                         <option value="{{ $departamento->id }}"  {{ $employee->departamento->id == $departamento->id ? 'selected' : '' }}>
                                               {{ $departamento->name }}
                                        </option>

                                        @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Cargo</label>
                            <div class="col-md-6">
                            <select class="form-control js-example-basic-single select2 @error('cargos') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="cargos" id="cargo_id" name="cargo_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($cargos as $cargo)
                                         <option value="{{ $cargo->id }}"  {{ $employee->cargo->id == $cargo->id ? 'selected' : '' }}>
                                               {{ $cargo->name }}
                                        </option>

                                        @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Foto</label>
                            <div class="col-md-6">
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo') }}"  placeholder="foto">
                            @if ($errors->has('photo'))
                                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                            @endif
                                    <img src="{{asset( $employee->photo)}}" width="300px">
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
