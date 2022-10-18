<?php

namespace App\Http\Controllers;

use App\Models\PetHotel;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function getPetHotelDetail(Request $request, int $id){
        $pet_hotel = PetHotel::where('pet_hotel_id', '=', $id)
            ->first();
        
        if (!$pet_hotel)  {
            return response()->json([
                'status' => 404,
                'error' => 'PET_HOTEL_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotel,
        ]);
    }
}
