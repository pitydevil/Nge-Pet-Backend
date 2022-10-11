<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StoreasuransiRequest;
use App\Http\Requests\UpdateasuransiRequest;
use App\Models\asuransi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsuransiController extends Controller
{
    public function getAllList(Request $request){
        $limit = intval($request->input('limit', 25));
        $asuransi = Asuransi::where('asuransi_id', '=', $request->asuransi_id)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($asuransi),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $asuransi = Asuransi::where('asuransi_id', '=', $id)
            ->where('asuransi_id', '=', $request->asuransi_id)
            ->first();
        
        if (!$asuransi)  {
            return response()->json([
                'status' => 404,
                'error' => 'ASURANSI_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $asuransi,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'asuransi_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $asuransi = Asuransi::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'asuransi_name' => $request->post('asuransi_name'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'asuransi_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $asuransi = Asuransi::where('asuransi_id', '=', $id)
            ->first();

        if (!$asuransi) return response()->json([
            'status' => 404,
            'error' => 'ASURANSI_NOT_FOUND',
            'data' => null,
        ], 404);

        $asuransi->asurasi_id = $request->post('asuransi_id', $asuransi->asurasi_id);
        $asuransi->asuransi_name = $request->post('asuransi_name', $asuransi->asuransi_name);
        $asuransi->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $asuransi = Asuransi::where('asuransi_id', '=', $id)
            ->first();

        if (!$asuransi) {
            return response()->json([
                'status' => 404,
                'error' => 'ASURANSI_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $asuransi->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}
