<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetHotelRequest;
use App\Http\Requests\UpdatePetHotelRequest;
use App\Models\PetHotel;

class PetHotelController extends Controller
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
     * @param  \App\Http\Requests\StorePetHotelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePetHotelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PetHotel  $petHotel
     * @return \Illuminate\Http\Response
     */
    public function show(PetHotel $petHotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PetHotel  $petHotel
     * @return \Illuminate\Http\Response
     */
    public function edit(PetHotel $petHotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePetHotelRequest  $request
     * @param  \App\Models\PetHotel  $petHotel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePetHotelRequest $request, PetHotel $petHotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PetHotel  $petHotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetHotel $petHotel)
    {
        //
    }
}
