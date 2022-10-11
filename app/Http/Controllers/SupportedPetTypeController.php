<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StoreSupportedPetTypeRequest;
use App\Http\Requests\UpdateSupportedPetTypeRequest;
use App\Models\SupportedPetType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportedPetTypeController extends Controller
{
    public function getAllList(Request $request)
    {
        $limit = intval($request->input('limit', 25));
        $supported_pet_type = SupportedPetType::where('supported_pet_type_id', '=', $request->supported_pet_type_id)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($supported_pet_type),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $supported_pet_type = SupportedPetType::where('supported_pet_type_id', '=', $id)
            ->where('supported_pet_type_id', '=', $request->supported_pet_type_id)
            ->first();
        
        if (!$supported_pet_type)  {
            return response()->json([
                'status' => 404,
                'error' => 'SUPPORTED_PET_TYPE_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $supported_pet_type,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'supported_pet_type_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $supported_pet_type = SupportedPetType::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'supported_pet_type_name' => $request->post('supported_pet_type_name'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'supported_pet_type_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $supported_pet_type = SupportedPetType::where('supported_pet_type_id', '=', $id)
            ->first();

        if (!$supported_pet_type) return response()->json([
            'status' => 404,
            'error' => 'SUPPORTED_PET_TYPE_NOT_FOUND',
            'data' => null,
        ], 404);

        $supported_pet_type->supported_pet_type_id = $request->post('supported_pet_type_id', $supported_pet_type->supported_pet_type_id);
        $supported_pet_type->supported_pet_type_name = $request->post('supported_pet_type_name', $supported_pet_type->supported_pet_type_name);
        $supported_pet_type->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $supported_pet_type = SupportedPetType::where('supported_pet_type_id', '=', $id)
            ->first();

        if (!$supported_pet_type) {
            return response()->json([
                'status' => 404,
                'error' => 'SUPPORTED_PET_TYPE_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $supported_pet_type->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}
