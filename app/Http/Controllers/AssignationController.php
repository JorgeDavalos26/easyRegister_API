<?php

namespace App\Http\Controllers;

use App\Models\Assignation;
use App\Http\Requests\StoreAssignationRequest;
use App\Http\Requests\UpdateAssignationRequest;

class AssignationController extends Controller
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
     * @param  \App\Http\Requests\StoreAssignationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignation  $assignation
     * @return \Illuminate\Http\Response
     */
    public function show(Assignation $assignation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignation  $assignation
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignation $assignation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssignationRequest  $request
     * @param  \App\Models\Assignation  $assignation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssignationRequest $request, Assignation $assignation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignation  $assignation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignation $assignation)
    {
        //
    }
}
