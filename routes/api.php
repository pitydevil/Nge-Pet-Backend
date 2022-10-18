<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CancelSopController;
use App\Http\Controllers\CustomSOPController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\AsuransiController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\MonitoringImageController;
use App\Http\Controllers\PetHotelImageController;
use App\Http\Controllers\SopGeneralController;
use App\Http\Controllers\SupportedPetTypeController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PetHotelController;
use App\Http\Controllers\Reservation;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SupportedPetController;

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

    Route::prefix('asuransi')->group(function() {
        Route::get('/', [AsuransiController::class, 'getAllList']);
        Route::get('/{id}', [AsuransiController::class, 'getDetailID']);
        Route::post('/add', [AsuransiController::class, 'add']);
        Route::put('/{id}', [AsuransiController::class, 'update']);
        Route::delete('/{id}', [AsuransiController::class, 'delete']);
    });
    
    Route::prefix('fasilitas')->group(function() {
        Route::get('/', [FasilitasController::class, 'getAllList']);
        Route::get('/{id}', [FasilitasController::class, 'getDetailID']);
        Route::post('/add', [FasilitasController::class, 'add']);
        Route::put('/{id}', [FasilitasController::class, 'update']);
        Route::delete('/{id}', [FasilitasController::class, 'delete']);
    });

    Route::prefix('custom_sop')->group(function() {
        Route::get('/', [CustomSOPController::class, 'getAllList']);
        Route::get('/{id}', [CustomSOPController::class, 'getDetailID']);
        Route::post('/add', [CustomSOPController::class, 'add']);
        Route::put('/{id}', [CustomSOPController::class, 'update']);
        Route::delete('/{id}', [CustomSOPController::class, 'delete']);
    });

    Route::prefix('supported_pet_type')->group(function() {
        Route::get('/', [SupportedPetTypeController::class, 'getAllList']);
        Route::get('/{id}', [SupportedPetTypeController::class, 'getDetailID']);
        Route::post('/add', [SupportedPetTypeController::class, 'add']);
        Route::put('/{id}', [SupportedPetTypeController::class, 'update']);
        Route::delete('/{id}', [SupportedPetTypeController::class, 'delete']);
    });

    Route::prefix('monitoring_image')->group(function() {
        Route::get('/', [MonitoringImageController::class, 'getAllList']);
        Route::get('/{id}', [MonitoringImageController::class, 'getDetailID']);
        Route::post('/add', [MonitoringImageController::class, 'add']);
        Route::put('/{id}', [MonitoringImageController::class, 'update']);
        Route::delete('/{id}', [MonitoringImageController::class, 'delete']);
    });

    Route::prefix('pet_hotel_image')->group(function() {
        Route::get('/', [PetHotelImageController::class, 'getAllList']);
        Route::get('/{id}', [PetHotelImageController::class, 'getDetailID']);
        Route::post('/add', [PetHotelImageController::class, 'add']);
        Route::put('/{id}', [PetHotelImageController::class, 'update']);
        Route::delete('/{id}', [PetHotelImageController::class, 'delete']);
    });

    Route::prefix('monitoring')->group(function() {
        Route::get('/', [MonitoringController::class, 'getAllList']);
        Route::get('/{id}', [MonitoringController::class, 'getDetailID']);
        Route::post('/add', [MonitoringController::class, 'add']);
        Route::put('/{id}', [MonitoringController::class, 'update']);
        Route::delete('/{id}', [MonitoringController::class, 'delete']);
    });

    Route::prefix('supported_pet')->group(function() {
        Route::get('/', [SupportedPetController::class, 'getAllList']);
        Route::get('/{id}', [SupportedPetController::class, 'getDetailID']);
        Route::post('/add', [SupportedPetController::class, 'add']);
        Route::put('/{id}', [SupportedPetController::class, 'update']);
        Route::delete('/{id}', [SupportedPetController::class, 'delete']);
    });

    Route::prefix('package')->group(function() {
        Route::get('/', [PackageController::class, 'getAllList']);
        Route::get('/{id}', [PackageController::class, 'getDetailID']);
        Route::post('/add', [PackageController::class, 'add']);
        Route::put('/{id}', [PackageController::class, 'update']);
        Route::delete('/{id}', [PackageController::class, 'delete']);
    });

    Route::prefix('pet_hotel')->group(function() {
        Route::get('/', [PetHotelController::class, 'getAllList']);
        Route::get('/{id}', [PetHotelController::class, 'getDetailID']);
        Route::post('/add', [PetHotelController::class, 'add']);
        Route::put('/{id}', [PetHotelController::class, 'update']);
        Route::delete('/{id}', [PetHotelController::class, 'delete']);
    });

    Route::prefix('order')->group(function() {
        Route::get('/', [OrderController::class, 'getAllList']);
        Route::get('/{id}', [OrderController::class, 'getDetailID']);
        Route::post('/add', [OrderController::class, 'add']);
        Route::put('/{id}', [OrderController::class, 'update']);
        Route::delete('/{id}', [OrderController::class, 'delete']);
    });

    Route::prefix('order_detail')->group(function() {
        Route::get('/', [OrderDetailController::class, 'getAllList']);
        Route::get('/{id}', [OrderDetailController::class, 'getDetailID']);
        Route::post('/add', [OrderDetailController::class, 'add']);
        Route::put('/{id}', [OrderDetailController::class, 'update']);
        Route::delete('/{id}', [OrderDetailController::class, 'delete']);
    });
});

Route::prefix('explore')->group(function() {
    Route::get('/get-all-list', [ExploreController::class, 'getAllList']);
});

Route::prefix('reservation')->group(function() {
    Route::get('/get_detail_pet_hotel/{id}', [ReservationController::class, 'getPetHotelDetail']);
});