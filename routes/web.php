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
use App\Http\Controllers\MicrosoftofficeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginUsersController;
use App\Http\Controllers\DiskstorageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PasswordController;


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
// Register the new login route

Route::get('/', function () {
    return view('auth.login');
});



Route::group(['prefix' => 'admin','middleware' => ['auth']], function() {

    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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
    Route::resource('microsoftoffices',MicrosoftofficeController::class);
    //Route::resource('newsletters',NewsletterController::class);
    Route::resource('diskstorages',DiskstorageController::class);
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
    Route::get('microsoftoffices.pagination', [MicrosoftofficeController::class, 'pagination'])->name('microsoftoffices.pagination');
    Route::get('diskstorages.pagination', [DiskstorageController::class, 'pagination'])->name('diskstorages.pagination');
    Route::post('/uploadinvoice', [DeviceController::class, 'uploadinvoice'])->name('uploadinvoice.file');
    Route::get('/cargarfacturamultiple', [DeviceController::class, 'cargarfacturamultiple'])->name('devices.cargarfacturamultiple');
    Route::post('/cargarfacturamultiplepost', [DeviceController::class, 'cargarfacturamultiplepost'])->name('devices.cargarfacturamultiplepost');
    Route::get('/reset-password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/reset-password', [PasswordController::class, 'update'])->name('password.update');
});

//Rutas de paginacion////

Route::post('/direccionesip', [IpaddressController::class, 'direccionesip'])->name('ipaddresses.direccionesip');
Route::post('/modelos', [CarModelController::class, 'modelos'])->name('carmodels.modelos');

