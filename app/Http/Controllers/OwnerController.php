<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use App\Models\Asuransi;
use App\Models\CancelSOP;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Package;
use App\Models\PackageDetail;
use App\Models\PetHotel;
use App\Models\PetHotelImage;
use App\Models\SOPGeneral;
use App\Models\SupportedPet;
use App\Models\SupportedPetType;

class OwnerController extends Controller
{
    public function authOwner(Request $request)
    {
        $email  = $request->email;

        $owner  = Owner::where('email', $email)->first();

        if(!$owner){
            $owner =Owner::create([
                'email'     => $email,
                'password'  => "bebas",
                'username'  => "miss_meeting"
            ]);

            return response()->json([
                'status' => 201,
                'error' => null,
                'data' => $owner
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'error' => null,
                'data' => $owner
            ]);
        }
    }

    public function createPetHotel(Request $request){
        $pet_hotel_name             = $request->pet_hotel_name;
        $pet_hotel_description      = $request->pet_hotel_description;
        $pet_hotel_longitude        = $request->pet_hotel_longitude;
        $pet_hotel_latitude         = $request->pet_hotel_latitude;
        $pet_hotel_address          = $request->pet_hotel_address;
        $pet_hotel_kelurahan        = $request->pet_hotel_kelurahan;
        $pet_hotel_kecamatan        = $request->pet_hotel_kecamatan;
        $pet_hotel_kota             = $request->pet_hotel_kota;
        $pet_hotel_provinsi         = $request->pet_hotel_provinsi;
        $pet_hotel_pos              = $request->pet_hotel_pos;
        $pet_hotel_owner_id         = $request->pet_hotel_owner_id;
        $pet_hotel_asuransi         = $request->pet_hotel_asuransi;
        $pet_hotel_cancel_sop       = $request->pet_hotel_cancel_sop;
        $pet_hotel_fasilitas        = $request->pet_hotel_fasilitas;
        $pet_hotel_package          = $request->pet_hotel_package;
        $package_details            = $pet_hotel_package["package_details"];
        $pet_hotel_image            = $request->pet_hotel_image;
        $pet_hotel_sop_general      = $request->pet_hotel_sop_general;
        $pet_hotel_supported_pet    = $request->pet_hotel_supported_pet;
        $supported_pet_type         = $pet_hotel_supported_pet["supported_pet_type"];

        $supported_pet_status  = 0;

        foreach($pet_hotel_supported_pet as $phsp){
            if($phsp["supported_pet_name"] == "Kucing" && $supported_pet_status == 0){
                $supported_pet_status = 1;
            }else if($phsp["supported_pet_name"] == "Anjing" && $supported_pet_status == 0){
                $supported_pet_status = 2;
            }else if($phsp["supported_pet_name"] == "Kucing" && $supported_pet_status == 2){
                $supported_pet_status = 3;
            }else if($phsp["supported_pet_name"] == "Anjing" && $supported_pet_status == 1){
                $supported_pet_status = 3;
            }
        }

        $pet_hotel = PetHotel::create([
            'pet_hotel_name'        => $pet_hotel_name,
            'pet_hotel_description' => $pet_hotel_description,
            'pet_hotel_longitude'   => $pet_hotel_longitude,
            'pet_hotel_latitude'    => $pet_hotel_latitude,
            'pet_hotel_address'     => $pet_hotel_address,
            'pet_hotel_kelurahan'   => $pet_hotel_kelurahan,
            'pet_hotel_kecamatan'   => $pet_hotel_kecamatan,
            'pet_hotel_kota'        => $pet_hotel_kota,
            'pet_hotel_provinsi'    => $pet_hotel_provinsi,
            'pet_hotel_pos'         => $pet_hotel_pos,
            'owner_id'              => $pet_hotel_owner_id,
            'supported_pet_status'  => $supported_pet_status
        ]);

        foreach($pet_hotel_image as $phi){
            PetHotelImage::create([
                'pet_hotel_image_url'   => $phi["pet_hotel_image_url"],
                'pet_hotel_id'          => $pet_hotel->pet_hotel_id
            ]);
        }

        foreach($pet_hotel_supported_pet as $phsp){
            $supported_pet = SupportedPet::create([
                'supported_pet_name'    => $phsp["supported_pet_name"],
                'pet_hotel_id'          => $pet_hotel->pet_hotel_id
            ]);

            foreach($supported_pet_type as $spt){
                SupportedPetType::create([
                    'supported_pet_type_short_size' => $spt["supported_pet_type_short_size"],
                    'supported_pet_type_size'       => $spt["supported_pet_type_size"],
                    'supported_pet_id'              => $supported_pet->supported_pet_id
                ]);
            }
        }

        foreach($pet_hotel_asuransi as $pha){
            Asuransi::create([
                'asuransi_description'  => $pha["asuransi_description"],
                'pet_hotel_id'          => $pet_hotel->pet_hotel_id
            ]);
        }

        foreach($pet_hotel_cancel_sop as $phca){
            CancelSOP::create([
                'cancel_sops_description'   => $phca["asuransi_description"],
                'pet_hotel_id'              => $pet_hotel->pet_hotel_id
            ]);
        }

        foreach($pet_hotel_fasilitas as $phf){
            Fasilitas::create([
                'fasilitas_name'        => $phf["fasilitas_name"],
                'fasilitas_icon_url'    => $phf["fasilitas_icon_url"],
                'fasilitas_status'      => $phf["fasilitas_status"],
                'pet_hotel_id'          => $pet_hotel->pet_hotel_id
            ]);
        }

        foreach($pet_hotel_package as $php){
            $package = Package::create([
                'package_name'      => $php["package_name"],
                'package_price'     => $php["package_price"],
                'supported_pet_id'  => $php["supported_pet_id"],
                'pet_hotel_id'      => $pet_hotel->pet_hotel_id
            ]);

            foreach($package_details as $pd){
                PackageDetail::create([
                    'package_detail_name'   => $pd["package_detail_name"],
                    'package_id'            => $package->package_id
                ]);
            }
        }

        foreach($pet_hotel_sop_general as $phsg){
            SOPGeneral::create([
                'sop_general_description'   => $phsg["sop_general_description"],
                'pet_hotel_id'              => $pet_hotel->pet_hotel_id
            ]);
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotel
        ]);
    }
}
