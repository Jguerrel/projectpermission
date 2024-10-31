<?php

namespace App\Http\Controllers;

use App\Models\Diskstorage;
use App\Http\Requests\StoreDiskstorageRequest;
use App\Http\Requests\UpdateDiskstorageRequest;
use Illuminate\View\View;
class DiskstorageController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('permission:ver-tamanio_de_discos', ['only' => ['index']]);
        $this->middleware('permission:crear-tamanio_de_discos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-tamanio_de_discos', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-tamanio_de_discos', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('diskstorages.index', [
            'diskstorages' => Diskstorage::orderBy('id','ASC')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('diskstorages.create');
    }

    /*Paginacion de datos*/
    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Diskstorage::select('*'))
            ->editColumn('status', function(Diskstorage $diskstorage) {
                return  '<span class="text-'. ($diskstorage->status ? 'success' : 'danger') .'">'. ($diskstorage->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (Diskstorage $diskstorage) use ($user) {

                $btn = '<form action='.route("diskstorages.destroy",$diskstorage->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Quieres eliminar el tipo de disco?");';
                if ($user->can('ver-tamanio_de_discos'))
                {
                   $btn  = $btn . '<a href="'.route("diskstorages.show",$diskstorage->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-tamanio_de_discos'))
                {
                    $btn =$btn.'<a href="'.route("diskstorages.edit",$diskstorage->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-tamanio_de_discos'))
                {
                    $btn =$btn.'<button type="submit" class="btn btn-danger btn-sm" onclick="'. $onclick.'"><i class="fas fa-trash"></i> Eliminar</button>';
                }

                  $btn =$btn .'</form>';
                  return $btn;

            })
            ->rawColumns(['status','action'])
            ->addIndexColumn()
	        ->make(true);
	    }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiskstorageRequest $request)
    {
        Diskstorage::create($request->all());
        return redirect()->route('diskstorages.index')
                ->withSuccess('Tipo de disco ha sido agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diskstorage $diskstorage)
    {
        return view('diskstorages.show', [
            'diskstorage' => $diskstorage
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diskstorage $diskstorage)
    {
        return view('diskstorages.edit', [
            'diskstorage' => $diskstorage
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiskstorageRequest $request, Diskstorage $diskstorage)
    {
        $diskstorage->update($request->all());
        return redirect()->route('diskstorages.index')
                ->withSuccess('Tamaño ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diskstorage $diskstorage)
    {
        $diskstorage->delete();
        return redirect()->route('diskstorages.index')
                ->withSuccess('Tipo de disco ha sido eliminado correctamente');
    }
}
