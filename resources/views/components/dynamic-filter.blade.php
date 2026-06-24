{{-- ============================================================
     Componente: <x-dynamic-filter>  — Query Builder style
     Uso:
       <x-dynamic-filter
           table-id="dispositivos"
           :filters="[
               ['id' => 'sucursal', 'label' => 'Sucursal', 'type' => 'text'],
               ['id' => 'status',   'label' => 'Estado',   'type' => 'select',
                'options' => ['' => 'Todos', '1' => 'Activo', '0' => 'Inactivo']],
               ['id' => 'fecha',    'label' => 'Fecha',    'type' => 'date'],
           ]"
       />

     En el DataTable de la vista, agrega en el ajax.data:
       data: function(d) { $.extend(d, window.getTableFilters('dispositivos')); }
     ============================================================ --}}

<div id="{{ $tableId }}-filters" class="mb-3 border rounded p-2 bg-light">

    {{-- Contenedor de filas de filtro (JS las inyecta aquí) --}}
    <div id="{{ $tableId }}-filter-rows"></div>

    {{-- Acciones globales --}}
    <div class="mt-2">
        <button type="button"
            class="btn btn-sidebar btn-sm qb-add-row"
            data-table="{{ $tableId }}">
            <i class="fas fa-plus"></i> Agregar filtro
        </button>
        <button type="button"
            class="btn btn-outline-secondary btn-sm qb-clear-all ml-1"
            data-table="{{ $tableId }}">
            <i class="fas fa-times"></i> Limpiar
        </button>
    </div>

</div>

<script>
(function () {
    var TABLE_ID   = '{{ $tableId }}';
    var FIELDS     = @json($filters);   // array de {id, label, type, options?, placeholder?}
    var rowCounter = 0;

    /* ── Mapa de campos por id ─────────────────────────────────── */
    var fieldMap = {};
    FIELDS.forEach(function (f) { fieldMap[f.id] = f; });

    /* ── Operadores disponibles por tipo ───────────────────────── */
    var OPERATORS = {
        text:   [
            { value: 'contains',    label: 'Contiene' },
            { value: 'equals',      label: 'Es igual a' },
            { value: 'starts_with', label: 'Comienza con' },
            { value: 'not_contains',label: 'No contiene' },
        ],
        select: [
            { value: 'equals', label: 'Es igual a' },
        ],
        date: [
            { value: 'equals', label: 'Es igual a' },
            { value: 'gte',    label: 'Mayor o igual' },
            { value: 'lte',    label: 'Menor o igual' },
        ],
    };

    /* ── Renderiza el input de valor según tipo de campo ────────── */
    function buildValueInput(field, rowId) {
        if (field.type === 'select') {
            var opts = Object.entries(field.options || {}).map(function (pair) {
                return '<option value="' + pair[0] + '">' + pair[1] + '</option>';
            }).join('');
            return '<select class="form-control form-control-sm qb-value" id="qb-val-' + rowId + '">' + opts + '</select>';
        }
        if (field.type === 'date') {
            return '<input type="date" class="form-control form-control-sm qb-value" id="qb-val-' + rowId + '">';
        }
        return '<input type="text" class="form-control form-control-sm qb-value" id="qb-val-' + rowId + '" placeholder="' + (field.placeholder || 'Valor...') + '">';
    }

    /* ── Renderiza una fila completa ────────────────────────────── */
    function buildRow(rowId) {
        var firstField = FIELDS[0];

        /* Opciones del selector de campo */
        var fieldOpts = FIELDS.map(function (f) {
            return '<option value="' + f.id + '">' + f.label + '</option>';
        }).join('');

        /* Opciones del selector de operador (para el primer campo) */
        var ops = OPERATORS[firstField.type] || OPERATORS.text;
        var opOpts = ops.map(function (o) {
            return '<option value="' + o.value + '">' + o.label + '</option>';
        }).join('');

        var valueInput = buildValueInput(firstField, rowId);

        return '<div class="form-row align-items-center mb-2 qb-row" data-row-id="' + rowId + '" data-table="' + TABLE_ID + '">'
            + '<div class="col-auto"><span class="text-muted small font-weight-bold">Buscar en</span></div>'
            + '<div class="col-md-3 col-sm-4">'
            +   '<select class="form-control form-control-sm qb-field" data-row="' + rowId + '">' + fieldOpts + '</select>'
            + '</div>'
            + '<div class="col-auto"><span class="text-muted small font-weight-bold">valor</span></div>'
            + '<div class="col-md-2 col-sm-3">'
            +   '<select class="form-control form-control-sm qb-op" data-row="' + rowId + '">' + opOpts + '</select>'
            + '</div>'
            + '<div class="col" id="qb-val-wrap-' + rowId + '">' + valueInput + '</div>'
            + '<div class="col-auto">'
            +   '<button type="button" class="btn btn-danger btn-sm qb-remove-row" data-row="' + rowId + '" title="Eliminar filtro">'
            +     '<i class="fas fa-minus"></i>'
            +   '</button>'
            + '</div>'
            + '</div>';
    }

    /* ── Agrega una nueva fila ──────────────────────────────────── */
    function addRow() {
        var rowId = TABLE_ID + '-r' + (rowCounter++);
        $('#' + TABLE_ID + '-filter-rows').append(buildRow(rowId));
    }

    /* ── Recarga el DataTable ────────────────────────────────────  */
    function reloadTable() {
        if ($.fn.DataTable.isDataTable('#' + TABLE_ID)) {
            $('#' + TABLE_ID).DataTable().ajax.reload(null, false);
        }
    }

    /* ── Colector de filtros para esta tabla ────────────────────── */
    window.dtFilterCollectors = window.dtFilterCollectors || {};
    window.dtFilterCollectors[TABLE_ID] = function () {
        var result = {};
        $('#' + TABLE_ID + '-filter-rows .qb-row').each(function () {
            var rowId = $(this).data('row-id');
            var field = $(this).find('.qb-field').val();
            var op    = $(this).find('.qb-op').val();
            var val   = $(this).find('.qb-value').val();

            if (!field || val === '' || val === null || val === undefined) return;

            /* Mapea operador a sufijo de parámetro */
            if (op === 'gte') {
                result[field + '_gte'] = val;
            } else if (op === 'lte') {
                result[field + '_lte'] = val;
            } else if (op === 'starts_with') {
                result[field + '_sw'] = val;
            } else if (op === 'not_contains') {
                result[field + '_nc'] = val;
            } else {
                result[field] = val;   /* contains / equals → mismo key que antes */
            }
        });
        return result;
    };

    /* ── Helper global (compatible hacia atrás) ─────────────────── */
    window.getTableFilters = window.getTableFilters || function (tableId) {
        if (window.dtFilterCollectors && window.dtFilterCollectors[tableId]) {
            return window.dtFilterCollectors[tableId]();
        }
        return {};
    };

    /* ── Eventos globales (se registran una sola vez) ───────────── */
    if (!window._qbHandlersRegistered) {
        window._qbHandlersRegistered = true;

        /* Cambio de campo → actualizar operadores y valor */
        $(document).on('change', '.qb-field', function () {
            var rowId  = $(this).data('row');
            var field  = fieldMap[$(this).val()];
            if (!field) return;

            var ops = OPERATORS[field.type] || OPERATORS.text;
            var opOpts = ops.map(function (o) {
                return '<option value="' + o.value + '">' + o.label + '</option>';
            }).join('');
            $('.qb-op[data-row="' + rowId + '"]').html(opOpts);
            $('#qb-val-wrap-' + rowId).html(buildValueInput(field, rowId));
            reloadTable();
        });

        /* Cambio de valor → recargar con debounce (keyup espera 400 ms) */
        var _qbDebounceTimers = {};
        $(document).on('keyup', '.qb-value', function () {
            var tableId = $(this).closest('.qb-row').data('table');
            if (!tableId) return;
            clearTimeout(_qbDebounceTimers[tableId]);
            _qbDebounceTimers[tableId] = setTimeout(function () {
                if ($.fn.DataTable.isDataTable('#' + tableId)) {
                    $('#' + tableId).DataTable().ajax.reload(null, false);
                }
            }, 400);
        });

        /* Cambio de operador o select → recargar inmediato */
        $(document).on('change', '.qb-value, .qb-op', function () {
            var tableId = $(this).closest('.qb-row').data('table');
            if (tableId && $.fn.DataTable.isDataTable('#' + tableId)) {
                clearTimeout(_qbDebounceTimers[tableId]);
                $('#' + tableId).DataTable().ajax.reload(null, false);
            }
        });

        /* Eliminar fila */
        $(document).on('click', '.qb-remove-row', function () {
            var rowId   = $(this).data('row');
            var tableId = $(this).closest('.qb-row').data('table');
            $('.qb-row[data-row-id="' + rowId + '"]').remove();
            if (tableId && $.fn.DataTable.isDataTable('#' + tableId)) {
                $('#' + tableId).DataTable().ajax.reload(null, false);
            }
        });

        /* Agregar fila */
        $(document).on('click', '.qb-add-row', function () {
            var tableId = $(this).data('table');
            /* Busca el componente correcto por table-id */
            window._qbAddRow && window._qbAddRow[tableId] && window._qbAddRow[tableId]();
        });

        /* Limpiar todo */
        $(document).on('click', '.qb-clear-all', function () {
            var tableId = $(this).data('table');
            $('#' + tableId + '-filter-rows').empty();
            window._qbAddRow && window._qbAddRow[tableId] && window._qbAddRow[tableId]();
            if ($.fn.DataTable.isDataTable('#' + tableId)) {
                $('#' + tableId).DataTable().ajax.reload(null, false);
            }
        });
    }

    /* ── Registra la función addRow para este table-id ──────────── */
    window._qbAddRow = window._qbAddRow || {};
    window._qbAddRow[TABLE_ID] = addRow;

    /* ── Inicia con una fila vacía ──────────────────────────────── */
    addRow();

})();
</script>
