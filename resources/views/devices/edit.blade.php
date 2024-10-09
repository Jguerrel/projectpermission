@extends('vendor.adminlte.page')

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
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('brand') is-invalid @enderror" id="marca" name="brand" value="{{ $device->brand }}">
                                @if ($errors->has('brand'))
                                    <span class="text-danger">{{ $errors->first('brand') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Modelo</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('model') is-invalid @enderror" id="modelo" name="model" value="{{ $device->model }}">
                                @if ($errors->has('model'))
                                    <span class="text-danger">{{ $errors->first('model') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Ram</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('ram') is-invalid @enderror" id="ram" name="ram" value="{{ $device->ram }}">
                                @if ($errors->has('ram'))
                                    <span class="text-danger">{{ $errors->first('ram') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Disco</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('disco') is-invalid @enderror" id="disco" name="disco" value="{{ $device->disco }}">
                                @if ($errors->has('disco'))
                                    <span class="text-danger">{{ $errors->first('disco') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Office</label>
                            <div class="col-md-6">
                            <input type="text" class="form-control @error('office') is-invalid @enderror" id="office" name="office" value="{{ $device->office }}">
                                @if ($errors->has('office'))
                                    <span class="text-danger">{{ $errors->first('office') }}</span>
                                @endif
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
                                   <textarea  type="text" rows="3" cols="1" class="form-control @error('devicecomment') is-invalid @enderror" id="comentario" name="devicecomment" value="{{ $device->devicecomment}}">{{ $device->devicecomment}}
                                  </textarea>
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
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-info" value="Actualizar">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {


        //Initialize Select2 Elements
        $('.select2').select2({
        placeholder: 'Select an option'
    });

    $('#sucursal').on('select2:select', function (e) {

          var sucursal = e.params.data;
         console.log(sucursal.id);
       //   Limpiar las opciones del segundo select
          var direccionip = document.getElementById('direccionip');
          direccionip.innerHTML = '<option value="">Selecciona un IP</option>';

          // Obtener los ip de la categoría seleccionada
          if (sucursal.id) {
            var id=sucursal.id;

            let token = '@csrf';
            token = token.substr(42, 40);
            $.ajax({
            url: "{{ route('ipaddresses.direccionesip') }}",
            type: 'POST',
            dataType: "json",
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {id: id},
            success: function (response) {
                for (var clave in response) {
                if (response.hasOwnProperty(clave)) {
                         var option = document.createElement('option');
                          option.value = response[clave].id;
                          option.textContent = response[clave].ip;
                          direccionip.appendChild(option);
                }}

              },
                 error : function(xhr, textStatus, errorThrown){

                        console.log('error'+JSON.stringify(xhr))
                        }
           });

          }
       });

    $.noConflict();
    $('#fecha').datepicker({
            language: 'es',
                autoclose: true,
                todayHighlight: true,
                uiLibrary: 'bootstrap4'
    });

    });

</script>
@endsection
