<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use Illuminate\Http\Request;
use App\Models\Owner;

class OwnerController extends Controller
{
    public function authOwner(Request $request)
    {
        $email  = $request->email;

        $owner  = Owner::where('email', $email)->first();

        if(!$owner){
            $owner =Owner::create([
                'email'     => $email,
                'password'  => "bebas",
                'username'  => "miss_meeting"
            ]);

            return response()->json([
                'status' => 201,
                'error' => null,
                'data' => $owner
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'error' => null,
                'data' => $owner
            ]);
        }
    }
}
