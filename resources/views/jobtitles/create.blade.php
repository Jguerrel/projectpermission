@extends('adminlte::page')

@section('content_header')
    <h1>Cargos</h1>
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
                            <a href="{{ route('jobtitles.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                            </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="{{ route('jobtitles.store') }}"  method="post" id='cargos'>
                         @csrf
                           <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right text-left">Cargo</label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
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
                                    <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Confirmar">
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
