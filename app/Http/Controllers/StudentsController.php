<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        if(count($students) == 0){
            return response()->json(['status' => 'ok', "students" => "No hay estudiantes todavia"], 200);
        }else{
            return response()->json(['status' => 'ok', "students" => $students], 200);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student;

        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->age = $request->age;
        $student->email = $request->email;
        $student->course = $request->course;

        $student->save();

        return response()->json(["status" => "ok", "student_created" => $student], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->age = $request->age;
        $student->email = $request->email;
        $student->course = $request->course;

        $student->save();

        return response()->json(["status" => "ok", "student_updated" => $student], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return response()->json(["status" => "ok", "message" => "El estudiante fue eliminado"], 200);
    }
}
