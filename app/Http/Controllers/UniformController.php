<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUniformRequest;
use App\Http\Requests\UpdateUniformRequest;
use App\Models\Uniform;
use Illuminate\Http\Request;

class UniformController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Uniform::select('*'))
            ->editColumn('status', function(Uniform $uniform) {
                return  '<span class="text-'. ($uniform->status ? 'success' : 'danger') .'">'. ($uniform->status ? 'Activo' : 'Inactivo').'</span>';
            })
            ->addColumn('action', function (Uniform $uniform) use ($user) {

                $btn = '<form action='.route("uniforms.destroy",$uniform->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-uniformes'))
                {
                   $btn  = $btn . '<a href="'.route("uniforms.show",$uniform->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-uniformes'))
                {
                    $btn =$btn.'<a href="'.route("uniforms.edit",$uniform->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-uniformes'))
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
        return view('uniforms.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('uniforms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUniformRequest $request)
    {
        $uniform = Uniform::create($request->only('name','status'));

        if ($request->has('uniformlevels')) {
            foreach ($request->uniformlevels as $uniformlevel) {
                $uniform->levels()->create($uniformlevel);
            }
        }

        return redirect()->route('uniforms.index')->with('success', 'Uniforme creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Uniform $uniform)
    {
        return view('uniforms.show', compact('uniform'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uniform $uniform)
    {
        return view('uniforms.edit', compact('uniform')); //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUniformRequest $request, Uniform $uniform)
    {
        $uniform->update($request->only('name', 'status'));

        // Eliminar detalles antiguos y agregar los nuevos
        $uniform->levels()->delete();

        foreach ($request->levels as $level) {
            $uniform->levels()->create($level);
        }

        return redirect()->route('uniforms.index')->with('success', 'Uniforme actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
