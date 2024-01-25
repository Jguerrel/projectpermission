<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CompaniaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TypedeviceController;
use App\Http\Controllers\AccountController;
/*
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/', function () {
    return redirect('/login');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resources([
//     'roles' => RoleController::class,
//     'users' => UserController::class,
//     'products' => ProductController::class,
//     'permissions' => PermissionController::class,
// ]);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin','middleware' => ['auth']], function() {
	Route::resource('roles', RoleController::class);
	Route::resource('users', UserController::class);
	Route::resource('permissions', PermissionController::class);
    Route::resource('products', ProductController::class);
    Route::resource('companias', CompaniaController::class);
    Route::resource('departamentos', DepartamentoController::class);
    Route::resource('cargos', CargoController::class);
    Route::resource('typedevices', TypedeviceController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('accounts', AccountController::class);
});
