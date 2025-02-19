<?php

namespace App\Http\Controllers;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\http\Requests\StoreSizeRequest;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {

         $this->middleware('auth');
         $this->middleware('permission:ver-tallas', ['only' => ['index']]);
         $this->middleware('permission:crear-tallas', ['only' => ['create','store']]);
         $this->middleware('permission:editar-tallas', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar-tallas', ['only' => ['destroy']]);
     }


    public function index()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Size::select('*'))
            ->editColumn('status', function(Size $size) {
                return  '<span class="text-'. ($size->status ? 'success' : 'danger') .'">'. ($size->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (Size $size) use ($user) {

                $btn = '<form action='.route("sizes.destroy",$size->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-tallas'))
                {
                   $btn  = $btn . '<a href="'.route("sizes.show",$size->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-tallas'))
                {
                    $btn =$btn.'<a href="'.route("sizes.edit",$size->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-tallas'))
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
        return view('sizes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizeRequest $request)
    {
        Size::create($request->all());
        return redirect()->route('sizes.index')
                ->withSuccess('Talla ha sido agregada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        return view('sizes.show', [
            'size' => $size
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        return view('sizes.edit', [
            'size' => $size
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
