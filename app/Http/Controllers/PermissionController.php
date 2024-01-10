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
         $this->middleware('permission:show-permission', ['only' => ['index']]);
         $this->middleware('permission:create-permission', ['only' => ['create','store']]);
         $this->middleware('permission:edit-permission', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-permission', ['only' => ['destroy']]);
    }

    public function index(Request $request): View
    {
        return view('permissions.index', [
            'permissions' => Permission::orderBy('id','DESC')->paginate(20)
        ]);
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
