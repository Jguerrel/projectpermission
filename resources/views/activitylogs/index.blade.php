@extends('adminlte::page')

@section('content_header')
    <h1>Registro de Actividad</h1>
@stop

@section('content')


<div class="card card-info card-outline">
    <div class="card-body">

        <x-dynamic-filter
            table-id="logs-table"
            :filters="[
                ['id' => 'module', 'label' => 'Módulo', 'type' => 'select', 'options' => [
                    '' => 'Todos', 'Device' => 'Dispositivos', 'Employee' => 'Colaboradores',
                    'User' => 'Usuarios', 'BranchOffice' => 'Sucursales', 'Department' => 'Departamentos',
                    'Ipaddress' => 'Direcciones IP', 'Brand' => 'Marcas', 'CarModel' => 'Modelos',
                    'Disktype' => 'Tipos de Disco', 'Diskstorage' => 'Tamaño de Disco',
                    'OperatingSystem' => 'Sistema Operativo', 'Microsoftoffice' => 'Office',
                    'Typedevice' => 'Tipos de Dispositivo', 'Account' => 'Cuentas',
                    'Size' => 'Tallas', 'Uniform' => 'Uniformes', 'Jobtitle' => 'Cargos',
                ]],
                ['id' => 'action', 'label' => 'Acción', 'type' => 'select', 'options' => [
                    '' => 'Todas', 'creado' => 'Creado', 'actualizado' => 'Actualizado', 'eliminado' => 'Eliminado',
                ]],
            ]"
        />

        <table class="table table-striped table-hover table-bordered table-sm" id="logs-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Módulo</th>
                    <th>Acción</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                </tr>
            </thead>
        </table>

    </div>
</div>

@stop

@section('js')
<script>
$(document).ready(function () {
    if ($.fn.DataTable.isDataTable('#logs-table')) {
        $('#logs-table').DataTable().destroy();
    }

    var table = $('#logs-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("activitylogs.pagination") }}',
            data: function (d) {
                $.extend(d, window.getTableFilters('logs-table'));
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'usuario',     name: 'user.name' },
            { data: 'module',      name: 'module' },
            { data: 'action',      name: 'action' },
            { data: 'message',     name: 'message' },
            { data: 'created_at', name: 'created_at' },
        ],
        order: [[0, 'desc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
    });

});
</script>
@stop
