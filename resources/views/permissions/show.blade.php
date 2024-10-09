@extends('vendor.adminlte.page')

@section('content')


<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ver Permiso</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Permisos</a></li>
                    <li class="breadcrumb-item active">Ver Permiso</li>
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
                    Informacion de Permiso
                </div>
                <div class="float-end">
                    <a href="{{ route('permissions.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Nombre:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $permission->name }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start"><strong>Guard Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $permission->guard_name }}
                        </div>
                    </div>


                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
