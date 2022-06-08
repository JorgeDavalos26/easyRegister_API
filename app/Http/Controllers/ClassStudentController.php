<?php

namespace App\Http\Controllers;

use App\Models\ClassStudent;
use App\Http\Requests\StoreClassStudentRequest;
use App\Http\Requests\UpdateClassStudentRequest;

class ClassStudentController extends Controller
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
     * @param  \App\Http\Requests\StoreClassStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassStudentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassStudent  $classStudent
     * @return \Illuminate\Http\Response
     */
    public function show(ClassStudent $classStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassStudent  $classStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassStudent $classStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassStudentRequest  $request
     * @param  \App\Models\ClassStudent  $classStudent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassStudentRequest $request, ClassStudent $classStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassStudent  $classStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassStudent $classStudent)
    {
        //
    }
}
