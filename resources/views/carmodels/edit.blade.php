@extends('adminlte::page')

@section('content_header')
    <h1>Modelo</h1>
@stop

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="float-left">
                    Editar Modelo
                </div>
                <div class="float-right">
                    <a href="{{ route('carmodels.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('carmodels.update', $carmodel->id) }}" method="post">
                    @csrf
                    @method("PUT")
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-left">Nombre</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $carmodel->name }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right text-left">Marca</label>
                                <div class="col-md-6">
                                    <select class="form-control js-example-basic-single select2 @error('brands') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="marca" id="marca" name="brand_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($brands as $brand)
                                         <option value="{{ $brand->id }}"  {{ $carmodel->brand->id == $brand->id ? 'selected' : '' }}>
                                               {{ $brand->name }}
                                        </option>
                                        @endforeach
                                   </select>
                               </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="status" class="col-md-4 col-form-label text-md-right text-left">Estado</label>
                             <div class="col-md-6">
                             <input type="hidden" name="status" value="0">
                             <div class="custom-control custom-switch mt-2"><input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" name="status" id='status' value="1" {{ $carmodel->status ? 'checked' : '' }} /><label class="custom-control-label" for="status">Activo</label></div>
                                @if ($errors->has('status'))
                                        <span class="text-danger">{{ $errors->first('status') }}</span>
                                    @endif
                            </div>
                        </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Editar Modelo">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
