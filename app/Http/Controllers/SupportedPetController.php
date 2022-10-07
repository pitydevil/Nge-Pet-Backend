<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupportedPetRequest;
use App\Http\Requests\UpdateSupportedPetRequest;
use App\Models\SupportedPet;

class SupportedPetController extends Controller
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
     * @param  \App\Http\Requests\StoreSupportedPetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupportedPetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupportedPet  $supportedPet
     * @return \Illuminate\Http\Response
     */
    public function show(SupportedPet $supportedPet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupportedPet  $supportedPet
     * @return \Illuminate\Http\Response
     */
    public function edit(SupportedPet $supportedPet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupportedPetRequest  $request
     * @param  \App\Models\SupportedPet  $supportedPet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupportedPetRequest $request, SupportedPet $supportedPet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupportedPet  $supportedPet
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportedPet $supportedPet)
    {
        //
    }
}
