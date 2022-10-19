<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageDetailRequest;
use App\Http\Requests\UpdatePackageDetailRequest;
use App\Models\PackageDetail;

class PackageDetailController extends Controller
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
     * @param  \App\Http\Requests\StorePackageDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageDetail  $packageDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PackageDetail $packageDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageDetail  $packageDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageDetail $packageDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageDetailRequest  $request
     * @param  \App\Models\PackageDetail  $packageDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageDetailRequest $request, PackageDetail $packageDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageDetail  $packageDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageDetail $packageDetail)
    {
        //
    }
}
