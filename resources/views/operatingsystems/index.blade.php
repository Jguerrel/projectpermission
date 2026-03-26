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
            <a href="{{ route('operatingsystems.create') }}" class="btn btn-sidebar btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
        <x-dynamic-filter
            table-id="sistemaoperativo"
            :filters="[
                ['id' => 'name',   'label' => 'Sistema Operativo', 'type' => 'text',   'placeholder' => 'Buscar SO...'],
                ['id' => 'status', 'label' => 'Estado',            'type' => 'select', 'options' => ['' => 'Todos', '1' => 'Activo', '0' => 'Inactivo']],
            ]"
        />
        <table class="table table-striped table-bordered" id ="sistemaoperativo">
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
                data: function(d) { $.extend(d, window.getTableFilters('sistemaoperativo')); },
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

