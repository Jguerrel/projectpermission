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
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Modelo</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('carmodels') is-invalid @enderror "  data-placeholder="Seleccione Item"   id="carmodel" name="carmodel_id">
                                <option value="" disabled selected>Seleccione Item</option>
                                  @foreach ($carmodels as $carmodel)
                                        <option value="{{ $carmodel->id }}" {{ in_array($carmodel->id, old('carmodels') ?? []) ? 'selected' : '' }}>
                                            {{ $carmodel->name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Ram</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('ram') is-invalid @enderror" id="ram" name="ram" value="{{ old('ram') }}">
                            @if ($errors->has('ram'))
                                <span class="text-danger">{{ $errors->first('ram') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Sistema Operativo</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('operatingsystems') is-invalid @enderror "  data-placeholder="Seleccione Item"   id="operatingsystems" name="operatingsystem_id">
                                <option value="" disabled selected>Seleccione Item</option>
                                  @foreach ($operatingsystems as $operatingsystem)
                                        <option value="{{ $operatingsystem->id }}" {{ in_array($operatingsystem->id, old('operatingsystems') ?? []) ? 'selected' : '' }}>
                                            {{ $operatingsystem->name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Tamaño de Disco</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('diskstorages') is-invalid @enderror "  data-placeholder="Seleccione Item"   id="diskstorages" name="diskstorage_id">
                                <option value="" disabled selected>Seleccione Item</option>
                                  @foreach ($diskstorages as $diskstorage)
                                        <option value="{{ $diskstorage->id }}" {{ in_array($diskstorage->id, old('diskstorage') ?? []) ? 'selected' : '' }}>
                                            {{ $diskstorage->name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="file" class="col-md-4 col-form-label text-md-end text-start">Foto</label>
                        <div class="col-md-6">
                          <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo') }}">
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
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Office</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('office') is-invalid @enderror" id="column_offi" name="office" value="{{ old('office') }}">
                            @if ($errors->has('office'))
                                <span class="text-danger">{{ $errors->first('office') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Tipos de dispositivo</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('typedevices') is-invalid @enderror "  data-placeholder="Seleccione Item"   id="typedevice" name="typedevice_id">
                                <option value="" disabled selected>Seleccione Item</option>
                                  @foreach ($typedevices as $typedevice)
                                        <option value="{{ $typedevice->id }}" {{ in_array($typedevice->id, old('typedevices') ?? []) ? 'selected' : '' }}>
                                            {{ $typedevice->name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Sucursal</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                    <select class="form-control js-example-basic-single select2 @error('branchoffices') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="sucursal" id="sucursal" name="branch_office_id">
                                               <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($branchoffices as $branchoffice)
                                             <option value="{{ $branchoffice->id }}" {{ in_array($branchoffice->id, old('branchoffices') ?? []) ? 'selected' : '' }}>
                                               {{ $branchoffice->name }}
                                            </option>

                                        @endforeach
                                   </select>
                             </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">IP</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select id="direccionip" name="ipaddress_id" class="form-control js-example-basic-single select2">
                                  <option value="" disabled selected>Seleccione un ip</option>

                                </select>
                             </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Colaborador</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                    <select class="form-control js-example-basic-single select2 @error('employee') is-invalid @enderror " data-placeholder="Seleccione Item"  aria-label="colaborador" id="colaborador" name="employee_id">
                                         <option value="" disabled selected>Seleccione Item</option>
                                        @foreach ($employees as $employee)
                                             <option value="{{ $employee->id }}" {{ in_array($employee->id, old('employees') ?? []) ? 'selected' : '' }}>
                                               {{ $employee->name }}
                                            </option>
                                        @endforeach
                                   </select>
                             </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Tipo de Disco</label>
                        <div class="col-md-6">
                          <div class="form-group">
                                <select class="form-control js-example-basic-single select2 @error('disktypes') is-invalid @enderror "  data-placeholder="Seleccione Item"   id="disco" name="disktype_id">
                                 <option value="" disabled selected>Seleccione Item</option>
                                    @foreach ($disktypes as $disktype)
                                        <option value="{{ $disktype->id }}" >
                                            {{ $disktype->name }}
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
 <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>  -->
 <script>
    $(document).ready(function() {

        $('.select2').select2({
        placeholder: 'Seleccione una opcion'
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


/**dejar  esto de ultimo para que no moleste los demas script*/
    // $.noConflict();
    // $('#datepurcharse').datepicker({
    //         language: 'es',
    //             autoclose: true,
    //             todayHighlight: true,
    //             uiLibrary: 'bootstrap4'
    // });



    });

</script>


@endsection
