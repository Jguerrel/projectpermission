@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Direccion IP</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Direccion IP</li>
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
                    Nuevo Direccion IP
                </div>
                <div class="float-end">
                    <a href="{{ route('ipaddresses.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('ipaddresses.store') }}" method="post"  enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Direccion IP</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('ip') is-invalid @enderror" required  pattern="^((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])$" id="ip" name="ip" value="{{ old('ip') }}">
                            @if ($errors->has('ip'))
                                <span class="text-danger">{{ $errors->first('ip') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Sucursal</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                    <select class="form-control js-example-basic-single select2 @error('branch_office_id') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="sucursal" id="sucursal" name="branch_office_id">
                                               <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($branch_offices as $branch_office)
                                             <option value="{{ $branch_office->id }}" {{ in_array($branch_office->id, old('branch_offices') ?? []) ? 'selected' : '' }}>
                                               {{ $branch_office->name }}
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
<script>
 $(function () {
    //Initialize Select2 Elements
    $('.js-example-basic-single').select2({
       placeholder: 'Select an option'
});
});

</script>
@endsection
