<?php

namespace App\Http\Controllers;

use App\Models\PetHotel;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function getNearestList(Request $request){
        $myLongitude    = $request->longitude;
        $myLatitude     = $request->latitude;

        function getDistanceBetweenPoints($myLongitude, $myLatitude, $hotelLongitude, $hotelLatitude) {
            $theta = $myLongitude - $hotelLongitude;
            $miles = (sin(deg2rad($myLatitude)) * sin(deg2rad($hotelLatitude))) + (cos(deg2rad($myLatitude)) * cos(deg2rad($hotelLatitude)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $feet  = $miles * 5280;
            $yards = $feet / 3;
            $kilometers = $miles * 1.609344;
            $meters = $kilometers * 1000;
            return $meters;
            // $jarak = 111.361904762 * pow(pow(($hotelLatitude - $myLatitude),2) + pow(($hotelLongitude - $myLongitude),2),0.5);
            // $jarak = 56696.2257766 * pow(pow((($hotelLatitude - $myLatitude)/360),2) + pow((($hotelLongitude - $myLongitude)/360),2),0.5);
            // return $jarak;
        }

        $pet_hotel  = PetHotel::with(['petHotelImage', 'supportedPet', 'supportedPet.supportedPetType'])->get();

        $result     = array();

        foreach($pet_hotel as $ph ){
            $hotelLongitude = $ph->pet_hotel_longitude;
            $hotelLatitude  = $ph->pet_hotel_latitude;

            $distance   = getDistanceBetweenPoints($myLongitude, $myLatitude, $hotelLongitude, $hotelLatitude);
            $ph->distance = $distance;

        }

        return response()->json([
            $pet_hotel
        ]);

    }
}
