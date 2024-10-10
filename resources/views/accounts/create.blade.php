@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cuenta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('accounts.index') }}">Cuenta</a></li>
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
                            <a href="{{ route('accounts.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                            </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <form action="{{ route('accounts.store') }}"  method="post" id='accounts'>
                         @csrf
                           <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre </label>
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
                                            <label for="status" class="col-md-4 col-form-label text-md-end text-start">Estado</label>
                                            <div class="col-md-6">
                                            <input type="checkbox" class="@error('status') is-invalid @enderror" name="status" id='status' value="1" {{ old('featured') ? 'checked="checked"' : '' }}/>
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
