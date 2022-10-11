<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StorefasilitasRequest;
use App\Http\Requests\UpdatefasilitasRequest;
use App\Models\fasilitas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FasilitasController extends Controller
{
    public function getAllList(Request $request){
        $limit = intval($request->input('limit', 25));
        $fasilitas = Fasilitas::where('fasilitas_id', '=', $request->fasilitas_id)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($fasilitas),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $fasilitas = Fasilitas::where('fasilitas_id', '=', $id)
            ->where('fasilitas_id', '=', $request->fasilitas_id)
            ->first();
        
        if (!$fasilitas)  {
            return response()->json([
                'status' => 404,
                'error' => 'FASILITAS_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $fasilitas,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'fasilitas_name' => 'required|string',
            'fasilitas_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $fasilitas = Fasilitas::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'fasilitas_name' => $request->post('fasilitas_name'),
            'fasilitas_description' => $request->post('fasilitas_description'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'fasilitas_name' => 'required|string',
            'fasilitas_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $fasilitas = Fasilitas::where('fasilitas_id', '=', $id)
            ->first();

        if (!$fasilitas) return response()->json([
            'status' => 404,
            'error' => 'FASILITAS_NOT_FOUND',
            'data' => null,
        ], 404);

        $fasilitas->fasilitas_id = $request->post('fasilitas_id', $fasilitas->fasilitas_id);
        $fasilitas->fasilitas_name = $request->post('fasilitas_name', $fasilitas->fasilitas_name);
        $fasilitas->fasilitas_description = $request->post('fasilitas_description', $fasilitas->fasilitas_description);
        $fasilitas->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $fasilitas = Fasilitas::where('fasilitas_id', '=', $id)
            ->first();

        if (!$fasilitas) {
            return response()->json([
                'status' => 404,
                'error' => 'FASILITAS_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $fasilitas->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }
}
