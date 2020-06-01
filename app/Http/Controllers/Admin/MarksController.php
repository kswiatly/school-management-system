<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Marks;
use App\Role;
use App\Teacher;
use App\Student;
use App\Classes;
use App\Subject;
use App\Test;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarksController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $marks = Marks::all();
        return view('admin.marks.index')->with('marks', Marks::paginate(10));
    }
    public function create(Marks $mark)
    {
        if(Gate::denies('create-marks')){
            return redirect(route('admin.marks.index'));
        }

        $teachers = Teacher::all();
        $students = Student::all();
        $classes = Classes::all();
        $subjects = Subject::all();
        $tests = Test::all();
        
        return view('admin.marks.create')->with([
            'classes' => $classes,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'students' => $students,
            'marks'=> $mark,
            'tests'=> $tests,
        ]);
    }

    public function store(Request $request)
    {
        $mark = new Marks;
        
        $mark->class_id = $request->name;
        $mark->teacher_id = $request->teacher;
        $mark->subject_id = $request->subject;
        $mark->student_id = $request->student;
        $mark->mark = $request->mark;
        $mark->test_id = $request->test;


        if($mark->save())
        {
            $request->session()->flash('success', $mark->mark . ' has been created');
        }
        else{
            $request->session()->flash('error','There was an error during creating the mark');
        }

        return redirect('/admin/marks');
    }
}
