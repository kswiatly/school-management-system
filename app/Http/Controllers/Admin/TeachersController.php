<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Teacher;
use App\Role;
use Gate;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.teachers.index')->with('teachers', Teacher::paginate(10));
    }

    public function edit(Teacher $teacher)
    {
        if(Gate::denies('edit-teachers')){
            return redirect(route('admin.teachers.index'));
        }

        $roles = Role::all();

        return view('admin.teachers.edit')->with([
            'teacher' => $teacher,
        ]);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $teacher->roles()->sync($request->roles);
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        
        if($teacher->save()){
            $request->session()->flash('success', $teacher->name . ' has been updated');
        }
        else{
            $request->session()->flash('error','There was an error during updating the teacher');
        }

        return redirect()->route('admin.teachers.index');
    }
}
