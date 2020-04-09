<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Classes;
use App\Role;
use App\Teacher;
use App\Student;
use Gate;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $classes = Classes::all();
        return view('admin.classes.index')->with('classes', Classes::paginate(10));
    }

    public function create(Classes $class)
    {
        if(Gate::denies('create-classes')){
            return redirect(route('admin.classes.index'));
        }

        $teachers = Teacher::all();
        $students = Student::all();

        return view('admin.classes.create')->with([
            'class' => $class,
            'teachers' => $teachers,
            'students' => $students,
        ]);
    }

    public function store(Request $request)
    {
        $class = new Classes;
        
        $class->name = $request->name;
        $class->description = $request->description;
        $class->tutor_id = $request->tutor;
        $class->chairman_id = $request->chairman;

        if($class->save())
        {
            $request->session()->flash('success', $class->name . ' has been created');
        }
        else{
            $request->session()->flash('error','There was an error during creating the class');
        }

        return redirect('/admin/classes');
    }

    public function edit(Classes $class)
    {
        if(Gate::denies('edit-students')){
            return redirect(route('admin.classes.index'));
        }

        $teachers = Teacher::all();
        $students = Student::all();

        return view('admin.classes.edit')->with([
            'class' => $class,
            'teachers' => $teachers,
            'students' => $students,
        ]);
    }

    public function update(Request $request, Classes $class)
    {
        $class->name = $request->name;
        $class->description = $request->description;
        $class->tutor_id =  $request->tutor;
        $class->chairman_id =  $request->chairman;
        
        if($class->save()){
            $request->session()->flash('success', $class->name . ' has been updated');
        }
        else{
            $request->session()->flash('error','There was an error during updating the class');
        }

        return redirect()->route('admin.classes.index');
    }

    public function destroy(Classes $class)
    {
        if(Gate::denies('delete-classes')){
            return redirect()->route('admin.classes.index');
        }
        
        if($class->delete()){
            session()->flash('success', $class->name . ' has been deleted');
        }
        else{
            session()->flash('error','There was an error during deleting the class');
        }

        return redirect()->route('admin.classes.index');
    }
}
