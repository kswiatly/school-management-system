<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Classes;
use App\Role;
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

    public function edit(Classes $class)
    {
        if(Gate::denies('edit-students')){
            return redirect(route('admin.students.index'));
        }

        $roles = Role::all();

        return view('admin.classes.edit')->with([
            'class' => $class,
        ]);
    }

    public function update(Request $request, Classes $class)
    {
        $class->roles()->sync($request->roles);
        $class->name = $request->name;
        $class->email = $request->email;
        
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

        $class->roles()->detach();
        
        if($class->delete()){
            session()->flash('success', $class->name . ' has been deleted');
        }
        else{
            session()->flash('error','There was an error during deleting the class');
        }

        return redirect()->route('admin.classes.index');
    }
}
