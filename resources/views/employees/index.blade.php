@extends('adminlte::page')

@section('content')

<section class="content-header" >
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Colaboradores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Colaboradores</a></li>

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
        <table class="table table-striped table-bordered dataTable dtr-inline" id ="employeedatatable">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Departamento</th>
                <th scope="col">Cargo</th>
                <th scope="col">Usuario</th>
                <th scope="col">Foto</th>
                <th scope="col">Estado</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>

       </table>
    </div>
</div>


<script type="text/javascript">
let rutaTabla = "{{route('employees.index')}}";
$(document).ready(function() {
    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#employeedatatable').DataTable({
          language: {
                    url:'/es-ES.json',
                    },
           processing: true,
           serverSide: true,
           ajax: {
                url: "{{ route('employees.pagination') }}",
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
                    { data: 'name', name: 'name' },
                    { data: 'department.name', name: 'department.name' },
                    { data: 'jobtitle.name', name: 'jobtitle.name' },
                    { data: 'usrcod', name: 'usrcod' },
                    { data: 'photo', name: 'photo' , orderable: false},
                    {data: 'status', name: 'status'},
                     {data: 'action', name: 'action', orderable: false},

                 ],
                 order: [[0, 'desc']]
       });

});
</script>

@endsection


