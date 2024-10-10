@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sistema Operativo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Sistema Operativo</a></li>

                    </ol>
                </div>
                </div>
            </div>
</section>

<div class="card card-info card-outline">

    <div class="card-body">
       @can('crear-sistemaoperativos')
            <a href="{{ route('operatingsystems.create') }}" class="btn btn-info btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <table class="table table-striped dataTable table-bordered "  id ="sistemaoperativo">
        <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Sistema Operativo</th>
                <th scope="col">Estado</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>

       </table>
   </div>
</div>


<script type="text/javascript">

$(document).ready(function() {

    $('#sistemaoperativo').DataTable({
          language: {
                    url:'/es-ES.json',
                    },
           processing: true,
           serverSide: true,
           ajax: {
                url: "{{ route('operatingsystems.pagination') }}",
                type: "GET",
                 error : function(xhr, textStatus, errorThrown){

                    console.log('error'+JSON.stringify(xhr))
                }
            },
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                     {data: 'status', name: 'status'},
                     {data: 'action', name: 'action', orderable: false},

                 ],
                 order: [[0, 'desc']]
       });
});
</script>

@endsection

