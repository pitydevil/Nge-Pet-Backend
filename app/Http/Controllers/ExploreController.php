<?php

namespace App\Http\Controllers;

use App\Models\PetHotel;
use App\Models\PetHotelImage;
use App\Models\SupportedPet;
use App\Models\SupportedPetType;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function getNearestList(Request $request){
        $myLongitude    = $request->longitude;
        $myLatitude     = $request->latitude;

        function getDistanceBetweenPoints($myLongitude, $myLatitude, $pet_hotel_longitude, $pet_hotel_latitude) {
            $theta = $myLongitude - $pet_hotel_longitude;
            $miles = (sin(deg2rad($myLatitude)) * sin(deg2rad($pet_hotel_latitude))) + (cos(deg2rad($myLatitude)) * cos(deg2rad($pet_hotel_latitude)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $feet  = $miles * 5280;
            $yards = $feet / 3;
            $kilometers = $miles * 1.609344;
            $meters = $kilometers * 1000;
            return $meters;
        }

        $pet_hotel  = PetHotel::select('pet_hotel_id', 'pet_hotel_name', 'pet_hotel_longitude', 'pet_hotel_latitude')->get();

        foreach($pet_hotel as $ph ){
            $pet_hotel_longitude = $ph->pet_hotel_longitude;
            $pet_hotel_latitude  = $ph->pet_hotel_latitude;

            $distance   = getDistanceBetweenPoints($myLongitude, $myLatitude, $pet_hotel_longitude, $pet_hotel_latitude);
            $ph->pet_hotel_distance = $distance;

            $pet_hotel_image        = PetHotelImage::select('pet_hotel_id', 'pet_hotel_image_url')->where('pet_hotel_id', $ph->pet_hotel_id)->first();
            $ph->pet_hotel_image    = $pet_hotel_image->pet_hotel_image_url;

            $supported_pet                  = SupportedPet::select('pet_hotel_id', 'supported_pet_name')->where('pet_hotel_id', $ph->pet_hotel_id)->get();
            $ph->pet_hotel_supported_pet    = $supported_pet;

            foreach($supported_pet as $sp){
                $supported_pet_type     = SupportedPetType::select('supported_pet_id', 'supported_pet_type_short_size')->where('supported_pet_id', $sp->supported_pet_id)->get();
                $sp->supported_pet_type = $supported_pet_type;
            }
        }

        return response()->json([
            $pet_hotel
        ]);

    }
}
