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
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Departamento</label>
                            <div class="col-md-6">
                            <select class="form-control js-example-basic-single select2 @error('departamentos') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="departments" id="department_id" name="department_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($departments as $department)
                                         <option value="{{ $department->id }}"  {{ $employee->department->id == $department->id ? 'selected' : '' }}>
                                               {{ $department->name }}
                                        </option>

                                        @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Cargo</label>
                            <div class="col-md-6">
                            <select class="form-control js-example-basic-single select2 @error('jobtitles') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="cargos" id="jobtitle_id" name="jobtitle_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($jobtitles as $jobtitle)
                                         <option value="{{ $jobtitle->id }}"  {{ $employee->jobtitle->id == $jobtitle->id ? 'selected' : '' }}>
                                               {{ $jobtitle->name }}
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
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Usuario Eskema</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('usrcod') is-invalid @enderror" id="usuario" name="usrcod" value="{{ $employee->usrcod }}">
                                @if ($errors->has('usrcod'))
                                    <span class="text-danger">{{ $errors->first('usrcod') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="status" class="col-md-4 col-form-label text-md-end text-start">Estado</label>
                             <div class="col-md-6">
                             <input type="hidden" name="status" value="0">
                             <input type="checkbox" class="@error('status') is-invalid @enderror" name="status" id='status' value="1" {{ $employee->status ? 'checked' : '' }} />
                                @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
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
