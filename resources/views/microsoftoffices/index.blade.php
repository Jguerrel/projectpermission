@extends('adminlte::page')

@section('content_header')
    <h1>Licencia office</h1>
@stop

@section('content')


<div class="card card-info card-outline">

    <div class="card-body">
       @can('crear-marcas')
            <a href="{{ route('microsoftoffices.create')}}" class="btn btn-sidebar btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan
                     @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" id="success-message">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('errors') }}
                        </div>
                    @endif

        <x-dynamic-filter
            table-id="office"
            :filters="[
                ['id' => 'name',   'label' => 'Office', 'type' => 'text',   'placeholder' => 'Buscar licencia...'],
                ['id' => 'status', 'label' => 'Estado', 'type' => 'select', 'options' => ['' => 'Todos', '1' => 'Activo', '0' => 'Inactivo']],
            ]"
        />
        <table class="table table-striped table-bordered" id ="office">
        <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Office</th>
                <th scope="col">Estado</th>
                <th scope="col" style="width: 20%;">Accion</th>
                </tr>
            </thead>

       </table>
   </div>
</div>


<script type="text/javascript">

$(document).ready(function() {

    $('#office').DataTable({
          language: {
                    url:'/es-ES.json',
                    },
           processing: true,
           serverSide: true,
           stateSave: true,
           stateDuration: 0,
           ajax: {
                url: "{{ route('microsoftoffices.pagination') }}",
                type: "GET",
                data: function(d) { $.extend(d, window.getTableFilters('office')); },
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

       setTimeout(function() {
            $('#success-message').fadeOut('slow');

        }, 4000); // tiempo antes de auto-ocultar el mensaje (ms)

});
</script>

@endsection

