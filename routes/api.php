<?php

use App\Http\Controllers\AssignationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasssController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () 
{
    Route::apiResource('classes', ClasssController::class);
    Route::apiResource('assignations', AssignationController::class);
    Route::apiResource('evaluations', EvaluationController::class);
    Route::apiResource('grades', GradeController::class);

    Route::prefix('auth')->group(function ()
    {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('register', [AuthController::class, 'register']);
    });
    
    Route::prefix('teachers')->group(function ()
    {
        Route::get('{id}/classes', [TeacherController::class, 'getClassesOfTeacher']);
    });

    Route::prefix('classes')->group(function ()
    {
       Route::get('{id}/students', [ClasssController::class, 'getStudentsOfClass']);
       Route::get('{id}/assignations', [ClasssController::class, 'getAssignationsOfClass']);
       Route::get('{id}/grades', [ClasssController::class, 'getGradesOfClass']);
       Route::get('{id}/evaluations', [ClasssController::class, 'getEvaluationsOfClass']);
       Route::post('{id}/removeStudent', [ClasssController::class, 'removeStudentFromClass']);
    });

    Route::prefix('assignations')->group(function ()
    {
       Route::get('{id}/student/{idStudent}/grade', [AssignationController::class, 'getGradeOfStudentInAssignation']);
       Route::get('{id}/grades', [AssignationController::class, 'getGradesOfAssignation']);
    });

});