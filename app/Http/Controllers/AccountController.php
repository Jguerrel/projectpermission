<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use Carbon\Carbon;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AccountController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
         $this->middleware('permission:ver-cuentas', ['only' => ['index']]);
         $this->middleware('permission:crear-cuentas', ['only' => ['create','store']]);
         $this->middleware('permission:editar-cuentas', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-cuentas', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('accounts.index', [
            'accounts' => Account::orderBy('id','ASC')->paginate(400)
        ]);
    }
    public function pagination()
    {
        $user = Auth()->user();
        if(request()->ajax()) {

	        return Datatables()->of(Account::select('*'))
            ->editColumn('status', function(Account $account) {
                return  '<span class="text-'. ($account->status ? 'success' : 'danger') .'">'. ($account->status ? 'Activo' : 'Inactivo').'</span>';
            })
	        ->addColumn('action', function (Account $account) use ($user) {

                $btn = '<form action='.route("accounts.destroy",$account->id).' method="post"><input type="hidden" name="_token"  value=" '.csrf_token().' " autocomplete="off"><input type="hidden" name="_method" value="DELETE">';
                $onclick='return confirm("Seguro que quieres eliminar esta cuenta?");';
                if ($user->can('ver-cuentas'))
                {
                   $btn  = $btn . '<a href="'.route("accounts.show",$account->id).'" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> Ver</a>';
                }

                if ($user->can('editar-cuentas'))
                {
                    $btn =$btn.'<a href="'.route("accounts.edit",$account->id).'" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</a>';
                }
                if ($user->can('eliminar-cuentas'))
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

    public function create(): View
    {
        return view('accounts.create');

    }

    public function store(StoreAccountRequest $request,Account $account): RedirectResponse
    {
        account::create($request->all());
        return redirect()->route('accounts.index')
        ->with('success','Cuenta creada correctamente');

    }

    public function show(Account $account)
    {
        return view('accounts.show', [
            'account' => $account
        ]);
    }

    public function edit(Account $account)
    {
        return view('accounts.edit', [
            'account' => $account
        ]);
    }

    public function update(UpdateAccountRequest $request, Account $account): RedirectResponse
    {
        $account->updated_at= Carbon::now();
        $account->update($request->all());
        return redirect()->route('accounts.index')
                ->withSuccess('Cuenta ha sido actualizado correctamente.');
    }
    public function destroy(Account $account): RedirectResponse
    {
        $account->delete();
        return redirect()->route('accounts.index')
                ->withSuccess('Cuenta ha sido eliminada correctamente');
    }

}
