<?php

namespace App\Http\Controllers;

use App\Models\Assignation;
use App\Http\Requests\StoreAssignationRequest;
use App\Http\Requests\UpdateAssignationRequest;
use App\Models\Grade;

class AssignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignations = Assignation::with(['evaluation', 'classs'])->get();
        return response()->success($assignations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssignationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignationRequest $request)
    {
        $assignation = Assignation::create([
            "name" => $request->name,
            "description" => $request->description,
            "classs_id" => $request->classs_id,
            "evaluation_id" => $request->evaluation_id
        ]);

        return response()->success($assignation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignation  $assignation
     * @return \Illuminate\Http\Response
     */
    public function show(Assignation $assignation)
    {
        return response()->success($assignation);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignation  $assignation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignation $assignation)
    {
        $assignation->delete();
        return response()->success($assignation);
    }


    public function getGradeOfStudentInAssignation($idAssignation, $idStudent)
    {
        $grade = Grade::with(['student'])
            ->where('assignation_id', $idAssignation)->where('student_id', $idStudent)->first();
        return response()->success($grade);
    }

    public function getGradesOfAssignation($idAssignation)
    {
        $grades = Grade::with(['student'])->where('assignation_id', $idAssignation)->get();
        return response()->success($grades);
    }

}
