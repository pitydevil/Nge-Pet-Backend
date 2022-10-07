<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storecancel_sopRequest;
use App\Http\Requests\Updatecancel_sopRequest;
use App\Models\cancel_sop;

class CancelSopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storecancel_sopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storecancel_sopRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cancel_sop  $cancel_sop
     * @return \Illuminate\Http\Response
     */
    public function show(cancel_sop $cancel_sop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cancel_sop  $cancel_sop
     * @return \Illuminate\Http\Response
     */
    public function edit(cancel_sop $cancel_sop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatecancel_sopRequest  $request
     * @param  \App\Models\cancel_sop  $cancel_sop
     * @return \Illuminate\Http\Response
     */
    public function update(Updatecancel_sopRequest $request, cancel_sop $cancel_sop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cancel_sop  $cancel_sop
     * @return \Illuminate\Http\Response
     */
    public function destroy(cancel_sop $cancel_sop)
    {
        //
    }
}
