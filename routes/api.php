<?php

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
    Route::apiResource('teachers', TeacherController::class);//
    Route::apiResource('classes', ClasssController::class);//
    Route::apiResource('assignations', AssignationController::class);//

    Route::prefix('auth')->group(function ()
    {
        Route::post('login', [AuthController::class, 'login']);//
        Route::post('logout', [AuthController::class, 'logout']);//
        Route::post('register', [AuthController::class, 'register']);//
    });
    
    Route::prefix('teachers')->group(function ()
    {
        Route::get('{id}/classes', [ClasssController::class, 'getClassesOfTeacher']);//
    });

    Route::prefix('classes')->group(function ()
    {
       Route::get('{id}/students', [ClasssController::class, 'getStudentsOfClass']);//
       Route::get('{id}/students/{id}', [ClasssController::class, 'getStudentOfClass']);//
       Route::get('{id}/assignations', [ClasssController::class, 'getAssignationsOfClass']);//
       Route::get('{id}/grades', [ClasssController::class, 'getGradesOfClass']);//
    });

    Route::prefix('grades')->group(function ()
    {
       Route::get('assignations/{id}/students/{id}', [GradeController::class, 'getGradesOfStudentOfAssignation']);//
    });

});