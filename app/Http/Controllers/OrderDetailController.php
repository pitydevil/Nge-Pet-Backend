<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;
use App\Models\CustomSOP;
use App\Models\Monitoring;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderDetailController extends Controller
{
    public function getAllList(Request $request)
    {
        $limit = intval($request->input('limit', 25));
        $order = OrderDetail::where('order_detail_id', '=', $request->order_id)
            ->with([
                'orders:order_id,user_id,pet_hotel_id,order_name,order_status,order_date_checkin,order_date_checkout',
                'monitorings:monitoring_id,monitoring_name,monitoring_image_id',
                'packages:package_id,fasilitas_id,supported_pet_id,package_price',
                'custom_sops:custom_sop_id,custom_sop_name'

            ])
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Order::paginate($order),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $order = OrderDetail::where('order_detail_id', '=', $id)
            ->where('order_id', '=', $request->order_detail_id)
            ->with([
                'orders,orders.order_id,orders.user_id,orders.pet_hotel_id,orders.order_name,orders.order_status,orders.order_date_checkin,orders.order_date_checkout',
                'monitorings,monitorings.monitoring_id,monitorings.monitoring_name,monitorings.monitoring_image_id',
                'packages,packages.package_id,packages.fasilitas_id,packages.supported_pet_id,packages.package_price',
                'custom_sops,custom_sops.custom_sop_id,custom_sops.custom_sop_name'
            ])
            ->first();
        
        if (!$order)  {
            return response()->json([
                'status' => 404,
                'error' => 'ORDER_DETAIL_NOT_FOUND',
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
            'pet_name' => 'required|string',
            'pet_type' => 'required|string',
            'order_detail_price' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $order = Monitoring::where('order_id', '=', $request->post('order_id'))->first();
 
        if (!$order) {
            return response()->json([
            'status' => 404,
             'error' => 'ORDER_ID_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        $monitoring = Monitoring::where('monitoring_id', '=', $request->post('monitoring_id'))->first();
 
        if (!$monitoring) {
            return response()->json([
            'status' => 404,
             'error' => 'MONITORING_ID_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        $package = Package::where('package_id', '=', $request->post('package_id'))->first();
 
        if (!$package) {
            return response()->json([
            'status' => 404,
             'error' => 'PACKAGE_ID_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        $custom_sop = CustomSOP::where('custom_sop_id', '=', $request->post('custom_sop_id'))->first();
 
        if (!$package) {
            return response()->json([
            'status' => 404,
             'error' => 'CUSTOM_SOP_ID_NOT_FOUND', 
             'data' => null ], 
             404);
        }

       OrderDetail::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'order_id' => $order->order_id,
            'monitoring_id' => $monitoring->monitoring_id,
            'package_id' => $package->package_id,
            'custom_sop_id' => $custom_sop->custom_sop_id,
            'pet_name' => $request->post('pet_name'),
            'pet_type' => $request->post('pet_type'),
            'order_detail_price' => $request->post('order_detail_price'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'pet_name' => 'required|string',
            'pet_type' => 'required|string',
            'order_detail_price' => 'required|string',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $order_detail = OrderDetail::where('order_detail_id', '=', $id)
            ->first();

        $order = Order::where('order_id', '=', $request->post('order_id'))->first();
 
        if (!$order) {
            return response()->json([
            'status' => 404,
             'error' => 'ORDER_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        $monitoring = Monitoring::where('monitoring_id', '=', $request->post('monitoring_id'))->first();
 
        if (!$monitoring) {
            return response()->json([
            'status' => 404,
             'error' => 'MONITORING_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        $package = Package::where('package_id', '=', $request->post('package_id'))->first();
 
        if (!$package) {
            return response()->json([
            'status' => 404,
             'error' => 'PACKAGE_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        $custom_sop = CustomSOP::where('custom_sop_id', '=', $request->post('custom_sop_id'))->first();
 
        if (!$custom_sop) {
            return response()->json([
            'status' => 404,
             'error' => 'CUSTOM_SOP_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        if (!$order_detail) return response()->json([
            'status' => 404,
            'error' => 'ORDER_DETAIL_NOT_FOUND',
            'data' => null,
        ], 404);

        $order_detail->order_detail_id = $request->post('order_detail_id', $order_detail->order_detail_id);
        $order_detail->order_id = $request->post('order_id', $order_detail->order_id);
        $order_detail->monitoring_id = $request->post('monitorng_id', $order_detail->monitoring_id);
        $order_detail->package_id = $request->post('package_id', $order_detail->package_id);
        $order_detail->custom_sop_id = $request->post('custom_sop_id', $order_detail->custom_sop_id);
        $order_detail->pet_name = $request->post('pet_name', $order_detail->pet_name);
        $order_detail->pet_type = $request->post('pet_type', $order_detail->pet_type);
        $order_detail->order_detail_price = $request->post('order_detail_price', $order_detail->order_detail_price);
        $order_detail->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $order = OrderDetail::where('order_detail_id', '=', $id)
            ->first();

        if (!$order) {
            return response()->json([
                'status' => 404,
                'error' => 'ORDER_DETAIL_NOT_FOUND',
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
