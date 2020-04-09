<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Teacher;
use App\Subject;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $subjects = Subject::all();

        return view('admin.teachers.edit')->with([
            'teacher' => $teacher,
            'subjects' => $subjects,
        ]);
    }

    public function update(Request $request, Teacher $teacher)
    {
        if($request->subjects==false){
            $request->session()->flash('warning','There was an error during updating the teacher. Teacher must be connected with at least one subject.');
            return redirect()->route('admin.teachers.index');
        }

        for($i=0; $i<count($request->subjects); $i++){
            $subjects_id[$i] = DB::table('subjects')->where('name', $request->subjects[$i])->value('id'); 
        }

        $teacher->subjects()->sync($subjects_id);

        if($teacher->save()){
            $request->session()->flash('success', $teacher->id . ' has been updated');
        }
        else{
            $request->session()->flash('error','There was an error during updating the teacher');
        }

        return redirect()->route('admin.teachers.index');
    }
}
