<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use App\Classes;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $students = Student::all();
        return view('admin.students.index')->with('students', Student::paginate(10));
    }

    public function edit(Student $student)
    {
        if(Gate::denies('edit-students')){
            return redirect(route('admin.students.index'));
        }

        $classes = Classes::all();

        return view('admin.students.edit')->with([
            'student' => $student,
            'classes' => $classes,
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $student->class_id = DB::table('classes')->where('name',$request->classes[0])->value('id');
        
        if($student->save()){
            $request->session()->flash('success', DB::table('users')->where('id', '=', $student->user_id)->value('name') . ' has been updated');
        }
        else{
            $request->session()->flash('error','There was an error during updating the student');
        }

        return redirect()->route('admin.students.index');
    }
}
