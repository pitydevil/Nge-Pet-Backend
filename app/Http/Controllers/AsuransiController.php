<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreasuransiRequest;
use App\Http\Requests\UpdateasuransiRequest;
use App\Models\asuransi;

class AsuransiController extends Controller
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
     * @param  \App\Http\Requests\StoreasuransiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreasuransiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\asuransi  $asuransi
     * @return \Illuminate\Http\Response
     */
    public function show(asuransi $asuransi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\asuransi  $asuransi
     * @return \Illuminate\Http\Response
     */
    public function edit(asuransi $asuransi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateasuransiRequest  $request
     * @param  \App\Models\asuransi  $asuransi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateasuransiRequest $request, asuransi $asuransi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\asuransi  $asuransi
     * @return \Illuminate\Http\Response
     */
    public function destroy(asuransi $asuransi)
    {
        //
    }
}
