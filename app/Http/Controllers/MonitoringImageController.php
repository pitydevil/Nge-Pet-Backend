<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StoreMonitoringImageRequest;
use App\Http\Requests\UpdateMonitoringImageRequest;
use App\Models\MonitoringImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonitoringImageController extends Controller
{
    public function getAllList(Request $request)
    {
        $limit = intval($request->input('limit', 25));
        $monitoring_image = MonitoringImage::where('monitoring_image_id', '=', $request->monitoring_image_id)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($monitoring_image),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $monitoring_image = MonitoringImage::where('monitoring_image_id', '=', $id)
            ->where('monitoring_image_id', '=', $request->monitoring_image_id)
            ->first();
        
        if (!$monitoring_image)  {
            return response()->json([
                'status' => 404,
                'error' => 'MONITORING_IMAGE_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $monitoring_image,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'monitoring_image_url' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $monitoring_image = MonitoringImage::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'monitoring_image_url' => $request->post('monitoring_image_url'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'monitoring_image_url' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $monitoring_image = MonitoringImage::where('monitoring_image_url', '=', $id)
            ->first();

        if (!$monitoring_image) return response()->json([
            'status' => 404,
            'error' => 'MONITORING_IMAGE_NOT_FOUND',
            'data' => null,
        ], 404);

        $monitoring_image->monitoring_image_id = $request->post('monitoring_image_id', $monitoring_image->monitoring_image_id);
        $monitoring_image->monitoring_image_url = $request->post('monitoring_image_url', $monitoring_image->monitoring_image_url);
        $monitoring_image->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $monitoring_image = MonitoringImage::where('monitoring_image_id', '=', $id)
            ->first();

        if (!$monitoring_image) {
            return response()->json([
                'status' => 404,
                'error' => 'MONITORING_IMAGE_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $monitoring_image->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}
