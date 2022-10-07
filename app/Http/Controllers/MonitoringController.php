<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonitoringRequest;
use App\Http\Requests\UpdateMonitoringRequest;
use App\Models\Monitoring;

class MonitoringController extends Controller
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
     * @param  \App\Http\Requests\StoreMonitoringRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMonitoringRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function show(Monitoring $monitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitoring $monitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMonitoringRequest  $request
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMonitoringRequest $request, Monitoring $monitoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Monitoring  $monitoring
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monitoring $monitoring)
    {
        //
    }
}
