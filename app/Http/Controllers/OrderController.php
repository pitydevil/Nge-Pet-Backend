<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\PetHotel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function getAllList(Request $request)
    {
        $limit = intval($request->input('limit', 25));
        $order = Order::where('order_id', '=', $request->order_id)
            ->with([
                'pet_hotels:pet_hotel_id,sops_general_id,asuransi_id,package_id,cancel_sops_id,fasilitas_id,supported_pet_id,pet_hotel_name,pet_hotel_latitude,pet_hotel_longitude,pet_hotel_location,pet_hotel_description,pet_hotel_image_id',
            ])
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($order),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $order = Order::where('order_id', '=', $id)
            ->where('order_id', '=', $request->order_id)
            ->with([
                'pet_hotels,pet_hotels.pet_hotel_id,pet_hotels.sops_general_id,pet_hotels.asuransi_id,pet_hotels.package_id,pet_hotels.cancel_sops_id,pet_hotels.fasilitas_id,pet_hotels.supported_pet_id,pet_hotels.pet_hotel_name,pet_hotels.pet_hotel_latitude,pet_hotels.pet_hotel_longitude,pet_hotels.pet_hotel_location,pet_hotels.pet_hotel_description,pet_hotels.pet_hotel_image_id',
                ])
            ->first();
        
        if (!$order)  {
            return response()->json([
                'status' => 404,
                'error' => 'ORDER_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $order,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'order_name' => 'required|string',
            'user_id' => 'required|string',
            'order_status' => 'required|string',
            'order_date_checkin' => 'required|date',
            'order_date_checkout' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $pet_hotel = PetHotel::where('pet_hotel_id', '=', $request->post('pet_hotel_id'))->first();
 
        if (!$pet_hotel) {
            return response()->json([
            'status' => 404,
             'error' => 'PET_HOTEL_ID_NOT_FOUND', 
             'data' => null ], 
             404);
        }

       Order::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'pet_hotel_id' => $pet_hotel->pet_hotel_id,
            'order_name' => $request->post('order_name'),
            'order_status' => $request->post('order_status'),
            'user_id' => $request->post('user_id'),
            'order_date_checkin' => $request->post('order_date_checkin'),
            'order_date_checkout' => $request->post('order_date_checkout'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'order_name' => 'required|string',
            'user_id' => 'required|string',
            'order_status' => 'required|string',
            'order_date_checkin' => 'required|date',
            'order_date_checkout' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $order = Order::where('order_id', '=', $id)
            ->first();

        $pet_hotel = PetHotel::where('pet_hotel_id', '=', $request->post('pet_hotel_id'))->first();
 
        if (!$pet_hotel) {
            return response()->json([
            'status' => 404,
             'error' => 'PET_HOTEL_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        if (!$order) return response()->json([
            'status' => 404,
            'error' => 'ORDER_NOT_FOUND',
            'data' => null,
        ], 404);

        $order->order_id = $request->post('order_id', $order->order_id);
        $order->pet_hotel_id = $request->post('pet_hotel_id', $order->pet_hotel_id);
        $order->user_id = $request->post('user_id', $order->user_id);
        $order->order_name = $request->post('order_name', $order->order_name);
        $order->order_status = $request->post('order_status', $order->order_status);
        $order->order_date_checkin = $request->post('order_date_checkin', $order->order_date_checkin);
        $order->order_date_checkout = $request->post('order_date_checkout', $order->order_date_checkout);
        $order->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $order = Order::where('order_id', '=', $id)
            ->first();

        if (!$order) {
            return response()->json([
                'status' => 404,
                'error' => 'ORDER_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $order->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}
