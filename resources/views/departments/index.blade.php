@extends('adminlte::page')

@section('content_header')
    <h1>Departamentos</h1>
@stop

@section('content')


<div class="card card-info card-outline">
    <!-- <div class="card-header">Permisos</div> -->

    <div class="card-body">
       @can('crear-departamentos')
            <a href="{{ route('departments.create') }}" class="btn btn-sidebar btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <x-dynamic-filter
            table-id="departamento"
            :filters="[
                ['id' => 'name',   'label' => 'Departamento', 'type' => 'text',   'placeholder' => 'Buscar departamento...'],
                ['id' => 'status', 'label' => 'Estado',       'type' => 'select', 'options' => ['' => 'Todos', '1' => 'Activo', '0' => 'Inactivo']],
            ]"
        />
        <table class="table table-striped table-bordered" id ="departamento">
        <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Permiso</th>
                <th scope="col">Estado</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>

       </table>
   </div>
</div>


<script type="text/javascript">

$(document).ready(function() {

    $('#departamento').DataTable({
          language: {
                    url:'/es-ES.json',
                    },
           processing: true,
           serverSide: true,
           ajax: {
                url: "{{ route('departments.pagination') }}",
                type: "GET",
                data: function(d) { $.extend(d, window.getTableFilters('departamento')); },
                error: function(xhr) { console.log('error' + JSON.stringify(xhr)); }
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

