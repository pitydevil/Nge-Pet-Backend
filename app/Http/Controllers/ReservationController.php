<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\PetHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function getPetHotelDetail(Request $request){
        
        // $pet_hotels = PetHotel::where('pet_hotels.pet_hotel_id', '=', $request->pet_hotel_id)
        // ->join('fasilitas', 'fasilitas.pet_hotel_id', '=', 'pet_hotels.pet_hotel_id')
        // ->get();

        $pet_hotels = DB::table('pet_hotels')
            ->where('pet_hotels.pet_hotel_id','=',$request->pet_hotel_id)
            ->select('pet_hotels.*')
            ->get();

        if (!$pet_hotels)  {
            return response()->json([
                'status' => 404,
                'error' => 'PET_HOTEL_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        // Begin pet hotel image Array
        $pet_hotel_images = DB::table('pet_hotel_images')
        ->where('pet_hotel_images.pet_hotel_id','=',$request->pet_hotel_id)
        ->select('pet_hotel_images.*')
        ->get()
        ->toArray();

        foreach($pet_hotels as &$pet_hotel)
        {
            $pet_hotel->pet_hotel_images = array_filter($pet_hotel_images, function($pet_hotel_image) use ($pet_hotel) {
                return $pet_hotel_image->pet_hotel_id === $pet_hotel->pet_hotel_id;
            });
        }
        // End cancel sop Array

        // Begin supported pet Array
        $supported_pets = DB::table('supported_pets')
        ->where('supported_pets.pet_hotel_id','=',$request->pet_hotel_id)
        ->select(
            'supported_pets.*',
            'supported_pet_types.*',
        )
        ->join('supported_pet_types','supported_pet_types.supported_pet_type_id', '=','supported_pets.supported_pet_type_id')
        ->get()
        ->toArray();

        foreach($pet_hotels as &$pet_hotel)
        {
            $pet_hotel->supported_pets = array_filter($supported_pets, function($supported_pet) use ($pet_hotel) {
                return $supported_pet->pet_hotel_id === $pet_hotel->pet_hotel_id;
            });
        }
        // End supported pet Array

        // Begin fasilitas Array
        $fasilitas = DB::table('fasilitas')
        ->where('fasilitas.pet_hotel_id','=',$request->pet_hotel_id)
        ->select('fasilitas.*')
        ->get()
        ->toArray();

        foreach($pet_hotels as &$pet_hotel)
        {
            $pet_hotel->fasilitas = array_filter($fasilitas, function($fasil) use ($pet_hotel) {
                return $fasil->pet_hotel_id === $pet_hotel->pet_hotel_id;
            });
        }
        // End fasilitas Array

        // Begin sop general Array
        $sop_generals = DB::table('sop_generals')
        ->where('sop_generals.pet_hotel_id','=',$request->pet_hotel_id)
        ->select('sop_generals.*')
        ->get()
        ->toArray();

        foreach($pet_hotels as &$pet_hotel)
        {
            $pet_hotel->sop_generals = array_filter($sop_generals, function($sop_general) use ($pet_hotel) {
                return $sop_general->pet_hotel_id === $pet_hotel->pet_hotel_id;
            });
        }
        // End sop general Array

        // Begin asuransi Array
        $asuransis = DB::table('asuransis')
        ->where('asuransis.pet_hotel_id','=',$request->pet_hotel_id)
        ->select('asuransis.*')
        ->get()
        ->toArray();

        foreach($pet_hotels as &$pet_hotel)
        {
            $pet_hotel->asuransis = array_filter($asuransis, function($asuransi) use ($pet_hotel) {
                return $asuransi->pet_hotel_id === $pet_hotel->pet_hotel_id;
            });
        }
        // End asuransi Array

        // Begin cancel sop Array
        $cancel_sops = DB::table('cancel_sops')
        ->where('cancel_sops.pet_hotel_id','=',$request->pet_hotel_id)
        ->select('cancel_sops.*')
        ->get()
        ->toArray();

        foreach($pet_hotels as &$pet_hotel)
        {
            $pet_hotel->cancel_sops = array_filter($cancel_sops, function($cancel_sop) use ($pet_hotel) {
                return $cancel_sop->pet_hotel_id === $pet_hotel->pet_hotel_id;
            });
        }
        // End cancel sop Array
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotels,
        ]);
    }

    public function getPetHotelPackage(Request $request){
        $packages = DB::table('packages')
            ->where('packages.pet_hotel_id','=',$request->pet_hotel_id)
            ->select('packages.*')
            ->get();

        if (!$packages)  {
            return response()->json([
                'status' => 404,
                'error' => 'PACKAGES_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        // Begin package detail Array
        foreach($packages as &$package)
        {
            $package_details = DB::table('package_details')
            ->where('package_details.package_id','=',$package->package_id)
            ->select('package_details.*')
            ->get()
            ->toArray();

            $package->package_details = array_filter($package_details, function($package_detail) use ($package) {
                return $package_detail->package_id === $package->package_id;
            });
        }
        // End cancel sop Array

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $packages,
        ]);
    }

    public function getPetHotelOrder(Request $request){
        $pet_hotels = DB::table('pet_hotels')
            ->where('pet_hotels.pet_hotel_id','=',$request->pet_hotel_id)
            ->select('pet_hotels.*')
            ->get();

        if (!$pet_hotels)  {
            return response()->json([
                'status' => 404,
                'error' => 'PET_HOTEL_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotels,
        ]);
    }

    public function getOrderDetail(Request $request){
        $pet_hotels = DB::table('pet_hotels')
            ->where('pet_hotels.pet_hotel_id','=',$request->pet_hotel_id)
            ->select('pet_hotels.*')
            ->get();

        if (!$pet_hotels)  {
            return response()->json([
                'status' => 404,
                'error' => 'PET_HOTEL_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotels,
        ]);
    }

    public function addOrder(Request $request){

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}