<?php

namespace App\Http\Controllers;

use App\Models\PetHotel;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function getAllList(Request $request)
    {
        $pet_hotel = PetHotel::all();
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotel,
        ]);
    }
}
