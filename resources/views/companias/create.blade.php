@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Compañia</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Compañia</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                            <div class="card-header">
                            <a href="{{ route('companias.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                            </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="{{ route('companias.store') }}"  method="post" id='permiso'>
                        @csrf
                           <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Codigo Eskema</label>
                                    <input type="text" class="form-control"  name="ciacod" id="ciacod" placeholder="codigo eskema">

                                    @error('ciacod')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Nombre </label>
                                    <input type="text" class="form-control" name="name"  id="name" placeholder="nombre" value=''>
                                    @error('name')
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
@endsection
