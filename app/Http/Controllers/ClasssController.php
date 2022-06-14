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
            'base' => $request->base,
            'teacher_id' => $request->teacher_id
        ]);

        $evals = json_decode($request->evaluations);

        foreach($evals as $e)
        {
            Evaluation::create([
                "name" => $e->name,
                "value" => $e->value,
                "classs_id" => $class->id,
            ]);
        }

        $students = json_decode($request->students);

        //return $students;

        //return var_dump($students);

        foreach($students as $student)
        {
            $student = Student::create([
                'firstname' => $student->firstname,
                'lastname' => $student->lastname,
                'email' => $student->email,
                'parent_whatsapp' => $student->parent_whatsapp,
                'number_list' => $student->number_list,
                'teacher_id' => $request->teacher_id
            ]);

            ClassStudent::create([
                'classs_id' => $class->id,
                'student_id' => $student->id
            ]);
        }

        $class = Classs::with(['evaluations'])->where('id', $class->id)->first();

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
        $class = Classs::find($idClass);

        $classes = ClassStudent::where('classs_id', $idClass)->get();

        $students = [];

        foreach($classes as $c)
        {
            $students[] = $c->student;
        }



        $evaluations = Evaluation::where('classs_id', $idClass)->get();


        


        $studentsWithGrades = [];

        foreach($students as $s)
        {
            /* $student = Student::where('id', $s->id)
                ->with(['grades', 'grades.assignation' => function($query) use ($idClass)
                {
                    $query->where('classs_id', $idClass);

                }, 'grades.assignation.evaluation'])->first();
            */

            /* $student = $student = Student::where('id', $s->id)
                ->with(['grades', 'grades.assignation' => function($query) use ($idClass)
                {
                    $query->whereHas('classs', function($query) 
                    {
                        $query->where('id', 1);
                    });

                }, 'grades.assignation.evaluation'])->first(); */

            $student = Student::where('id', $s->id)
                ->with(['grades' => function($query) use ($idClass)
                {
                    $query->whereHas('assignation', function($query) use ($idClass)
                    {
                        $query->whereHas('classs', function($query) use ($idClass)
                        {
                            $query->where('id', $idClass);
                        });
                    });

                }
                , 'grades.assignation', 'grades.assignation.evaluation'])->first();

            $evalPerGrade = [];
        
            foreach($evaluations as $e)
            {
                $numberAssignations = Assignation::where('classs_id', $idClass)
                    ->where('evaluation_id', $e->id)->count();

                $evalPerGrade[$e->name] = [
                    "evaluation" => $e,
                    "totalAssignations" => $numberAssignations,
                    "percentageToEvaluate" => $e->value,
                    "totalToEvaluate" => $class->base,
                    "totalObtained" => 0,
                    "totalAssignationsObtained" => 0
                ];
            }

            //return $evalPerGrade;

            foreach($student->grades as $grade)
            {
                $e = $grade->assignation->evaluation;
                $evalPerGrade[$e->name]["totalObtained"] += $grade->value;
                $evalPerGrade[$e->name]["totalAssignationsObtained"] += 1;
            }



            $studentGrade = [];

            $studentGrade = [
                "student_id" => $s->id,
                "student" => $s->firstname . " " . $s->lastname,
                "total" => 0,
            ];

            foreach($evaluations as $e)
            {
                $evl = (object)$evalPerGrade[$e->name];

                $studentGrade[strtolower($e->name)] = 
                    (($evl->totalObtained/$evl->totalAssignations)*$evl->percentageToEvaluate)/$evl->totalToEvaluate;

                $studentGrade["total"] += $studentGrade[strtolower($e->name)];
            }

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
