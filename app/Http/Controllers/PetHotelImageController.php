<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StorePetHotelImageRequest;
use App\Http\Requests\UpdatePetHotelImageRequest;
use App\Models\PetHotelImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PetHotelImageController extends Controller
{
    public function getAllList(Request $request)
    {
        $limit = intval($request->input('limit', 25));
        $pet_hotel_image = PetHotelImage::where('pet_hotel_image_id', '=', $request->pet_hotel_image_id)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($pet_hotel_image),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $pet_hotel_image = PetHotelImage::where('pet_hotel_image_id', '=', $id)
            ->where('pet_hotel_image_id', '=', $request->pet_hotel_image_id)
            ->first();
        
        if (!$pet_hotel_image)  {
            return response()->json([
                'status' => 404,
                'error' => 'PET_HOTEL_IMAGE_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotel_image,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'pet_hotel_image_url' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $pet_hotel_image = PetHotelImage::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'pet_hotel_image_hotel' => $request->post('pet_hotel_image_url'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'pet_hotel_image_url' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $pet_hotel_image = PetHotelImage::where('pet_hotel_image_url', '=', $id)
            ->first();

        if (!$pet_hotel_image) return response()->json([
            'status' => 404,
            'error' => 'PET_HOTEL_IMAGE_NOT_FOUND',
            'data' => null,
        ], 404);

        $pet_hotel_image->pet_hotel_image_id = $request->post('pet_hotel_image_id', $pet_hotel_image->pet_hotel_image_id);
        $pet_hotel_image->pet_hotel_image_url = $request->post('pet_hotel_image_url', $pet_hotel_image->pet_hotel_image_url);
        $pet_hotel_image->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $pet_hotel_image = PetHotelImage::where('pet_hotel_image_id', '=', $id)
            ->first();

        if (!$pet_hotel_image) {
            return response()->json([
                'status' => 404,
                'error' => 'PET_HOTEL_IMAGE_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $pet_hotel_image->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

}
