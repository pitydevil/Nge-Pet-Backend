<?php

namespace App\Http\Controllers;

use App\Models\PetHotel;
use App\Models\PetHotelImage;
use App\Models\SupportedPet;
use App\Models\SupportedPetType;
use App\Models\Package;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    //Get default pet hotel list / nearest from user
    public function getNearestPetHotel(Request $request){
        $myLongitude    = $request->longitude;
        $myLatitude     = $request->latitude;

        //Calculate the distance between pet hotel and user
        function getDistanceBetweenPoints($myLongitude, $myLatitude, $pet_hotel_longitude, $pet_hotel_latitude) {
            $theta = $myLongitude - $pet_hotel_longitude;
            $miles = (sin(deg2rad($myLatitude)) * sin(deg2rad($pet_hotel_latitude))) + (cos(deg2rad($myLatitude)) * cos(deg2rad($pet_hotel_latitude)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $feet  = $miles * 5280;
            $yards = $feet / 3;
            $kilometers = round($miles * 1.609344);
            $meters = round($kilometers * 1000);
            //Return with meter if distance < 1000 m
            if($meters < 1000)
            {
                return $meters. "m";
            }
            //Return with meter if distance > 1000 m
            else if($meters > 1000)
            {
                return $kilometers. "km";
            }
        }

        //Get all pet hotel data
        $pet_hotel = PetHotel::select('pet_hotel_id', 'pet_hotel_name', 'pet_hotel_longitude', 'pet_hotel_latitude')->get();

        //If pet hotel data is null
        if (!$pet_hotel)  {
            return response()->json([
                'status' => 404,
                'error' => 'PET_HOTEL_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        foreach($pet_hotel as $data ){
            //Get user longitude and latitude
            $pet_hotel_longitude = $data->pet_hotel_longitude;
            $pet_hotel_latitude  = $data->pet_hotel_latitude;

            //Calculate the distance and put into data object
            $distance                   = getDistanceBetweenPoints($myLongitude, $myLatitude, $pet_hotel_longitude, $pet_hotel_latitude);
            $data->pet_hotel_distance   = $distance;

            //Get first Pet Hotel image for certain pet hotel and put into data object
            $pet_hotel_image        = PetHotelImage::select('pet_hotel_id', 'pet_hotel_image_url')->where('pet_hotel_id', $data->pet_hotel_id)->first();
            $data->pet_hotel_image  = $pet_hotel_image->pet_hotel_image_url;

            //Get supported pet data for certain pet hotel and put into data object
            $supported_pet                  = SupportedPet::select('pet_hotel_id', 'supported_pet_name', 'supported_pet_id')->where('pet_hotel_id', $data->pet_hotel_id)->get();
            $data->pet_hotel_supported_pet  = $supported_pet;

            foreach($supported_pet as $sp){
                //Get supported pet type data for certain supported pet and put into supported pet object
                $supported_pet_type     = SupportedPetType::select('supported_pet_type_id', 'supported_pet_id', 'supported_pet_type_short_size')->where('supported_pet_id', $sp->supported_pet_id)->get();
                $sp->supported_pet_type = $supported_pet_type;
            }

            //Get cheapest package price for certain pet hotel and put into data object
            $package                        = Package::where('pet_hotel_id', $data->pet_hotel_id)->orderBy('package_price', 'asc')->first();
            $data->pet_hotel_start_price    = number_format($package->package_price, 0, ",", ".");
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotel
        ]);

    }
}
