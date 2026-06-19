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
            <a href="{{ route('accounts.create') }}" class="btn btn-sidebar btn-sm my-2"><i class="fas fa-plus-circle"></i> Nuevo</a>
        @endcan

        <x-dynamic-filter
            table-id="cuentas"
            :filters="[
                ['id' => 'name',   'label' => 'Cuenta',  'type' => 'text',   'placeholder' => 'Buscar cuenta...'],
                ['id' => 'status', 'label' => 'Estado',  'type' => 'select', 'options' => ['' => 'Todos', '1' => 'Activo', '0' => 'Inactivo']],
            ]"
        />

        <table class="table table-striped table-bordered" id='cuentas'>
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
                data: function(d) { $.extend(d, window.getTableFilters('cuentas')); },
                error: function(xhr) { console.log('error' + JSON.stringify(xhr)); }
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
                "targets": 2, // Columna de contraseña: enmascarada con botón mostrar/ocultar
                "orderable": false,
                "searchable": false,
                "render": function ( data, type, row ) {
                    if (type !== 'display') {
                        return data;
                    }
                    if (!data) {
                        return '';
                    }
                    // Escapar el valor antes de meterlo en el atributo
                    var safe = $('<div>').text(data).html();
                    return '<span class="acct-pass" data-pass="' + safe + '">••••••••</span>' +
                           ' <button type="button" class="btn btn-xs btn-link p-0 ml-1 toggle-pass" ' +
                           'title="Mostrar/ocultar"><i class="fas fa-eye"></i></button>';
                }
            }
        ]
       });

    // Mostrar/ocultar contraseña (delegado, funciona con paginación AJAX)
    $('#cuentas tbody').on('click', '.toggle-pass', function () {
        var $btn  = $(this);
        var $span = $btn.siblings('.acct-pass').first();
        var $icon = $btn.find('i');
        if ($span.data('shown')) {
            $span.text('••••••••').data('shown', false);
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $span.text($span.attr('data-pass')).data('shown', true);
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });

});
</script>

@endsection
