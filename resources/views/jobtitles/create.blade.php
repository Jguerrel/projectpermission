@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cargos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('jobtitles.index') }}">Cargos</a></li>
                    <li class="breadcrumb-item active">Nuevo</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>

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
                                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Cargo</label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                        <label for="status" class="col-md-4 col-form-label text-md-end text-start">Estado</label>
                                            <div class="col-md-6">
                                                <input type="checkbox" class="@error('status') is-invalid @enderror" name="status" id='status' value="1" checked/>
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
