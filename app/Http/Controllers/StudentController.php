<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
    }

    public function save_student(){
        $student = new Student;
        $student->name = request()->name;
        $student->email = request()->email;
        $student->phone = request()->phone;
        $student->save();
        return "ok";
    }
    public function all_students(){
        $students = Student::paginate(3);
        //as data is send to vue so it should be in form of json
        return response()->json($students);
    }

    public function edit_student($id){
        $student = Student::find($id);
        return response()->json($student);
    }
    public function updateStudent($id){
        $student = Student::find($id);
        $student->name = request()->name;
        $student->email = request()->email;
        $student->phone = request()->phone;
        $student->update();
    }
    public function deleteStudent($id){
        $student = Student::find($id);
        $student->delete();
    }
}
