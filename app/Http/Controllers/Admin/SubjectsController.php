<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use App\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index')->with('subjects', Subject::paginate(10));
    }

    public function create(Subject $subject)
    {
        if(Gate::denies('create-subjects')){
            return redirect(route('admin.subjects.index'));
        }

        return view('admin.subjects.create')->with([
            'subject' => $subject,
        ]);
    }

    public function store(Request $request)
    {
        $subject = new Subject;
        
        $subject->name = $request->name;
        $subject->description = $request->description;

        if($subject->save())
        {
            $request->session()->flash('success', $subject->name . ' has been created');
        }
        else{
            $request->session()->flash('error','There was an error during creating the subject');
        }

        return redirect('/admin/subjects');
    }

    public function edit(Subject $subject)
    {
        if(Gate::denies('edit-subjects')){
            return redirect(route('admin.subjects.index'));
        }

        return view('admin.subjects.edit')->with([
            'subject' => $subject,
        ]);
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->name = $request->name;
        $subject->description = $request->description;
        
        if($subject->save()){
            $request->session()->flash('success', $subject->name . ' has been updated');
        }
        else{
            $request->session()->flash('error','There was an error during updating the subject');
        }

        return redirect()->route('admin.subjects.index');
    }

    public function destroy(Subject $subject)
    {
        if(Gate::denies('delete-subjects')){
            return redirect()->route('admin.subjects.index');
        }
        
        if($subject->delete()){
            session()->flash('success', $subject->name . ' has been deleted');
        }
        else{
            session()->flash('error','There was an error during deleting the subject');
        }

        return redirect()->route('admin.subjects.index');
    }
}
