@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Listado de IP </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Listado de IP</a></li>

                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>

<div class="card card-info card-outline">
    <div class="card-body">
         @can('crear-colaboradores')
            <a href="{{ route('employees.create') }}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <table class="table table-striped table-bordered dataTable dtr-inline" id ="direccionesip">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">IP</th>
                <th scope="col">Fecha de Creacion</th>
                <th scope="col">Fecha de Actualizacion</th>
                <th scope="col">Sucursal</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>

       </table>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {

    $('#direccionesip').DataTable({
        language: {
                    url:'/es-ES.json',
                    },
           processing: true,
           serverSide: true,
           ajax: {
                url: "{{ route('ipaddresses.pagination') }}",
                type: "GET",
                // success:function(data){
                //  alert(JSON.stringify(data))
                // },
                 error : function(xhr, textStatus, errorThrown){

                    console.log('error'+JSON.stringify(xhr))
                }
            },
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'ip', name: 'ip' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'branch_office.name', name: 'branch_office.name'},
                     {data: 'action', name: 'action', orderable: false},
                 ],
            order: [[0, 'asc']],
            "columnDefs": [
            {
                "targets": [2,3], // Índice de la columna 'created_at'
                "render": function(data, type, row) {
                    // Convertir la fecha y hora a una fecha
                    return moment(data).format('DD-MM-YYYY');
                }
            }
        ]
       });

});
</script>

@endsection
