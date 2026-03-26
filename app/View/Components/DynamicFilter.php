<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class DynamicFilter extends Component
{
    /**
     * @param string $tableId  ID del elemento <table> que DataTables usa
     * @param array  $filters  Lista de filtros. Cada filtro es un array con:
     *                           - id:          string  (se usa como id HTML: "filter-{id}")
     *                           - label:       string
     *                           - type:        'text' | 'select' | 'date'
     *                           - placeholder: string  (opcional, para text)
     *                           - options:     array   (para select: ['value' => 'label', ...])
     * @param int    $colSize  Columnas Bootstrap por filtro (1-12, default 3)
     */
    public function __construct(
        public string $tableId,
        public array  $filters  = [],
        public int    $colSize  = 3,
    ) {}

    public function render(): View
    {
        return view('components.dynamic-filter');
    }
}
