<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetHotelImageRequest;
use App\Http\Requests\UpdatePetHotelImageRequest;
use App\Models\PetHotelImage;

class PetHotelImageController extends Controller
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
     * @param  \App\Http\Requests\StorePetHotelImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePetHotelImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PetHotelImage  $petHotelImage
     * @return \Illuminate\Http\Response
     */
    public function show(PetHotelImage $petHotelImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PetHotelImage  $petHotelImage
     * @return \Illuminate\Http\Response
     */
    public function edit(PetHotelImage $petHotelImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePetHotelImageRequest  $request
     * @param  \App\Models\PetHotelImage  $petHotelImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePetHotelImageRequest $request, PetHotelImage $petHotelImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PetHotelImage  $petHotelImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PetHotelImage $petHotelImage)
    {
        //
    }
}
