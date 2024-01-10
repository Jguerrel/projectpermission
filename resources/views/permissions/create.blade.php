
@extends('adminlte::page')

@section('content')

             <!--  <div class="content-wrapper" style='margin:0px'>
            <!-- Content Header (Page header) -->
        <section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear Permisos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home/</a><a href="{{ route('permissions.index') }}"> Permisos</a></li>
                    <li class="breadcrumb-item active"></li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

            <!-- Main content -->
            <section class="content">
            <div class="container-fluid">
                <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                            <div class="card-header">
                            <a href="{{ route('permissions.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                            </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="{{ route('permissions.store') }}"  method="post" id='permiso'>

                        @csrf
                           <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control"  name="name" id="name" placeholder="Introduce el permiso">

                                    @error('name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="guard_name">Guard Name</label>
                                    <input type="text" class="form-control" name="guard_name"  id="guard_name" placeholder="" value=''>
                                    @error('guard_name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                <button type="submit" class="btn btn-info">Confirmar</button>

                                </div>
                     <!--</form>-->
                            </div>
                    <!-- /.card -->


                        </form>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->

       <!--     </div>

Content Wrapper. Contains page content -->

@endsection
