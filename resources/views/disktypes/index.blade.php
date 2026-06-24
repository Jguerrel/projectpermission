@extends('adminlte::page')

@section('content_header')
    <h1>Tipos de Discos</h1>
@stop

@section('content')


<div class="card card-info card-outline">
    <!-- <div class="card-header">Permisos</div> -->

    <div class="card-body">
       @can('crear-tipodiscos')
            <a href="{{ route('disktypes.create') }}" class="btn btn-sidebar btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <x-dynamic-filter
            table-id="tiposdiscos"
            :filters="[
                ['id' => 'name',   'label' => 'Tipo',   'type' => 'text',   'placeholder' => 'Buscar tipo...'],
                ['id' => 'status', 'label' => 'Estado', 'type' => 'select', 'options' => ['' => 'Todos', '1' => 'Activo', '0' => 'Inactivo']],
            ]"
        />
        <table class="table table-striped table-bordered" id ="tiposdiscos">
        <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>

       </table>
   </div>
</div>


<script type="text/javascript">

$(document).ready(function() {

    $('#tiposdiscos').DataTable({
          language: {
                    url:'/es-ES.json',
                    },
           processing: true,
           serverSide: true,
           ajax: {
                url: "{{ route('disktypes.pagination') }}",
                type: "GET",
                data: function(d) { $.extend(d, window.getTableFilters('tiposdiscos')); },
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

