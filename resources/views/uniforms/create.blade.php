@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Uniforme</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Uniforme</li>
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
                    Nuevo Uniforme
                </div>
                <div class="float-end">
                    <a href="{{ route('uniforms.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('uniforms.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Producto</label>
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


                        <div class="card card-info">
                            <div class="card-header">
                                    <h3 class="card-title">Detalle</h3>
                            </div>
                                <div class="card-body" id ='detalles'>
                                    <div class="mb-3 row">
                                            <button type="button" class="btn btn-remove" onclick="quitarDetalle(this)"><i class="fa fa-xmark"></i></button>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control @error('status') is-invalid @enderror" name="uniformlevels[0][size]" placeholder="Talla" required>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control @error('status') is-invalid @enderror" name="uniformlevels[0][existence]" placeholder="Existencia" required>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control @error('status') is-invalid @enderror" name="uniformlevels[0][departure]" placeholder="Salidas" required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control @error('status') is-invalid @enderror" name="uniformlevels[0][stock]" placeholder="Stock" required>
                                            </div>

                                    </div>
                                </div>
                        </div>
                    <div class=" col-md-1">
                        <button type="button" class="btn btn-block btn-outline-info btn-xs" onclick="agregarDetalle()"><i class="fa fa-plus"></i>NUEVA LINEA</button>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Confirmar">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>
        let index = 1;
        function agregarDetalle() {
            let div = document.createElement('div');
            div.innerHTML = `
            <div class="mb-3 row">
            <div class="col-md-3"><input type="text"  class="form-control @error('status') is-invalid @enderror" name="uniformlevels[${index}][size]" placeholder="Talla" required></div>
            <div class="col-md-3"><input type="text"  class="form-control @error('status') is-invalid @enderror" name="uniformlevels[${index}][existence]" placeholder="Existencia" required></div>
            <div class="col-md-3"><input type="text"  class="form-control @error('status') is-invalid @enderror" name="uniformlevels[${index}][departure]" placeholder="Salidas" required></div>
            <div class="col-md-3"><input type="text"  class="form-control @error('status') is-invalid @enderror" name="uniformlevels[${index}][stock]" placeholder="Stock" required></div>
            </div>
            `;
            document.getElementById('detalles').appendChild(div);
            index++;
        }

        function quitarDetalle(button) {
            button.parentElement.remove();
        }
 </script>
@endsection
