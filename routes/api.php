<?php

use App\Http\Controllers\Api\AccountApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CarModelApiController;
use App\Http\Controllers\Api\DeviceApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use App\Http\Controllers\Api\IpaddressApiController;
use App\Http\Controllers\Api\TypedeviceApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes  —  todas bajo el prefijo /api
|--------------------------------------------------------------------------
*/

/* ── Autenticación (pública) ─────────────────────────────────────────── */
Route::prefix('auth')->group(function () {
    Route::post('login',       [AuthApiController::class, 'login']);       // clientes API
    Route::post('login-user',  [AuthApiController::class, 'loginUser']);   // usuarios del panel web
    Route::post('logout',      [AuthApiController::class, 'logout'])->middleware('auth:sanctum');
});

/* ── Recursos protegidos con token Sanctum ───────────────────────────── */
Route::middleware('auth:sanctum')->group(function () {

    // Dispositivos
    Route::get ('devices',     [DeviceApiController::class, 'index']);
    Route::post('devices',     [DeviceApiController::class, 'store']);

    // Cuentas (solo consulta)
    Route::get('accounts',     [AccountApiController::class, 'index']);

    // Tipos de dispositivo
    Route::get ('typedevices',        [TypedeviceApiController::class, 'index']);
    Route::post('typedevices',        [TypedeviceApiController::class, 'store']);
    Route::put ('typedevices/{id}',   [TypedeviceApiController::class, 'update']);

    // Modelos
    Route::get ('carmodels',          [CarModelApiController::class, 'index']);
    Route::post('carmodels',          [CarModelApiController::class, 'store']);
    Route::put ('carmodels/{id}',     [CarModelApiController::class, 'update']);

    // Direcciones IP
    Route::get ('ipaddresses',        [IpaddressApiController::class, 'index']);
    Route::post('ipaddresses',        [IpaddressApiController::class, 'store']);
    Route::put ('ipaddresses/{id}',   [IpaddressApiController::class, 'update']);

    // Colaboradores
    Route::get ('employees',          [EmployeeApiController::class, 'index']);
    Route::post('employees',          [EmployeeApiController::class, 'store']);
    Route::put ('employees/{id}',     [EmployeeApiController::class, 'update']);

});
