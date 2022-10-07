<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomSOPRequest;
use App\Http\Requests\UpdateCustomSOPRequest;
use App\Models\CustomSOP;

class CustomSOPController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomSOPRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomSOPRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomSOP  $customSOP
     * @return \Illuminate\Http\Response
     */
    public function show(CustomSOP $customSOP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomSOP  $customSOP
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomSOP $customSOP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomSOPRequest  $request
     * @param  \App\Models\CustomSOP  $customSOP
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomSOPRequest $request, CustomSOP $customSOP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomSOP  $customSOP
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomSOP $customSOP)
    {
        //
    }
}
