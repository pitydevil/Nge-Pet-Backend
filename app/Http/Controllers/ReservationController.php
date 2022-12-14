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

        $package                            = Package::where('pet_hotel_id', $request->pet_hotel_id)->orderBy('package_price', 'asc')->first();
        $pet_hotel->pet_hotel_start_price   = number_format($package->package_price, 0, ",", ".");

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

        foreach($packages as $package){
            //Get supported pet type data for certain supported pet and put into supported pet object
            $supported_pet     = SupportedPet::where('supported_pet_id', $package->supported_pet_id)->first();
            $package->supported_pet_name = $supported_pet->supported_pet_name;
        }

        $filtered_packages = array();

        foreach($packages as $package){
            if($package->supported_pet_name === $request->supported_pet_name) {
                array_push($filtered_packages, $package);
            }
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $filtered_packages,
        ]);
    }

    public function getOrderList(Request $request){
        $order_status   = "finish-order";
        $user_id        = $request->user_id;

        if($request->order_status == "aktif") {
            $orders = Order::select(
                'orders.order_id', 'orders.user_id', 'orders.order_code','orders.order_date_checkin','orders.order_date_checkout','orders.order_date_checkout', 'orders.order_status',
                'pet_hotels.pet_hotel_name',
            )
            ->where('order_status', '!=', $order_status)
            ->where('user_id', $user_id)
            ->join('pet_hotels', 'orders.pet_hotel_id', '=', 'pet_hotels.pet_hotel_id')
            ->get();

            foreach($orders as $order){
                $order_details = OrderDetail::select(
                    'order_details.order_detail_id',
                    'order_details.pet_name','order_details.pet_type','order_details.pet_size',
                    'packages.package_name',
                    DB::raw('count(custom_sops.custom_sop_id) as custom_sops_count')
                )
                ->where('order_details.order_id', '=', $order->order_id)
                ->join('custom_sops', 'order_details.order_detail_id', '=', 'custom_sops.order_detail_id')
                ->join('packages', 'packages.package_id', '=', 'order_details.package_id')
                ->groupBy(
                    'order_details.order_detail_id',
                    'order_details.pet_name','order_details.pet_type','order_details.pet_size',
                    'packages.package_name',
                )
                ->get();

                $order->order_detail = $order_details;
            }

        } else if($request->order_status == "riwayat") {

            $orders = Order::select(
                'orders.order_id', 'orders.user_id', 'orders.order_code','orders.order_date_checkin','orders.order_date_checkout','orders.order_date_checkout', 'orders.order_status',
                'pet_hotels.pet_hotel_name',
            )
            ->where('order_status', '=', $order_status)
            ->where('user_id', $user_id)
            ->join('pet_hotels', 'orders.pet_hotel_id', '=', 'pet_hotels.pet_hotel_id')
            ->get();

            foreach($orders as $order){
                $order_details = OrderDetail::select(
                    'order_details.order_detail_id','order_details.pet_name','order_details.pet_type','order_details.pet_size',
                    'packages.package_name',
                    DB::raw('count(custom_sops.custom_sop_id) as custom_sops_count')
                )
                ->where('order_details.order_id', '=', $order->order_id)
                ->join('custom_sops', 'order_details.order_detail_id', '=', 'custom_sops.order_detail_id')
                ->join('packages', 'packages.package_id', '=', 'order_details.package_id')
                ->groupBy('order_details.order_detail_id',
                    'order_details.pet_name','order_details.pet_type','order_details.pet_size',
                    'packages.package_name',
                )
                ->get();

                $order->order_detail = $order_details;
            }
        } else {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => null,
            ]);
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
                            'petHotel', 'petHotel.petHotelImage', 'petHotel.cancelSOP'
                        ])
                        ->first();

        if (!$order)  {
            return response()->json([
                'status' => 404,
                'error' => 'ORDER_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        $order_detail = OrderDetail::where('order_details.order_id', '=', $request->order_id)
                        ->with([
                            'package', 'customSOP'
                        ])
                        ->get();

        foreach($order_detail as $detail){
            $sops_count = OrderDetail::select(
                'order_details.order_detail_id',
                DB::raw('count(custom_sops.custom_sop_id) as custom_sops_count')
            )
            ->where('order_details.order_detail_id', '=', $detail->order_detail_id)
            ->join('custom_sops', 'order_details.order_detail_id', '=', 'custom_sops.order_detail_id')
            ->join('packages', 'packages.package_id', '=', 'order_details.package_id')
            ->groupBy('order_details.order_detail_id',
            )
            ->first();

            $detail->custom_sops_count = $sops_count->custom_sops_count;
        }

        // bind order detail to order have order detail
        $order->order_detail = $order_detail;

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $order,
        ]);
    }

    public function addOrder(Request $request){

        function generateOrderCode() {
            $order_count = Order::count();
            $order_code = 'ORD-';
            if(($order_count+ 1) < 10) {
                $order_code .= '00' .($order_count+ 1);
            } else if(($order_count+ 1) < 100) {
                $order_code .= '0' .($order_count+ 1);
            } else {
                $order_code .($order_count+ 1);
            }
            return $order_code;
        }

        $validator_order = Validator::make($request->all(), [
            'order_total_price' => 'required|integer',
            'order_date_checkin' => 'required|string',
            'order_date_checkin' => 'required|string',
        ]);

        if ($validator_order->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator_order->errors(),
            ], 400);
        }

        $order = Order::create([
            'order_code' => generateOrderCode(),
            'order_date_checkin' => $request->post('order_date_checkin'),
            'order_date_checkout' => $request->post('order_date_checkout'),
            'order_total_price' => $request->post('order_total_price'),
            'order_status' =>  "waiting-for-confirmation",
            'user_id' => $request->post('user_id'),
            'pet_hotel_id' => $request->post('pet_hotel_id'),
        ]);

        $order_details = $request->order_details;

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

            $custom_sops = $order_detail['custom_sops'];

            foreach($custom_sops as $custom_sop)
            {
                CustomSOP::create([
                    'custom_sop_name' => $custom_sop['custom_sop_name'],
                    'order_detail_id' => $detail->order_detail_id,
                ]);
            }
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}
