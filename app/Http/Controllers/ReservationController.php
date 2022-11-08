<?php

namespace App\Http\Controllers;

use App\Models\CustomSOP;
use App\Models\Fasilitas;
use App\Models\Monitoring;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Package;
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
        $pet_hotel  = PetHotel::where('pet_hotel_id', '=', $request->pet_hotel_id)
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
        $packages = Package::where('pet_hotel_id','=',$request->pet_hotel_id)
                            ->with([
                                    'packageDetail',
                                ])
                            ->get();

        if (!$packages)  {
            return response()->json([
                'status' => 404,
                'error' => 'PACKAGES_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $packages,
        ]);
    }

    public function getOrderList(Request $request){
        $order_status = "finish-order";

        if($request->order_status !== "riwayat") {
            $orders = Order::select(
                'orders.order_id','orders.order_code','orders.order_date_checkin','orders.order_date_checkout','orders.order_date_checkout', 'orders.order_status',
                'pet_hotels.pet_hotel_name',
            )
            ->where('order_status', '!=', $order_status)
            ->join('pet_hotels', 'orders.pet_hotel_id', '=', 'pet_hotels.pet_hotel_id')
            ->get();

            foreach($orders as $order){
                $order_details = OrderDetail::select(
                    'order_details.pet_name','order_details.pet_type','order_details.pet_size',
                    'packages.package_name',
                    DB::raw('count(custom_sops.custom_sop_id) as custom_sops_count')
                )
                ->where('order_details.order_id', '=', $order->order_id)
                ->join('custom_sops', 'order_details.order_detail_id', '=', 'custom_sops.order_detail_id')
                ->join('packages', 'packages.package_id', '=', 'order_details.package_id')
                ->groupBy(
                    'order_details.pet_name','order_details.pet_type','order_details.pet_size',
                    'packages.package_name',
                )
                ->get();

                $order->order_detail = $order_details;
            }

        } else {

            $orders = Order::select(
                'orders.order_id','orders.order_code','orders.order_date_checkin','orders.order_date_checkout','orders.order_date_checkout', 'orders.order_status',
                'pet_hotels.pet_hotel_name',
            )
            ->where('order_status', '=', $order_status)
            ->join('pet_hotels', 'orders.pet_hotel_id', '=', 'pet_hotels.pet_hotel_id')
            ->get();

            foreach($orders as $order){
                $order_details = OrderDetail::select(
                    'order_details.pet_name','order_details.pet_type','order_details.pet_size',
                    'packages.package_name',
                    DB::raw('count(custom_sops.custom_sop_id) as custom_sops_count')
                )
                ->where('order_details.order_id', '=', $order->order_id)
                ->join('custom_sops', 'order_details.order_detail_id', '=', 'custom_sops.order_detail_id')
                ->join('packages', 'packages.package_id', '=', 'order_details.package_id')
                ->groupBy(
                    'order_details.pet_name','order_details.pet_type','order_details.pet_size',
                    'packages.package_name',
                )
                ->get();

                $order->order_detail = $order_details;
            }
        }


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
        $order = Order::where('orders.order_id', '=', $request->order_id)
                        ->with([
                            'petHotel', 'petHotel.petHotelImage', 'petHotel.cancelSOP', 'orderDetail', 'orderDetail.package', 'orderDetail.customSOP'
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
