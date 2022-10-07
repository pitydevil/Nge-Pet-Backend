<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storesop_generalRequest;
use App\Http\Requests\Updatesop_generalRequest;
use App\Models\sop_general;

class SopGeneralController extends Controller
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
     * @param  \App\Http\Requests\Storesop_generalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storesop_generalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sop_general  $sop_general
     * @return \Illuminate\Http\Response
     */
    public function show(sop_general $sop_general)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sop_general  $sop_general
     * @return \Illuminate\Http\Response
     */
    public function edit(sop_general $sop_general)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatesop_generalRequest  $request
     * @param  \App\Models\sop_general  $sop_general
     * @return \Illuminate\Http\Response
     */
    public function update(Updatesop_generalRequest $request, sop_general $sop_general)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sop_general  $sop_general
     * @return \Illuminate\Http\Response
     */
    public function destroy(sop_general $sop_general)
    {
        //
    }
}
