<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use App\Role;
use Gate;
use Illuminate\Http\Request;

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

        $roles = Role::all();

        return view('admin.students.edit')->with([
            'student' => $student,
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $student->roles()->sync($request->roles);
        $student->name = $request->name;
        $student->email = $request->email;
        
        if($student->save()){
            $request->session()->flash('success', $student->name . ' has been updated');
        }
        else{
            $request->session()->flash('error','There was an error during updating the student');
        }

        return redirect()->route('admin.students.index');
    }
}
