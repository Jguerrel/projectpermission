<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ver-logs', ['only' => ['index']]);
    }

    public function index(): View
    {
        return view('activitylogs.index');
    }

    public function pagination(Request $request)
    {
        $data = ActivityLog::with('user')
            ->when($request->filled('module'), fn($q) => $q->where('module', $request->module))
            ->when($request->filled('action'), fn($q) => $q->where('action', $request->action))
            ->orderBy('id', 'DESC');

        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('usuario', fn(ActivityLog $log) => $log->user?->name ?? 'Sistema')
                ->editColumn('action', fn(ActivityLog $log) => match ($log->action) {
                    'creado'      => '<span class="badge badge-success">Creado</span>',
                    'actualizado' => '<span class="badge badge-info">Actualizado</span>',
                    'eliminado'   => '<span class="badge badge-danger">Eliminado</span>',
                    default       => '<span class="badge badge-secondary">' . $log->action . '</span>',
                })
                ->editColumn('created_at', fn(ActivityLog $log) => $log->created_at->format('d/m/Y H:i:s'))
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }
}
