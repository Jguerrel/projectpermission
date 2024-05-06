<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TypedeviceController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BranchOfficeController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DisktypeController;

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
    Route::resource('branches', BranchController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('jobtitles', JobTitleController::class);
    Route::resource('typedevices', TypedeviceController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('accounts', AccountController::class);
    Route::resource('branchoffices', BranchOfficeController::class);
    Route::resource('devices', DeviceController::class);
    Route::resource('disktypes', DisktypeController::class);
});

//Rutas de paginacion////
Route::get('employees', [EmployeeController::class, 'pagination'])->name('employees.pagination');
Route::get('devices', [DeviceController::class, 'pagination'])->name('devices.pagination');
Route::get('permissions', [PermissionController::class, 'pagination'])->name('permissions.pagination');
//Route::get('employees/getemployee', 'EmployeeController@getemployee')->name('employees.getemployee');
