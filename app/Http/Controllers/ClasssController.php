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
use Illuminate\Http\Request;

class ClasssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classs::with(['teacher', 'teacher.user'])->get();
        return response()->success($classes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClasssRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClasssRequest $request)
    {
        $class = Classs::create([
            'name' => $request->name,
            'teacher_id' => $request->teacher_id
        ]);

        return response()->success($class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classs  $classs
     * @return \Illuminate\Http\Response
     */
    public function show(Classs $class)
    {
        return response()->success($class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClasssRequest  $request
     * @param  \App\Models\Classs  $classs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClasssRequest $request, Classs $class)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classs  $classs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classs $class)
    {
        $class->delete();
        return response()->success($class);
    }

    public function getStudentsOfClass($idClass)
    {
        $classes = ClassStudent::where('classs_id', $idClass)->get();

        $students = [];

        foreach($classes as $class)
        {
            $students[] = $class->student;
        }
        
        return response()->success($students);
    }

    public function getAssignationsOfClass($idClass)
    {
        $assignations = Assignation::where('classs_id', $idClass)->get();

        return response()->success($assignations);
    }

    public function getGradesOfClass($idClass)
    {

        $assignations = Assignation::where('classs_id', $idClass)->get();


        
        $classes = ClassStudent::where('classs_id', $idClass)->get();

        $students = [];

        foreach($classes as $class)
        {
            $students[] = $class->student;
        }



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
                $studentGrade[$key] = ($evals['obtained'] * $evals['percentage'])/($evals['totalAssignations'] * 100);
            }

            $studentGrade['student'] = $s;

            $studentsWithGrades[] = $studentGrade;

        }

        return response()->success($studentsWithGrades);
    }

    public function getEvaluationsOfClass($idClass)
    {
        $evaluations = Evaluation::where('classs_id', $idClass)->get();

        return response()->success($evaluations);
    }


}
