@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cuentas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Cuentas</a></li>

                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>

<div class="card card-info card-outline">
    <!-- <div class="card-header">Cargos</div> -->

    <div class="card-body">
       @can('crear-cuentas')
            <a href="{{ route('accounts.create') }}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <table class="table table-striped table-bordered dataTable dtr-inline" id='cuentas'>
        <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Cuenta</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Link</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Estado</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>

       </table>
   </div>
</div>

<script type="text/javascript">

$(document).ready(function() {



    $('#cuentas').DataTable({
        language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
         },
           processing: true,
           serverSide: true,
           ajax: {
                url: "{{ route('accounts.pagination') }}",
                type: "GET",
                 error : function(xhr, textStatus, errorThrown){

                    console.log('error'+JSON.stringify(xhr))
                }
            },
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'password', name: 'password' },
                    { data: 'link', name: 'link' },
                    { data: 'description', name: 'description' },
                    { data: 'status', name: 'status' },
                     {data: 'action', name: 'action', orderable: false},
                 ],
                 order: [[0, 'desc']],
        columnDefs: [
            {
                "targets": 2, // Índice de la columna de contraseña
                "render": function ( data, type, row ) {
                    // Si el tipo es display, renderiza el input password
                    if(type === 'display') {
                        return '<span  style="-webkit-text-security:disc;">' + data + '" </span>';
                    }
                    // De lo contrario, devuelve el dato tal cual
                    return data;
                }
            }
        ]
       });

});
</script>

@endsection
