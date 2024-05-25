<?php

namespace App\Http\Controllers;

use App\Models\Ipaddress;
use Illuminate\Http\Request;
use App\Models\BranchOffice;

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
        //return view('ipaddresses.direccionesip', compact('ipaddresses'));
      
    }

    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Ipaddress::with('branch_office')->select('*'))
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
        return view('ipaddresses.pagination', compact('ipaddresses'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
