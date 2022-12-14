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
        //Get user input
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
            // if($meters < 1000)
            // {
            //     return $meters. "m";
            // }
            // //Return with meter if distance > 1000 m
            // else if($meters > 1000)
            // {
            //     return $kilometers. "km";
            // }
            return $meters;
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
            $data->distance   = $distance;
            if($distance < 1000)
            {
                $data->pet_hotel_distance   = $distance. "m";
                // return $meters. "m";
            }
            //Return with meter if distance > 1000 m
            else if($distance > 1000)
            {
                $data->pet_hotel_distance   = round($distance / 1000). "km";
                // round($distance / 1000);
                // return $kilometers. "km";
            }

            // $data->pet_hotel_distance   = $distance;

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

        //Sorting Pet Hotel Collection by nearest
        $pet_hotel_sort = $pet_hotel->sortBy('distance')->values();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotel_sort
        ]);
    }

    public function searchPetHotel(Request $request){
        //Get user input
        $myLongitude    = $request->longitude;
        $myLatitude     = $request->latitude;
        $myCheckInDate  = $request->check_in_date;
        $myCheckOutDate = $request->check_out_date;
        $myPet          = $request->pets;
        $pet_supported  = 0;

        if(!$myPet){
            $pet_supported = 4;
        }

        foreach($myPet as $pet){
            if($pet['pet_type'] == "Kucing" && $pet_supported == 0){
                $pet_supported = 1;
            }else if($pet['pet_type'] == "Anjing" && $pet_supported == 0){
                $pet_supported = 2;
            }else if($pet['pet_type'] == "Kucing" && $pet_supported == 2){
                $pet_supported = 3;
            }else if($pet['pet_type'] == "Anjing" && $pet_supported == 1){
                $pet_supported = 3;
            }
        }

        //Calculate the distance between pet hotel and user
        function getDistanceBetweenPoints2($myLongitude, $myLatitude, $pet_hotel_longitude, $pet_hotel_latitude) {
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
            // if($meters < 1000)
            // {
            //     return $meters. "m";
            // }
            // //Return with meter if distance > 1000 m
            // else if($meters > 1000)
            // {
            //     return $kilometers. "km";
            // }
            return $meters;
        }

        if($pet_supported == 1){
            $pet_hotel = PetHotel::select('pet_hotel_id', 'pet_hotel_name', 'pet_hotel_longitude', 'pet_hotel_latitude', 'supported_pet_status')->WHERE('supported_pet_status', $pet_supported)->get();
        }else if($pet_supported == 2){
            $pet_hotel = PetHotel::select('pet_hotel_id', 'pet_hotel_name', 'pet_hotel_longitude', 'pet_hotel_latitude', 'supported_pet_status')->WHERE('supported_pet_status', $pet_supported)->get();
        }else if($pet_supported == 3){
            $pet_hotel = PetHotel::select('pet_hotel_id', 'pet_hotel_name', 'pet_hotel_longitude', 'pet_hotel_latitude', 'supported_pet_status')->WHERE('supported_pet_status', $pet_supported)->get();
        }else if($pet_supported == 4){
            $pet_hotel = PetHotel::select('pet_hotel_id', 'pet_hotel_name', 'pet_hotel_longitude', 'pet_hotel_latitude', 'supported_pet_status')->get();
        }


        //Get all pet hotel data
        //$pet_hotel = PetHotel::select('pet_hotel_id', 'pet_hotel_name', 'pet_hotel_longitude', 'pet_hotel_latitude')->with('SupportedPet')->get();

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
            $distance                   = getDistanceBetweenPoints2($myLongitude, $myLatitude, $pet_hotel_longitude, $pet_hotel_latitude);
            $data->distance   = $distance;
            if($distance < 1000)
            {
                $data->pet_hotel_distance   = $distance. "m";
                // return $meters. "m";
            }
            //Return with meter if distance > 1000 m
            else if($distance > 1000)
            {
                $data->pet_hotel_distance   = round($distance / 1000). "km";
                // round($distance / 1000);
                // return $kilometers. "km";
            }

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

        //Sorting Pet Hotel Collection by nearest
        $pet_hotel_sort = $pet_hotel->sortBy('distance')->values();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotel_sort
        ]);

    }
}
