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
         $this->middleware('permission:crear-cuenta|editar-cuenta|eliminar-cuenta', ['only' => ['index']]);
         $this->middleware('permission:crear-cuenta', ['only' => ['create','store']]);
         $this->middleware('permission:editar-cuenta', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar-cuenta', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('accounts.index', [
            'accounts' => Account::orderBy('id','ASC')->paginate(400)
        ]);
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
