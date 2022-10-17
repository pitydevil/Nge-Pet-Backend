<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\Storesop_generalRequest;
use App\Http\Requests\Updatesop_generalRequest;
use App\Models\SOPGeneral;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SopGeneralController extends Controller
{   
    public function getAllList(Request $request){
        $limit = intval($request->input('limit', 25));
        $sop_general = SOPGeneral::all();
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $sop_general,
        ]);
    }

    public function getDetailID($id){
        $sop_general = SOPGeneral::where('sop_generals_id', '=', $id)
            ->first();
        
        if (!$sop_general)  {
            return response()->json([
                'status' => 404,
                'error' => 'SOP_GENERAL_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $sop_general,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'sop_generals_description' => 'required|string',
            'sop_generals_asuransi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $sop_general = SOPGeneral::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'sop_generals_description' => $request->post('sop_generals_description'),
            'sop_generals_asuransi' => $request->post('sop_generals_asuransi'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'sop_generals_description' => 'required|string',
            'sop_generals_asuransi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $sop_general = SOPGeneral::where('sop_generals_id', '=', $id)
            ->first();

        if (!$sop_general) return response()->json([
            'status' => 404,
            'error' => 'SOP_GENERAL_NOT_FOUND',
            'data' => null,
        ], 404);

        $sop_general->sop_generals_id = $request->post('sop_generals_id', $sop_general->sop_generals_id);
        $sop_general->sop_generals_description = $request->post('sop_generals_description', $sop_general->sop_generals_description);
        $sop_general->sop_generals_asuransi = $request->post('sop_generals_asuransi', $sop_general->sop_generals_asuransi);
        $sop_general->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete($id){
        $sop_general = SOPGeneral::where('sop_generals_id', '=', $id)
            ->first();

        if (!$sop_general) {
            return response()->json([
                'status' => 404,
                'error' => 'SOP_GENERAL_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $sop_general->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}
