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
        @endcan
                    <table class="table table-striped table-hover table-bordered table-sm dataTable dtr-inline " id ="dispositivos">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Serie</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Sistema operativo</th>
                            <th scope="col">Fecha de compra</th>
                            <th scope="col">IP</th>
                            <th scope="col">Office</th>
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
                    { data: 'operatingsystem.name', name: 'operatingsystem.name' },
                    { data: 'datedevicepurchase', name: 'datedevicepurchase'},
                    { data: 'ipaddress.ip', name: 'ipaddress.ip' },
                    { data: 'microsoftoffice.name', name: 'microsoftoffice.name' ,visible: true},
                    { data: 'status', name: 'status' ,visible: true},
                     {data: 'action', name: 'action', orderable: false},
                 ],
                 order: [[0, 'desc']],
                 language: {
                    url:'/es-ES.json',
                    },
       }).buttons().container().appendTo('#dispositivos_wrapper .col-md-6:eq(1)');

});
</script>

@endsection


