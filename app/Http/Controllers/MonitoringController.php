<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StoreMonitoringRequest;
use App\Http\Requests\UpdateMonitoringRequest;
use App\Models\Monitoring;
use App\Models\MonitoringImage;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\CustomSOP;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonitoringController extends Controller
{
    public function getDetailMonitoring(Request $request){
        $order_id          = $request->order_id;
        $order = Order::where('order_id', '=', $order_id)->where('order_status', '=', 'diproses')
        ->with([
            'petHotel:pet_hotel_id,pet_hotel_name,pet_hotel_description,pet_hotel_longitude,pet_hotel_latitude,pet_hotel_address',
        ])
        ->first();

        if (!$order) {
            return response()->json([
                'status' => 404,
                'error' => "EMPTY ORDER",
                'data' => null,
            ], 404);
        }

        $result = $order->toArray();

        $result['order_detail'] = $order->orderDetail->map(function ($orderDetail) {
            $monitoring_array = Monitoring::where('order_detail_id', '=', $orderDetail->order_detail_id)->get()->all();
            $cart = array();
            foreach ($monitoring_array as $object) {
                $test = MonitoringImage::where('monitoring_id', '=', $object->monitoring_id)->get()->all();
                foreach ($test as $d) {
                    array_push($cart, $d);
                }
            }
            $cart = collect($cart);
            return [
                'order_detail_id' => $orderDetail->order_detail_id,
                'pet_name' => $orderDetail->pet_name,
                'pet_type' => $orderDetail->pet_type,
                'pet_size' => $orderDetail->pet_size,
                'order_detail_price' => $orderDetail->order_detail_price,
                'custom_SOP' => CustomSOP::where('order_detail_id', '=', $orderDetail->order_detail_id)->get()->all(),
                'monitoring' => $monitoring_array,

                'monitoring_image' => $cart->map(function ($c) {
                    return [
                       'monitoring_image_id' => $c->monitoring_image_id,
                       'monitoring_image_url' => $c->monitoring_image_url,
                    ];
                }),
            ];
        });

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $result,
        ], 200);
    }

    public function getAllByDate(Request $request){
        $date = $request->date;
        $time = strtotime($date);
        $date_object = date('Y-m-d',$time);
        $order = Order::where('order_status', '=', 'diproses')
        ->with([
            'petHotel:pet_hotel_id,pet_hotel_name,pet_hotel_description,pet_hotel_longitude,pet_hotel_latitude,pet_hotel_address',
        ])->get()->all();

        if (!$order) {
            return response()->json([
                'status' => 404,
                'error' => "EMPTY ORDER",
                'data' => null,
            ], 404);
        }

        $cart = array();

        foreach ($order as $object) {
            $result = $object->toArray();
            $result['order_detail'] = $object->orderDetail->map(function ($orderDetail) use ($date_object) {
                $monitoring_array = Monitoring::where('order_detail_id', '=', $orderDetail->order_detail_id)->whereDate('created_at', '=', $date_object)->get()->all();
                $test = array();
                foreach ($monitoring_array as $object) {
                    $x = MonitoringImage::where('monitoring_id', '=', $object->monitoring_id)->get()->all();
                    foreach ($x as $d) {
                        array_push($test, $d);
                    }
                }
                $test = collect($test);
                return [
                    'order_detail_id' => $orderDetail->order_detail_id,
                    'pet_name' => $orderDetail->pet_name,
                    'pet_type' => $orderDetail->pet_type,
                    'pet_size' => $orderDetail->pet_size,
                    'order_detail_price' => $orderDetail->order_detail_price,
                    'custom_SOP' => CustomSOP::where('order_detail_id', '=', $orderDetail->order_detail_id)->get()->all(),
                    'monitoring' => $monitoring_array,
    
                    'monitoring_image' => $test->map(function ($c) {
                        return [
                        'monitoring_image_id' => $c->monitoring_image_id,
                          'monitoring_image_url' => $c->monitoring_image_url,
                        ];
                    }),
                ];
           });
           array_push($cart, $result);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $cart,
        ], 200);
    }

    public function getPetByDate(Request $request){
        $final_pet = array();
        $date = $request->date;
        $pet_array = array();
        foreach($request->pets as $value) {
            $time = strtotime($date);
            $date_object = date('Y-m-d',$time);
            $order = Order::where('order_status', '=', 'diproses')
            ->with([
                'petHotel:pet_hotel_id,pet_hotel_name,pet_hotel_description,pet_hotel_longitude,pet_hotel_latitude,pet_hotel_address',
            ])->get()->all();

            if (!$order) {
                return response()->json([
                    'status' => 404,
                    'error' => "EMPTY ORDER",
                    'data' => null,
                ], 404);
            }
            
            foreach ($order as $object) {
                $order_detail = OrderDetail::where('order_id', '=', $object->order_id)->where('pet_name', $value['pet_name'])->get()->all();
                foreach ($order_detail as $od) {
                    $monitoring_array = Monitoring::where('order_detail_id', '=', $od->order_detail_id)->whereDate('created_at', '=', $date_object)->get()->all();
                    $test = array();
                    foreach ($monitoring_array as $object) {
                        $x = MonitoringImage::where('monitoring_id', '=', $object->monitoring_id)->get()->all();
                        foreach ($x as $d) {
                            array_push($test, $d);
                        }
                    }
                    $test = collect($test);

                    $final_pet = [
                        'order_detail_id' => $od->order_detail_id,
                        'pet_name' => $od->pet_name,
                        'pet_type' => $od->pet_type,
                        'pet_size' => $od->pet_size,
                        'order_detail_price' => $od->order_detail_price,
                        'custom_SOP' => CustomSOP::where('order_detail_id', '=', $od->order_detail_id)->get()->all(),
                        'monitoring' => $monitoring_array,
                        'monitoring_image' => $test->map(function ($c) {
                            return [
                            'monitoring_image_id' => $c->monitoring_image_id,
                            'monitoring_image_url' => $c->monitoring_image_url,
                            ];
                        }),
                    ]; 
                    array_push($pet_array, $final_pet);  
                }
            }
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_array,
        ], 200);
    }

    public function addMonitoring(Request $request){
        $validator = Validator::make($request->all(), [
            'monitoring_activity' => 'required|string',
            'order_detail_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        Monitoring::create([
            'monitoring_activity' => $request->post('monitoring_activity'),
            'order_detail_id' => $request->post('order_detail_id'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

}