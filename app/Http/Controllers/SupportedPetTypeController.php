<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupportedPetTypeRequest;
use App\Http\Requests\UpdateSupportedPetTypeRequest;
use App\Models\SupportedPetType;

class SupportedPetTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreSupportedPetTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupportedPetTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupportedPetType  $supportedPetType
     * @return \Illuminate\Http\Response
     */
    public function show(SupportedPetType $supportedPetType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupportedPetType  $supportedPetType
     * @return \Illuminate\Http\Response
     */
    public function edit(SupportedPetType $supportedPetType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupportedPetTypeRequest  $request
     * @param  \App\Models\SupportedPetType  $supportedPetType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupportedPetTypeRequest $request, SupportedPetType $supportedPetType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupportedPetType  $supportedPetType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportedPetType $supportedPetType)
    {
        //
    }
}
