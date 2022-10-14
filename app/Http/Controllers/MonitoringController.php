<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StoreMonitoringRequest;
use App\Http\Requests\UpdateMonitoringRequest;
use App\Models\Monitoring;
use App\Models\MonitoringImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonitoringController extends Controller
{
    public function getAllList(Request $request){
        $limit = intval($request->input('limit', 25));
        $monitoring = Monitoring::where('monitoring_id', '=', $request->monitoring_id)
            ->with([
            'monitoring_images:monitoring_image_id,monitoring_image_url'
            ])
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($monitoring),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $monitoring = Monitoring::where('monitoring_id', '=', $id)
            ->where('monitoring_id', '=', $request->monitoring_id)
            ->with(['monitoring_images,monitoring_images.monitoring_image_id,monitoring_images.monitoring_image_id'])
            ->first();
        
        if (!$monitoring)  {
            return response()->json([
                'status' => 404,
                'error' => 'MONITORING_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $monitoring,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'monitoring_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $monitoring_image = MonitoringImage::where('monitoring_image_id', '=', $request->post('monitoring_image_id'))->first();
        if (!$monitoring_image) {
            return response()->json([
            'status' => 404,
             'error' => 'MONITORING_IMAGE_NOT_FOUND', 
             'data' => null ], 
             404);
        }

        Monitoring::create([
            'monitoring_image_id' => $monitoring_image->monitoring_image_id,
            'monitoring_name'    => $request->post('monitoring_name'),
            'creation_date'         => $request->post('creation_date', Carbon::now()),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'monitoring_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $monitoring = Monitoring::where('monitoring_id', '=', $id)
        ->first();
        $monitoring_image = MonitoringImage::where('monitoring_image_id', '=', $request->post('monitoring_image_id'))->first();

        if (!$monitoring_image) {
            return response()->json([
                'status' => 404, 
                'error' => 'MONITORING_IMAGE_NOT_FOUND',
                'data' => null 
            ], 404);
        }

        if (!$monitoring) {
            return response()->json([
                'status' => 404,
                'error' => 'MONITORING_NOT_FOUND',
                'data' => null,
            ], 404);
        }

        $monitoring->monitoring_id = $request->post('monitoring_id', $monitoring->monitoring_id );
        $monitoring->monitoring_image_id = $request->post('monitoring_image_id', $monitoring->monitoring_image_id);
        $monitoring->monitoring_image_url = $request->post('monitoring_image_url',  $monitoring->monitoring_image_url);
        $monitoring->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $monitoring = Monitoring::where('monitoring_id', '=', $id)
            ->first();

        if (!$monitoring) {
            return response()->json([
                'status' => 404,
                'error' => 'MONITORING_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $monitoring->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}