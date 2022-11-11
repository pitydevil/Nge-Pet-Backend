<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StoreMonitoringRequest;
use App\Http\Requests\UpdateMonitoringRequest;
use App\Models\Monitoring;
use App\Models\MonitoringImage;
use App\Models\PetHotel;
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

    public function getMonitoringByDate(Request $request){
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

    public function getMonitoringDataTest1(Request $request){
        $order_status   = "finish-order";
        $user_id        = $request->user_id;
        date_default_timezone_set("Asia/Jakarta");
        $today          = date("Y-m-d");

        $data = array();

        $orders         = Order::where('user_id', $user_id)->where('order_status', '!=', $order_status)->get();

        if (!$orders)  {
            return response()->json([
                'status' => 404,
                'error' => 'ORDER_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        foreach($orders as $order){
            $pet_hotel      = PetHotel::where('pet_hotel_id', $order->pet_hotel_id)->first();
            $order_details  = OrderDetail::where('order_id', $order->order_id)->get();

            foreach($order_details as $order_detail){
                $monitorings        = Monitoring::where('order_detail_id', $order_detail->order_detail_id)->whereDate('created_at', 'LIKE', $today)->with('MonitoringImage')->get();

                if (!$monitorings)  {
                    return response()->json([
                        'status' => 404,
                        'error' => 'MONITORING_NOT_FOUND',
                        'data' => null,
                    ], 404);
                }

                foreach ($monitorings as $monitoring) {
                    $time_upload                = date("Y-m-d h:i:sa", strtotime($monitoring->created_at));
                    $time_now                   = date("Y-m-d h:i:sa");
                    $from_time = strtotime($time_upload);
                    $to_time = strtotime($time_now);
                    $diff_time = round(abs($from_time - $to_time) / 60);
                    if($diff_time < 60){
                        $diff_time = round(abs($from_time - $to_time) / 60). "m";
                    }else if($diff_time >= 60 && $diff_time < 1440){
                        $diff_time = round($diff_time/60). "h";
                    }else if($diff_time > 60 && $diff_time > 1440){
                        $diff_time = date("d M y, H.i", strtotime($monitoring->created_at));
                    }

                    $custom_sop_value   = array();

                    $custom_sops_datas  = explode(',',$monitoring->custom_sops);
                    foreach($custom_sops_datas as $custom_sop_data){
                        $custom_sops        = CustomSOP::where('custom_sop_id', $custom_sop_data)->get();

                        foreach($custom_sops as $custom_sop){
                            array_push($custom_sop_value, $custom_sop);
                        }
                    }

                    $monitoring->time_upload    = $diff_time;
                    $monitoring->pet_hotel_name = $pet_hotel->pet_hotel_name;
                    $monitoring->pet_name       = $order_detail->pet_name;
                    $monitoring->custom_sops    = $custom_sop_value;
                    array_push($data, $monitoring);
                }
            }
        }

        return response()->json([
                'status' => 200,
                'error' => null,
                'data' => $data
            ]);
    }

    public function getMonitoringDataTest2(Request $request){
        $order_status   = "finish-order";
        $user_id        = $request->user_id;
        $date           = $request->date;

        $data = array();

        $orders         = Order::where('user_id', $user_id)->where('order_status', '!=', $order_status)->get();

        if (!$orders)  {
            return response()->json([
                'status' => 404,
                'error' => 'ORDER_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        foreach($orders as $order){
            $pet_hotel      = PetHotel::where('pet_hotel_id', $order->pet_hotel_id)->first();
            $order_details  = OrderDetail::where('order_id', $order->order_id)->get();

            foreach($order_details as $order_detail){
                $monitorings        = Monitoring::where('order_detail_id', $order_detail->order_detail_id)->whereDate('created_at', 'LIKE', $date)->with('MonitoringImage')->get();

                if (!$monitorings)  {
                    return response()->json([
                        'status' => 404,
                        'error' => 'MONITORING_NOT_FOUND',
                        'data' => null,
                    ], 404);
                }

                foreach ($monitorings as $monitoring) {
                    date_default_timezone_set("Asia/Jakarta");
                    $time_now       = date("Y-m-d");
                    $time_delta     = "";

                    if($date == $time_now){
                        $time_upload                = date("Y-m-d h:i:sa", strtotime($monitoring->created_at));
                        $time_now                   = date("Y-m-d h:i:sa");
                        $from_time  = strtotime($time_upload);
                        $to_time    = strtotime($time_now);
                        $diff_time  = round(abs($from_time - $to_time) / 60);
                        if($diff_time < 60){
                            $diff_time  = round(abs($from_time - $to_time) / 60). "m";
                        }else if($diff_time >= 60 && $diff_time < 1440){
                            $diff_time  = round($diff_time/60). "h";
                        }
                        $time_delta = $diff_time;
                    }else if($date < $time_now){
                        $time_delta = date("d M y, H.i", strtotime($monitoring->created_at));
                    }

                    $custom_sop_value   = array();

                    $custom_sops_datas  = explode(',',$monitoring->custom_sops);
                    foreach($custom_sops_datas as $custom_sop_data){
                        $custom_sops    = CustomSOP::where('custom_sop_id', $custom_sop_data)->get();

                        foreach($custom_sops as $custom_sop){
                            array_push($custom_sop_value, $custom_sop);
                        }
                    }

                    $monitoring->time_upload    = $time_delta;
                    $monitoring->pet_hotel_name = $pet_hotel->pet_hotel_name;
                    $monitoring->pet_name       = $order_detail->pet_name;
                    $monitoring->custom_sops    = $custom_sop_value;
                    array_push($data, $monitoring);
                }
            }
        }

        return response()->json([
                'status' => 200,
                'error' => null,
                'data' => $data
            ]);
    }

    public function getMonitoringData(Request $request){
        $order_status   = "finish-order";
        $user_id        = $request->user_id;
        $date           = $request->date;
        $pets           = $request->pets;

        $data = array();

        $orders         = Order::where('user_id', $user_id)->where('order_status', '!=', $order_status)->get();

        if (!$orders)  {
            return response()->json([
                'status' => 404,
                'error' => 'ORDER_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        foreach($orders as $order){
            $pet_hotel      = PetHotel::where('pet_hotel_id', $order->pet_hotel_id)->first();


                foreach($pets as $pet){
                    $order_details  = OrderDetail::where([
                        ['order_id', $order->order_id],
                        ['pet_name', $pet['pet_name']],
                        ['pet_type', $pet['pet_type']],
                        ['pet_size', $pet['pet_size']]
                    ])->get();

                    foreach($order_details as $order_detail){
                        $monitorings        = Monitoring::where('order_detail_id', $order_detail->order_detail_id)->whereDate('created_at', 'LIKE', $date)->with('MonitoringImage')->get();
        
                        if (!$monitorings)  {
                            return response()->json([
                                'status' => 404,
                                'error' => 'MONITORING_NOT_FOUND',
                                'data' => null,
                            ], 404);
                        }
        
                        foreach ($monitorings as $monitoring) {
                            date_default_timezone_set("Asia/Jakarta");
                            $time_now       = date("Y-m-d");
                            $time_delta     = "";
        
                            if($date == $time_now){
                                $time_upload                = date("Y-m-d h:i:sa", strtotime($monitoring->created_at));
                                $time_now                   = date("Y-m-d h:i:sa");
                                $from_time  = strtotime($time_upload);
                                $to_time    = strtotime($time_now);
                                $diff_time  = round(abs($from_time - $to_time) / 60);
                                if($diff_time < 60){
                                    $diff_time  = round(abs($from_time - $to_time) / 60). "m";
                                }else if($diff_time >= 60 && $diff_time < 1440){
                                    $diff_time  = round($diff_time/60). "h";
                                }
                                $time_delta = $diff_time;
                            }else if($date < $time_now){
                                $time_delta = date("d M y, H.i", strtotime($monitoring->created_at));
                            }
        
                            $custom_sop_value   = array();
        
                            $custom_sops_datas  = explode(',',$monitoring->custom_sops);
                            foreach($custom_sops_datas as $custom_sop_data){
                                $custom_sops    = CustomSOP::where('custom_sop_id', $custom_sop_data)->get();
        
                                foreach($custom_sops as $custom_sop){
                                    array_push($custom_sop_value, $custom_sop);
                                }
                            }
        
                            $monitoring->time_upload    = $time_delta;
                            $monitoring->pet_hotel_name = $pet_hotel->pet_hotel_name;
                            $monitoring->pet_name       = $order_detail->pet_name;
                            $monitoring->custom_sops    = $custom_sop_value;
                            array_push($data, $monitoring);
                        }
                    }
                }

        }

        return response()->json([
                'status' => 200,
                'error' => null,
                'data' => $data
            ]);
    }
}
