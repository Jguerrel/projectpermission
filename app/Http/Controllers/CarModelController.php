<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarmodelRequest;
use App\Http\Requests\UpdateModelRequest;
use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Laravel\Ui\Presets\Vue;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('carmodels.index', [
            'carmodels' => CarModel::orderBy('id','ASC')->paginate(10)
        ]);
    }

    public function modelos(Request $request)
    {
         $id = $request->input('id');
         $modelos = CarModel::where('brand_id', $id)->get();
         return response()->json($modelos);

    }

    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(CarModel::with('brand')->select('*'))
            ->editColumn('status', function(CarModel $carmodel) {
                return  '<span class="text-'. ($carmodel->status ? 'success' : 'danger') .'">'. ($carmodel->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (CarModel $carmodel) use ($user) {

                $btn = '<form action='.route("carmodels.destroy",$carmodel->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-modelos'))
                {
                   $btn  = $btn . '<a href="'.route("carmodels.show",$carmodel->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-modelos'))
                {
                    $btn =$btn.'<a href="'.route("carmodels.edit",$carmodel->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-modelos'))
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
        $brands = Brand::all();
        return view('carmodels.create',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarModelRequest $request): RedirectResponse
    {
         CarModel::create($request->all());
        return redirect()->route('carmodels.index')
                ->withSuccess('Modelo ha sido agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $carmodel)
    {
        return view('carmodels.show', [
            'carmodel' => $carmodel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carmodel = CarModel::with('brand')->findOrFail($id);
        $brands = Brand::get();
        return view('carmodels.edit',compact('carmodel','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModelRequest $request, CarModel $carmodel)
    {
        $carmodel->update($request->all());
        return redirect()->route('carmodels.index')
                ->withSuccess('Modelo ha sido actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $carmodel)
    {
        $carmodel->delete();
        return redirect()->route('carmodels.index')
                ->withSuccess('Modelo ha sido eliminado correctamente');
    }
}
