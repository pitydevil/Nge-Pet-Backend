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

Route::prefix('monitoring')->group(function() {
    // ROUTE FOR PET OWNER
    Route::post('/get-monitoring-by-date', [MonitoringController::class, 'getMonitoringByDate']);
    Route::post('/get-detail-monitoring', [MonitoringController::class, 'getDetailMonitoring']);
    Route::post('/get-pet-by-date', [MonitoringController::class, 'getPetByDate']);
    Route::post('/get-monitoring-data', [MonitoringController::class, 'getMonitoringData']);

    // ROUTE FOR PET HOTEL
    Route::post('/add', [PetHotelController::class, 'addMonitoring']);
    Route::delete('/delete/{id}', [PetHotelController::class, 'deleteMonitoring']);
    Route::post('/get-pet-hotel-monitoring-list', [PetHotelController::class, 'getPetHotelMonitoringList']);
});

Route::prefix('explore')->group(function() {
    Route::post('/get-nearest-pet-hotel',[ExploreController::class, 'getNearestPetHotel']);
    Route::post('/search-pet-hotel',[ExploreController::class, 'searchPetHotel']);
});

Route::prefix('reservation')->group(function() {
    Route::prefix('pet_hotel')->group(function() {
        Route::post('/detail', [ReservationController::class, 'getPetHotelDetail']);
        Route::post('/package', [ReservationController::class, 'getPetHotelPackage']);
    });
    Route::prefix('order')->group(function() {
        // ROUTE FOR PET OWNER
        Route::post('/list', [ReservationController::class, 'getOrderList']);
        Route::post('/detail', [ReservationController::class, 'getOrderDetail']);
        Route::post('/add', [ReservationController::class, 'addOrder']);

        // ROUTE FOR PET HOTEL
        Route::post('/update-status', [PetHotelController::class, 'updateOrderStatus']);
    });
});

Route::prefix('pet_hotel')->group(function() {
    Route::post('/order-list', [PetHotelController::class, 'getPetHotelOrderList']);
});
