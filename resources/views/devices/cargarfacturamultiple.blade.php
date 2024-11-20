@extends('adminlte::page')

@section('content')
<section class="content-header " >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cargar Factura</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Cargar Factura</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>

    <div class="row justify-content-center animate__animated animate__zoomInDown">
        <div class="col-md-12">
            <div class="card car-info">
                <div class="card-header">
                        <div class="float-start">
                            Nuevo Dispositivo
                        </div>
                        <div class="float-end">
                            <a href="{{ route('devices.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                        </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('devices.cargarfacturamultiplepost') }}" method="post"  enctype="multipart/form-data">
                       @csrf

                       <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Dispositivos</label>
                            <div class="col-md-6  form-group">
                            <select class="form-control select2 @error('cargarfacturamultiples') is-invalid @enderror "  multiple  aria-label="cargarfacturamultiples" id="cargarfacturamultiples" name="ids[]">
                                    @forelse ($cargarfacturamultiples as $cargarfacturamultiple)
                                        <option value="{{ $cargarfacturamultiple->id }}" {{ in_array($cargarfacturamultiple->id, old('cargarfacturamultiples') ?? []) ? 'selected' : '' }}>
                                            {{ $cargarfacturamultiple->serialnumber }}
                                        </option>
                                    @empty

                                    @endforelse
                                </select>

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="text" class="col-md-4 col-form-label text-md-end text-start">Factura</label>
                            <div class="col-md-6 input-group mb-3">
                                <button class="btn btn btn-info" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">Cargar documento</button>
                                <input type="text" class="form-control @error('invoicepath') is-invalid @enderror" id="invoicepath" name="invoicepath" value="{{ old('invoicepath') }}" readonly>
                                    @if ($errors->has('invoicepath'))
                                        <span class="text-danger">{{ $errors->first('invoicepath') }}</span>
                                    @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Actualizar">
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </div>

    @include('components.dropzoneinvoice')
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2(
    {
        multiple: true,
    }

        );
    });
</script>
@endsection
