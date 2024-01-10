@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Colaborador</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Colaborador</li>
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
                    Nuevo Colaborador
                </div>
                <div class="float-end">
                    <a href="{{ route('employees.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('employees.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Apellido</label>
                        <div class="col-md-6">
                          <input type="name" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}">
                            @if ($errors->has('lastname'))
                                <span class="text-danger">{{ $errors->first('lastname') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Compañia</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                    <select class="form-control js-example-basic-single select2 @error('companias') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="companias" id="companias" name="compania_id">
                                               <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($companias as $compania)
                                             <option value="{{ $compania->id }}" {{ in_array($compania->id, old('companias') ?? []) ? 'selected' : '' }}>
                                               {{ $compania->name }}
                                            </option>

                                        @endforeach
                                   </select>
                             </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Departamentos</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('departamentos') is-invalid @enderror "  data-placeholder="Seleccione Item"   id="departamento" name="departamento_id">
                                <option value="" disabled selected>Seleccione Item</option>
                                  @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}" {{ in_array($departamento->id, old('departamentos') ?? []) ? 'selected' : '' }}>
                                            {{ $departamento->name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Cargo</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('cargos') is-invalid @enderror "  data-placeholder="Seleccione Item"   id="cargo" name="cargo_id">
                                 <option value="" disabled selected>Seleccione Item</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->id }}" >
                                            {{ $cargo->name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Guardar">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<script>
 $(function () {
    //Initialize Select2 Elements
    $('.js-example-basic-single').select2({
       placeholder: 'Select an option'
});
});

</script>
@endsection
