@extends('adminlte::page')

@section('content_header')
    <h1>Permisos</h1>
@stop

@section('content')


<div class="card card-info card-outline">
    <!-- <div class="card-header">Permisos</div> -->

    <div class="card-body">
       @can('crear-permisos')
            <a href="{{ route('permissions.create') }}" class="btn btn-sidebar btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <x-dynamic-filter
            table-id="tablepermiso"
            :filters="[
                ['id' => 'name', 'label' => 'Permiso', 'type' => 'text', 'placeholder' => 'Buscar permiso...'],
            ]"
        />
        <table class="table table-striped table-bordered" id ='tablepermiso'>
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
                data: function(d) { $.extend(d, window.getTableFilters('tablepermiso')); },
                error: function(xhr) { console.log('error' + JSON.stringify(xhr)); }
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

