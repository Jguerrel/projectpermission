<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\View\View;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:ver-permisos', ['only' => ['index']]);
         $this->middleware('permission:crear-permisos', ['only' => ['create','store']]);
         $this->middleware('permission:editar-permisos', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-permisos', ['only' => ['destroy']]);
    }

    public function index():view
    {
        return view('permissions.index');
        // , [
        //     'permissions' => Permission::orderBy('id','DESC')->paginate(20)
        // ]);


    }
    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

            return Datatables()->of(Permission::select('*'))
            ->addColumn('action', function (Permission $permission) use ($user) {

                $btn = '<form action='.route("permissions.destroy",$permission->id).' method="post"><input type="hidden" name="_token" value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-permisos'))
                {
                   $btn  = $btn . '<a href="'.route("permissions.show",$permission->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-permisos'))
                {
                    $btn =$btn.'<a href="'.route("permissions.edit",$permission->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-permisos'))
                {
                    $btn =$btn.'<button type="submit" class="btn btn-danger btn-sm" onclick="'. $onclick.'"><i class="fas fa-trash"></i> Eliminar</button>';
                }

                  $btn =$btn .'</form>';
                  return $btn;

            })

            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request): RedirectResponse
    {
        // $input =new $input();
        $input = $request->all();

        // $input->name =$request->name;
        // $input->guard_name =$request->guard_name;
        $permission = Permission::create($input);
        // $input->save();
        return redirect()->route('permissions.index')
        ->with('success','Permission created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('permissions.show', [
            'permission' => $permission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', [
            'permission' => $permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission  $permission)
    {
        $permission->update($request->all());
        return  redirect()->route('permissions.index')
                ->withSuccess('permiso ha sido actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')
                ->withSuccess('Permiso ha sido  eliminiado correctamente.');
    }
}
