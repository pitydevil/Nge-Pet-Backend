<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StoreSupportedPetRequest;
use App\Http\Requests\UpdateSupportedPetRequest;
use App\Models\SupportedPet;
use App\Models\SupportedPetType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportedPetController extends Controller{
    
    public function getAllList(Request $request){
        $limit = intval($request->input('limit', 25));
        $supported_pet = SupportedPet::where('supported_pet_id', '=', $request->supported_pet_id)
            ->with([
            'supported_pet_types:supported_pet_type_id,supported_pet_type_name'
            ])
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($supported_pet),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $supported_pet = SupportedPet::where('supported_pet_id', '=', $id)
            ->where('supported_pet_id', '=', $request->supported_pet_id)
            ->with(['supported_pet_types,supported_pet_types.supported_pet_type_id,supported_pet_types.supported_pet_type_name'])
            ->first();
        
        if (!$supported_pet)  {
            return response()->json([
                'status' => 404,
                'error' => 'SUPPORTED_PET_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $supported_pet,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'supported_pet_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $supported_pet_type = SupportedPetType::where('supported_pet_type_id', '=', $request->post('supported_pet_type_id'))->first();
        if (!$supported_pet_type) {
            return response()->json([
            'status' => 404,
             'error' => 'SUPPORTED_PET_TYPE_ID_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        SupportedPet::create([
            'supported_pet_type_id' => $supported_pet_type->supported_pet_type_id,
            'supported_pet_name'    => $request->post('supported_pet_name'),
            'creation_date'         => $request->post('creation_date', Carbon::now()),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'supported_pet_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $supported_pet = SupportedPet::where('supported_pet_id', '=', $id)
        ->first();
        $supported_pet_type = SupportedPetType::where('supported_pet_type_id', '=', $request->post('supported_pet_type_id'))->first();

        if (!$supported_pet_type) {
            return response()->json([
                'status' => 404, 
                'error' => 'SUPPORTED_PET_TYPE_NOT_FOUND',
                'data' => null 
            ], 404);
        }

        if (!$supported_pet) {
            return response()->json([
                'status' => 404,
                'error' => 'SUPPORTED_PET_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        $supported_pet->supported_pet_id = $request->post('supported_pet_id', $supported_pet->supported_pet_id);
        $supported_pet->supported_pet_type_id = $request->post('supported_pet_type_id', $supported_pet->supported_pet_type_id);
        $supported_pet->supported_pet_name = $request->post('supported_pet_name', $supported_pet->supported_pet_name);
        $supported_pet->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $supported_pet = SupportedPet::where('supported_pet_id', '=', $id)
            ->first();

        if (!$supported_pet) {
            return response()->json([
                'status' => 404,
                'error' => 'SUPPORTED_PET_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $supported_pet->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}
