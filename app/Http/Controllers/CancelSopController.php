<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storecancel_sopRequest;
use App\Http\Requests\Updatecancel_sopRequest;
use App\Models\CancelSOP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Http\Helper;

class CancelSopController extends Controller
{
    public function getAllList(Request $request){
        $limit = intval($request->input('limit', 25));
        $cancel_sop = CancelSOP::where('cancel_sops_id', '=', $request->cancel_sops_id)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($cancel_sop),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $cancel_sop = CancelSOP::where('cancel_sops_id', '=', $id)
            ->where('cancel_sops_id', '=', $request->cancel_sops_id)
            ->first();
        
        if (!$cancel_sop)  {
            return response()->json([
                'status' => 404,
                'error' => 'CANCEL_SOP_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $cancel_sop,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'cancel_sops_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $cancel_sop = CancelSOP::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'cancel_sops_description' => $request->post('cancel_sops_description'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'cancel_sops_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $cancel_sop = CancelSOP::where('cancel_sops_id', '=', $id)
            ->first();

        if (!$cancel_sop) return response()->json([
            'status' => 404,
            'error' => 'CANCEL_SOP_NOT_FOUND',
            'data' => null,
        ], 404);

        $cancel_sop->cancel_sops_id = $request->post('cancel_sops_id', $cancel_sop->cancel_sops_id);
        $cancel_sop->cancel_sops_description = $request->post('cancel_sops_description', $cancel_sop->cancel_sops_description);
        $cancel_sop->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $cancel_sop = CancelSOP::where('cancel_sops_id', '=', $id)
            ->first();

        if (!$cancel_sop) {
            return response()->json([
                'status' => 404,
                'error' => 'CANCEL_SOP_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $cancel_sop->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}
