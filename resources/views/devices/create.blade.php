@extends('adminlte::page')

@section('content')

<section class="content-header " >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dispositivo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dispositivo</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>
<div class="row justify-content-center animate__animated animate__zoomInDown">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="float-left">
                    Nuevo Dispositivo
                </div>
                <div class="float-right">
                    <a href="{{ route('devices.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('devices.store') }}" method="post"  enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 row">
                        <label for="serialnumber" class="col-md-4 col-form-label text-md-right text-left">Serial</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('serialnumber') is-invalid @enderror" id="serialnumber" name="serialnumber" value="{{ old('serialnumber') }}">
                            @if ($errors->has('serialnumber'))
                                <span class="text-danger">{{ $errors->first('serialnumber') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="brand_id" class="col-md-4 col-form-label text-md-right text-left">Marca</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('brand_id') is-invalid @enderror" data-placeholder="Seleccione una marca" id="brand_id" name="brand_id">
                                     <option value="" disabled {{ old('brand_id') ? '' : 'selected' }}>Seleccione Item</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                </select>
                             @if ($errors->has('brand_id'))
                                <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="carmodel" class="col-md-4 col-form-label text-md-right text-left">Modelo</label>
                        <div class="col-md-6">
                           <div class="form-group">
                                <select id="carmodel" name="carmodel_id" class="form-control js-example-basic-single select2  @error('carmodel_id') is-invalid @enderror " data-placeholder="Seleccione un modelo">
                                  <option value="" disabled {{ old('carmodel_id') ? '' : 'selected' }}>Seleccione un modelo</option>
                                        @foreach ($carmodels as $carmodel)
                                        <option value="{{ $carmodel->id }}" {{ old('carmodel_id') == $carmodel->id ? 'selected' : '' }}>
                                        {{ $carmodel->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('carmodel_id'))
                                <span class="text-danger">{{ $errors->first('carmodel_id') }}</span>
                            @endif
                             </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ram" class="col-md-4 col-form-label text-md-right text-left">Ram</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control @error('ram') is-invalid @enderror" id="ram" name="ram" value="{{ old('ram') }}" min="1" max="100" step="1" >
                            @if ($errors->has('ram'))
                                <span class="text-danger">{{ $errors->first('ram') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="anydesknumber" class="col-md-4 col-form-label text-md-right text-left">Número de Anydesk</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('anydesknumber') is-invalid @enderror" id="anydesknumber" name="anydesknumber" value="{{ old('anydesknumber') }}" >
                            @if ($errors->has('anydesknumber'))
                                <span class="text-danger">{{ $errors->first('anydesknumber') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="operatingsystems" class="col-md-4 col-form-label text-md-right text-left">Sistema Operativo</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('operatingsystem_id') is-invalid @enderror "  data-placeholder="Seleccione un sistema"   id="operatingsystems" name="operatingsystem_id">
                                <option value="" disabled {{ old('operatingsystem_id') ? '' : 'selected' }}>Seleccione Item</option>
                                  @foreach ($operatingsystems as $operatingsystem)
                                        <option value="{{ $operatingsystem->id }}" {{ old('operatingsystem_id') == $operatingsystem->id ? 'selected' : '' }}>
                                            {{ $operatingsystem->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('operatingsystem_id'))
                                    <span class="text-danger">{{ $errors->first('operatingsystem_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="diskstorages" class="col-md-4 col-form-label text-md-right text-left">Tamaño de Disco</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('diskstorage_id') is-invalid @enderror "  data-placeholder="Seleccione un tamaño"   id="diskstorages" name="diskstorage_id">
                                <option value="" disabled {{ old('diskstorage_id') ? '' : 'selected' }}>Seleccione Item</option>
                                  @foreach ($diskstorages as $diskstorage)
                                        <option value="{{ $diskstorage->id }}" {{ old('diskstorage_id') == $diskstorage->id ? 'selected' : '' }}>
                                            {{ $diskstorage->name }}
                                        </option>

                                    @endforeach
                                </select>
                                @if ($errors->has('diskstorage_id'))
                                     <span class="text-danger">{{ $errors->first('diskstorage_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="file" class="col-md-4 col-form-label text-md-right text-left">Foto</label>
                        <div class="col-md-6">
                          <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*" >
                            @if ($errors->has('photo'))
                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="datepurcharse" class="col-md-4 col-form-label text-md-right text-left">Fecha de Compra</label>

                            <div class="col-md-6 input-group-addon datepicker" style ='display: inline-flex;'>

                            <input type="date" class="form-control  @error('datedevicepurchase') is-invalid @enderror" id="datepurcharse" name="datedevicepurchase" >
                                @if ($errors->has('datedevicepurchase'))
                                <span class="text-danger">{{ $errors->first('datedevicepurchase') }}</span>
                                @endif
                         </div>
                    </div>
                    <div class="mb-3 row input-group">
                        <label for="comments" class="col-md-4 col-form-label text-md-right text-left">Comentarios</label>
                        <div class="col-md-6">
                          <textarea  type="text" rows="3" class="form-control @error('devicecomment') is-invalid @enderror" id="comments" name="devicecomment" value="{{ old('devicecomment') }}"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="office" class="col-md-4 col-form-label text-md-right text-left">Office</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('microsoftoffice_id') is-invalid @enderror"  data-placeholder="Seleccione Office"   id="office" name="microsoftoffice_id">
                                <option value="" disabled {{ old('microsoftoffice_id') ? '' : 'selected' }}>Seleccione Office</option>
                                  @foreach ($microsoftoffices as $microsoftoffice)
                                        <option value="{{ $microsoftoffice->id }}" {{ old('microsoftoffice_id') == $microsoftoffice->id ? 'selected' : '' }}>
                                            {{ $microsoftoffice->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('microsoftoffice_id'))
                                    <span class="text-danger">{{ $errors->first('microsoftoffice_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="typedevice" class="col-md-4 col-form-label text-md-right text-left">Tipos de dispositivo</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('typedevice_id') is-invalid @enderror" data-placeholder="Seleccione tipo de dispositivo" id="typedevice" name="typedevice_id">
                                <option value="" disabled {{ old('typedevice_id') ? '' : 'selected' }}>Seleccione tipo de dispositivo</option>
                                  @foreach ($typedevices as $typedevice)
                                        <option value="{{ $typedevice->id }}" {{ old('typedevice_id') == $typedevice->id ? 'selected' : '' }}>
                                            {{ $typedevice->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('typedevice_id'))
                                    <span class="text-danger">{{ $errors->first('typedevice_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="sucursal" class="col-md-4 col-form-label text-md-right text-left">Sucursal</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('branch_office_id') is-invalid @enderror" data-placeholder="Seleccione una sucursal" id="sucursal" name="branch_office_id">
                                    <option value="" disabled {{ old('branch_office_id') ? '' : 'selected' }}>Seleccione una sucursal</option>
                                    @foreach ($branchoffices as $branchoffice)
                                         <option value="{{ $branchoffice->id }}" {{ old('branch_office_id') == $branchoffice->id ? 'selected' : '' }}>
                                           {{ $branchoffice->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('branch_office_id'))
                                    <span class="text-danger">{{ $errors->first('branch_office_id') }}</span>
                                @endif
                             </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="direccionip" class="col-md-4 col-form-label text-md-right text-left">IP</label>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select id="direccionip" name="ipaddress_id" class="form-control js-example-basic-single select2 @error('ipaddress') is-invalid @enderror"  data-placeholder="Seleccione un ip" >
                                  <option value="" disabled selected>Seleccione un ip</option>
                                </select>
                                @if ($errors->has('ipaddress_id'))
                                    <span class="text-danger">{{ $errors->first('ipaddress_id') }}</span>
                                @endif
                             </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="colaborador" class="col-md-4 col-form-label text-md-right text-left">Colaborador</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                    <select class="form-control js-example-basic-single select2 @error('employee_id') is-invalid @enderror " data-placeholder="Seleccione un colaborador"  aria-label="colaborador" id="colaborador" name="employee_id">
                                         <option value="" disabled {{ old('employee_id') ? '' : 'selected' }}>Seleccione Item</option>
                                        @foreach ($employees as $employee)
                                             <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                               {{ $employee->name }}
                                            </option>
                                        @endforeach
                                   </select>
                                   @if ($errors->has('employee_id'))
                                    <span class="text-danger">{{ $errors->first('employee_id') }}</span>
                                 @endif
                             </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="disco" class="col-md-4 col-form-label text-md-right text-left">Tipo de Disco</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('disktypes') is-invalid @enderror "  data-placeholder="Seleccione tipo de disco"   id="disco" name="disktype_id">
                                 <option value="" disabled selected>Seleccione Item</option>
                                    @foreach ($disktypes as $disktype)
                                        <option value="{{ $disktype->id }}" >
                                            {{ $disktype->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('disktype_id'))
                                    <span class="text-danger">{{ $errors->first('disktype_id') }}</span>
                                 @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="invoicepath" class="col-md-4 col-form-label text-md-right text-left">Factura</label>
                        <div class="col-md-6 input-group mb-3">
                         <button class="btn btn btn-info" type="button"  data-toggle="modal" data-target="#exampleModal">Cargar documento</button>
                          <input type="text" class="form-control @error('invoicepath') is-invalid @enderror" id="invoicepath" name="invoicepath" value="{{ old('invoicepath') }}" readonly>
                            @if ($errors->has('invoicepath'))
                                <span class="text-danger">{{ $errors->first('invoicepath') }}</span>
                            @endif
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
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Guardar">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
      <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="mb-0">Subir Factura</h4>
                            </div>
                                    <div class="card-body">
                                        <form action="{{ route('uploadinvoice.file') }}" method="POST" enctype="multipart/form-data"
                                            class="dropzone" id="file-Upload">
                                            @csrf
                                        </form>
                                        <h5 id="message"></h5>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript de Bootstrap -->

<script src="{{ asset('vendor/jquery/jquerycustom.js') }}"></script>
 <script>

$(document).ready(function() {

$('.select2').select2({
placeholder: 'Seleccione una opcion'
});

        $('#sucursal').on('select2:select', function (e) {
            url="{{route('ipaddresses.direccionesip')}}";
            ippaddres(e,url);
        });


        $('#brand_id').on('select2:select', function (e) {
            url="{{route('carmodels.modelos')}}";

            modelos(e,url);
        });



});
//Dropzone.autoDiscover = false;

    Dropzone.options.fileUpload = {
            dictDefaultMessage: "Arrastra tus archivos aquí para cargarlos",
            dictInvalidFileType: "No puedes subir archivos de este tipo.",
            dictFallbackMessage: "Tu navegador no soporta la carga de archivos mediante arrastrar y soltar.",
            maxFilesize : 2,
            maxFiles: 1,
            dictFileTooBig: "El archivo es demasiado grande MiB. Máximo permitido: 2 MiB.",

            acceptedFiles: ".jpeg,.jpg,.png,.pdf", // Tipos de archivo permitidos
            success: function (file, response) {

                $("#invoicepath").val(response.file_path);
                Swal.fire({
                title: "OK!",
                text: "¡Archivo subido correctamente!",
                icon: "success"
                });

            },
            error: function (file, response) {

                Swal.fire({
                title: "NoOK!",
                text: response,
                icon: "error"
                });

            }
        };

</script>


@endsection
