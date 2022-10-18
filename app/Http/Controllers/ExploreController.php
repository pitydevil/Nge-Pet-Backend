<?php

namespace App\Http\Controllers;

use App\Models\PetHotel;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    // public function getAllList(Request $request)
    // {

    //     $pet_hotel = PetHotel::all();

    //     // dd($pet_hotel);

    //     return response()->json([
    //         $request ->all(),
    //     ]);
    // }

    public function getNearestList(Request $request){
        $longitude          = $request->longitude;
        $latitude           = $request->latitude;
        $nearest_pet_hotel  = PetHotel::where('longitude', $longitude)->where('latitude', $latitude)->get();

        return response()->json([
            $nearest_pet_hotel
        ]);

    }
}
