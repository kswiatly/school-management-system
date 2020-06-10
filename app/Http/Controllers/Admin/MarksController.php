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
use Auth;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $mark = new Marks;
        $mark->timestamps = false;
        $student_id = DB::table('students')->where('user_id', $request->student)->value('id');
        if(Auth::user()->id==1)
        {
            $teacher_id = DB::table('teachers')->where('user_id', $request->teacher)->value('id');
        }
        else
        {
            $teacher_id = DB::table('teachers')->where('user_id', Auth::user()->id)->value('id');
        }

        
        $mark->teacher_id = $teacher_id;
        $mark->class_id = $request->class;
        $mark->subject_id = $request->subject;
        $mark->student_id = $student_id;
        $mark->mark = $request->mark;
        $mark->test_id = $request->test;


        if($mark->save())
        {
            $request->session()->flash('success', 'Mark has been created');
        }
        else{
            $request->session()->flash('error','There was an error during creating the mark');
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return redirect('/admin/marks');
    }

    public function destroy(Marks $mark)
    {
        if(Gate::denies('delete-marks')){
            return redirect()->route('admin.marks.index');
        }
        
        if($mark->delete()){
            session()->flash('success', 'Mark has been deleted');
        }
        else{
            session()->flash('error','There was an error during deleting the mark');
        }

        return redirect()->route('admin.marks.index');
    }

    public function edit(Marks $mark)
    {
        if(Gate::denies('edit-marks')){
            return redirect(route('admin.marks.index'));
        }

        $teachers = Teacher::all();
        $students = Student::all();
        $classes = Classes::all();
        $subjects = Subject::all();
        $tests = Test::all();
        
        return view('admin.marks.edit')->with([
            'classes' => $classes,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'students' => $students,
            'marks'=> $mark,
            'tests'=> $tests,
        ]);
    }

    public function update(Request $request, Marks $mark)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $mark->timestamps = false;
        $student_id = DB::table('students')->where('user_id', $request->student)->value('id');
        if(Auth::user()->id==1)
        {
            $teacher_id = DB::table('teachers')->where('user_id', $request->teacher)->value('id');
        }
        else
        {
            $teacher_id = DB::table('teachers')->where('user_id', Auth::user()->id)->value('id');
        }

        
        $mark->teacher_id = $teacher_id;
        $mark->class_id = $request->class;
        $mark->subject_id = $request->subject;
        $mark->student_id = $student_id;
        $mark->mark = $request->mark;
        $mark->test_id = $request->test;
        
        if($mark->save()){
            $request->session()->flash('success', 'Mark has been updated');
        }
        else{
            $request->session()->flash('error','There was an error during updating the mark');
        }

        return redirect()->route('admin.marks.index');
    }
}
