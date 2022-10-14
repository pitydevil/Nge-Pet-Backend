<?php

namespace App\Http\Controllers;

use App\Http\Helper;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function getAllList(Request $request)
    {
        $limit = intval($request->input('limit', 25));
        $package = Package::where('package_id', '=', $request->package_id)
            ->with([
                'fasilitas:fasilitas_id', 'fasilitas_name', 'fasilitas_description',
            ])
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => Helper::paginate($package),
        ]);
    }

    public function getDetailID(Request $request, int $id){
        $package = Package::where('package_id', '=', $id)
            ->where('package_id', '=', $request->package_id)
            ->first();
        
        if (!$package)  {
            return response()->json([
                'status' => 404,
                'error' => 'PACKAGE_NOT_FOUND',
                'data' => null,
            ], 404);
        }
        
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => $package,
        ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'package_price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $package = Package::create([
            'creation_date' => $request->post('creation_date', Carbon::now()),
            'package_price' => $request->post('package_price'),
        ]);

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'package_price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => 'INVALID_REQUEST',
                'data' => $validator->errors(),
            ], 400);
        }

        $package = Package::where('package_id', '=', $id)
            ->first();

        if (!$package) return response()->json([
            'status' => 404,
            'error' => 'PET_HOTEL_IMAGE_NOT_FOUND',
            'data' => null,
        ], 404);

        $package->package_id = $request->post('package_id', $package->package_id);
        $package->package_price = $request->post('package_price', $package->package_price);
        $package->save();

        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    public function delete(Request $request, int $id){
        $package = Package::where('package_id', '=', $id)
            ->first();

        if (!$package) {
            return response()->json([
                'status' => 404,
                'error' => 'PACKAGE_NOT_FOUND',
                'data' => null,
            ], 404);
        } 

        $package->delete();
        return response()->json([
            'status' => 200,
            'error' => null,
            'data' => null,
        ]);
    }

    
}
