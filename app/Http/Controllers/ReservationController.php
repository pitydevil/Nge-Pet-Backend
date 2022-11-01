<?php

namespace App\Http\Controllers;

use App\Models\CustomSOP;
use App\Models\Fasilitas;
use App\Models\Monitoring;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PetHotel;
use App\Models\PetHotelImage;
use App\Models\SupportedPet;
use App\Models\SupportedPetType;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{

    public function getPetHotelDetail(Request $request){
        $pet_hotel = PetHotel::where('pet_hotel_id', '=', $request->pet_hotel_id)
            ->with([
                'petHotelImage', 'fasilitas', 'sopGeneral', 'asuransi', 'cancelSOP',
                ])
            ->first();
        
        if (!$pet_hotel)  {
            return response()->json([
                'status' => 404,
                'error' => 'PET_HOTEL_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        //Get supported pet data for certain pet hotel and put into data object
        $supported_pet                 = SupportedPet::where('pet_hotel_id', $request->pet_hotel_id)->get();
        $pet_hotel->supported_pet      = $supported_pet;

        foreach($supported_pet as $sp){
            //Get supported pet type data for certain supported pet and put into supported pet object
            $supported_pet_type     = SupportedPetType::where('supported_pet_id', $sp->supported_pet_id)->get();
            $sp->supported_pet_types = $supported_pet_type;
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotel,
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
        // End package detail sop Array

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $packages,
        ]);
    }

    public function getOrderList(){
        $orders = DB::table('orders')
            ->select(
                'orders.order_id','orders.order_code','orders.order_date_checkin','orders.order_date_checkout','orders.order_date_checkout', 
                'pet_hotels.pet_hotel_name', 
                'order_details.pet_name','order_details.pet_type','order_details.pet_size',
                'packages.package_name',
                DB::raw('count(custom_sops.custom_sop_id) as custom_sops_count')
            )
            ->join('pet_hotels', 'orders.pet_hotel_id', '=', 'pet_hotels.pet_hotel_id')
            ->join('order_details', 'orders.order_id', '=', 'order_details.order_id')
            ->join('custom_sops', 'order_details.order_detail_id', '=', 'custom_sops.order_detail_id')
            ->join('packages', 'packages.package_id', '=', 'order_details.package_id')
            ->groupBy(
                'orders.order_id','orders.order_code','orders.order_date_checkin','orders.order_date_checkout','orders.order_date_checkout', 
                'pet_hotels.pet_hotel_name', 
                'order_details.pet_name','order_details.pet_type','order_details.pet_size',
                'packages.package_name',
            )
            ->get();

        if (!$orders)  {
            return response()->json([
                'status' => 404,
                'error' => 'ORDER_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $orders,
        ]);
    }

    public function getOrderDetail(Request $request){
        $order = DB::table('orders')
            ->where('orders.order_id', '=', $request->order_id)
            ->select(
                'orders.*', 
            )
            ->first();

        if (!$order)  {
            return response()->json([
                'status' => 404,
                'error' => 'ORDER_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        $pet_hotel = DB::table('pet_hotels')
            ->where('pet_hotels.pet_hotel_id','=',$order->pet_hotel_id)
            ->select('pet_hotels.*')
            ->first();

         // Begin cancel sop Array
         $cancel_sops = DB::table('cancel_sops')
         ->where('cancel_sops.pet_hotel_id','=',$pet_hotel->pet_hotel_id)
         ->select('cancel_sops.*')
         ->get()
         ->toArray();
 
         $pet_hotel->cancel_sops = array_filter($cancel_sops, function($cancel_sop) use ($pet_hotel) {
             return $cancel_sop->pet_hotel_id === $pet_hotel->pet_hotel_id;
         });
         // End cancel sop Array

        $order->pet_hotel = $pet_hotel;


        $order_details = DB::table('order_details')
        ->where('order_details.order_id','=',$order->order_id)
        ->select('order_details.*')
        ->get()
        ->toArray();

        // Begin package Array
        foreach($order_details as &$order_detail)
        {
            $package = DB::table('packages')
            ->where('packages.package_id','=',$order_detail->package_id)
            ->select('packages.*')
            ->first();

            $order_detail->package = $package;
        }
        // End package sop Array

         // Begin custom sop Array
         foreach($order_details as &$order_detail)
         {
             $custom_sops = DB::table('custom_sops')
             ->where('custom_sops.order_detail_id','=',$order_detail->order_detail_id)
             ->select('custom_sops.*')
             ->get()
             ->toArray();
 
             $order_detail->custom_sops = array_filter($custom_sops, function($custom_sop) use ($order_detail) {
                return $custom_sop->order_detail_id === $order_detail->order_detail_id;
            });
         }
         // End custom sop Array

        $order->order_details = array_filter($order_details, function($order_detail) use ($order) {
            return $order_detail->order_id === $order->order_id;
        });
        

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $order,
        ]);
    }

    public function addOrder(Request $request){
        $validator_order = Validator::make($request->all(), [
            'order_code' => 'required|string',
            'order_total_price' => 'required|integer',
            'order_date_checkin' => 'required|string',
            'order_date_checkin' => 'required|string',
            'order_status' => 'required|string',
        ]);

        if ($validator_order->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator_order->errors(),
            ], 400);
        }

        $order = Order::create([
            'order_code' => $request->post('order_code'),
            'order_date_checkin' => $request->post('order_date_checkin'),
            'order_date_checkout' => $request->post('order_date_checkout'),
            'order_total_price' => $request->post('order_total_price'),
            'order_status' => $request->post('order_status'),
            'user_id' => $request->post('user_id'),
            'pet_hotel_id' => $request->post('pet_hotel_id'),
        ]);

        $order_details = $request->order_details;

        $count = null;

        foreach($order_details as $order_detail)
        {
            $detail = OrderDetail::create([
                'pet_name' => $order_detail['pet_name'],
                'pet_type' => $order_detail['pet_type'],
                'pet_size' => $order_detail['pet_size'],
                'order_detail_price' => $order->order_total_price,
                'order_id' => $order->order_id,
                'package_id' => $order_detail['package_id'],
            ]);

            // $monitoring_activity = $order->order_code.'- Aktivtias Hewan';
            // $monitoring = Monitoring::create([
            //     'monitoring_activity' => $monitoring_activity,
            //     'order_detail_id' => $detail->order_detail_id,
            // ]);

            $custom_sops = $order_detail['custom_sops'];

            foreach($custom_sops as $custom_sop)
            {
                $custom = CustomSOP::create([
                    'custom_sop_name' => $custom_sop['custom_sop_name'],
                    'order_detail_id' => $detail->order_detail_id,
                    'monitoring_id' => 1,
                ]);
            }
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $count,
        ]);
    }

    public function updateOrderStatus(Request $request){
        $validator = Validator::make($request->all(), [
            'order_status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $order = Order::where('order_id', '=', $request->order_id)
        ->first();

        if (!$order) return response()->json([
            'status' => 404,
            'error' => 'ORDER_NOT_FOUND',
            'data' => null,
        ], 404);

        $order->order_status = $request->post('order_status', $order->order_status);
        $order->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $order,
        ]);
    }
}