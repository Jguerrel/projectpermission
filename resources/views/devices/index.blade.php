@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dispositivos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Dispositivos</a></li>

                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>

<div class="card card-info card-outline">
    <div class="card-body ">
         @can('crear-dispositivos')
            <a href="{{ route('devices.create') }}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
            <a href="{{ route('devices.cargarfacturamultiple') }}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Cargar Factura</a>
        @endcan
                     @if(session('success'))
                        <div class="alert alert-success" id='success-message'>
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-striped table-hover table-bordered table-sm dataTable dtr-inline fixed " style ='overflow-x: auto;' id ="dispositivos">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Serie</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Fecha de compra</th>
                            <th scope="col">IP</th>
                            <th scope="col">Office</th>
                            <th scope="col">Colaborador</th>
                            <th scope="col">Almacenamiento</th>
                            <th scope="col">ID de Anydesk</th>
                            <th scope="col">OS</th>
                            <th scope="col">Estado</th>
                            <th scope="col" style="width: 20%;">Accion</th>
                            </tr>
                        </thead>
                    </table>
    </div>
</div>


<script type="text/javascript">
let rutaTabla = "{{route('devices.index')}}";
$(document).ready(function() {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var table =$('#dispositivos').DataTable({

            dom : 'lBfrtip',
                buttons: [
                    'excel', 'pdf', 'print','colvis'
                ],
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                bLengthChange: true,
                pageLength: 10,
           processing: true,
           scrollX: true,
           scrollY: '50vh', // Altura fija de la tabla
           scrollCollapse: true,
           autoWidth: false,
           responsive: true,
           serverSide: true,

            ajax: {
                url: "{{ route('devices.pagination') }}",
                type: "GET",
                 error : function(xhr, textStatus, errorThrown){

                    console.log('error'+JSON.stringify(xhr))
                }
            },
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'serialnumber', name: 'serialnumber' },
                    { data: 'brand.name', name: 'brand.name' },
                    { data: 'carmodel.name', name: 'carmodel.name' },
                    { data: 'datedevicepurchase', name: 'datedevicepurchase'},
                    { data: 'ipaddress.ip', name: 'ipaddress.ip' },
                    { data: 'microsoftoffice.name', name: 'microsoftoffice.name'},
                    { data: 'employee.name', name: 'employee.name' },
                    { data: 'diskstorage.name', name: 'diskstorage.name',visible: false },
                    { data: 'anydesknumber', name: 'anydesknumber'},
                    { data: 'operatingsystem.name', name: 'operatingsystem.name',visible: false },
                    { data: 'status', name: 'status' ,visible: true},
                     {data: 'action', name: 'action', orderable: false},
                 ],
                 order: [[0, 'desc']],
                 language: {
                    url:'/es-ES.json',
                    },
       }).buttons().container().appendTo('#dispositivos_wrapper .col-md-6:eq(1)');

       // Ocultar el mensaje después de 5 segundos (5000 milisegundos)
        setTimeout(function() {
            $('#success-message').fadeOut('slow');
        }, 2000); // Cambiar 5000 por el número de milisegundos que desees

});
</script>

@endsection


