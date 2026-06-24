@extends('adminlte::page')

@section('content_header')
    <h1>Cuenta</h1>
@stop

@section('content')


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <!-- left column -->
                <div class="col-md-10">
                    <!-- general form elements -->
                    <div class="card card-outline card-info">
                            <div class="card-header">
                            <a href="{{ route('accounts.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                            </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="{{ route('accounts.store') }}"  method="post" id='accounts'>
                         @csrf
                           <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right text-left">Nombre </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="name"  id="name" placeholder="nombre" value=''>
                                                @error('name')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="password" class="col-md-4 col-form-label">Contraseña </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="password"  id="passwordt" placeholder="contraseña" value=''>
                                             @error('password')
                                             <p class='text-danger inputerror'>{{ $message }} </p>
                                             @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="enlace" class="col-sm-4 col-form-label">Link </label>
                                        <div class="col-sm-8">
                                               <input type="text" class="form-control" name="link"  id="linkt" placeholder="link" value=''>
                                                @error('link')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                        </div>
                                     </div>
                                     <div class="mb-3 row">
                                        <label for="descripcion" class="col-sm-4 col-form-label">Descripcion </label>
                                        <div class="col-sm-8">
                                               <input type="text" class="form-control" name="description"  id="descriptiont" placeholder="descripcion" value=''>
                                                @error('description')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                        </div>
                                     </div>

                                     <div class="mb-3 row">
                                            <label for="status" class="col-md-4 col-form-label text-md-right text-left">Estado</label>
                                            <div class="col-md-6">
                                            <div class="custom-control custom-switch mt-2"><input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" name="status" id='status' value="1" checked/><label class="custom-control-label" for="status">Activo</label></div>
                                                @if ($errors->has('status'))
                                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                                    @endif
                                            </div>
                                    </div>
                                    <div class="mb-3 row">

                                             <button type="submit" class="btn btn-info">Confirmar</button>
                                     </div>
                            </div>
                     <!--</form>-->

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
