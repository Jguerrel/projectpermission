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
                <form action="{{ route('devices.store') }}" method="post"  enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Serial</label>
                        <d class="col-md-6">
                          <input type="text" class="form-control @error('serialnumber') is-invalid @enderror" id="serialnumber" name="serialnumber" value="{{ old('serialnumber') }}">
                            @if ($errors->has('serialnumber'))
                                <span class="text-danger">{{ $errors->first('serialnumber') }}</span>
                            @endif
                        </d iv>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Marca</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('brands') is-invalid @enderror"  data-placeholder="Seleccione una marca"   id="brand_id" name="brand_id">
                                <option value="" disabled selected>Seleccione una opcion</option>
                                  @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ in_array($brand->id, old('brands') ?? []) ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                             <!-- Muestra el mensaje de error -->
                             @if ($errors->has('brand_id'))
                                <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Modelo</label>
                        <div class="col-md-6">
                           <div class="form-group">
                                <select id="carmodel" name="carmodel_id" class="form-control js-example-basic-single select2  @error('carmodels') is-invalid @enderror " data-placeholder="Seleccione un modelo">
                                  <option value="" disabled selected>Seleccione un modelo</option>
                                </select>
                                @if ($errors->has('carmodel_id'))
                                <span class="text-danger">{{ $errors->first('carmodel_id') }}</span>
                            @endif
                             </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Ram</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control @error('ram') is-invalid @enderror" id="ram" name="ram" value="{{ old('ram') }}" min="1" max="100" step="1" >
                            @if ($errors->has('ram'))
                                <span class="text-danger">{{ $errors->first('ram') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Número de Anydesk</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('anydesknumber') is-invalid @enderror" id="anydesknumber" name="anydesknumber" value="{{ old('anydesknumber') }}" >
                            @if ($errors->has('anydesknumber'))
                                <span class="text-danger">{{ $errors->first('anydesknumber') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Sistema Operativo</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('operatingsystems') is-invalid @enderror "  data-placeholder="Seleccione un sistema"   id="operatingsystems" name="operatingsystem_id">
                                <option value="" disabled selected>Seleccione Item</option>
                                  @foreach ($operatingsystems as $operatingsystem)
                                        <option value="{{ $operatingsystem->id }}" {{ in_array($operatingsystem->id, old('operatingsystems') ?? []) ? 'selected' : '' }}>
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
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Tamaño de Disco</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('diskstorages') is-invalid @enderror "  data-placeholder="Seleccione un tamaño"   id="diskstorages" name="diskstorage_id">
                                <option value="" disabled selected>Seleccione Item</option>
                                  @foreach ($diskstorages as $diskstorage)
                                        <option value="{{ $diskstorage->id }}" {{ in_array($diskstorage->id, old('diskstorage') ?? []) ? 'selected' : '' }}>
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
                        <label for="file" class="col-md-4 col-form-label text-md-end text-start">Foto</label>
                        <div class="col-md-6">
                          <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo') }}" >
                            @if ($errors->has('photo'))
                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="date" class="col-md-4 col-form-label text-md-end text-start">Fecha de Compra</label>

                            <div class="col-md-6 input-group-addon datepicker" style ='display: inline-flex;'>

                            <input type="date" class="form-control  @error('datedevicepurchase') is-invalid @enderror" id="datepurcharse" name="datedevicepurchase" >
                                @if ($errors->has('datedevicepurchase'))
                                <span class="text-danger">{{ $errors->first('datedevicepurchase') }}</span>
                                @endif
                         </div>
                    </div>
                    <div class="mb-3 row input-group">
                        <label for="textarea" class="col-md-4 col-form-label text-md-end text-start">Comentarios</label>
                        <div class="col-md-6">
                          <textarea  type="text" rows="3" class="form-control @error('devicecomment') is-invalid @enderror" id="comments" name="devicecomment" value="{{ old('devicecomment') }}"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Office</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('microsoftoffices') is-invalid @enderror"  data-placeholder="Seleccione tipo de dispositivo"   id="office" name="microsoftoffice_id">
                                <option value="" disabled selected>Seleccione tipo de dispositivo</option>
                                  @foreach ($microsoftoffices as $microsoftoffice)
                                        <option value="{{ $microsoftoffice->id }}" {{ in_array($microsoftoffice->id, old('microsoftoffices') ?? []) ? 'selected' : '' }}>
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
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Tipos de dispositivo</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('typedevices') is-invalid @enderror"  data-placeholder="Seleccione tipo de dispositivo"   id="typedevice" name="typedevice_id">
                                <option value="" disabled selected>Seleccione tipo de dispositivo</option>
                                  @foreach ($typedevices as $typedevice)
                                        <option value="{{ $typedevice->id }}" {{ in_array($typedevice->id, old('typedevices') ?? []) ? 'selected' : '' }}>
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
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Sucursal</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                    <select class="form-control js-example-basic-single select2 @error('branch_offices') is-invalid @enderror" data-placeholder="Seleccione una sucursal"  aria-label="sucursal" id="sucursal" name="branch_office_id">
                                        <option value="" disabled selected>Seleccione una sucursal</option>
                                        @foreach ($branchoffices as $branchoffice)
                                             <option value="{{ $branchoffice->id }}" {{ in_array($branchoffice->id, old('branchoffices') ?? []) ? 'selected' : '' }}>
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
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">IP</label>
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
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Colaborador</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                    <select class="form-control js-example-basic-single select2 @error('employees') is-invalid @enderror " data-placeholder="Seleccione un colaborador"  aria-label="colaborador" id="colaborador" name="employee_id">
                                         <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($employees as $employee)
                                             <option value="{{ $employee->id }}" {{ in_array($employee->id, old('employees') ?? []) ? 'selected' : '' }}>
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
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Tipo de Disco</label>
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
                            <label for="status" class="col-md-4 col-form-label text-md-end text-start">Estado</label>
                             <div class="col-md-6">
                             <input type="checkbox" class="@error('status') is-invalid @enderror" name="status" id='status' value="1" checked/>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
