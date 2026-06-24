@extends('adminlte::page')

@section('content_header')
    <h1>Compañia</h1>
@stop

@section('content')


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                            <div class="card-header">
                            <a href="{{ route('branches.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                            </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="{{ route('branches.store') }}"  method="post" id='permiso'>
                        @csrf
                           <div class="card-body">

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
