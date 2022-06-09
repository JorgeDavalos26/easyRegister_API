<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluations = Evaluation::with(['classs'])->get();
        return response()->success($evaluations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEvaluationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvaluationRequest $request)
    {
        $evaluation = Evaluation::create([
            'name' => $request->name,
            'value' => $request->value,
            'classs_id' => $request->classs_id,
        ]);

        return response()->success($evaluation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        return response()->success($evaluation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEvaluationsRequest  $request
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvaluationRequest $request, Evaluation $evaluations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return response()->success($evaluation);
    }
}
