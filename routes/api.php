<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CancelSopController;
use App\Http\Controllers\CustomSOPController;
use App\Http\Controllers\SopGeneralController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function() {
    Route::prefix('cancel_sop')->group(function() {
        Route::get('/', [CancelSopController::class, 'getAllList']);
        Route::get('/{id}', [CancelSopController::class, 'getDetailID']);
        Route::post('/add', [CancelSopController::class, 'add']);
        Route::put('/{id}', [CancelSopController::class, 'update']);
        Route::delete('/{id}', [CancelSopController::class, 'delete']);
    });

    Route::prefix('sop_general')->group(function() {
        Route::get('/', [SopGeneralController::class, 'getAllList']);
        Route::get('/{id}', [SopGeneralController::class, 'getDetailID']);
        Route::post('/add', [SopGeneralController::class, 'add']);
        Route::put('/{id}', [SopGeneralController::class, 'update']);
        Route::delete('/{id}', [SopGeneralController::class, 'delete']);
    });

    Route::prefix('fasilitas')->group(function() {
        Route::get('/', [FasilitasController::class, 'getAllList']);
        Route::get('/{id}', [FasilitasController::class, 'getDetailID']);
        Route::post('/add', [FasilitasController::class, 'add']);
        Route::put('/{id}', [FasilitasController::class, 'update']);
        Route::delete('/{id}', [FasilitasController::class, 'delete']);
    });

    Route::prefix('asuransi')->group(function() {
        Route::get('/', [AsuransiController::class, 'getAllList']);
        Route::get('/{id}', [AsuransiController::class, 'getDetailID']);
        Route::post('/add', [AsuransiController::class, 'add']);
        Route::put('/{id}', [AsuransiController::class, 'update']);
        Route::delete('/{id}', [AsuransiController::class, 'delete']);
    });

    Route::prefix('custom_sop')->group(function() {
        Route::get('/', [CustomSOPController::class, 'getAllList']);
        Route::get('/{id}', [CustomSOPController::class, 'getDetailID']);
        Route::post('/add', [CustomSOPController::class, 'add']);
        Route::put('/{id}', [CustomSOPController::class, 'update']);
        Route::delete('/{id}', [CustomSOPController::class, 'delete']);
    });


});