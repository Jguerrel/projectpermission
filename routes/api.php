<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\DeviceApiController;
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

    Route::prefix('devices')->group(function () {
        Route::get('/',  [DeviceApiController::class, 'index']);   // listar
        Route::post('/', [DeviceApiController::class, 'store']);   // registrar
    });

});
