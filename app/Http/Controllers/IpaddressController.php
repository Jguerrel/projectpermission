<?php

namespace App\Http\Controllers;

use App\Models\Ipaddress;
use Illuminate\Http\Request;
use App\Models\BranchOffice;
use App\Http\Requests\StoreIpaddressRequest;
use App\Http\Requests\UpdateIpaddressRequest;

class IpaddressController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('permission:ver-direccionesip', ['only' => ['index']]);
        $this->middleware('permission:crear-direccionesip', ['only' => ['create','store']]);
        $this->middleware('permission:editar-direccionesip', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-direccionesip', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ipaddresses.index');
    }

    public function direccionesip(Request $request)
    {
        $id = $request->input('id');
         $direccionesip = Ipaddress::where('branch_office_id', $id)->get();
         return response()->json($direccionesip);

    }

    public function pagination(Request $request)
    {
        $user = Auth()->user();
        if(request()->ajax()) {
            $data = Ipaddress::with('branch_office')->select('*');
            if ($request->filled('ip')) {
                $data->where('ip', 'like', '%' . $request->ip . '%');
            }
            if ($request->filled('ip_sw')) {
                $data->where('ip', 'like', $request->ip_sw . '%');
            }
            if ($request->filled('ip_nc')) {
                $data->where('ip', 'not like', '%' . $request->ip_nc . '%');
            }
            if ($request->filled('sucursal')) {
                $data->whereHas('branch_office', fn($q) => $q->where('name', 'like', '%' . $request->sucursal . '%'));
            }
            if ($request->filled('sucursal_sw')) {
                $data->whereHas('branch_office', fn($q) => $q->where('name', 'like', $request->sucursal_sw . '%'));
            }
            if ($request->filled('sucursal_nc')) {
                $data->whereHas('branch_office', fn($q) => $q->where('name', 'not like', '%' . $request->sucursal_nc . '%'));
            }
	        return Datatables()->of($data)
	        ->addColumn('action', function (Ipaddress $ipaddress) use ($user) {

                $btn = '<form action='.route("ipaddresses.destroy",$ipaddress->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Do you want to delete this user?");';
                if ($user->can('ver-direccionesip'))
                {
                   $btn  = $btn . '<a href="'.route("ipaddresses.show",$ipaddress->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-direccionesip'))
                {
                    $btn =$btn.'<a href="'.route("ipaddresses.edit",$ipaddress->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-direccionesip'))
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


    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branch_offices = BranchOffice::all();
        return view('ipaddresses.create',compact('branch_offices') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIpaddressRequest $request)
    {
        Ipaddress::create($request->all());
        return redirect()->route('ipaddresses.index')
                ->withSuccess('Direccion IP ha sido agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ipaddress $ipaddress)
    {
        return view('ipaddresses.show', [
            'ipaddress' => $ipaddress
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ipaddress = Ipaddress::with('branch_office')->findOrFail($id);;
        $branch_offices = BranchOffice::all();
        return view('ipaddresses.edit',compact('ipaddress','branch_offices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIpaddressRequest $request, Ipaddress $ipaddress)
    {
        $input = $request->all();

        $ipaddress->update($input);

        return redirect()->route('ipaddresses.index')
                ->withSuccess('Direccion IP ha sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ipaddress $ipaddress)
    {
        $ipaddress->delete();
        return redirect()->route('ipaddresses.index')
                ->withSuccess('Direccion ip ha sido eliminado correctamente');
    }
}
