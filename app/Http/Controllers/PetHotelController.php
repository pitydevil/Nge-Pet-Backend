<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StorePetHotelRequest;
use App\Http\Requests\UpdatePetHotelRequest;
use App\Models\Asuransi;
use App\Models\CancelSOP;
use App\Models\Fasilitas;
use App\Models\Monitoring;
use App\Models\MonitoringImage;
use App\Models\Order;
use App\Models\CustomSOP;
use App\Models\Package;
use App\Models\PetHotel;
use App\Models\PetHotelImage;
use App\Models\SOPGeneral;
use App\Models\SupportedPet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

class PetHotelController extends Controller
{
    public function getAllList(Request $request)
    {
        $limit = intval($request->input('limit', 25));
        $pet_hotel = PetHotel::where('pet_hotel_id', '=', $request->pet_hotel_id)
            ->with([
                'sop_generals:sop_generals_id,sop_general_description,sop_generals_asuransi',
                'asuransis:asuransi_id,asuransi_name',
                'packages:package_id,fasilitas_id,supported_pet_id,package_price',
                'fasilitas:fasilitas_id,fasilitas_name,fasilitas_description',
                'cancel_sops:cancel_sops_id,cancel_sops_description',
                'supported_pets:supported_pet_id,supported_pet_name,supported_pet_type_id',
                'supported_pet_types:supported_pet_type_id,supported_pet_type_name',
                'pet_hotel_images:pet_hotel_image_id,pet_hotel_image_url',
            ])
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($pet_hotel),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $pet_hotel = PetHotel::where('pet_hotel_id', '=', $id)
            ->where('pet_hotel_id', '=', $request->pet_hotel_id)
            ->with([
                'sop_generals,sop_generals.sop_generals_id,sop_generals.sop_generals_description,sop_generals.sop_generals_asuransi',
                'asuransis,asuransis.asuransi_id,asuransis.asuransi_name',
                'packages,packages.package_id,packages.fasilitas_id,packages.supported_pet_id,packages.package_price',
                'fasilitas,fasilitas.fasilitas.fasilitas_id,fasilitas.fasilitas_name,fasilitas.fasilitas_description',
                'cancel_sops,cancel_sops.cancel_sops_id,cancel_sops.cancel_sops_description',
                'supported_pets,supported_pets.supported_pet_id,supported_pets.supported_pet_name, supported_pets.supported_pet_type_id',
                'supported_pet_types:supported_pet_type_id,supported_pet_type_name',
                'pet_hotel_images,pet_hotel_images.pet_hotel_image_id,pet_hotel_image_url',
                ])
            ->first();

        if (!$pet_hotel)  {
            return response()->json([
                'status' => 404,
                'error' => 'PET_HOTEL_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $pet_hotel,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'pet_hotel_name' => 'required|string',
            'pet_hotel_longitude' => 'required|double',
            'pet_hotel_latitude' => 'required|double',
            'pet_hotel_location' => 'required|string',
            'pet_hotel_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }


        $sop_general = SOPGeneral::where('sop_generals_id', '=', $request->post('sop_generals_id'))->first();

        if (!$sop_general) {
            return response()->json([
            'status' => 404,
             'error' => 'SOP_GENERAL_ID_NOT_FOUND',
             'data' => null ],
             404);
        }

        $asuransi = Asuransi::where('asuransi_id', '=', $request->post('asuransi_id'))->first();

        if (!$asuransi) {
            return response()->json([
            'status' => 404,
             'error' => 'ASURANSI_ID_NOT_FOUND',
             'data' => null ],
             404);
        }


        $package = Package::where('package_id', '=', $request->post('package_id'))->first();

        if (!$package) {
            return response()->json([
            'status' => 404,
             'error' => 'PACKAGES_ID_NOT_FOUND',
             'data' => null ],
             404);
        }

        $fasilitas = Fasilitas::where('fasilitas_id', '=', $request->post('fasilitas_id'))->first();

        if (!$fasilitas) {
            return response()->json([
            'status' => 404,
             'error' => 'FASILITAS_ID_NOT_FOUND',
             'data' => null ],
             404);
        }


        $cancel_sop = CancelSOP::where('cancel_sops_id', '=', $request->post('cancel_sops_id'))->first();

        if (!$cancel_sop) {
            return response()->json([
            'status' => 404,
             'error' => 'CANCEL_SOP_ID_NOT_FOUND',
             'data' => null ],
             404);
        }

        $supported_pet = SupportedPet::where('supported_pet_id', '=', $request->post('supported_pet_id'))->first();

        if (!$supported_pet) {
            return response()->json([
            'status' => 404,
             'error' => 'SUPPORTED_PET_ID_NOT_FOUND',
             'data' => null ],
             404);
        }

        $pet_hotel_image = PetHotelImage::where('pet_hotel_image_id', '=', $request->post('pet_hotel_image_id'))->first();

        if (!$pet_hotel_image) {
            return response()->json([
            'status' => 404,
             'error' => 'PET_HOTEL_IMAGE_ID_NOT_FOUND',
             'data' => null ],
             404);
        }

       PetHotel::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'sop_generals_id' => $sop_general->sop_generals_id,
            'asuransi_id' => $asuransi->asuransi_id,
            'package_id' => $package->package_id,
            'fasilitas_id' => $fasilitas->fasilitas_id,
            'cancel_sops_id' => $cancel_sop->cancel_sops_id,
            'supported_pet_id' => $fasilitas->supported_pet_id,
            'pet_hotel_name' => $request->post('pet_hotel_name'),
            'pet_hotel_longitude' => $request->post('pet_hotel_longitude'),
            'pet_hotel_latitude' => $request->post('latitude'),
            'pet_hotel_location' => $request->post('pet_hotel_location'),
            'pet_hotel_description' => $request->post('pet_hotel_description'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'pet_hotel_name' => 'required|string',
            'pet_hotel_longitude' => 'required|double',
            'pet_hotel_latitude' => 'required|double',
            'pet_hotel_location' => 'required|string',
            'pet_hotel_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $pet_hotel = PetHotel::where('pet_hotel_id', '=', $id)
            ->first();

        $sop_general = SOPGeneral::where('sop_generals_id', '=', $request->post('sop_generals_id'))->first();

        if (!$sop_general) {
            return response()->json([
            'status' => 404,
             'error' => 'SOP_GENERAL_NOT_FOUND',
             'data' => null ],
             404);
        }

        $asuransi = Asuransi::where('asuransi_id', '=', $request->post('asuransi_id'))->first();

        if (!$asuransi) {
            return response()->json([
            'status' => 404,
             'error' => 'ASURANSI_NOT_FOUND',
             'data' => null ],
             404);
        }


        $package = Package::where('package_id', '=', $request->post('package_id'))->first();

        if (!$package) {
            return response()->json([
            'status' => 404,
             'error' => 'PACKAGES_NOT_FOUND',
             'data' => null ],
             404);
        }

        $fasilitas = Fasilitas::where('fasilitas_id', '=', $request->post('fasilitas_id'))->first();

        if (!$fasilitas) {
            return response()->json([
                'status' => 404,
                'error' => 'FASILITAS_NOT_FOUND',
                'data' => null
            ], 404);
        }

        $cancel_sop = CancelSOP::where('cancel_sops_id', '=', $request->post('cancel_sops_id'))->first();

        if (!$cancel_sop) {
            return response()->json([
            'status' => 404,
             'error' => 'CANCEL_SOP_NOT_FOUND',
             'data' => null ],
             404);
        }

        $supported_pet = SupportedPet::where('supported_pet_id', '=', $request->post('supported_pet_id'))->first();

        if (!$supported_pet) {
            return response()->json([
                'status' => 404,
                'error' => 'SUPPORTED_PET_NOT_FOUND',
                'data' => null
            ], 404);
        }

        $pet_hotel_image = PetHotelImage::where('pet_hotel_image_id', '=', $request->post('pet_hotel_image_id'))->first();

        if (!$pet_hotel_image) {
            return response()->json([
            'status' => 404,
             'error' => 'PET_HOTEL_IMAGE_NOT_FOUND',
             'data' => null ],
             404);
        }

        if (!$pet_hotel) return response()->json([
            'status' => 404,
            'error' => 'PET_HOTEL_NOT_FOUND',
            'data' => null,
        ], 404);

        $pet_hotel->package_id = $request->post('package_id', $pet_hotel->package_id);
        $pet_hotel->sop_generals_id = $request->post('sop_generals_id', $pet_hotel->sop_generals_id);
        $pet_hotel->asuransi_id = $request->post('asuransi_id', $pet_hotel->asuransi_id);
        $pet_hotel->package_id = $request->post('package_id', $pet_hotel->package_id);
        $pet_hotel->cancel_sops_id = $request->post('cancel_sops_id', $pet_hotel->cancels_sops_id);
        $pet_hotel->fasilitas_id = $request->post('fasilitas_id', $pet_hotel->fasilitas_id);
        $pet_hotel->supported_pet_id = $request->post('supported_pet_id', $pet_hotel->supported_pet_id);
        $pet_hotel->pet_hotel_image_id = $request->post('pet_hotel_image_id', $pet_hotel->pet_hotel_image_id);
        $pet_hotel->pet_hotel_name = $request->post('pet_hotel_name', $package->pet_hotel_name);
        $pet_hotel->pet_hotel_longitude = $request->post('pet_hotel_longitude', $package->pet_hotel_longitude);
        $pet_hotel->pet_hotel_latitude = $request->post('pet_hotel_latitude', $package->pet_hotel_latitude);
        $pet_hotel->pet_hotel_location = $request->post('pet_hotel_location', $package->pet_hotel_location);
        $pet_hotel->pet_hotel_name = $request->post('pet_hotel_name', $package->pet_hotel_name);
        $pet_hotel->pet_hotel_description = $request->post('pet_hotel_description', $package->pet_hotel_description);
        $pet_hotel->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
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

        $custom_sops = $request->custom_sops;
        $custom_sops_encode = '';
        $custom_sops_counter = 0;

        foreach($custom_sops as $custom_sop) {
            if ($custom_sops_counter === count($custom_sops) - 1) {
                $custom_sops_encode .= $custom_sop['custom_sop_id'];
            } else{
                $custom_sops_encode .= $custom_sop['custom_sop_id'].',';
            }
            $custom_sops_counter++;
        }

        $monitoring =  Monitoring::create([
            'monitoring_activity' => $request->post('monitoring_activity'),
            'order_detail_id' => $request->post('order_detail_id'),
            'custom_sops' => $custom_sops_encode,
        ]);

        $monitoring_images = $request->monitoring_images;

        foreach($monitoring_images as $image) {
            MonitoringImage::create([
                'monitoring_image_url' => $image['monitoring_image_url'],
                'monitoring_id' => $monitoring->monitoring_id,
            ]);
        }

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function deleteMonitoring(Request $request, $id){
        $monitoring = Monitoring::where('monitoring_id', '=', $id)
            ->first();

        if (!$monitoring) {
            return response()->json([
                'status' => 404,
                'error' => 'MONITORING_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        $monitoring_images = MonitoringImage::where('monitoring_id', '=', $monitoring->monitoring_id)
                            ->get();

        foreach($monitoring_images as $image) {
            $image->delete();
        }

        $monitoring->delete();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
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

    public function getPetHotelOrderList(Request $request){
        $owner_id       = $request->owner_id;

        $pet_hotel      = PetHotel::where('owner_id', $owner_id)->first();

        $pet_hotel_id   = $pet_hotel->pet_hotel_id;

        $orders  = Order::where('pet_hotel_id', $pet_hotel_id)->with('OrderDetail')->with('OrderDetail.CustomSOP')->get();
        $orders->pet_hotel_name = $pet_hotel->pet_hotel_name;

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $orders,
        ]);
    }

    public function getPetHotelMonitoringList(Request $request){
        $order_detail_id    = $request->order_detail_id;
        $data = array();
        $monitorings        = Monitoring::where('order_detail_id', $order_detail_id)->get();

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
            //$monitoring->pet_hotel_name = $pet_hotel->pet_hotel_name;
            //$monitoring->pet_name       = $order_detail->pet_name;
            $monitoring->custom_sops    = $custom_sop_value;
            array_push($data, $monitoring);
        }

        return response()->json([
                'status' => 200,
                'error' => null,
                'data' => $data
            ]);
    }

    public function getCustomSOPList(Request $request){
        $order_detail_id    = $request->order_detail_id;
        $custom_sops        = CustomSOP::where('order_detail_id', $order_detail_id)->get();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $custom_sops,
        ]);
    }
}
