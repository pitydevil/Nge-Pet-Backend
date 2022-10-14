<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Fasilitas;
use App\Models\Package;
use App\Models\SupportedPet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function getAllList(Request $request)
    {
        $limit = intval($request->input('limit', 25));
        $package = Package::where('package_id', '=', $request->package_id)
            ->with([
                'fasilitas:fasilitas_id,fasilitas_name,fasilitas_description',
                'supported_pets:supported_pet_id,supported_pet_name,supported_pet_type_id'
            ])
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($package),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $package = Package::where('package_id', '=', $id)
            ->where('package_id', '=', $request->package_id)
            ->with([
                'fasilitas,fasilitas.fasilitas.fasilitas_id,fasilitas.fasilitas_name,fasilitas.fasilitas_description',
                'supported_pets,supported_pets.supported_pet_id,supported_pets.supported_pet_name, supported_pets.supported_pet_type_id'
                ])
            ->first();
        
        if (!$package)  {
            return response()->json([
                'status' => 404,
                'error' => 'PACKAGE_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $package,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'package_price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $fasilitas = Fasilitas::where('fasilitas_id', '=', $request->post('fasilitas_id'))->first();
 
        if (!$fasilitas) {
            return response()->json([
            'status' => 404,
             'error' => 'FASILITAS_ID_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        $supported_pet = SupportedPet::where('supported_pet_id', '=', $request->post('supported_pet_id'))->first();

        if (!$supported_pet) {
            return response()->json([
            'status' => 404,
             'error' => 'SUPPORTED_PET_ID_NOT_FOUND', 
             'data' => null ], 
             404);
        }

       Package::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'fasilitas_id' => $fasilitas->fasilitas_id,
            'supported_pet_id' => $fasilitas->supported_pet_id,
            'package_price' => $request->post('package_price'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'package_price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $package = Package::where('package_id', '=', $id)
            ->first();

        $fasilitas = Fasilitas::where('fasilitas_id', '=', $request->post('fasilitas_id'))->first();

        if (!$fasilitas) {
            return response()->json([
                'status' => 404, 
                'error' => 'FASILITAS_NOT_FOUND',
                'data' => null 
            ], 404);
        }

        $supported_pet = SupportedPet::where('supported_pet_id', '=', $request->post('supported_pet_id'))->first();

        if (!$supported_pet) {
            return response()->json([
                'status' => 404, 
                'error' => 'SUPPORTED_PET_NOT_FOUND',
                'data' => null 
            ], 404);
        }

        if (!$package) return response()->json([
            'status' => 404,
            'error' => 'PACKAGE_NOT_FOUND',
            'data' => null,
        ], 404);

        $package->package_id = $request->post('package_id', $package->package_id);
        $package->fasilitas_id = $request->post('fasilitas_id', $package->fasilitas_id);
        $package->supported_pet_id = $request->post('supported_pet_id', $package->supported_pet_id);
        $package->package_price = $request->post('package_price', $package->package_price);
        $package->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $package = Package::where('package_id', '=', $id)
            ->first();

        if (!$package) {
            return response()->json([
                'status' => 404,
                'error' => 'PACKAGE_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $package->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    
}
