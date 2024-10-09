@extends('vendor.adminlte.page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Permiso</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Permisos</a></li>
                    <li class="breadcrumb-item active">Editar Permiso</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>
<div class="row justify-content-center">
   <div class="col-md-12">
        <div class="card card-info card-outline">
                <div class="card-header">
                    <div class="float-start">
                        Editar Permiso
                    </div>
                    <div class="float-end">
                        <a href="{{ route('permissions.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('permissions.update', $permission->id) }}" method="post">
                     @csrf
                     @method("PUT")

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Permiso</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $permission->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                         <label for="email" class="col-md-4 col-form-label text-md-end text-start">Guard Name</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name" value="{{ $permission->guard_name }}">
                                @if ($errors->has('guard_name'))
                                    <span class="text-danger">{{ $errors->first('guard_name') }}</span>
                                @endif
                            </div>
                    </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Actualizar Permiso">
                        </div>
                    </form>
                </div>

        </div>
   </div>
</div>


@endsection

