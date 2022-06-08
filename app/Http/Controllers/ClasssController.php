<?php

namespace App\Http\Controllers;

use App\Models\Classs;
use App\Http\Requests\StoreClasssRequest;
use App\Http\Requests\UpdateClasssRequest;
use App\Models\Assignation;
use App\Models\ClassStudent;
use App\Models\Evaluation;
use App\Models\Evaluations;
use App\Models\Grade;
use App\Models\Student;

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

    public function getStudentsOfClass($idClass)
    {
        $classes = ClassStudent::where('classs_id', $idClass)->get();

        foreach($classes as $class)
        {
            $students[] = $class->student;
        }

        return response()->json();
    }

    public function getStudentOfClass($idClass, $idStudent)
    {
        $class = ClassStudent::where('classs_id', $idClass)->where('student_id', $idStudent)->first();

        $student = $class->student;

        return response()->json();
    }

    public function getAssignationsOfClass($idClass)
    {
        $assignations = Assignation::where('classs_id', $idClass)->get();

        return response()->json();
    }

    public function getGradesOfClass($idClass)
    {

        $assignations = Assignation::where('classs_id', $idClass)->get();


        
        $classes = ClassStudent::where('classs_id', $idClass)->get();

        foreach($classes as $class)
        {
            $students[] = $class->student;
        }




        $evaluations = Evaluation::where('classs_id', $idClass)->get();




        $studentsWithGrades = [];

        foreach($students as $s)
        {
            $student = Student::where('id', $s->id)
                ->with(['grades', 'grades.assignation' => function($query) use ($idClass)
                {
                    $query->where('classs_id', $idClass);

                }, 'grades.assignation.evaluation'])->first();


            $evaluationGrades = [];

            foreach($student->grades as $grade)
            {
                $evaluation = $grade->assignation->evaluation;

                if(!array_key_exists($evaluation->name, $evaluationGrades))
                {
                    $numberAssignations = Assignation::where('classs_id', $idClass)
                        ->where('evaluation_id', $evaluation->id)->count();

                    $evaluationGrades[$evaluation->name] = [
                        "obtained" => 0,
                        "percentage" => $evaluation->value,
                        "totalAssignations" => $numberAssignations
                    ];
                }

                $evaluationGrades[$evaluation->name]['obtained'] += $grade->value;
            }

            $studentGrade = [];

            foreach($evaluationGrades as $key => $evals)
            {
                $studentGrade[$key] = ($evals['obtained'] * $evals['percentage'])/$evals['totalAssignations'];
            }

            $studentsWithGrades[] = $studentGrade;

        }

        return response()->json();
    }

    public function getEvaluationsOfClass($idClass)
    {
        $evaluations = Evaluation::where('classs_id', $idClass)->get();

        return response()->json();
    }



    // util

    function getRecordById($id, $array)
    {
        foreach($array as $a) if($id == $a->id) return $a;
        return null;
    }


}
