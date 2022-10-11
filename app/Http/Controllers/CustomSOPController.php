<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomSOPRequest;
use App\Http\Requests\UpdateCustomSOPRequest;
use App\Models\CustomSOP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Helper;

class CustomSOPController extends Controller
{
    public function getAllList(Request $request)
    {
        $limit = intval($request->input('limit', 25));
        $custom_sop = CustomSOP::where('custom_sop_id', '=', $request->custom_sop_id)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($custom_sop),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $custom_sop = CustomSOP::where('custom_sop_id', '=', $id)
            ->where('custom_sop_id', '=', $request->custom_sop_id)
            ->first();
        
        if (!$custom_sop)  {
            return response()->json([
                'status' => 404,
                'error' => 'CUSTOM_SOP_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $custom_sop,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'custom_sop_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $custom_sop = CustomSOP::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'custom_sop_name' => $request->post('custom_sop_name'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'custom_sop_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $custom_sop = CustomSOP::where('custom_sop_id', '=', $id)
            ->first();

        if (!$custom_sop) return response()->json([
            'status' => 404,
            'error' => 'CUSTOM_SOP_NOT_FOUND',
            'data' => null,
        ], 404);

        $custom_sop->custom_sop_id = $request->post('custom_sop_id', $custom_sop->custom_sop_id);
        $custom_sop->custom_sop_name = $request->post('custom_sop_name', $custom_sop->custom_sop_name);
        $custom_sop->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $custom_sop = CustomSOP::where('custom_sop_id', '=', $id)
            ->first();

        if (!$custom_sop) {
            return response()->json([
                'status' => 404,
                'error' => 'CUSTOM_SOP_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $custom_sop->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

}
