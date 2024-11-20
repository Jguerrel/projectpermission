@extends('adminlte::page')

@section('content')
<section class="content-header" >
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
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card car-info">
            <div class="card-header">
                <div class="float-start">
                    Editar Dispositivo
                </div>
                <div class="float-end">
                    <a href="{{ route('devices.index') }}" class="btn btn-info btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('devices.update', $device->id) }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Numero de Serie</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('serialnumber') is-invalid @enderror" id="serie" name="serialnumber" value="{{ $device->serialnumber }}">
                                @if ($errors->has('serialnumber'))
                                    <span class="text-danger">{{ $errors->first('serialnumber') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Marca</label>
                            <div class="col-md-6 ">
                                    <select class="form-control js-example-basic-single select2 @error('brand_id') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="tmarca" id="brand" name="brand_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($brands as $brand)
                                         <option value="{{ $brand->id }}"  {{ $device->brand->id == $brand->id ? 'selected' : '' }}>
                                               {{ $brand->name }}
                                        </option>

                                        @endforeach
                                   </select>
                            </div>
                      </div>
                      <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Marca</label>
                            <div class="col-md-6 ">
                                    <select class="form-control js-example-basic-single select2 @error('carmodel_id') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="tmodelo" id="carmodel" name="carmodel_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($carmodels as $carmodel)
                                         <option value="{{ $carmodel->id }}"  {{ $device->carmodel->id == $carmodel->id ? 'selected' : '' }}>
                                               {{ $carmodel->name }}
                                        </option>

                                        @endforeach
                                   </select>
                            </div>
                      </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Ram</label>
                            <div class="col-md-6">
                            <input type="numeric" class="form-control @error('ram') is-invalid @enderror" id="ram" name="ram" value="{{ $device->ram }}" min="1" max="100" step="1">
                                @if ($errors->has('ram'))
                                    <span class="text-danger">{{ $errors->first('ram') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Número de AnyDesk</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('anydesknumber') is-invalid @enderror" id="anydesknumber" name="anydesknumber" value="{{ $device->anydesknumber }}" >
                                @if ($errors->has('anydesknumber'))
                                    <span class="text-danger">{{ $errors->first('anydesknumber') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Sistema Operativo</label>
                            <div class="col-md-6 ">
                                    <select class="form-control js-example-basic-single select2 @error('operatingsystem_id') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="Tsistema" id="sistema" name="operatingsystem_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($operatingsystems as $operatingsystem)
                                         <option value="{{ $operatingsystem->id }}"  {{ $device->operatingsystem->id == $operatingsystem->id ? 'selected' : '' }}>
                                               {{ $operatingsystem->name }}
                                        </option>

                                        @endforeach
                                   </select>
                            </div>
                      </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Tamaño de Disco</label>
                            <div class="col-md-6 ">
                                    <select class="form-control js-example-basic-single select2 @error('diskstorage_id') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="Tdisco" id="diskstorage" name="diskstorage_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($diskstorages as $diskstorage)
                                         <option value="{{ $diskstorage->id }}"  {{ $device->diskstorage->id == $diskstorage->id ? 'selected' : '' }}>
                                               {{ $diskstorage->name }}
                                        </option>

                                        @endforeach
                                   </select>
                            </div>
                      </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Office</label>
                            <div class="col-md-6 ">
                                    <select class="form-control js-example-basic-single select2 @error('microsoftoffice_id') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="Toffice" id="microsoftoffice" name="microsoftoffice_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($microsoftoffices as $microsoftoffice)
                                         <option value="{{ $microsoftoffice->id }}"  {{ $device->microsoftoffice->id == $microsoftoffice->id ? 'selected' : '' }}>
                                               {{ $microsoftoffice->name }}
                                        </option>

                                        @endforeach
                                   </select>
                            </div>
                      </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Fecha de Compra</label>
                            <div class="col-md-6 input-group-addon datepicker" style ='display: inline-flex;'>
                            <input type="text" class="form-control @error('datedevicepurchase') is-invalid @enderror" id="fecha" name="datedevicepurchase" value="{{ $device->datedevicepurchase }}">
                                @if ($errors->has('datedevicepurchase'))
                                    <span class="text-danger">{{ $errors->first('datedevicepurchase') }}</span>
                                @endif
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row input-group">
                          <label for="textarea" class="col-md-4 col-form-label text-md-end text-start">Comentarios</label>
                                <div class="col-md-6">
                                   <textarea  type="text" rows="3" cols="1" class="form-control @error('devicecomment') is-invalid @enderror" id="comentario" name="devicecomment" value="{{ $device->devicecomment}}">{{ $device->devicecomment}}</textarea>

                               </div>
                         </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Sucursal</label>
                                <div class="col-md-6">
                                    <select class="form-control js-example-basic-single select2 @error('branch_offices') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="sucursal" id="sucursal" name="branch_office_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($branch_offices as $branch_office)
                                         <option value="{{ $branch_office->id }}"  {{ $device->branch_office->id == $branch_office->id ? 'selected' : '' }}>
                                               {{ $branch_office->name }}
                                        </option>
                                        @endforeach
                                   </select>
                               </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="roles" class="col-md-4 col-form-label text-md-end text-start">IP</label>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select id="direccionip" name="ipaddress_id" class="form-control js-example-basic-single select2">
                                          <option value="" disabled selected>Seleccione un ip</option>
                                         @foreach ($ipaddresses as $ipaddress)
                                            <option value="{{ $ipaddress->id }}"  {{ $device->ipaddress->id == $ipaddress->id ? 'selected' : '' }}>
                                               {{ $ipaddress->ip }}
                                            </option>
                                        @endforeach
                                   </select>
                                </div>
                            </div>
                        </div>
                      <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Colaborador</label>
                            <div class="col-md-6 ">
                            <select class="form-control js-example-basic-single select2 @error('employees') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="colaborador" id="colaborador" name="employee_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($employees as $employee)
                                         <option value="{{ $employee->id }}"  {{ $device->employee->id == $employee->id ? 'selected' : '' }}>
                                               {{ $employee->name }}
                                        </option>

                                        @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Tipos de dispositivo</label>
                            <div class="col-md-6 ">
                            <select class="form-control js-example-basic-single select2 @error('typedevices') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="tipodis" id="tipodis" name="typedevice_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($typedevices as $typedevice)
                                         <option value="{{ $typedevice->id }}"  {{ $device->typedevice->id == $typedevice->id ? 'selected' : '' }}>
                                               {{ $typedevice->name }}
                                        </option>

                                        @endforeach
                                   </select>
                        </div>
                      </div>
                      <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Tipos de Disco</label>
                            <div class="col-md-6 ">
                            <select class="form-control js-example-basic-single select2 @error('disktypes') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="tdisco" id="disktype_id" name="disktype_id">
                                        <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($disktypes as $disktype)
                                         <option value="{{ $disktype->id }}"  {{ $device->disktype->id == $disktype->id ? 'selected' : '' }}>
                                               {{ $disktype->name }}
                                        </option>

                                        @endforeach
                                   </select>
                        </div>
                      </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Foto</label>
                            <div class="col-md-6">
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="foto" name="photo" value="{{ $device->photo }}"  placeholder="foto">
                            @if ($errors->has('photo'))
                                 <img src="{{asset( $device->photo)}}" width="300px">
                            @endif

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="text" class="col-md-4 col-form-label text-md-end text-start">Factura</label>
                                <div class="col-md-6 input-group mb-3">
                                    <button class="btn btn btn-info" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">Cambiar factura</button>
                                    <input type="text" class="form-control @error('invoicepath') is-invalid @enderror" id="invoicepath" name="invoicepath" value="{{ $device->invoicepath }}" readonly>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Ver Factura</button>
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
<!--modal que muestra pdf-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <iframe src="{{ asset('storage/' . $device->invoicepath) }}" width="100%" height="1000" frameborder="0"  style="overflow:hidden;width:100%;border: none;" >
            Este navegador no soporta la visualización de PDFs.
        </iframe>

      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    $(document).ready(function() {


        //Initialize Select2 Elements
        $('.select2').select2({
        placeholder: 'Select an option'
    });


    $('#sucursal').on('select2:select', function (e) {
            url="{{route('ipaddresses.direccionesip')}}";
            ippaddres(e,url);
        });


        $('#brand').on('select2:select', function (e) {
            url="{{route('carmodels.modelos')}}";

            modelos(e,url);
        });

    $.noConflict();
    $('#fecha').datepicker({
            language: 'es',
                autoclose: true,
                todayHighlight: true,
                uiLibrary: 'bootstrap4'
    });

    });

    Dropzone.options.fileUpload = {
            dictDefaultMessage: "Arrastra tus archivos aquí para cargarlos",
            dictFallbackMessage: "Tu navegador no soporta la carga de archivos mediante arrastrar y soltar.",
            dictInvalidFileType: "No puedes subir archivos de este tipo.",
            dictFileTooBig: "El archivo es demasiado grande. Máximo permitido: 2 MiB.",
            maxFilesize: 1, // Tamaño máximo en MB
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
