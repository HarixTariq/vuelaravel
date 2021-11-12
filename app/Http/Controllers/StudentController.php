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
        $students = Student::paginate(1);
        //as data is send to vue so it should be in form of json
        return response()->json($students);
    }
}
