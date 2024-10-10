@extends('adminlte::page')

@section('content')
<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permisos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Permisos</a></li>

                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
</section>

<div class="card card-info card-outline">
    <!-- <div class="card-header">Permisos</div> -->

    <div class="card-body">
       @can('crear-permisos')
            <a href="{{ route('permissions.create') }}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <table class="table table-striped table-bordered dataTable dtr-inline" id ='tablepermiso'>
        <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Permiso</th>
                <th scope="col">Fecha de Creación</th>
                <th scope="col"  style="width: 20%;">Accion</th>
                </tr>
            </thead>


       </table>
   </div>
</div>

<script type="text/javascript">

$(document).ready(function() {


    $('#tablepermiso').DataTable({
           processing: true,
           serverSide: true,
           language: {
           url: 'https://cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
            },
           ajax: {
                url: "{{ route('permissions.pagination') }}",
                type: "GET",
                //  success:function(data){
                //  alert(JSON.stringify(data))
                // },
                 error : function(xhr, textStatus, errorThrown){

                    console.log('error'+JSON.stringify(xhr))
                }
            },
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                     {data: 'action', name: 'action', orderable: false},
                 ],
                 order: [[0, 'desc']]
       });

});
</script>



@endsection

