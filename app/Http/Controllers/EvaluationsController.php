<?php

namespace App\Http\Controllers;

use App\Models\Evaluations;
use App\Http\Requests\StoreEvaluationsRequest;
use App\Http\Requests\UpdateEvaluationsRequest;

class EvaluationsController extends Controller
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
     * @param  \App\Http\Requests\StoreEvaluationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvaluationsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluations $evaluations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluations $evaluations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEvaluationsRequest  $request
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvaluationsRequest $request, Evaluations $evaluations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluations $evaluations)
    {
        //
    }
}
