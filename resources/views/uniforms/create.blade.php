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


                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-info">
                                            <tr>
                                                <th>Acción</th>
                                                <th>Talla</th>
                                                <th>Existencia</th>
                                                <th>Salidas</th>
                                                <th>Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody id="detalles">

                                            <tr>
                                                <td>
                                                <button type="button" class="btn btn-remove" onclick="quitarDetalle(this)"><i class="fa fa-xmark"></i></button>
                                                </td>
                                                <td> <input type="text" class="form-control @error('status') is-invalid @enderror" name="uniformlevels[0][size]" placeholder="Talla" required></td>
                                                <td><input type="number" class="existencia form-control @error('status') is-invalid @enderror" name="uniformlevels[0][existence]" placeholder="Existencia" required></td>
                                                <td><input type="number" class="salidas form-control @error('status') is-invalid @enderror" name="uniformlevels[0][departure]" placeholder="Salidas" required></td>
                                                <td><input type="number" class="stock form-control @error('status') is-invalid @enderror" name="uniformlevels[0][stock]" placeholder="Stock" required readonly></td>
                                            </tr>

                                        </tbody>
                                    </table>
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
            let tbody = document.getElementById('detalles');
            let row = document.createElement('tr');
            row.innerHTML =`

                <td>
                <button type="button" class="btn btn-remove" onclick="quitarDetalle(this)"><i class="fa fa-xmark"></i></button>
                </td>
                <td> <input type="text"  class="form-control @error('status') is-invalid @enderror" name="levels[${index}][size]" placeholder="Talla"   required></td>
                <td><input type="number"  id='existencia' class="existencia form-control @error('status') is-invalid @enderror" name="levels[${index}][existence]" placeholder="Existencia"  value=0 required></td>
                <td><input type="number" id ='salidas' class="salidas form-control @error('status') is-invalid @enderror" name="levels[${index}][departure]" placeholder="Salidas" value=0  required></td>
                <td><input type="number"  id="existencia_restante" class="stock form-control @error('status') is-invalid @enderror" name="levels[${index}][stock]" placeholder="Stock"  value=0   required readonly></td>

            `;
            tbody.appendChild(row);
            index++;
        }


        function quitarDetalle(button) {
            button.parentElement.remove();
        }



        document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("table").addEventListener("input", function (event) {
        if (event.target.tagName === "INPUT") {
            let row = event.target.closest("tr"); // Obtiene la fila actual

            let existencia = parseFloat(row.querySelector(".existencia")?.value) || 0;
            let salidas = parseFloat(row.querySelector(".salidas")?.value) || 0;
            let stockInput = row.querySelector(".stock");

            if (stockInput) {
                stockInput.value = existencia - salidas; // Calcula stock automáticamente
            }

s
        }
    });
});
 </script>
@endsection
