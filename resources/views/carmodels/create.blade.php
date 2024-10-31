@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Modelos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Modelos</li>
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
                    Nuevo Modelo
                </div>
                <div class="float-end">
                    <a href="{{ route('carmodels.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('carmodels.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Modelo</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Marca</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('brands') is-invalid @enderror "  data-placeholder="Seleccione Item"   id="brand" name="brand_id">
                                <option value="" disabled selected>Seleccione Item</option>
                                  @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ in_array($brand->id, old('brands') ?? []) ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
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

                </form>
            </div>
        </div>
    </div>
</div>


<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
        placeholder: 'Seleccione una opcion'
    });
});

</script>
@endsection
