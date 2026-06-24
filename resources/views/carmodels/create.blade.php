@extends('adminlte::page')

@section('content_header')
    <h1>Modelos</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="float-left">
                    Nuevo Modelo
                </div>
                <div class="float-right">
                    <a href="{{ route('carmodels.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('carmodels.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-right text-left">Modelo</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="brand" class="col-md-4 col-form-label text-md-right text-left">Marca</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('brand_id') is-invalid @enderror "  data-placeholder="Seleccione Item"   id="brand" name="brand_id">
                                <option value="" disabled {{ old('brand_id') ? '' : 'selected' }}>Seleccione Item</option>
                                  @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
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
