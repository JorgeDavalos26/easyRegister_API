<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Http\Requests\StoreClasssRequest;
use App\Http\Requests\UpdateClasssRequest;

class ClasssController extends Controller
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
     * @param  \App\Http\Requests\StoreClasssRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClasssRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classs  $classs
     * @return \Illuminate\Http\Response
     */
    public function show(Classs $classs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classs  $classs
     * @return \Illuminate\Http\Response
     */
    public function edit(Classs $classs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClasssRequest  $request
     * @param  \App\Models\Classs  $classs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClasssRequest $request, Classs $classs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classs  $classs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classs $classs)
    {
        //
    }
}
