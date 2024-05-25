<?php

namespace App\Http\Controllers;
use App\DataTables\ExportDataTable;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function index(ExportDataTable $dataTable)
    {
     return $dataTable->render('export');
    }
}
