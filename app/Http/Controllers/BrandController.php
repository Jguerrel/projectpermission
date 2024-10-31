<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{

    public function __construct()
    {

         $this->middleware('auth');
         $this->middleware('permission:ver-marcas', ['only' => ['index']]);
         $this->middleware('permission:crear-marcas', ['only' => ['create','store']]);
         $this->middleware('permission:editar-marcas', ['only' => ['edit','update']]);
         $this->middleware('permission:eliminar-marcas', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('brands.index', [
            'brands' => Brand::orderBy('id','ASC')->paginate(20)
        ]);
    }

    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Brand::select('*'))
            ->editColumn('status', function(Brand $brand) {
                return  '<span class="text-'. ($brand->status ? 'success' : 'danger') .'">'. ($brand->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (Brand $brand) use ($user) {

                $btn = '<form action='.route("brands.destroy",$brand->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-marcas'))
                {
                   $btn  = $btn . '<a href="'.route("brands.show",$brand->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-marcas'))
                {
                    $btn =$btn.'<a href="'.route("brands.edit",$brand->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-marcas'))
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->all());
        return redirect()->route('brands.index')
                ->withSuccess('Marca ha sido agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('brands.show', [
            'brand' => $brand
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit', [
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
                $brand->update($request->all());
                return redirect()->route('brands.index')
                        ->withSuccess('Marca ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')
                ->withSuccess('Marca ha sido eliminado correctamente');
    }
}
