<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TypedeviceController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BranchOfficeController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DisktypeController;
use App\Http\Controllers\IpaddressController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\OperatingSystemController;
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


Route::group(['prefix' => 'admin','middleware' => ['auth']], function() {
	Route::resource('roles', RoleController::class);
	Route::resource('users', UserController::class);
	Route::resource('permissions', PermissionController::class);
    Route::resource('products', ProductController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('jobtitles', JobTitleController::class);
    Route::resource('typedevices', TypedeviceController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('products', ProductController::class);
    Route::resource('accounts', AccountController::class);
    Route::resource('branchoffices', BranchOfficeController::class);
    Route::resource('devices', DeviceController::class);
    Route::resource('disktypes', DisktypeController::class);
    Route::resource('ipaddresses',IpaddressController::class);
    Route::resource('brands',BrandController::class);
    Route::resource('carmodels',CarModelController::class);
    Route::resource('operatingsystems',OperatingSystemController::class);


    /*Paginacion*/
    Route::get('employees.pagination', [EmployeeController::class, 'pagination'])->name('employees.pagination');
    Route::get('branchoffices.pagination', [BranchOfficeController::class, 'pagination'])->name('branchoffices.pagination');
    Route::get('departments.pagination', [DepartmentController::class, 'pagination'])->name('departments.pagination');
    Route::get('devices.pagination', [DeviceController::class, 'pagination'])->name('devices.pagination');
    Route::get('accounts.pagination', [AccountController::class, 'pagination'])->name('accounts.pagination');
    Route::get('disktypes.pagination', [DisktypeController::class, 'pagination'])->name('disktypes.pagination');
    Route::get('jobtitles.pagination', [JobTitleController::class, 'pagination'])->name('jobtitles.pagination');
    Route::get('carmodels.pagination', [CarModelController::class, 'pagination'])->name('carmodels.pagination');
    Route::get('brands.pagination', [BrandController::class, 'pagination'])->name('brands.pagination');
    Route::get('permissions.pagination', [PermissionController::class, 'pagination'])->name('permissions.pagination');
    Route::get('ipaddresses.pagination', [IpaddressController::class, 'pagination'])->name('ipaddresses.pagination');
    Route::get('operatingsystems.pagination', [OperatingSystemController::class, 'pagination'])->name('operatingsystems.pagination');
});

//Rutas de paginacion////


//Route::get('ipadresses', [IpaddressController::class, 'pagination'])->name('ipaddresses.pagination');
Route::post('/direccionesip', [IpaddressController::class, 'direccionesip'])->name('ipaddresses.direccionesip');
//Route::get('permissioneskema', [PermissionEskemaController::class, 'permissioneskema']);
//Route::resource('permissioneskema ', PermissionEskemaController::class);
//Route::get('acccessobjeto', [App\Http\Controllers\PermissionEskemaController::class, 'acccessobjeto'])->name('acccessobjeto');
//Route::get('employees/getemployee', 'EmployeeController@getemployee')->name('employees.getemployee');
